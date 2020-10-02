<?php


namespace rizwanjiwan\probatio\client;

use rizwanjiwan\probatio\controllers\ApiController;
use rizwanjiwan\probatio\filters\ApiKeyFilter;
use rizwanjiwan\probatio\payloads\v1\GenericPayload;

/**
 * Connect to the the server via php calls
 */
class InMemoryClient extends AbstractClient
{

    private $controller;

    public function __construct()
    {
        ApiKeyFilter::enableTestMode();//we're in memory, no need to filter out for api keys
        $this->controller=new ApiController();
    }
    /**
     * Make an API call to the probatio server
     * @param $activity string the activity you're trying to do. e.g. if you're trying ot hit '/api/create/' just pass 'create'
     * @param $payload GenericPayload or subclass
     * @return GenericPayload
     */
    protected function makeApiCall($activity, $payload)
    {
        //call the method directly
        $request=new JsonInterceptorRequest();
        $this->controller->$activity($request,$payload);
        return JsonInterceptorRequest::$capturedJson;
    }
}