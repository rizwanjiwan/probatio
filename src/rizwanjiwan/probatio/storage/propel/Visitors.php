<?php

namespace rizwanjiwan\probatio\storage\propel;

use rizwanjiwan\probatio\storage\propel\Base\Visitors as BaseVisitors;

/**
 * Skeleton subclass for representing a row from the 'visitors' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 */
class Visitors extends BaseVisitors
{
    public function __construct()
    {
        parent::__construct();
        $this->setCreated(time());
        $this->setUpdated(time());
    }
}
