<?php
namespace rizwanjiwan\probatio\payloads\v1;


use stdClass;

class AssociatePayload extends GenericPayload
{

    /**
     * @var VisitorIdPayload
     */
    public $visitorId;
    /**
     * @var VisitorIdPayload
     */
    public $linkToId;
}