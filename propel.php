<?php
use rizwanjiwan\common\classes\Config;

$queryies=array('utf8'=>"SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci, COLLATION_CONNECTION = utf8mb4_unicode_ci, COLLATION_DATABASE = utf8mb4_unicode_ci, COLLATION_SERVER = utf8mb4_unicode_ci");
if(Config::getBool('DB_SKIP_SET_SET')===true)
    $queryies=array();
return [
    'propel' => [
        'database' => [
            'connections' => [
                'default' => [
                    'adapter' => 'mysql',
                    'dsn' => 'mysql:host='.Config::get('DB_HOST').';port='.Config::get('DB_PORT').';dbname='.Config::get('DB_DATABASE').';charset=utf8mb4',
                    'user' => Config::get('DB_LOGIN'),
                    'password' => Config::get('DB_PASSWORD'),
                    'settings' => [
                        'charset' => 'utf8mb4',
                        'queries'=>$queryies
                    ]
                ]
            ]
        ]
    ]
];
