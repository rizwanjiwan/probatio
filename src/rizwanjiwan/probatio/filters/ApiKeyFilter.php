<?php
namespace rizwanjiwan\probatio\filters;

/**
 * Filter that:
 *      - validates that the header for api key is set
 *      - Validates that the api key provided is valid
 * If the API key is valid, passes this filter
 * If it fails, outputs a json error and kills further execution
 */

use rizwanjiwan\common\classes\Config;
use rizwanjiwan\common\traits\NameableTrait;
use rizwanjiwan\common\web\Filter;
use rizwanjiwan\probatio\controllers\ApiController;

class ApiKeyFilter implements Filter
{

    use NameableTrait;
    const HEADER='probatio-api-key';

    private static $testmode=false;//set to true to skip any filtering while testing

    public function filter($request)
    {
        if(self::$testmode)
            return;//skip all checks
        $headers=getallheaders();
        if(array_key_exists(self::HEADER,$headers))
        {
            $providedKey=$headers[self::HEADER];
            $validKeys=Config::getArray('API_KEYS');
            if(array_search($providedKey,$validKeys)!==false)
                return;//passes
        }
        //error
        ApiController::generateApiError($request,'Invalid API Key');
        exit(0);
    }

    public static function enableTestMode()
    {
        self::$testmode=true;
    }
}