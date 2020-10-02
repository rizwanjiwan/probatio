<?php
namespace rizwanjiwan\probatio\controllers;

use rizwanjiwan\common\classes\LogManager;
use rizwanjiwan\common\classes\NameableContainer;
use rizwanjiwan\common\web\AbstractController;
use rizwanjiwan\common\web\Request;
use Exception;
use rizwanjiwan\probatio\filters\ApiKeyFilter;
use rizwanjiwan\probatio\payloads\v1\AssociatePayload;
use rizwanjiwan\probatio\payloads\v1\CreatePayload;
use rizwanjiwan\probatio\payloads\v1\ErrorPayload;
use rizwanjiwan\probatio\payloads\v1\GenericPayload;
use rizwanjiwan\probatio\payloads\v1\RollDicePayload;
use rizwanjiwan\probatio\storage\StorageFactory;

class ApiController extends AbstractController
{

    /**
     * Create a new test
     * @param $request Request
     * @param  $payload null|CreatePayload override reading the payload from a web request (used for testing)
     */
    public function create($request,$payload=null)
    {
        $log=LogManager::createLogger('ApiController');
        try
        {
            if($payload===null)
            {
                $input=trim(file_get_contents('php://input'));
                $payload=json_decode($input);
            }
            /**@var $payload CreatePayload*/
            StorageFactory::get()->createTest($payload);
            $request->respondJson(new GenericPayload());
        }
        catch(Exception $e) //failure is an option
        {
            self::generateApiError($request,$e->getMessage());
            $log->error($e->getMessage()." -> ".$e->getTraceAsString());
        }
    }

    /**
     * Roll the dice or get the results of previous rolls for this visitor
     * @param $request Request
     * @param  $payload null|RollDicePayload override reading the payload from a web request (used for testing)
     */
    public function rolldice($request,$payload=null)
    {
        $log=LogManager::createLogger('ApiController');
        try
        {
            if($payload===null)
            {
                $input=trim(file_get_contents('php://input'));
                $payload=json_decode($input);
            }
            /**@var $payload RollDicePayload*/
            $storage=StorageFactory::get();
            $visitorId=$storage->getOrCreateVisitor($payload->visitor);
            $variant=$storage->rollDice($payload->test_name,$visitorId);
            $request->respondJson($variant);
        }
        catch(Exception $e) //failure is an option
        {
            self::generateApiError($request,$e->getMessage());
            $log->error($e->getMessage()." -> ".$e->getTraceAsString());
        }
    }

    /**
     * Allows you to associate one ID with another so you can track people across systems
     * @param  $payload null|AssociatePayload override reading the payload from a web request (used for testing)
     * @param $request Request
     */
    public function associate($request,$payload=null)
    {
        $log=LogManager::createLogger('ApiController');
        try
        {
            if($payload===null)
            {
                $input=trim(file_get_contents('php://input'));
                $payload=json_decode($input);
            }
            /**@var $payload AssociatePayload*/
            StorageFactory::get()->associate($payload->visitorId,$payload->linkToId);
            $request->respondJson(new GenericPayload());
        }
        catch(Exception $e) //failure is an option
        {
            self::generateApiError($request,$e->getMessage());
            $log->error($e->getMessage()." -> ".$e->getTraceAsString());
        }
    }

    /**
     * @param $request Request
     * @param $message string the message to send back
     */
    public static function generateApiError($request,$message)
    {
        $response=new ErrorPayload();
        $response->message=$message;
        $request->respondJson($response);
    }

    /**
     * Specify Filters for all calls to this controller from the router
     * @return NameableContainer
     */
    public function getFilters()
    {
        return NameableContainer::create()->add(new ApiKeyFilter());
    }
}