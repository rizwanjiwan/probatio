<?php
/**
 * Main handler that pipes everything down the controller/view/redirect path
 */


use rizwanjiwan\common\web\RequestHandler;
use rizwanjiwan\common\web\routes\ControllerRoute;

date_default_timezone_set('America/Toronto');
require_once realpath(dirname(__FILE__)).'/../vendor/autoload.php';
require_once realpath(dirname(__FILE__)).'/../generated-conf/config.php';

$rh=new RequestHandler();
$rh->registerForShutdownErrors();

$rh->addRoute(new ControllerRoute('/api/create/','ApiController.create'));
$rh->addRoute(new ControllerRoute('/api/rolldice/','ApiController.rolldice'));
$rh->addRoute(new ControllerRoute('/api/associate/','ApiController.associate'));

$rh->handle();
