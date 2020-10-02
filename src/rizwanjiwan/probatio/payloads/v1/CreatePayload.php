<?php
namespace rizwanjiwan\probatio\payloads\v1;


use stdClass;

class CreatePayload extends GenericPayload
{
    /**
     * @var string
     */
    public $test_name;
    /**
     * @var VariantsPayload[]
     */
    public $variants=array();
}