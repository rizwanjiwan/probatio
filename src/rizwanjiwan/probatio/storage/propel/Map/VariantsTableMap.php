<?php

namespace rizwanjiwan\probatio\storage\propel\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use rizwanjiwan\probatio\storage\propel\Variants;
use rizwanjiwan\probatio\storage\propel\VariantsQuery;


/**
 * This class defines the structure of the 'variants' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class VariantsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'rizwanjiwan.probatio.storage.propel.Map.VariantsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'variants';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\rizwanjiwan\\probatio\\storage\\propel\\Variants';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'rizwanjiwan.probatio.storage.propel.Variants';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the id field
     */
    const COL_ID = 'variants.id';

    /**
     * the column name for the test_id field
     */
    const COL_TEST_ID = 'variants.test_id';

    /**
     * the column name for the variant_name field
     */
    const COL_VARIANT_NAME = 'variants.variant_name';

    /**
     * the column name for the metadata field
     */
    const COL_METADATA = 'variants.metadata';

    /**
     * the column name for the created field
     */
    const COL_CREATED = 'variants.created';

    /**
     * the column name for the updated field
     */
    const COL_UPDATED = 'variants.updated';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'testId', 'VariantName', 'Metadata', 'Created', 'Updated', ),
        self::TYPE_CAMELNAME     => array('id', 'testId', 'variantName', 'metadata', 'created', 'updated', ),
        self::TYPE_COLNAME       => array(VariantsTableMap::COL_ID, VariantsTableMap::COL_TEST_ID, VariantsTableMap::COL_VARIANT_NAME, VariantsTableMap::COL_METADATA, VariantsTableMap::COL_CREATED, VariantsTableMap::COL_UPDATED, ),
        self::TYPE_FIELDNAME     => array('id', 'test_id', 'variant_name', 'metadata', 'created', 'updated', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'testId' => 1, 'VariantName' => 2, 'Metadata' => 3, 'Created' => 4, 'Updated' => 5, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'testId' => 1, 'variantName' => 2, 'metadata' => 3, 'created' => 4, 'updated' => 5, ),
        self::TYPE_COLNAME       => array(VariantsTableMap::COL_ID => 0, VariantsTableMap::COL_TEST_ID => 1, VariantsTableMap::COL_VARIANT_NAME => 2, VariantsTableMap::COL_METADATA => 3, VariantsTableMap::COL_CREATED => 4, VariantsTableMap::COL_UPDATED => 5, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'test_id' => 1, 'variant_name' => 2, 'metadata' => 3, 'created' => 4, 'updated' => 5, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('variants');
        $this->setPhpName('Variants');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\rizwanjiwan\\probatio\\storage\\propel\\Variants');
        $this->setPackage('rizwanjiwan.probatio.storage.propel');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('test_id', 'testId', 'INTEGER', 'tests', 'id', true, null, null);
        $this->addColumn('variant_name', 'VariantName', 'VARCHAR', true, 127, null);
        $this->addColumn('metadata', 'Metadata', 'VARCHAR', false, 127, null);
        $this->addColumn('created', 'Created', 'TIMESTAMP', true, null, null);
        $this->addColumn('updated', 'Updated', 'TIMESTAMP', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Tests', '\\rizwanjiwan\\probatio\\storage\\propel\\Tests', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':test_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('AssignedVariants', '\\rizwanjiwan\\probatio\\storage\\propel\\AssignedVariants', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':variant_id',
    1 => ':id',
  ),
), null, null, 'AssignedVariantss', false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? VariantsTableMap::CLASS_DEFAULT : VariantsTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Variants object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = VariantsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = VariantsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + VariantsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = VariantsTableMap::OM_CLASS;
            /** @var Variants $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            VariantsTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = VariantsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = VariantsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Variants $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                VariantsTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(VariantsTableMap::COL_ID);
            $criteria->addSelectColumn(VariantsTableMap::COL_TEST_ID);
            $criteria->addSelectColumn(VariantsTableMap::COL_VARIANT_NAME);
            $criteria->addSelectColumn(VariantsTableMap::COL_METADATA);
            $criteria->addSelectColumn(VariantsTableMap::COL_CREATED);
            $criteria->addSelectColumn(VariantsTableMap::COL_UPDATED);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.test_id');
            $criteria->addSelectColumn($alias . '.variant_name');
            $criteria->addSelectColumn($alias . '.metadata');
            $criteria->addSelectColumn($alias . '.created');
            $criteria->addSelectColumn($alias . '.updated');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(VariantsTableMap::DATABASE_NAME)->getTable(VariantsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(VariantsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(VariantsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new VariantsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Variants or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Variants object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VariantsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \rizwanjiwan\probatio\storage\propel\Variants) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(VariantsTableMap::DATABASE_NAME);
            $criteria->add(VariantsTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = VariantsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            VariantsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                VariantsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the variants table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return VariantsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Variants or Criteria object.
     *
     * @param mixed               $criteria Criteria or Variants object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VariantsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Variants object
        }

        if ($criteria->containsKey(VariantsTableMap::COL_ID) && $criteria->keyContainsValue(VariantsTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.VariantsTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = VariantsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // VariantsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
VariantsTableMap::buildTableMap();
