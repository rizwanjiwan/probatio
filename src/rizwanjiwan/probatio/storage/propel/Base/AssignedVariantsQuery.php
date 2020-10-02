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
use rizwanjiwan\probatio\storage\propel\AssignedVariants as ChildAssignedVariants;
use rizwanjiwan\probatio\storage\propel\AssignedVariantsQuery as ChildAssignedVariantsQuery;
use rizwanjiwan\probatio\storage\propel\Map\AssignedVariantsTableMap;

/**
 * Base class that represents a query for the 'assigned_variants' table.
 *
 *
 *
 * @method     ChildAssignedVariantsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildAssignedVariantsQuery orderByInternalVisitorId($order = Criteria::ASC) Order by the internal_visitor_id column
 * @method     ChildAssignedVariantsQuery orderByVariantId($order = Criteria::ASC) Order by the variant_id column
 * @method     ChildAssignedVariantsQuery orderByCreated($order = Criteria::ASC) Order by the created column
 * @method     ChildAssignedVariantsQuery orderByUpdated($order = Criteria::ASC) Order by the updated column
 *
 * @method     ChildAssignedVariantsQuery groupById() Group by the id column
 * @method     ChildAssignedVariantsQuery groupByInternalVisitorId() Group by the internal_visitor_id column
 * @method     ChildAssignedVariantsQuery groupByVariantId() Group by the variant_id column
 * @method     ChildAssignedVariantsQuery groupByCreated() Group by the created column
 * @method     ChildAssignedVariantsQuery groupByUpdated() Group by the updated column
 *
 * @method     ChildAssignedVariantsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAssignedVariantsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAssignedVariantsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAssignedVariantsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAssignedVariantsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAssignedVariantsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAssignedVariantsQuery leftJoinVisitors($relationAlias = null) Adds a LEFT JOIN clause to the query using the Visitors relation
 * @method     ChildAssignedVariantsQuery rightJoinVisitors($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Visitors relation
 * @method     ChildAssignedVariantsQuery innerJoinVisitors($relationAlias = null) Adds a INNER JOIN clause to the query using the Visitors relation
 *
 * @method     ChildAssignedVariantsQuery joinWithVisitors($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Visitors relation
 *
 * @method     ChildAssignedVariantsQuery leftJoinWithVisitors() Adds a LEFT JOIN clause and with to the query using the Visitors relation
 * @method     ChildAssignedVariantsQuery rightJoinWithVisitors() Adds a RIGHT JOIN clause and with to the query using the Visitors relation
 * @method     ChildAssignedVariantsQuery innerJoinWithVisitors() Adds a INNER JOIN clause and with to the query using the Visitors relation
 *
 * @method     ChildAssignedVariantsQuery leftJoinVariants($relationAlias = null) Adds a LEFT JOIN clause to the query using the Variants relation
 * @method     ChildAssignedVariantsQuery rightJoinVariants($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Variants relation
 * @method     ChildAssignedVariantsQuery innerJoinVariants($relationAlias = null) Adds a INNER JOIN clause to the query using the Variants relation
 *
 * @method     ChildAssignedVariantsQuery joinWithVariants($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Variants relation
 *
 * @method     ChildAssignedVariantsQuery leftJoinWithVariants() Adds a LEFT JOIN clause and with to the query using the Variants relation
 * @method     ChildAssignedVariantsQuery rightJoinWithVariants() Adds a RIGHT JOIN clause and with to the query using the Variants relation
 * @method     ChildAssignedVariantsQuery innerJoinWithVariants() Adds a INNER JOIN clause and with to the query using the Variants relation
 *
 * @method     \rizwanjiwan\probatio\storage\propel\VisitorsQuery|\rizwanjiwan\probatio\storage\propel\VariantsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAssignedVariants findOne(ConnectionInterface $con = null) Return the first ChildAssignedVariants matching the query
 * @method     ChildAssignedVariants findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAssignedVariants matching the query, or a new ChildAssignedVariants object populated from the query conditions when no match is found
 *
 * @method     ChildAssignedVariants findOneById(int $id) Return the first ChildAssignedVariants filtered by the id column
 * @method     ChildAssignedVariants findOneByInternalVisitorId(int $internal_visitor_id) Return the first ChildAssignedVariants filtered by the internal_visitor_id column
 * @method     ChildAssignedVariants findOneByVariantId(int $variant_id) Return the first ChildAssignedVariants filtered by the variant_id column
 * @method     ChildAssignedVariants findOneByCreated(string $created) Return the first ChildAssignedVariants filtered by the created column
 * @method     ChildAssignedVariants findOneByUpdated(string $updated) Return the first ChildAssignedVariants filtered by the updated column *

 * @method     ChildAssignedVariants requirePk($key, ConnectionInterface $con = null) Return the ChildAssignedVariants by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAssignedVariants requireOne(ConnectionInterface $con = null) Return the first ChildAssignedVariants matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAssignedVariants requireOneById(int $id) Return the first ChildAssignedVariants filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAssignedVariants requireOneByInternalVisitorId(int $internal_visitor_id) Return the first ChildAssignedVariants filtered by the internal_visitor_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAssignedVariants requireOneByVariantId(int $variant_id) Return the first ChildAssignedVariants filtered by the variant_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAssignedVariants requireOneByCreated(string $created) Return the first ChildAssignedVariants filtered by the created column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAssignedVariants requireOneByUpdated(string $updated) Return the first ChildAssignedVariants filtered by the updated column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAssignedVariants[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildAssignedVariants objects based on current ModelCriteria
 * @method     ChildAssignedVariants[]|ObjectCollection findById(int $id) Return ChildAssignedVariants objects filtered by the id column
 * @method     ChildAssignedVariants[]|ObjectCollection findByInternalVisitorId(int $internal_visitor_id) Return ChildAssignedVariants objects filtered by the internal_visitor_id column
 * @method     ChildAssignedVariants[]|ObjectCollection findByVariantId(int $variant_id) Return ChildAssignedVariants objects filtered by the variant_id column
 * @method     ChildAssignedVariants[]|ObjectCollection findByCreated(string $created) Return ChildAssignedVariants objects filtered by the created column
 * @method     ChildAssignedVariants[]|ObjectCollection findByUpdated(string $updated) Return ChildAssignedVariants objects filtered by the updated column
 * @method     ChildAssignedVariants[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AssignedVariantsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \rizwanjiwan\probatio\storage\propel\Base\AssignedVariantsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\rizwanjiwan\\probatio\\storage\\propel\\AssignedVariants', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAssignedVariantsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAssignedVariantsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildAssignedVariantsQuery) {
            return $criteria;
        }
        $query = new ChildAssignedVariantsQuery();
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
     * @return ChildAssignedVariants|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AssignedVariantsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AssignedVariantsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildAssignedVariants A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, internal_visitor_id, variant_id, created, updated FROM assigned_variants WHERE id = :p0';
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
            /** @var ChildAssignedVariants $obj */
            $obj = new ChildAssignedVariants();
            $obj->hydrate($row);
            AssignedVariantsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildAssignedVariants|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildAssignedVariantsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AssignedVariantsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildAssignedVariantsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AssignedVariantsTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildAssignedVariantsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(AssignedVariantsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(AssignedVariantsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AssignedVariantsTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the internal_visitor_id column
     *
     * Example usage:
     * <code>
     * $query->filterByInternalVisitorId(1234); // WHERE internal_visitor_id = 1234
     * $query->filterByInternalVisitorId(array(12, 34)); // WHERE internal_visitor_id IN (12, 34)
     * $query->filterByInternalVisitorId(array('min' => 12)); // WHERE internal_visitor_id > 12
     * </code>
     *
     * @see       filterByVisitors()
     *
     * @param     mixed $internalVisitorId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAssignedVariantsQuery The current query, for fluid interface
     */
    public function filterByInternalVisitorId($internalVisitorId = null, $comparison = null)
    {
        if (is_array($internalVisitorId)) {
            $useMinMax = false;
            if (isset($internalVisitorId['min'])) {
                $this->addUsingAlias(AssignedVariantsTableMap::COL_INTERNAL_VISITOR_ID, $internalVisitorId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($internalVisitorId['max'])) {
                $this->addUsingAlias(AssignedVariantsTableMap::COL_INTERNAL_VISITOR_ID, $internalVisitorId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AssignedVariantsTableMap::COL_INTERNAL_VISITOR_ID, $internalVisitorId, $comparison);
    }

    /**
     * Filter the query on the variant_id column
     *
     * Example usage:
     * <code>
     * $query->filterByVariantId(1234); // WHERE variant_id = 1234
     * $query->filterByVariantId(array(12, 34)); // WHERE variant_id IN (12, 34)
     * $query->filterByVariantId(array('min' => 12)); // WHERE variant_id > 12
     * </code>
     *
     * @see       filterByVariants()
     *
     * @param     mixed $variantId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAssignedVariantsQuery The current query, for fluid interface
     */
    public function filterByVariantId($variantId = null, $comparison = null)
    {
        if (is_array($variantId)) {
            $useMinMax = false;
            if (isset($variantId['min'])) {
                $this->addUsingAlias(AssignedVariantsTableMap::COL_VARIANT_ID, $variantId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($variantId['max'])) {
                $this->addUsingAlias(AssignedVariantsTableMap::COL_VARIANT_ID, $variantId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AssignedVariantsTableMap::COL_VARIANT_ID, $variantId, $comparison);
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
     * @return $this|ChildAssignedVariantsQuery The current query, for fluid interface
     */
    public function filterByCreated($created = null, $comparison = null)
    {
        if (is_array($created)) {
            $useMinMax = false;
            if (isset($created['min'])) {
                $this->addUsingAlias(AssignedVariantsTableMap::COL_CREATED, $created['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($created['max'])) {
                $this->addUsingAlias(AssignedVariantsTableMap::COL_CREATED, $created['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AssignedVariantsTableMap::COL_CREATED, $created, $comparison);
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
     * @return $this|ChildAssignedVariantsQuery The current query, for fluid interface
     */
    public function filterByUpdated($updated = null, $comparison = null)
    {
        if (is_array($updated)) {
            $useMinMax = false;
            if (isset($updated['min'])) {
                $this->addUsingAlias(AssignedVariantsTableMap::COL_UPDATED, $updated['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updated['max'])) {
                $this->addUsingAlias(AssignedVariantsTableMap::COL_UPDATED, $updated['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AssignedVariantsTableMap::COL_UPDATED, $updated, $comparison);
    }

    /**
     * Filter the query by a related \rizwanjiwan\probatio\storage\propel\Visitors object
     *
     * @param \rizwanjiwan\probatio\storage\propel\Visitors|ObjectCollection $visitors The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildAssignedVariantsQuery The current query, for fluid interface
     */
    public function filterByVisitors($visitors, $comparison = null)
    {
        if ($visitors instanceof \rizwanjiwan\probatio\storage\propel\Visitors) {
            return $this
                ->addUsingAlias(AssignedVariantsTableMap::COL_INTERNAL_VISITOR_ID, $visitors->getId(), $comparison);
        } elseif ($visitors instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AssignedVariantsTableMap::COL_INTERNAL_VISITOR_ID, $visitors->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByVisitors() only accepts arguments of type \rizwanjiwan\probatio\storage\propel\Visitors or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Visitors relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAssignedVariantsQuery The current query, for fluid interface
     */
    public function joinVisitors($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Visitors');

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
            $this->addJoinObject($join, 'Visitors');
        }

        return $this;
    }

    /**
     * Use the Visitors relation Visitors object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \rizwanjiwan\probatio\storage\propel\VisitorsQuery A secondary query class using the current class as primary query
     */
    public function useVisitorsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVisitors($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Visitors', '\rizwanjiwan\probatio\storage\propel\VisitorsQuery');
    }

    /**
     * Filter the query by a related \rizwanjiwan\probatio\storage\propel\Variants object
     *
     * @param \rizwanjiwan\probatio\storage\propel\Variants|ObjectCollection $variants The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildAssignedVariantsQuery The current query, for fluid interface
     */
    public function filterByVariants($variants, $comparison = null)
    {
        if ($variants instanceof \rizwanjiwan\probatio\storage\propel\Variants) {
            return $this
                ->addUsingAlias(AssignedVariantsTableMap::COL_VARIANT_ID, $variants->getId(), $comparison);
        } elseif ($variants instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AssignedVariantsTableMap::COL_VARIANT_ID, $variants->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByVariants() only accepts arguments of type \rizwanjiwan\probatio\storage\propel\Variants or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Variants relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAssignedVariantsQuery The current query, for fluid interface
     */
    public function joinVariants($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Variants');

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
            $this->addJoinObject($join, 'Variants');
        }

        return $this;
    }

    /**
     * Use the Variants relation Variants object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \rizwanjiwan\probatio\storage\propel\VariantsQuery A secondary query class using the current class as primary query
     */
    public function useVariantsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVariants($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Variants', '\rizwanjiwan\probatio\storage\propel\VariantsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildAssignedVariants $assignedVariants Object to remove from the list of results
     *
     * @return $this|ChildAssignedVariantsQuery The current query, for fluid interface
     */
    public function prune($assignedVariants = null)
    {
        if ($assignedVariants) {
            $this->addUsingAlias(AssignedVariantsTableMap::COL_ID, $assignedVariants->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the assigned_variants table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AssignedVariantsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AssignedVariantsTableMap::clearInstancePool();
            AssignedVariantsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AssignedVariantsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AssignedVariantsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AssignedVariantsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AssignedVariantsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // AssignedVariantsQuery
