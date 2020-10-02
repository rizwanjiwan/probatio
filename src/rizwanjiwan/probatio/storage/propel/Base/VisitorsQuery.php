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
use rizwanjiwan\probatio\storage\propel\Visitors as ChildVisitors;
use rizwanjiwan\probatio\storage\propel\VisitorsQuery as ChildVisitorsQuery;
use rizwanjiwan\probatio\storage\propel\Map\VisitorsTableMap;

/**
 * Base class that represents a query for the 'visitors' table.
 *
 *
 *
 * @method     ChildVisitorsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildVisitorsQuery orderByCreated($order = Criteria::ASC) Order by the created column
 * @method     ChildVisitorsQuery orderByUpdated($order = Criteria::ASC) Order by the updated column
 *
 * @method     ChildVisitorsQuery groupById() Group by the id column
 * @method     ChildVisitorsQuery groupByCreated() Group by the created column
 * @method     ChildVisitorsQuery groupByUpdated() Group by the updated column
 *
 * @method     ChildVisitorsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildVisitorsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildVisitorsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildVisitorsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildVisitorsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildVisitorsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildVisitorsQuery leftJoinExternalVisitors($relationAlias = null) Adds a LEFT JOIN clause to the query using the ExternalVisitors relation
 * @method     ChildVisitorsQuery rightJoinExternalVisitors($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ExternalVisitors relation
 * @method     ChildVisitorsQuery innerJoinExternalVisitors($relationAlias = null) Adds a INNER JOIN clause to the query using the ExternalVisitors relation
 *
 * @method     ChildVisitorsQuery joinWithExternalVisitors($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ExternalVisitors relation
 *
 * @method     ChildVisitorsQuery leftJoinWithExternalVisitors() Adds a LEFT JOIN clause and with to the query using the ExternalVisitors relation
 * @method     ChildVisitorsQuery rightJoinWithExternalVisitors() Adds a RIGHT JOIN clause and with to the query using the ExternalVisitors relation
 * @method     ChildVisitorsQuery innerJoinWithExternalVisitors() Adds a INNER JOIN clause and with to the query using the ExternalVisitors relation
 *
 * @method     ChildVisitorsQuery leftJoinAssignedVariants($relationAlias = null) Adds a LEFT JOIN clause to the query using the AssignedVariants relation
 * @method     ChildVisitorsQuery rightJoinAssignedVariants($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AssignedVariants relation
 * @method     ChildVisitorsQuery innerJoinAssignedVariants($relationAlias = null) Adds a INNER JOIN clause to the query using the AssignedVariants relation
 *
 * @method     ChildVisitorsQuery joinWithAssignedVariants($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the AssignedVariants relation
 *
 * @method     ChildVisitorsQuery leftJoinWithAssignedVariants() Adds a LEFT JOIN clause and with to the query using the AssignedVariants relation
 * @method     ChildVisitorsQuery rightJoinWithAssignedVariants() Adds a RIGHT JOIN clause and with to the query using the AssignedVariants relation
 * @method     ChildVisitorsQuery innerJoinWithAssignedVariants() Adds a INNER JOIN clause and with to the query using the AssignedVariants relation
 *
 * @method     \rizwanjiwan\probatio\storage\propel\ExternalVisitorsQuery|\rizwanjiwan\probatio\storage\propel\AssignedVariantsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildVisitors findOne(ConnectionInterface $con = null) Return the first ChildVisitors matching the query
 * @method     ChildVisitors findOneOrCreate(ConnectionInterface $con = null) Return the first ChildVisitors matching the query, or a new ChildVisitors object populated from the query conditions when no match is found
 *
 * @method     ChildVisitors findOneById(int $id) Return the first ChildVisitors filtered by the id column
 * @method     ChildVisitors findOneByCreated(string $created) Return the first ChildVisitors filtered by the created column
 * @method     ChildVisitors findOneByUpdated(string $updated) Return the first ChildVisitors filtered by the updated column *

 * @method     ChildVisitors requirePk($key, ConnectionInterface $con = null) Return the ChildVisitors by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVisitors requireOne(ConnectionInterface $con = null) Return the first ChildVisitors matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVisitors requireOneById(int $id) Return the first ChildVisitors filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVisitors requireOneByCreated(string $created) Return the first ChildVisitors filtered by the created column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVisitors requireOneByUpdated(string $updated) Return the first ChildVisitors filtered by the updated column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVisitors[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildVisitors objects based on current ModelCriteria
 * @method     ChildVisitors[]|ObjectCollection findById(int $id) Return ChildVisitors objects filtered by the id column
 * @method     ChildVisitors[]|ObjectCollection findByCreated(string $created) Return ChildVisitors objects filtered by the created column
 * @method     ChildVisitors[]|ObjectCollection findByUpdated(string $updated) Return ChildVisitors objects filtered by the updated column
 * @method     ChildVisitors[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class VisitorsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \rizwanjiwan\probatio\storage\propel\Base\VisitorsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\rizwanjiwan\\probatio\\storage\\propel\\Visitors', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildVisitorsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildVisitorsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildVisitorsQuery) {
            return $criteria;
        }
        $query = new ChildVisitorsQuery();
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
     * @return ChildVisitors|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VisitorsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = VisitorsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildVisitors A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, created, updated FROM visitors WHERE id = :p0';
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
            /** @var ChildVisitors $obj */
            $obj = new ChildVisitors();
            $obj->hydrate($row);
            VisitorsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildVisitors|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildVisitorsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(VisitorsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildVisitorsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(VisitorsTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildVisitorsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(VisitorsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(VisitorsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VisitorsTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildVisitorsQuery The current query, for fluid interface
     */
    public function filterByCreated($created = null, $comparison = null)
    {
        if (is_array($created)) {
            $useMinMax = false;
            if (isset($created['min'])) {
                $this->addUsingAlias(VisitorsTableMap::COL_CREATED, $created['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($created['max'])) {
                $this->addUsingAlias(VisitorsTableMap::COL_CREATED, $created['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VisitorsTableMap::COL_CREATED, $created, $comparison);
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
     * @return $this|ChildVisitorsQuery The current query, for fluid interface
     */
    public function filterByUpdated($updated = null, $comparison = null)
    {
        if (is_array($updated)) {
            $useMinMax = false;
            if (isset($updated['min'])) {
                $this->addUsingAlias(VisitorsTableMap::COL_UPDATED, $updated['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updated['max'])) {
                $this->addUsingAlias(VisitorsTableMap::COL_UPDATED, $updated['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VisitorsTableMap::COL_UPDATED, $updated, $comparison);
    }

    /**
     * Filter the query by a related \rizwanjiwan\probatio\storage\propel\ExternalVisitors object
     *
     * @param \rizwanjiwan\probatio\storage\propel\ExternalVisitors|ObjectCollection $externalVisitors the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildVisitorsQuery The current query, for fluid interface
     */
    public function filterByExternalVisitors($externalVisitors, $comparison = null)
    {
        if ($externalVisitors instanceof \rizwanjiwan\probatio\storage\propel\ExternalVisitors) {
            return $this
                ->addUsingAlias(VisitorsTableMap::COL_ID, $externalVisitors->getInternalVisitorId(), $comparison);
        } elseif ($externalVisitors instanceof ObjectCollection) {
            return $this
                ->useExternalVisitorsQuery()
                ->filterByPrimaryKeys($externalVisitors->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByExternalVisitors() only accepts arguments of type \rizwanjiwan\probatio\storage\propel\ExternalVisitors or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ExternalVisitors relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildVisitorsQuery The current query, for fluid interface
     */
    public function joinExternalVisitors($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ExternalVisitors');

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
            $this->addJoinObject($join, 'ExternalVisitors');
        }

        return $this;
    }

    /**
     * Use the ExternalVisitors relation ExternalVisitors object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \rizwanjiwan\probatio\storage\propel\ExternalVisitorsQuery A secondary query class using the current class as primary query
     */
    public function useExternalVisitorsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinExternalVisitors($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ExternalVisitors', '\rizwanjiwan\probatio\storage\propel\ExternalVisitorsQuery');
    }

    /**
     * Filter the query by a related \rizwanjiwan\probatio\storage\propel\AssignedVariants object
     *
     * @param \rizwanjiwan\probatio\storage\propel\AssignedVariants|ObjectCollection $assignedVariants the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildVisitorsQuery The current query, for fluid interface
     */
    public function filterByAssignedVariants($assignedVariants, $comparison = null)
    {
        if ($assignedVariants instanceof \rizwanjiwan\probatio\storage\propel\AssignedVariants) {
            return $this
                ->addUsingAlias(VisitorsTableMap::COL_ID, $assignedVariants->getInternalVisitorId(), $comparison);
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
     * @return $this|ChildVisitorsQuery The current query, for fluid interface
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
     * @param   ChildVisitors $visitors Object to remove from the list of results
     *
     * @return $this|ChildVisitorsQuery The current query, for fluid interface
     */
    public function prune($visitors = null)
    {
        if ($visitors) {
            $this->addUsingAlias(VisitorsTableMap::COL_ID, $visitors->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the visitors table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VisitorsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            VisitorsTableMap::clearInstancePool();
            VisitorsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(VisitorsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(VisitorsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            VisitorsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            VisitorsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // VisitorsQuery
