<?php


namespace rizwanjiwan\probatio\payloads\v1;


class ErrorPayload extends  GenericPayload
{

    public $error=true;
    public $message;
}