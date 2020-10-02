<?php

namespace rizwanjiwan\probatio\storage\propel\Base;

use \DateTime;
use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use rizwanjiwan\probatio\storage\propel\AssignedVariants as ChildAssignedVariants;
use rizwanjiwan\probatio\storage\propel\AssignedVariantsQuery as ChildAssignedVariantsQuery;
use rizwanjiwan\probatio\storage\propel\ExternalVisitors as ChildExternalVisitors;
use rizwanjiwan\probatio\storage\propel\ExternalVisitorsQuery as ChildExternalVisitorsQuery;
use rizwanjiwan\probatio\storage\propel\Visitors as ChildVisitors;
use rizwanjiwan\probatio\storage\propel\VisitorsQuery as ChildVisitorsQuery;
use rizwanjiwan\probatio\storage\propel\Map\AssignedVariantsTableMap;
use rizwanjiwan\probatio\storage\propel\Map\ExternalVisitorsTableMap;
use rizwanjiwan\probatio\storage\propel\Map\VisitorsTableMap;

/**
 * Base class that represents a row from the 'visitors' table.
 *
 *
 *
 * @package    propel.generator.rizwanjiwan.probatio.storage.propel.Base
 */
abstract class Visitors implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\rizwanjiwan\\probatio\\storage\\propel\\Map\\VisitorsTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the created field.
     *
     * @var        DateTime
     */
    protected $created;

    /**
     * The value for the updated field.
     *
     * @var        DateTime
     */
    protected $updated;

    /**
     * @var        ObjectCollection|ChildExternalVisitors[] Collection to store aggregation of ChildExternalVisitors objects.
     */
    protected $collExternalVisitorss;
    protected $collExternalVisitorssPartial;

    /**
     * @var        ObjectCollection|ChildAssignedVariants[] Collection to store aggregation of ChildAssignedVariants objects.
     */
    protected $collAssignedVariantss;
    protected $collAssignedVariantssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildExternalVisitors[]
     */
    protected $externalVisitorssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildAssignedVariants[]
     */
    protected $assignedVariantssScheduledForDeletion = null;

    /**
     * Initializes internal state of rizwanjiwan\probatio\storage\propel\Base\Visitors object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Visitors</code> instance.  If
     * <code>obj</code> is an instance of <code>Visitors</code>, delegates to
     * <code>equals(Visitors)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return void
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [optionally formatted] temporal [created] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreated($format = null)
    {
        if ($format === null) {
            return $this->created;
        } else {
            return $this->created instanceof \DateTimeInterface ? $this->created->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdated($format = null)
    {
        if ($format === null) {
            return $this->updated;
        } else {
            return $this->updated instanceof \DateTimeInterface ? $this->updated->format($format) : null;
        }
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v New value
     * @return $this|\rizwanjiwan\probatio\storage\propel\Visitors The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[VisitorsTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Sets the value of [created] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\rizwanjiwan\probatio\storage\propel\Visitors The current object (for fluent API support)
     */
    public function setCreated($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created !== null || $dt !== null) {
            if ($this->created === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created->format("Y-m-d H:i:s.u")) {
                $this->created = $dt === null ? null : clone $dt;
                $this->modifiedColumns[VisitorsTableMap::COL_CREATED] = true;
            }
        } // if either are not null

        return $this;
    } // setCreated()

    /**
     * Sets the value of [updated] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\rizwanjiwan\probatio\storage\propel\Visitors The current object (for fluent API support)
     */
    public function setUpdated($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated !== null || $dt !== null) {
            if ($this->updated === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated->format("Y-m-d H:i:s.u")) {
                $this->updated = $dt === null ? null : clone $dt;
                $this->modifiedColumns[VisitorsTableMap::COL_UPDATED] = true;
            }
        } // if either are not null

        return $this;
    } // setUpdated()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : VisitorsTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : VisitorsTableMap::translateFieldName('Created', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : VisitorsTableMap::translateFieldName('Updated', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = VisitorsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\rizwanjiwan\\probatio\\storage\\propel\\Visitors'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VisitorsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildVisitorsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collExternalVisitorss = null;

            $this->collAssignedVariantss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Visitors::setDeleted()
     * @see Visitors::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(VisitorsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildVisitorsQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(VisitorsTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                VisitorsTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->externalVisitorssScheduledForDeletion !== null) {
                if (!$this->externalVisitorssScheduledForDeletion->isEmpty()) {
                    \rizwanjiwan\probatio\storage\propel\ExternalVisitorsQuery::create()
                        ->filterByPrimaryKeys($this->externalVisitorssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->externalVisitorssScheduledForDeletion = null;
                }
            }

            if ($this->collExternalVisitorss !== null) {
                foreach ($this->collExternalVisitorss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->assignedVariantssScheduledForDeletion !== null) {
                if (!$this->assignedVariantssScheduledForDeletion->isEmpty()) {
                    \rizwanjiwan\probatio\storage\propel\AssignedVariantsQuery::create()
                        ->filterByPrimaryKeys($this->assignedVariantssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->assignedVariantssScheduledForDeletion = null;
                }
            }

            if ($this->collAssignedVariantss !== null) {
                foreach ($this->collAssignedVariantss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[VisitorsTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . VisitorsTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(VisitorsTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(VisitorsTableMap::COL_CREATED)) {
            $modifiedColumns[':p' . $index++]  = 'created';
        }
        if ($this->isColumnModified(VisitorsTableMap::COL_UPDATED)) {
            $modifiedColumns[':p' . $index++]  = 'updated';
        }

        $sql = sprintf(
            'INSERT INTO visitors (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'created':
                        $stmt->bindValue($identifier, $this->created ? $this->created->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'updated':
                        $stmt->bindValue($identifier, $this->updated ? $this->updated->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = VisitorsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getCreated();
                break;
            case 2:
                return $this->getUpdated();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Visitors'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Visitors'][$this->hashCode()] = true;
        $keys = VisitorsTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getCreated(),
            $keys[2] => $this->getUpdated(),
        );
        if ($result[$keys[1]] instanceof \DateTimeInterface) {
            $result[$keys[1]] = $result[$keys[1]]->format('c');
        }

        if ($result[$keys[2]] instanceof \DateTimeInterface) {
            $result[$keys[2]] = $result[$keys[2]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collExternalVisitorss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'externalVisitorss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'external_visitorss';
                        break;
                    default:
                        $key = 'ExternalVisitorss';
                }

                $result[$key] = $this->collExternalVisitorss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collAssignedVariantss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'assignedVariantss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'assigned_variantss';
                        break;
                    default:
                        $key = 'AssignedVariantss';
                }

                $result[$key] = $this->collAssignedVariantss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\rizwanjiwan\probatio\storage\propel\Visitors
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = VisitorsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\rizwanjiwan\probatio\storage\propel\Visitors
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setCreated($value);
                break;
            case 2:
                $this->setUpdated($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = VisitorsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setCreated($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setUpdated($arr[$keys[2]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\rizwanjiwan\probatio\storage\propel\Visitors The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(VisitorsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(VisitorsTableMap::COL_ID)) {
            $criteria->add(VisitorsTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(VisitorsTableMap::COL_CREATED)) {
            $criteria->add(VisitorsTableMap::COL_CREATED, $this->created);
        }
        if ($this->isColumnModified(VisitorsTableMap::COL_UPDATED)) {
            $criteria->add(VisitorsTableMap::COL_UPDATED, $this->updated);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildVisitorsQuery::create();
        $criteria->add(VisitorsTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \rizwanjiwan\probatio\storage\propel\Visitors (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCreated($this->getCreated());
        $copyObj->setUpdated($this->getUpdated());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getExternalVisitorss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addExternalVisitors($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getAssignedVariantss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAssignedVariants($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \rizwanjiwan\probatio\storage\propel\Visitors Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('ExternalVisitors' === $relationName) {
            $this->initExternalVisitorss();
            return;
        }
        if ('AssignedVariants' === $relationName) {
            $this->initAssignedVariantss();
            return;
        }
    }

    /**
     * Clears out the collExternalVisitorss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addExternalVisitorss()
     */
    public function clearExternalVisitorss()
    {
        $this->collExternalVisitorss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collExternalVisitorss collection loaded partially.
     */
    public function resetPartialExternalVisitorss($v = true)
    {
        $this->collExternalVisitorssPartial = $v;
    }

    /**
     * Initializes the collExternalVisitorss collection.
     *
     * By default this just sets the collExternalVisitorss collection to an empty array (like clearcollExternalVisitorss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initExternalVisitorss($overrideExisting = true)
    {
        if (null !== $this->collExternalVisitorss && !$overrideExisting) {
            return;
        }

        $collectionClassName = ExternalVisitorsTableMap::getTableMap()->getCollectionClassName();

        $this->collExternalVisitorss = new $collectionClassName;
        $this->collExternalVisitorss->setModel('\rizwanjiwan\probatio\storage\propel\ExternalVisitors');
    }

    /**
     * Gets an array of ChildExternalVisitors objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildVisitors is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildExternalVisitors[] List of ChildExternalVisitors objects
     * @throws PropelException
     */
    public function getExternalVisitorss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collExternalVisitorssPartial && !$this->isNew();
        if (null === $this->collExternalVisitorss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collExternalVisitorss) {
                    $this->initExternalVisitorss();
                } else {
                    $collectionClassName = ExternalVisitorsTableMap::getTableMap()->getCollectionClassName();

                    $collExternalVisitorss = new $collectionClassName;
                    $collExternalVisitorss->setModel('\rizwanjiwan\probatio\storage\propel\ExternalVisitors');

                    return $collExternalVisitorss;
                }
            } else {
                $collExternalVisitorss = ChildExternalVisitorsQuery::create(null, $criteria)
                    ->filterByInternalVisitors($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collExternalVisitorssPartial && count($collExternalVisitorss)) {
                        $this->initExternalVisitorss(false);

                        foreach ($collExternalVisitorss as $obj) {
                            if (false == $this->collExternalVisitorss->contains($obj)) {
                                $this->collExternalVisitorss->append($obj);
                            }
                        }

                        $this->collExternalVisitorssPartial = true;
                    }

                    return $collExternalVisitorss;
                }

                if ($partial && $this->collExternalVisitorss) {
                    foreach ($this->collExternalVisitorss as $obj) {
                        if ($obj->isNew()) {
                            $collExternalVisitorss[] = $obj;
                        }
                    }
                }

                $this->collExternalVisitorss = $collExternalVisitorss;
                $this->collExternalVisitorssPartial = false;
            }
        }

        return $this->collExternalVisitorss;
    }

    /**
     * Sets a collection of ChildExternalVisitors objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $externalVisitorss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildVisitors The current object (for fluent API support)
     */
    public function setExternalVisitorss(Collection $externalVisitorss, ConnectionInterface $con = null)
    {
        /** @var ChildExternalVisitors[] $externalVisitorssToDelete */
        $externalVisitorssToDelete = $this->getExternalVisitorss(new Criteria(), $con)->diff($externalVisitorss);


        $this->externalVisitorssScheduledForDeletion = $externalVisitorssToDelete;

        foreach ($externalVisitorssToDelete as $externalVisitorsRemoved) {
            $externalVisitorsRemoved->setInternalVisitors(null);
        }

        $this->collExternalVisitorss = null;
        foreach ($externalVisitorss as $externalVisitors) {
            $this->addExternalVisitors($externalVisitors);
        }

        $this->collExternalVisitorss = $externalVisitorss;
        $this->collExternalVisitorssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ExternalVisitors objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ExternalVisitors objects.
     * @throws PropelException
     */
    public function countExternalVisitorss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collExternalVisitorssPartial && !$this->isNew();
        if (null === $this->collExternalVisitorss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collExternalVisitorss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getExternalVisitorss());
            }

            $query = ChildExternalVisitorsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByInternalVisitors($this)
                ->count($con);
        }

        return count($this->collExternalVisitorss);
    }

    /**
     * Method called to associate a ChildExternalVisitors object to this object
     * through the ChildExternalVisitors foreign key attribute.
     *
     * @param  ChildExternalVisitors $l ChildExternalVisitors
     * @return $this|\rizwanjiwan\probatio\storage\propel\Visitors The current object (for fluent API support)
     */
    public function addExternalVisitors(ChildExternalVisitors $l)
    {
        if ($this->collExternalVisitorss === null) {
            $this->initExternalVisitorss();
            $this->collExternalVisitorssPartial = true;
        }

        if (!$this->collExternalVisitorss->contains($l)) {
            $this->doAddExternalVisitors($l);

            if ($this->externalVisitorssScheduledForDeletion and $this->externalVisitorssScheduledForDeletion->contains($l)) {
                $this->externalVisitorssScheduledForDeletion->remove($this->externalVisitorssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildExternalVisitors $externalVisitors The ChildExternalVisitors object to add.
     */
    protected function doAddExternalVisitors(ChildExternalVisitors $externalVisitors)
    {
        $this->collExternalVisitorss[]= $externalVisitors;
        $externalVisitors->setInternalVisitors($this);
    }

    /**
     * @param  ChildExternalVisitors $externalVisitors The ChildExternalVisitors object to remove.
     * @return $this|ChildVisitors The current object (for fluent API support)
     */
    public function removeExternalVisitors(ChildExternalVisitors $externalVisitors)
    {
        if ($this->getExternalVisitorss()->contains($externalVisitors)) {
            $pos = $this->collExternalVisitorss->search($externalVisitors);
            $this->collExternalVisitorss->remove($pos);
            if (null === $this->externalVisitorssScheduledForDeletion) {
                $this->externalVisitorssScheduledForDeletion = clone $this->collExternalVisitorss;
                $this->externalVisitorssScheduledForDeletion->clear();
            }
            $this->externalVisitorssScheduledForDeletion[]= clone $externalVisitors;
            $externalVisitors->setInternalVisitors(null);
        }

        return $this;
    }

    /**
     * Clears out the collAssignedVariantss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addAssignedVariantss()
     */
    public function clearAssignedVariantss()
    {
        $this->collAssignedVariantss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collAssignedVariantss collection loaded partially.
     */
    public function resetPartialAssignedVariantss($v = true)
    {
        $this->collAssignedVariantssPartial = $v;
    }

    /**
     * Initializes the collAssignedVariantss collection.
     *
     * By default this just sets the collAssignedVariantss collection to an empty array (like clearcollAssignedVariantss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAssignedVariantss($overrideExisting = true)
    {
        if (null !== $this->collAssignedVariantss && !$overrideExisting) {
            return;
        }

        $collectionClassName = AssignedVariantsTableMap::getTableMap()->getCollectionClassName();

        $this->collAssignedVariantss = new $collectionClassName;
        $this->collAssignedVariantss->setModel('\rizwanjiwan\probatio\storage\propel\AssignedVariants');
    }

    /**
     * Gets an array of ChildAssignedVariants objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildVisitors is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildAssignedVariants[] List of ChildAssignedVariants objects
     * @throws PropelException
     */
    public function getAssignedVariantss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collAssignedVariantssPartial && !$this->isNew();
        if (null === $this->collAssignedVariantss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collAssignedVariantss) {
                    $this->initAssignedVariantss();
                } else {
                    $collectionClassName = AssignedVariantsTableMap::getTableMap()->getCollectionClassName();

                    $collAssignedVariantss = new $collectionClassName;
                    $collAssignedVariantss->setModel('\rizwanjiwan\probatio\storage\propel\AssignedVariants');

                    return $collAssignedVariantss;
                }
            } else {
                $collAssignedVariantss = ChildAssignedVariantsQuery::create(null, $criteria)
                    ->filterByVisitors($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAssignedVariantssPartial && count($collAssignedVariantss)) {
                        $this->initAssignedVariantss(false);

                        foreach ($collAssignedVariantss as $obj) {
                            if (false == $this->collAssignedVariantss->contains($obj)) {
                                $this->collAssignedVariantss->append($obj);
                            }
                        }

                        $this->collAssignedVariantssPartial = true;
                    }

                    return $collAssignedVariantss;
                }

                if ($partial && $this->collAssignedVariantss) {
                    foreach ($this->collAssignedVariantss as $obj) {
                        if ($obj->isNew()) {
                            $collAssignedVariantss[] = $obj;
                        }
                    }
                }

                $this->collAssignedVariantss = $collAssignedVariantss;
                $this->collAssignedVariantssPartial = false;
            }
        }

        return $this->collAssignedVariantss;
    }

    /**
     * Sets a collection of ChildAssignedVariants objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $assignedVariantss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildVisitors The current object (for fluent API support)
     */
    public function setAssignedVariantss(Collection $assignedVariantss, ConnectionInterface $con = null)
    {
        /** @var ChildAssignedVariants[] $assignedVariantssToDelete */
        $assignedVariantssToDelete = $this->getAssignedVariantss(new Criteria(), $con)->diff($assignedVariantss);


        $this->assignedVariantssScheduledForDeletion = $assignedVariantssToDelete;

        foreach ($assignedVariantssToDelete as $assignedVariantsRemoved) {
            $assignedVariantsRemoved->setVisitors(null);
        }

        $this->collAssignedVariantss = null;
        foreach ($assignedVariantss as $assignedVariants) {
            $this->addAssignedVariants($assignedVariants);
        }

        $this->collAssignedVariantss = $assignedVariantss;
        $this->collAssignedVariantssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related AssignedVariants objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related AssignedVariants objects.
     * @throws PropelException
     */
    public function countAssignedVariantss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collAssignedVariantssPartial && !$this->isNew();
        if (null === $this->collAssignedVariantss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAssignedVariantss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAssignedVariantss());
            }

            $query = ChildAssignedVariantsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByVisitors($this)
                ->count($con);
        }

        return count($this->collAssignedVariantss);
    }

    /**
     * Method called to associate a ChildAssignedVariants object to this object
     * through the ChildAssignedVariants foreign key attribute.
     *
     * @param  ChildAssignedVariants $l ChildAssignedVariants
     * @return $this|\rizwanjiwan\probatio\storage\propel\Visitors The current object (for fluent API support)
     */
    public function addAssignedVariants(ChildAssignedVariants $l)
    {
        if ($this->collAssignedVariantss === null) {
            $this->initAssignedVariantss();
            $this->collAssignedVariantssPartial = true;
        }

        if (!$this->collAssignedVariantss->contains($l)) {
            $this->doAddAssignedVariants($l);

            if ($this->assignedVariantssScheduledForDeletion and $this->assignedVariantssScheduledForDeletion->contains($l)) {
                $this->assignedVariantssScheduledForDeletion->remove($this->assignedVariantssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildAssignedVariants $assignedVariants The ChildAssignedVariants object to add.
     */
    protected function doAddAssignedVariants(ChildAssignedVariants $assignedVariants)
    {
        $this->collAssignedVariantss[]= $assignedVariants;
        $assignedVariants->setVisitors($this);
    }

    /**
     * @param  ChildAssignedVariants $assignedVariants The ChildAssignedVariants object to remove.
     * @return $this|ChildVisitors The current object (for fluent API support)
     */
    public function removeAssignedVariants(ChildAssignedVariants $assignedVariants)
    {
        if ($this->getAssignedVariantss()->contains($assignedVariants)) {
            $pos = $this->collAssignedVariantss->search($assignedVariants);
            $this->collAssignedVariantss->remove($pos);
            if (null === $this->assignedVariantssScheduledForDeletion) {
                $this->assignedVariantssScheduledForDeletion = clone $this->collAssignedVariantss;
                $this->assignedVariantssScheduledForDeletion->clear();
            }
            $this->assignedVariantssScheduledForDeletion[]= clone $assignedVariants;
            $assignedVariants->setVisitors(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Visitors is new, it will return
     * an empty collection; or if this Visitors has previously
     * been saved, it will retrieve related AssignedVariantss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Visitors.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAssignedVariants[] List of ChildAssignedVariants objects
     */
    public function getAssignedVariantssJoinVariants(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAssignedVariantsQuery::create(null, $criteria);
        $query->joinWith('Variants', $joinBehavior);

        return $this->getAssignedVariantss($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->created = null;
        $this->updated = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collExternalVisitorss) {
                foreach ($this->collExternalVisitorss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAssignedVariantss) {
                foreach ($this->collAssignedVariantss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collExternalVisitorss = null;
        $this->collAssignedVariantss = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(VisitorsTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
            }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
