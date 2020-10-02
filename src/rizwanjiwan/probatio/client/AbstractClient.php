<?php


namespace rizwanjiwan\probatio\client;


use rizwanjiwan\probatio\payloads\v1\AssociatePayload;
use rizwanjiwan\probatio\payloads\v1\CreatePayload;
use rizwanjiwan\probatio\payloads\v1\ErrorPayload;
use rizwanjiwan\probatio\payloads\v1\GenericPayload;
use rizwanjiwan\probatio\payloads\v1\RollDicePayload;
use rizwanjiwan\probatio\payloads\v1\VariantsPayload;

abstract class AbstractClient
{

    /**
     * Create a new test
     * @param $payload CreatePayload the payload to send
     * @return GenericPayload the response from the server
     * @throws ProbatioException on error
     */
    public function createTest($payload)
    {
        $result=$this->makeApiCall('create',$payload);
        if($result->error===true)
        {
            /**@var $result ErrorPayload*/
            throw new ProbatioException($result->message);
        }
        return $result;
    }

    /**
     * Roll the dice or get back the already assigned variant for a the given user
     * @param $payload RollDicePayload
     * @return VariantsPayload the response from the server
     * @throws ProbatioException
     */
    public function rollDice($payload)
    {
        $result=$this->makeApiCall('rolldice',$payload);
        if($result->error===true)
        {
            /**@var $result ErrorPayload*/
            throw new ProbatioException($result->message);
        }
        /**@var $result VariantsPayload*/
        return $result;
    }

    /**
     * Associate a known visitor id with another visitor id.
     * @param $payload AssociatePayload
     * @return GenericPayload the response from the server
     * @throws ProbatioException
     */
    public function associate($payload)
    {
        $result=$this->makeApiCall('associate',$payload);
        if($result->error===true)
        {
            /**@var $result ErrorPayload*/
            throw new ProbatioException($result->message);
        }
        return $result;
    }

    /**
     * Make an API call to the probatio server
     * @param $activity string the activity you're trying to do. e.g. if you're trying ot hit '/api/create/' just pass 'create'
     * @param $payload GenericPayload or subclass
     * @return GenericPayload
     */
    protected abstract function makeApiCall($activity,$payload);

}