<?php


namespace rizwanjiwan\probatio\payloads\v1;


use stdClass;

class VisitorIdPayload extends GenericPayload
{

    /**
     * @var string the type of ID. e.g. PROD_USER_ID or MKTING_COOKIE (to prevent collisions)
     */
    public $type;
    /**
     * @var string an ID for this visitor
     */
    public $id;
    /**
     * @var int time() when to expire this ID association or 0 for never expire
     */
    public $expiry=0;
}