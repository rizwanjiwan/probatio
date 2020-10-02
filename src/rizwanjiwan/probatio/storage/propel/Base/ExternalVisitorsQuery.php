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
use rizwanjiwan\probatio\storage\propel\ExternalVisitors as ChildExternalVisitors;
use rizwanjiwan\probatio\storage\propel\ExternalVisitorsQuery as ChildExternalVisitorsQuery;
use rizwanjiwan\probatio\storage\propel\Map\ExternalVisitorsTableMap;

/**
 * Base class that represents a query for the 'external_visitors' table.
 *
 *
 *
 * @method     ChildExternalVisitorsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildExternalVisitorsQuery orderByInternalVisitorId($order = Criteria::ASC) Order by the internal_visitor_id column
 * @method     ChildExternalVisitorsQuery orderByExternalVisitorId($order = Criteria::ASC) Order by the external_visitor_id column
 * @method     ChildExternalVisitorsQuery orderByExternalIdType($order = Criteria::ASC) Order by the external_id_type column
 * @method     ChildExternalVisitorsQuery orderByExpires($order = Criteria::ASC) Order by the expires column
 * @method     ChildExternalVisitorsQuery orderByCreated($order = Criteria::ASC) Order by the created column
 * @method     ChildExternalVisitorsQuery orderByUpdated($order = Criteria::ASC) Order by the updated column
 *
 * @method     ChildExternalVisitorsQuery groupById() Group by the id column
 * @method     ChildExternalVisitorsQuery groupByInternalVisitorId() Group by the internal_visitor_id column
 * @method     ChildExternalVisitorsQuery groupByExternalVisitorId() Group by the external_visitor_id column
 * @method     ChildExternalVisitorsQuery groupByExternalIdType() Group by the external_id_type column
 * @method     ChildExternalVisitorsQuery groupByExpires() Group by the expires column
 * @method     ChildExternalVisitorsQuery groupByCreated() Group by the created column
 * @method     ChildExternalVisitorsQuery groupByUpdated() Group by the updated column
 *
 * @method     ChildExternalVisitorsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildExternalVisitorsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildExternalVisitorsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildExternalVisitorsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildExternalVisitorsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildExternalVisitorsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildExternalVisitorsQuery leftJoinInternalVisitors($relationAlias = null) Adds a LEFT JOIN clause to the query using the InternalVisitors relation
 * @method     ChildExternalVisitorsQuery rightJoinInternalVisitors($relationAlias = null) Adds a RIGHT JOIN clause to the query using the InternalVisitors relation
 * @method     ChildExternalVisitorsQuery innerJoinInternalVisitors($relationAlias = null) Adds a INNER JOIN clause to the query using the InternalVisitors relation
 *
 * @method     ChildExternalVisitorsQuery joinWithInternalVisitors($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the InternalVisitors relation
 *
 * @method     ChildExternalVisitorsQuery leftJoinWithInternalVisitors() Adds a LEFT JOIN clause and with to the query using the InternalVisitors relation
 * @method     ChildExternalVisitorsQuery rightJoinWithInternalVisitors() Adds a RIGHT JOIN clause and with to the query using the InternalVisitors relation
 * @method     ChildExternalVisitorsQuery innerJoinWithInternalVisitors() Adds a INNER JOIN clause and with to the query using the InternalVisitors relation
 *
 * @method     \rizwanjiwan\probatio\storage\propel\VisitorsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildExternalVisitors findOne(ConnectionInterface $con = null) Return the first ChildExternalVisitors matching the query
 * @method     ChildExternalVisitors findOneOrCreate(ConnectionInterface $con = null) Return the first ChildExternalVisitors matching the query, or a new ChildExternalVisitors object populated from the query conditions when no match is found
 *
 * @method     ChildExternalVisitors findOneById(int $id) Return the first ChildExternalVisitors filtered by the id column
 * @method     ChildExternalVisitors findOneByInternalVisitorId(int $internal_visitor_id) Return the first ChildExternalVisitors filtered by the internal_visitor_id column
 * @method     ChildExternalVisitors findOneByExternalVisitorId(string $external_visitor_id) Return the first ChildExternalVisitors filtered by the external_visitor_id column
 * @method     ChildExternalVisitors findOneByExternalIdType(string $external_id_type) Return the first ChildExternalVisitors filtered by the external_id_type column
 * @method     ChildExternalVisitors findOneByExpires(int $expires) Return the first ChildExternalVisitors filtered by the expires column
 * @method     ChildExternalVisitors findOneByCreated(string $created) Return the first ChildExternalVisitors filtered by the created column
 * @method     ChildExternalVisitors findOneByUpdated(string $updated) Return the first ChildExternalVisitors filtered by the updated column *

 * @method     ChildExternalVisitors requirePk($key, ConnectionInterface $con = null) Return the ChildExternalVisitors by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExternalVisitors requireOne(ConnectionInterface $con = null) Return the first ChildExternalVisitors matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExternalVisitors requireOneById(int $id) Return the first ChildExternalVisitors filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExternalVisitors requireOneByInternalVisitorId(int $internal_visitor_id) Return the first ChildExternalVisitors filtered by the internal_visitor_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExternalVisitors requireOneByExternalVisitorId(string $external_visitor_id) Return the first ChildExternalVisitors filtered by the external_visitor_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExternalVisitors requireOneByExternalIdType(string $external_id_type) Return the first ChildExternalVisitors filtered by the external_id_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExternalVisitors requireOneByExpires(int $expires) Return the first ChildExternalVisitors filtered by the expires column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExternalVisitors requireOneByCreated(string $created) Return the first ChildExternalVisitors filtered by the created column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExternalVisitors requireOneByUpdated(string $updated) Return the first ChildExternalVisitors filtered by the updated column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExternalVisitors[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildExternalVisitors objects based on current ModelCriteria
 * @method     ChildExternalVisitors[]|ObjectCollection findById(int $id) Return ChildExternalVisitors objects filtered by the id column
 * @method     ChildExternalVisitors[]|ObjectCollection findByInternalVisitorId(int $internal_visitor_id) Return ChildExternalVisitors objects filtered by the internal_visitor_id column
 * @method     ChildExternalVisitors[]|ObjectCollection findByExternalVisitorId(string $external_visitor_id) Return ChildExternalVisitors objects filtered by the external_visitor_id column
 * @method     ChildExternalVisitors[]|ObjectCollection findByExternalIdType(string $external_id_type) Return ChildExternalVisitors objects filtered by the external_id_type column
 * @method     ChildExternalVisitors[]|ObjectCollection findByExpires(int $expires) Return ChildExternalVisitors objects filtered by the expires column
 * @method     ChildExternalVisitors[]|ObjectCollection findByCreated(string $created) Return ChildExternalVisitors objects filtered by the created column
 * @method     ChildExternalVisitors[]|ObjectCollection findByUpdated(string $updated) Return ChildExternalVisitors objects filtered by the updated column
 * @method     ChildExternalVisitors[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ExternalVisitorsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \rizwanjiwan\probatio\storage\propel\Base\ExternalVisitorsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\rizwanjiwan\\probatio\\storage\\propel\\ExternalVisitors', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildExternalVisitorsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildExternalVisitorsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildExternalVisitorsQuery) {
            return $criteria;
        }
        $query = new ChildExternalVisitorsQuery();
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
     * @return ChildExternalVisitors|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ExternalVisitorsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ExternalVisitorsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildExternalVisitors A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, internal_visitor_id, external_visitor_id, external_id_type, expires, created, updated FROM external_visitors WHERE id = :p0';
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
            /** @var ChildExternalVisitors $obj */
            $obj = new ChildExternalVisitors();
            $obj->hydrate($row);
            ExternalVisitorsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildExternalVisitors|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildExternalVisitorsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ExternalVisitorsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildExternalVisitorsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ExternalVisitorsTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildExternalVisitorsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ExternalVisitorsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ExternalVisitorsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExternalVisitorsTableMap::COL_ID, $id, $comparison);
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
     * @see       filterByInternalVisitors()
     *
     * @param     mixed $internalVisitorId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildExternalVisitorsQuery The current query, for fluid interface
     */
    public function filterByInternalVisitorId($internalVisitorId = null, $comparison = null)
    {
        if (is_array($internalVisitorId)) {
            $useMinMax = false;
            if (isset($internalVisitorId['min'])) {
                $this->addUsingAlias(ExternalVisitorsTableMap::COL_INTERNAL_VISITOR_ID, $internalVisitorId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($internalVisitorId['max'])) {
                $this->addUsingAlias(ExternalVisitorsTableMap::COL_INTERNAL_VISITOR_ID, $internalVisitorId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExternalVisitorsTableMap::COL_INTERNAL_VISITOR_ID, $internalVisitorId, $comparison);
    }

    /**
     * Filter the query on the external_visitor_id column
     *
     * Example usage:
     * <code>
     * $query->filterByExternalVisitorId('fooValue');   // WHERE external_visitor_id = 'fooValue'
     * $query->filterByExternalVisitorId('%fooValue%', Criteria::LIKE); // WHERE external_visitor_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $externalVisitorId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildExternalVisitorsQuery The current query, for fluid interface
     */
    public function filterByExternalVisitorId($externalVisitorId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($externalVisitorId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExternalVisitorsTableMap::COL_EXTERNAL_VISITOR_ID, $externalVisitorId, $comparison);
    }

    /**
     * Filter the query on the external_id_type column
     *
     * Example usage:
     * <code>
     * $query->filterByExternalIdType('fooValue');   // WHERE external_id_type = 'fooValue'
     * $query->filterByExternalIdType('%fooValue%', Criteria::LIKE); // WHERE external_id_type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $externalIdType The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildExternalVisitorsQuery The current query, for fluid interface
     */
    public function filterByExternalIdType($externalIdType = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($externalIdType)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExternalVisitorsTableMap::COL_EXTERNAL_ID_TYPE, $externalIdType, $comparison);
    }

    /**
     * Filter the query on the expires column
     *
     * Example usage:
     * <code>
     * $query->filterByExpires(1234); // WHERE expires = 1234
     * $query->filterByExpires(array(12, 34)); // WHERE expires IN (12, 34)
     * $query->filterByExpires(array('min' => 12)); // WHERE expires > 12
     * </code>
     *
     * @param     mixed $expires The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildExternalVisitorsQuery The current query, for fluid interface
     */
    public function filterByExpires($expires = null, $comparison = null)
    {
        if (is_array($expires)) {
            $useMinMax = false;
            if (isset($expires['min'])) {
                $this->addUsingAlias(ExternalVisitorsTableMap::COL_EXPIRES, $expires['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expires['max'])) {
                $this->addUsingAlias(ExternalVisitorsTableMap::COL_EXPIRES, $expires['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExternalVisitorsTableMap::COL_EXPIRES, $expires, $comparison);
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
     * @return $this|ChildExternalVisitorsQuery The current query, for fluid interface
     */
    public function filterByCreated($created = null, $comparison = null)
    {
        if (is_array($created)) {
            $useMinMax = false;
            if (isset($created['min'])) {
                $this->addUsingAlias(ExternalVisitorsTableMap::COL_CREATED, $created['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($created['max'])) {
                $this->addUsingAlias(ExternalVisitorsTableMap::COL_CREATED, $created['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExternalVisitorsTableMap::COL_CREATED, $created, $comparison);
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
     * @return $this|ChildExternalVisitorsQuery The current query, for fluid interface
     */
    public function filterByUpdated($updated = null, $comparison = null)
    {
        if (is_array($updated)) {
            $useMinMax = false;
            if (isset($updated['min'])) {
                $this->addUsingAlias(ExternalVisitorsTableMap::COL_UPDATED, $updated['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updated['max'])) {
                $this->addUsingAlias(ExternalVisitorsTableMap::COL_UPDATED, $updated['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExternalVisitorsTableMap::COL_UPDATED, $updated, $comparison);
    }

    /**
     * Filter the query by a related \rizwanjiwan\probatio\storage\propel\Visitors object
     *
     * @param \rizwanjiwan\probatio\storage\propel\Visitors|ObjectCollection $visitors The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildExternalVisitorsQuery The current query, for fluid interface
     */
    public function filterByInternalVisitors($visitors, $comparison = null)
    {
        if ($visitors instanceof \rizwanjiwan\probatio\storage\propel\Visitors) {
            return $this
                ->addUsingAlias(ExternalVisitorsTableMap::COL_INTERNAL_VISITOR_ID, $visitors->getId(), $comparison);
        } elseif ($visitors instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ExternalVisitorsTableMap::COL_INTERNAL_VISITOR_ID, $visitors->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByInternalVisitors() only accepts arguments of type \rizwanjiwan\probatio\storage\propel\Visitors or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the InternalVisitors relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildExternalVisitorsQuery The current query, for fluid interface
     */
    public function joinInternalVisitors($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('InternalVisitors');

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
            $this->addJoinObject($join, 'InternalVisitors');
        }

        return $this;
    }

    /**
     * Use the InternalVisitors relation Visitors object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \rizwanjiwan\probatio\storage\propel\VisitorsQuery A secondary query class using the current class as primary query
     */
    public function useInternalVisitorsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinInternalVisitors($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'InternalVisitors', '\rizwanjiwan\probatio\storage\propel\VisitorsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildExternalVisitors $externalVisitors Object to remove from the list of results
     *
     * @return $this|ChildExternalVisitorsQuery The current query, for fluid interface
     */
    public function prune($externalVisitors = null)
    {
        if ($externalVisitors) {
            $this->addUsingAlias(ExternalVisitorsTableMap::COL_ID, $externalVisitors->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the external_visitors table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExternalVisitorsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ExternalVisitorsTableMap::clearInstancePool();
            ExternalVisitorsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ExternalVisitorsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ExternalVisitorsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ExternalVisitorsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ExternalVisitorsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ExternalVisitorsQuery
