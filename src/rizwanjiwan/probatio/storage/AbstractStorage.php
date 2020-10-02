<?php
namespace rizwanjiwan\probatio\storage;

use rizwanjiwan\probatio\payloads\v1\CreatePayload;
use rizwanjiwan\probatio\payloads\v1\VariantsPayload;
use rizwanjiwan\probatio\payloads\v1\VisitorIdPayload;

/**
 * Wraps magic that persists stuff we want to store
 */

abstract class AbstractStorage
{

    /**
     * Create a new test
     * @param $createPayload CreatePayload
     * @throws StorageException
     */
    public abstract function createTest($createPayload);

    /**
     * Get the visitor based on external id
     * @param $type string the type of id this is
     * @param $externalVisitorId string the external id
     * @param null|int $updatedExpiry an expiry time to update this visitor link to in the event it does exist
     * @return int|null internal to this storage system visitor id or null if it doesn't exist
     * @throws StorageException
     */
    protected abstract function getVisitor($type,$externalVisitorId,$updatedExpiry=null);

    /**
     * Create a visitor based on external id. Assumption is that this external visitor doesn't already exist (who hasn't expired).
     * @param $type string the type of id this is
     * @param $externalVisitorId string the external id
     * @param $expiry int when this id would expire and no longer link to this visitor. Returns 0 if the id never expires.
     * @param $internalVisitorId int|null null to have an internalVisitorId created. Otherwise use this id specified.
     * @return int internal to this storage system visitor id or null if the visitorId doesn't exist
     * @throws StorageException
     */
    protected abstract function createVisitor($type,$externalVisitorId,$expiry,$internalVisitorId=null);

    /**
     * Get the name of a test variant assigned to a given visitor
     * @param $testName string the test name
     * @param $internalVisitorId int the internal visitor id to this storage system
     * @return VariantsPayload|null the name of an assigned test variant or null if no such test exists
     * @throws StorageException
     */
    protected abstract function getAssignedVariant($testName, $internalVisitorId);

    /**
     * Assign a test variant assigned to a given visitor.
     * Assumption that the caller has already checked if the visitor is already assigned a variant for this test.
     * @param $testName string the test name
     * @param $internalVisitorId int the internal visitor id to this storage system
     * @param $variantName string to assign
     * @throws StorageException
     */
    protected abstract function assignVariant($testName, $internalVisitorId, $variantName);

    /**
     * Get all the variants for a given test
     * @param $testName string name of the test
     * @return VariantsPayload[] all the variants for this test
     * @throws StorageException
     */
    protected abstract function getAllVariants($testName);

    /**
     * Create a visitor based on an external id
     * @param $visitorIdPayload VisitorIdPayload
     * @return int internal to this storage system visitor id
     * @throws StorageException
     */
    public function getOrCreateVisitor($visitorIdPayload)
    {
        $existingVisitorId=$this->getVisitor($visitorIdPayload->type,$visitorIdPayload->id,$visitorIdPayload->expiry);
        if($existingVisitorId!==null)
            return $existingVisitorId;
        return $this->createVisitor($visitorIdPayload->type,$visitorIdPayload->id,$visitorIdPayload->expiry);
    }

    /**
     * Will roll the dice (or grab a previously rolled result if it was already done for this visitor)
     * @param $testName string the test name you want the variant for
     * @param $internalVisitorId int the internal visitor id to this storage system
     * @return VariantsPayload the variant that this visitorId has been assigned
     * @throws StorageException
     */
    public function rollDice($testName, $internalVisitorId)
    {
        //has this visitor been assigned an ID? If not, roll, if so, return the already existing roll
        $variant=$this->getAssignedVariant($testName,$internalVisitorId);
        if($variant!==null)
            return $variant;
        $variants=$this->getAllVariants($testName);
        $numVariants=count($variants);
        $randNum=rand(0,$numVariants-1);
        $variant=$variants[$randNum];
        $this->assignVariant($testName,$internalVisitorId,$variant->name);
        return $variant;
    }

    /**
     * @param $visitor1 VisitorIdPayload
     * @param $visitor2 VisitorIdPayload
     * @throws StorageException
     */
    public function associate($visitor1, $visitor2)
    {
        if(strcmp($visitor1->type,$visitor2->type)===0)
            throw new StorageException('Can\'t link the same visitor type with different IDs: '.$visitor1->type);
        $visitor1InternalId=$this->getVisitor($visitor1->type,$visitor1->id);
        $visitor2InternalId=$this->getVisitor($visitor2->type,$visitor2->id);
        if($visitor1InternalId!==null)  //see if we can link #2 to #1's internal id
        {
            if($visitor2InternalId!==null)
            {
                if($visitor1InternalId===$visitor2InternalId)//all good, already linked
                    return;
                throw new StorageException('The two ids are already linked to different visitors');
            }
            $this->createVisitor($visitor2->type,$visitor2->id,$visitor2->expiry,$visitor1InternalId);
        }
        else if($visitor2InternalId!==null)//see if we can link #1 to #2's internal id
        {
            if($visitor1InternalId!==null)
            {
                if($visitor1InternalId===$visitor2InternalId)//all good, already linked
                    return;
                throw new StorageException('The two ids are already linked to different visitors');
            }
            $this->createVisitor($visitor1->type,$visitor1->id,$visitor1->expiry,$visitor2InternalId);
        }
        else//create visitor #1, assign #2 to that one
        {
            $visitor1InternalId=$this->createVisitor($visitor1->type,$visitor1->id,$visitor1->expiry);
            $this->createVisitor($visitor2->type,$visitor2->id,$visitor2->expiry,$visitor1InternalId);
        }
    }



}