<?php

use rizwanjiwan\common\classes\Config;
use Monolog\Handler\StreamHandler;
use Propel\Runtime\Propel;

$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass('default', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$queryies=array('utf8'=>"SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci, COLLATION_CONNECTION = utf8mb4_unicode_ci, COLLATION_DATABASE = utf8mb4_unicode_ci, COLLATION_SERVER = utf8mb4_unicode_ci");
if(Config::getBool('DB_SKIP_SET_SET')===true)
    $queryies=array();

$manager->setConfiguration(array (
    'dsn' => 'mysql:host='.Config::get('DB_HOST').';port='.Config::get('DB_PORT').';dbname='.Config::get('DB_DATABASE').';charset=utf8mb4',
    'user' => Config::get('DB_LOGIN'),
    'password' => Config::get('DB_PASSWORD'),
    'settings' =>
        array (
            'charset' => 'utf8mb4',
            'queries' =>$queryies,
        ),
    'classname' => '\\Propel\\Runtime\\Connection\\ConnectionWrapper',
    'model_paths' =>
        array (
            0 => 'src',
            1 => 'vendor',
        ),
));
$manager->setName('default');
$serviceContainer->setConnectionManager('default', $manager);
$serviceContainer->setDefaultDatasource('default');
if(strcmp(Config::get('ENV'),'dev')===0)//add logging
{
    $logger = new Monolog\Logger('defaultLogger');
    $logger->pushHandler(new StreamHandler(realpath(dirname(__FILE__)).'/../logs/propel.log'));
    Propel::getServiceContainer()->setLogger('defaultLogger', $logger);
    $logger->info('Dev logging on');
    $con = Propel::getWriteConnection(\rizwanjiwan\probatio\storage\propel\Map\VisitorsTableMap::DATABASE_NAME);
    $con->useDebug(true);
}