<?php

namespace rizwanjiwan\probatio\storage\propel;

use rizwanjiwan\probatio\payloads\v1\VariantsPayload;
use rizwanjiwan\probatio\storage\propel\Base\Variants as BaseVariants;

/**
 * Skeleton subclass for representing a row from the 'variants' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 */
class Variants extends BaseVariants
{

    public function __construct()
    {
        parent::__construct();
        $this->setCreated(time());
        $this->setUpdated(time());
    }

    public function toPayload()
    {
        $payload=new VariantsPayload();
        $payload->name=$this->getVariantName();
        $payload->metaData=$this->getMetadata();
        return $payload;
    }
}
