<?php
namespace rizwanjiwan\probatio\payloads\v1;


use stdClass;

class VariantsPayload extends GenericPayload
{
    /**
     * @var string
     */
    public $name;
    /**
     * @var string anything you want
     */
    public $metaData;
}