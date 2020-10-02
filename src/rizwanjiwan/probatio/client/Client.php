<?php
namespace rizwanjiwan\probatio\client;

use rizwanjiwan\probatio\payloads\v1\GenericPayload;

/**
 * A client that will connect over http
 */
class Client extends AbstractClient
{
    const API_HEADER='probatio-api-key';

    protected $server;
    protected $apikey;

    /**
     * Client constructor.
     * @param $server string the base URL of the server (e.g. http://probaito.sassservice.com/)
     * @param $apikey string your api key for this server
     */
    public function __construct($server,$apikey)
    {
        if(strcmp(substr($server,-1),'/')!==0)  //end with a slash
            $server.='/';
        $this->server=$server;
        $this->apikey=$apikey;
    }

    /**
     * Make an API call to the probatio server
     * @param $activity string the activity you're trying to do. e.g. if you're trying ot hit '/api/create/' just pass 'create'
     * @param $payload GenericPayload or subclass
     * @return GenericPayload
     */
    protected function makeApiCall($activity,$payload)
    {
        $url = $this->server.'api/' . $activity.'/';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',self::API_HEADER.':' .$this->apikey ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        return json_decode($result);
    }

}