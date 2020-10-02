<?php

namespace rizwanjiwan\probatio\storage\propel\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use rizwanjiwan\probatio\storage\propel\Variants as ChildVariants;
use rizwanjiwan\probatio\storage\propel\VariantsQuery as ChildVariantsQuery;
use rizwanjiwan\probatio\storage\propel\Map\VariantsTableMap;

/**
 * Base class that represents a query for the 'variants' table.
 *
 *
 *
 * @method     ChildVariantsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildVariantsQuery orderBytestId($order = Criteria::ASC) Order by the test_id column
 * @method     ChildVariantsQuery orderByVariantName($order = Criteria::ASC) Order by the variant_name column
 * @method     ChildVariantsQuery orderByMetadata($order = Criteria::ASC) Order by the metadata column
 * @method     ChildVariantsQuery orderByCreated($order = Criteria::ASC) Order by the created column
 * @method     ChildVariantsQuery orderByUpdated($order = Criteria::ASC) Order by the updated column
 *
 * @method     ChildVariantsQuery groupById() Group by the id column
 * @method     ChildVariantsQuery groupBytestId() Group by the test_id column
 * @method     ChildVariantsQuery groupByVariantName() Group by the variant_name column
 * @method     ChildVariantsQuery groupByMetadata() Group by the metadata column
 * @method     ChildVariantsQuery groupByCreated() Group by the created column
 * @method     ChildVariantsQuery groupByUpdated() Group by the updated column
 *
 * @method     ChildVariantsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildVariantsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildVariantsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildVariantsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildVariantsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildVariantsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildVariantsQuery leftJoinTests($relationAlias = null) Adds a LEFT JOIN clause to the query using the Tests relation
 * @method     ChildVariantsQuery rightJoinTests($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Tests relation
 * @method     ChildVariantsQuery innerJoinTests($relationAlias = null) Adds a INNER JOIN clause to the query using the Tests relation
 *
 * @method     ChildVariantsQuery joinWithTests($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Tests relation
 *
 * @method     ChildVariantsQuery leftJoinWithTests() Adds a LEFT JOIN clause and with to the query using the Tests relation
 * @method     ChildVariantsQuery rightJoinWithTests() Adds a RIGHT JOIN clause and with to the query using the Tests relation
 * @method     ChildVariantsQuery innerJoinWithTests() Adds a INNER JOIN clause and with to the query using the Tests relation
 *
 * @method     ChildVariantsQuery leftJoinAssignedVariants($relationAlias = null) Adds a LEFT JOIN clause to the query using the AssignedVariants relation
 * @method     ChildVariantsQuery rightJoinAssignedVariants($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AssignedVariants relation
 * @method     ChildVariantsQuery innerJoinAssignedVariants($relationAlias = null) Adds a INNER JOIN clause to the query using the AssignedVariants relation
 *
 * @method     ChildVariantsQuery joinWithAssignedVariants($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the AssignedVariants relation
 *
 * @method     ChildVariantsQuery leftJoinWithAssignedVariants() Adds a LEFT JOIN clause and with to the query using the AssignedVariants relation
 * @method     ChildVariantsQuery rightJoinWithAssignedVariants() Adds a RIGHT JOIN clause and with to the query using the AssignedVariants relation
 * @method     ChildVariantsQuery innerJoinWithAssignedVariants() Adds a INNER JOIN clause and with to the query using the AssignedVariants relation
 *
 * @method     \rizwanjiwan\probatio\storage\propel\TestsQuery|\rizwanjiwan\probatio\storage\propel\AssignedVariantsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildVariants findOne(ConnectionInterface $con = null) Return the first ChildVariants matching the query
 * @method     ChildVariants findOneOrCreate(ConnectionInterface $con = null) Return the first ChildVariants matching the query, or a new ChildVariants object populated from the query conditions when no match is found
 *
 * @method     ChildVariants findOneById(int $id) Return the first ChildVariants filtered by the id column
 * @method     ChildVariants findOneBytestId(int $test_id) Return the first ChildVariants filtered by the test_id column
 * @method     ChildVariants findOneByVariantName(string $variant_name) Return the first ChildVariants filtered by the variant_name column
 * @method     ChildVariants findOneByMetadata(string $metadata) Return the first ChildVariants filtered by the metadata column
 * @method     ChildVariants findOneByCreated(string $created) Return the first ChildVariants filtered by the created column
 * @method     ChildVariants findOneByUpdated(string $updated) Return the first ChildVariants filtered by the updated column *

 * @method     ChildVariants requirePk($key, ConnectionInterface $con = null) Return the ChildVariants by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVariants requireOne(ConnectionInterface $con = null) Return the first ChildVariants matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVariants requireOneById(int $id) Return the first ChildVariants filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVariants requireOneBytestId(int $test_id) Return the first ChildVariants filtered by the test_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVariants requireOneByVariantName(string $variant_name) Return the first ChildVariants filtered by the variant_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVariants requireOneByMetadata(string $metadata) Return the first ChildVariants filtered by the metadata column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVariants requireOneByCreated(string $created) Return the first ChildVariants filtered by the created column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVariants requireOneByUpdated(string $updated) Return the first ChildVariants filtered by the updated column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVariants[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildVariants objects based on current ModelCriteria
 * @method     ChildVariants[]|ObjectCollection findById(int $id) Return ChildVariants objects filtered by the id column
 * @method     ChildVariants[]|ObjectCollection findBytestId(int $test_id) Return ChildVariants objects filtered by the test_id column
 * @method     ChildVariants[]|ObjectCollection findByVariantName(string $variant_name) Return ChildVariants objects filtered by the variant_name column
 * @method     ChildVariants[]|ObjectCollection findByMetadata(string $metadata) Return ChildVariants objects filtered by the metadata column
 * @method     ChildVariants[]|ObjectCollection findByCreated(string $created) Return ChildVariants objects filtered by the created column
 * @method     ChildVariants[]|ObjectCollection findByUpdated(string $updated) Return ChildVariants objects filtered by the updated column
 * @method     ChildVariants[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class VariantsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \rizwanjiwan\probatio\storage\propel\Base\VariantsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\rizwanjiwan\\probatio\\storage\\propel\\Variants', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildVariantsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildVariantsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildVariantsQuery) {
            return $criteria;
        }
        $query = new ChildVariantsQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildVariants|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VariantsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = VariantsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildVariants A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, test_id, variant_name, metadata, created, updated FROM variants WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildVariants $obj */
            $obj = new ChildVariants();
            $obj->hydrate($row);
            VariantsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildVariants|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildVariantsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(VariantsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildVariantsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(VariantsTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVariantsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(VariantsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(VariantsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VariantsTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the test_id column
     *
     * Example usage:
     * <code>
     * $query->filterBytestId(1234); // WHERE test_id = 1234
     * $query->filterBytestId(array(12, 34)); // WHERE test_id IN (12, 34)
     * $query->filterBytestId(array('min' => 12)); // WHERE test_id > 12
     * </code>
     *
     * @see       filterByTests()
     *
     * @param     mixed $testId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVariantsQuery The current query, for fluid interface
     */
    public function filterBytestId($testId = null, $comparison = null)
    {
        if (is_array($testId)) {
            $useMinMax = false;
            if (isset($testId['min'])) {
                $this->addUsingAlias(VariantsTableMap::COL_TEST_ID, $testId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($testId['max'])) {
                $this->addUsingAlias(VariantsTableMap::COL_TEST_ID, $testId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VariantsTableMap::COL_TEST_ID, $testId, $comparison);
    }

    /**
     * Filter the query on the variant_name column
     *
     * Example usage:
     * <code>
     * $query->filterByVariantName('fooValue');   // WHERE variant_name = 'fooValue'
     * $query->filterByVariantName('%fooValue%', Criteria::LIKE); // WHERE variant_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $variantName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVariantsQuery The current query, for fluid interface
     */
    public function filterByVariantName($variantName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($variantName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VariantsTableMap::COL_VARIANT_NAME, $variantName, $comparison);
    }

    /**
     * Filter the query on the metadata column
     *
     * Example usage:
     * <code>
     * $query->filterByMetadata('fooValue');   // WHERE metadata = 'fooValue'
     * $query->filterByMetadata('%fooValue%', Criteria::LIKE); // WHERE metadata LIKE '%fooValue%'
     * </code>
     *
     * @param     string $metadata The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVariantsQuery The current query, for fluid interface
     */
    public function filterByMetadata($metadata = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($metadata)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VariantsTableMap::COL_METADATA, $metadata, $comparison);
    }

    /**
     * Filter the query on the created column
     *
     * Example usage:
     * <code>
     * $query->filterByCreated('2011-03-14'); // WHERE created = '2011-03-14'
     * $query->filterByCreated('now'); // WHERE created = '2011-03-14'
     * $query->filterByCreated(array('max' => 'yesterday')); // WHERE created > '2011-03-13'
     * </code>
     *
     * @param     mixed $created The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVariantsQuery The current query, for fluid interface
     */
    public function filterByCreated($created = null, $comparison = null)
    {
        if (is_array($created)) {
            $useMinMax = false;
            if (isset($created['min'])) {
                $this->addUsingAlias(VariantsTableMap::COL_CREATED, $created['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($created['max'])) {
                $this->addUsingAlias(VariantsTableMap::COL_CREATED, $created['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VariantsTableMap::COL_CREATED, $created, $comparison);
    }

    /**
     * Filter the query on the updated column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdated('2011-03-14'); // WHERE updated = '2011-03-14'
     * $query->filterByUpdated('now'); // WHERE updated = '2011-03-14'
     * $query->filterByUpdated(array('max' => 'yesterday')); // WHERE updated > '2011-03-13'
     * </code>
     *
     * @param     mixed $updated The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVariantsQuery The current query, for fluid interface
     */
    public function filterByUpdated($updated = null, $comparison = null)
    {
        if (is_array($updated)) {
            $useMinMax = false;
            if (isset($updated['min'])) {
                $this->addUsingAlias(VariantsTableMap::COL_UPDATED, $updated['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updated['max'])) {
                $this->addUsingAlias(VariantsTableMap::COL_UPDATED, $updated['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VariantsTableMap::COL_UPDATED, $updated, $comparison);
    }

    /**
     * Filter the query by a related \rizwanjiwan\probatio\storage\propel\Tests object
     *
     * @param \rizwanjiwan\probatio\storage\propel\Tests|ObjectCollection $tests The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildVariantsQuery The current query, for fluid interface
     */
    public function filterByTests($tests, $comparison = null)
    {
        if ($tests instanceof \rizwanjiwan\probatio\storage\propel\Tests) {
            return $this
                ->addUsingAlias(VariantsTableMap::COL_TEST_ID, $tests->getId(), $comparison);
        } elseif ($tests instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(VariantsTableMap::COL_TEST_ID, $tests->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTests() only accepts arguments of type \rizwanjiwan\probatio\storage\propel\Tests or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Tests relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildVariantsQuery The current query, for fluid interface
     */
    public function joinTests($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Tests');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Tests');
        }

        return $this;
    }

    /**
     * Use the Tests relation Tests object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \rizwanjiwan\probatio\storage\propel\TestsQuery A secondary query class using the current class as primary query
     */
    public function useTestsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTests($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Tests', '\rizwanjiwan\probatio\storage\propel\TestsQuery');
    }

    /**
     * Filter the query by a related \rizwanjiwan\probatio\storage\propel\AssignedVariants object
     *
     * @param \rizwanjiwan\probatio\storage\propel\AssignedVariants|ObjectCollection $assignedVariants the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildVariantsQuery The current query, for fluid interface
     */
    public function filterByAssignedVariants($assignedVariants, $comparison = null)
    {
        if ($assignedVariants instanceof \rizwanjiwan\probatio\storage\propel\AssignedVariants) {
            return $this
                ->addUsingAlias(VariantsTableMap::COL_ID, $assignedVariants->getVariantId(), $comparison);
        } elseif ($assignedVariants instanceof ObjectCollection) {
            return $this
                ->useAssignedVariantsQuery()
                ->filterByPrimaryKeys($assignedVariants->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByAssignedVariants() only accepts arguments of type \rizwanjiwan\probatio\storage\propel\AssignedVariants or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AssignedVariants relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildVariantsQuery The current query, for fluid interface
     */
    public function joinAssignedVariants($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AssignedVariants');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'AssignedVariants');
        }

        return $this;
    }

    /**
     * Use the AssignedVariants relation AssignedVariants object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \rizwanjiwan\probatio\storage\propel\AssignedVariantsQuery A secondary query class using the current class as primary query
     */
    public function useAssignedVariantsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAssignedVariants($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AssignedVariants', '\rizwanjiwan\probatio\storage\propel\AssignedVariantsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildVariants $variants Object to remove from the list of results
     *
     * @return $this|ChildVariantsQuery The current query, for fluid interface
     */
    public function prune($variants = null)
    {
        if ($variants) {
            $this->addUsingAlias(VariantsTableMap::COL_ID, $variants->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the variants table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VariantsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            VariantsTableMap::clearInstancePool();
            VariantsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VariantsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(VariantsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            VariantsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            VariantsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // VariantsQuery
