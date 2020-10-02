<?php


namespace rizwanjiwan\probatio\payloads\v1;


use stdClass;

class GenericPayload extends stdClass
{
    public $version='1.0';
    public $error=false;

    public function __toString()
    {
        return json_encode($this);
    }
}