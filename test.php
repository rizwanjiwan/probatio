<?php
/**
 * Run some tests in memory without booting up multiple servers etc. You still need to do that testing at some point
 * but this let's you just test the logic quickly instead.
 */
use rizwanjiwan\probatio\client\InMemoryClient;
use rizwanjiwan\probatio\payloads\v1\AssociatePayload;
use rizwanjiwan\probatio\payloads\v1\CreatePayload;
use rizwanjiwan\probatio\payloads\v1\RollDicePayload;
use rizwanjiwan\probatio\payloads\v1\VariantsPayload;
use rizwanjiwan\probatio\payloads\v1\VisitorIdPayload;

date_default_timezone_set('America/Toronto');
require_once realpath(dirname(__FILE__)).'/vendor/autoload.php';
require_once realpath(dirname(__FILE__)).'/generated-conf/config.php';

//testing data
$userIPaddress='10.0.1.15';
$userCookieOnMarketing='dfslkjadskoa9ds8j';
$userIdOnProd='15';

$testSetup=new CreatePayload();
$testSetup->test_name='price_test_2020-10-02';

$variant1=new VariantsPayload();
$variant1->name='current_price';
$variant1->metaData='["sub_dfsafds","sub_fdsadsf","sub_fdsiofjds"]';
array_push($testSetup->variants,$variant1);

$variant2=new VariantsPayload();
$variant2->name='higher_price';
$variant2->metaData='["sub_dfsafds2","sub_fdsadsf2","sub_fdsiofjds2"]';
array_push($testSetup->variants,$variant2);

// run test
//create the test
$client=new InMemoryClient();
$client->createTest($testSetup);

//someone hit the marketing site price page, let's assign or grab them a price
//track them by marketing site cookie
$visitorByMarketingCookie=new VisitorIdPayload();
$visitorByMarketingCookie->id=$userCookieOnMarketing;
$visitorByMarketingCookie->expiry=strtotime('+30 days');    //cookie will expire in 30 days so this link should as well
$visitorByMarketingCookie->type='marketing_site_cookie';
//we also want to try to use their IP to pick them up again in case they clear their cookies but we'll track that for only a few days
$visitorByIp=new VisitorIdPayload();
$visitorByIp->id=$userIPaddress;
$visitorByIp->expiry=strtotime('+3 days');    //cookie will expire in 30 days so this link should as well
$visitorByIp->type='ip';
$assoc=new AssociatePayload();
$assoc->visitorId=$visitorByMarketingCookie;
$assoc->linkToId=$visitorByIp;
$client->associate($assoc);//should both be considered the same 'visitor' by the service

$rolldice=new RollDicePayload();
$rolldice->visitor=$visitorByMarketingCookie;
$rolldice->test_name=$testSetup->test_name;
$variantAssigned=$client->rollDice($rolldice);
echo "User assigned: ".json_encode($variantAssigned);

//pretend they hit the prod site but we have no cookie link but we could have had a hand-off between teh sites as well which would be included in the association below
$visitorByProdId=new VisitorIdPayload();
$visitorByProdId->id=$userIdOnProd;
$visitorByProdId->type='prod_id';
$assoc=new AssociatePayload();
$assoc->visitorId=$visitorByProdId;
$assoc->linkToId=$visitorByIp;  //we can always use IP
$client->associate($assoc);//should both be considered the same 'visitor' by the service and by virtue of the IP link, now be tied to the marketing cookie
//now they hit the pricing page we need to either assign or grab a price
$rolldice=new RollDicePayload();
$rolldice->visitor=$visitorByProdId;
$rolldice->test_name=$testSetup->test_name;
$variantAssigned=$client->rollDice($rolldice);
echo "\nUser assigned: ".json_encode($variantAssigned); //this should be the same as above
