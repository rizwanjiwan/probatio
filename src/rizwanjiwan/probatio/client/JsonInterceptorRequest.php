<?php


namespace rizwanjiwan\probatio\client;


use rizwanjiwan\common\web\Request;

/**
 * The request sent to ApiController to avoid outputting json but instead capture it while testing/in-memory
 */
class JsonInterceptorRequest extends Request
{

    public static $capturedJson=null;
    /**
     * When you want to dump output as json
     * @param $obj object|array which can be passed through json_encode
     */
    public function respondJson($obj)
    {
        self::$capturedJson=$obj;
    }
}