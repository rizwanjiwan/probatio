<?php
namespace rizwanjiwan\probatio\storage;
use Propel\Runtime\Exception\PropelException;
use rizwanjiwan\probatio\payloads\v1\CreatePayload;
use rizwanjiwan\probatio\payloads\v1\VariantsPayload;
use rizwanjiwan\probatio\storage\propel\AssignedVariants;
use rizwanjiwan\probatio\storage\propel\ExternalVisitors;
use rizwanjiwan\probatio\storage\propel\ExternalVisitorsQuery;
use rizwanjiwan\probatio\storage\propel\Tests;
use rizwanjiwan\probatio\storage\propel\TestsQuery;
use rizwanjiwan\probatio\storage\propel\Variants;
use rizwanjiwan\probatio\storage\propel\VariantsQuery;
use rizwanjiwan\probatio\storage\propel\Visitors;
use rizwanjiwan\probatio\storage\propel\VisitorsQuery;

/**
 * Class PropelStorage
 * Stores stuff using Propel to some DB
 */

class PropelStorage extends AbstractStorage
{

    /**
     * Create a new test
     * @param $createPayload CreatePayload
     * @throws StorageException|PropelException
     */
    public function createTest($createPayload)
    {
        //already exists? If not, create
        if(TestsQuery::create()->filterByTestName($createPayload->test_name)->findOne()!==null)
            throw new StorageException('Test '.$createPayload->test_name.' already exists');
        $test=new Tests();
        $test->setTestName($createPayload->test_name);
        $test->save();
        foreach($createPayload->variants as $variant)
        {
            $variantDb=new Variants();
            $variantDb
                ->setTests($test)
                ->setVariantName($variant->name)
                ->setMetadata($variant->metaData)
                ->save();
        }
    }
    /**
     * Create a visitor based on external id. Assumption is that this external visitor doesn't already exist (who hasn't expired).
     * @param $type string the type of id this is
     * @param $externalVisitorId string the external id
     * @param $expiry int when this id would expire and no longer link to this visitor. Returns 0 if the id never expires.
     * @param $internalVisitorId int|null null to have an internalVisitorId created. Otherwise use this id specified.
     * @return int internal to this storage system visitor id or null if the visitorId doesn't exist
     * @throws PropelException
     */
    protected function createVisitor($type, $externalVisitorId, $expiry, $internalVisitorId = null)
    {
        //create external visitor id
        $externalVisitor=new ExternalVisitors();
        $externalVisitor
            ->setExternalIdType($type)
            ->setExternalVisitorId($externalVisitorId)
            ->setExpires($expiry);
        //create or load the visitor as needed
        $visitor=null;
        if($internalVisitorId!==null)
            $visitor=VisitorsQuery::create()->filterById($internalVisitorId)->findOne();
        else
        {
            $visitor=new Visitors();
            $visitor->save();
        }
        $externalVisitor
            ->setInternalVisitors($visitor)
            ->save();
        return $visitor->getId();
    }

    /**
     * Get the visitor based on external id
     * @param $type string the type of id this is
     * @param $externalVisitorId string the external id
     * @param null|int $updatedExpiry an expiry time to update this visitor link to in the event it does exist
     * @return int|null internal to this storage system visitor id or null if it doesn't exist
     * @throws PropelException
     */
    protected function getVisitor($type, $externalVisitorId, $updatedExpiry = null)
    {
        $q=ExternalVisitorsQuery::create();
        //complex query, see combine line to make it easy to understand
        $q->condition('externalTypeId','ExternalVisitors.external_id_type=?',$type);
        $q->condition('externalVisitorId','ExternalVisitors.external_visitor_id=?',$externalVisitorId);
        $q->condition('expiryInfinite','ExternalVisitors.expires=?',0);
        $q->condition('expiryFuture','ExternalVisitors.expires>=?',time());
        $q->combine(array('expiryInfinite', 'expiryFuture'), 'or', 'expiry');
        $q->combine(array('externalTypeId', 'externalVisitorId','expiry'), 'and');
        //grab the first one (there might be multiple based on the schema but our assumption in create is that the caller has already checked)
        $externalVisitor=$q->findOne();
        if($externalVisitor===null)
            return null;
        if($updatedExpiry!==null)
            $externalVisitor->setExpires($updatedExpiry)->save();
        return $externalVisitor->getInternalVisitorId();
    }


    /**
     * Assign a test variant assigned to a given visitor.
     * Assumption that the caller has already checked if the visitor is already assigned a variant for this test.
     * @param $testName string the test name
     * @param $internalVisitorId int the internal visitor id to this storage system
     * @param $variantName string to assign
     * @throws StorageException
     * @throws PropelException
     */
    protected function assignVariant($testName, $internalVisitorId, $variantName)
    {
        // get the variant/visitor, validate stuff, assign
        $variant=VariantsQuery::create()
            ->filterByVariantName($variantName)
            ->useTestsQuery()
                ->filterByTestName($testName)
            ->endUse()
            ->findOne();
        if($variant===null)
            throw new StorageException('Invalid test or variant name');
        (new AssignedVariants())
            ->setVariants($variant)
            ->setInternalVisitorId($internalVisitorId)
            ->save();
    }

    /**
     * Get the name of a test variant assigned to a given visitor
     * @param $testName string the test name
     * @param $internalVisitorId int the internal visitor id to this storage system
     * @return VariantsPayload|null the name of an assigned test variant or null if no such variant exists
     * @throws StorageException|PropelException
     */
    protected function getAssignedVariant($testName, $internalVisitorId)
    {
        //get teh test, get the variant assigned, shove into a payload and return
        $test=TestsQuery::create()->filterByTestName($testName)->findOne();
        if($test===null)
            throw new StorageException('Invalid test name');
        $variant=VariantsQuery::create()
            ->filterByTests($test)
            ->useAssignedVariantsQuery()
                ->filterByInternalVisitorId($internalVisitorId)
            ->endUse()
            ->find();
        if(count($variant)===0)
            return null;
        else if(count($variant)>1)  //it's a bad moon
            throw new StorageException('Assigned '.count($variant).' variants.');
        return $variant[0]->toPayload();
    }

    /**
     * Get all the variants for a given test
     * @param $testName string name of the test
     * @return VariantsPayload[] all the variants for this test
     * @throws StorageException
     */
    protected function getAllVariants($testName)
    {
        //find variants, push them into the variant payload format, return
        $variants=VariantsQuery::create()
            ->useTestsQuery()
                ->filterByTestName($testName)
            ->endUse()
            ->find();
        if(count($variants)===0)
            throw new StorageException('No variants for that test');
        $variantsPayload=array();
        foreach($variants as $variant)
            array_push($variantsPayload,$variant->toPayload());
        return $variantsPayload;
    }
}