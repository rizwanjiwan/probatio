<?php


namespace rizwanjiwan\probatio\payloads\v1;


use stdClass;

class RollDicePayload extends GenericPayload
{

    /**
     * @var string the name of the test you want to roll the dice for
     */
    public $test_name;
    /**
     * @var VisitorIdPayload the visitor id you have for whatever tracking you want to use
     */
    public $visitor;

}