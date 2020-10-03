# probatio

A multivariate test assignment service that allows for multiple identifiers across any number of sites to be shared.

I cranked this out in an evening just for kicks so take it for what it is...

---

Example: You have a marketing site and a web application on a different domain that share a pricing page. You'd like to run a pricing test across both sites with the same prices.

Step 1: Create a client.

```php
$client=new Client('https://probatio.server/','YOUR_API_KEY_SET_IN_SERVER_CONFIG');
```

Step 2: Setup your test.

```php
$testSetup=new CreatePayload();
$testSetup->test_name='price_test_2020-10-02';

$variant1=new VariantsPayload();
$variant1->name='current_price';
$variant1->metaData='anything you want up to 127 characters';
array_push($testSetup->variants,$variant1);

$variant2=new VariantsPayload();
$variant2->name='new_price';
$variant2->metaData='anything you want up to 127 characters';
array_push($testSetup->variants,$variant2);
$client->createTest($testSetup);
```

Step 3: track user

```php
//someone hit the marketing site price page, let's assign or grab them a price
//track them by using marketing site cookie
$visitorByMarketingCookie=new VisitorIdPayload();
$visitorByMarketingCookie->id='10';
$visitorByMarketingCookie->expiry=strtotime('+30 days');    //cookie will expire in 30 days so this link should as well
$visitorByMarketingCookie->type='marketing_site_cookie';

//we also want to try to use their IP to pick them up again in case they clear their cookies but we'll track that for only a few days
$visitorByIp=new VisitorIdPayload();
$visitorByIp->id='127.0.0.1';
$visitorByIp->expiry=strtotime('+3 days');    //cookie will expire in 3 days so this link should as well
$visitorByIp->type='ip';

//associate both those IDs as the same visitor
$assoc=new AssociatePayload();
$assoc->visitorId=$visitorByMarketingCookie;
$assoc->linkToId=$visitorByIp;
$client->associate($assoc);
```

Step 4: Assign this user to a variant in our test when they visit our pricing page

```php
$rolldice=new RollDicePayload();
$rolldice->visitor=$visitorByMarketingCookie;
$rolldice->test_name='price_test_2020-10-02';
$variantAssigned=$client->rollDice($rolldice);
```
$variantAssigned now contains the information of which variant this user should experience.

As the user clicks through to the app from the marketing site, you should try to pass along the cookie ID from the marketing site to the app. The app can then make another associate call with the app's internal tracking ID and the marketing site's cookie ID. 

We're going to assume though that in this case it didn't happen, we can still track the user across and keep a consistent test experience by keying off of IP with-in the 3 days which is what we'll see happen below.

Step 5: Link the app ID with the user's IP

```php
//pretend they hit the app but we have no cookie link but we could have had a hand-off between the sites as well which would be included in the association below
$visitorByProdId=new VisitorIdPayload();
$visitorByProdId->id='app_id';
$visitorByProdId->type='app';   //we can always use the app id (it never changes b/c the user has to login) so we use an expiry of 0 (the default)
$assoc=new AssociatePayload();
$assoc->visitorId=$visitorByMarketingCookie;
$assoc->linkToId=$visitorByIp;  
$client->associate($assoc);//should both be considered the same 'visitor' by the service and by virtue of the IP link, now be tied to the marketing cookie as well!
//now they hit the pricing page we need to either assign or grab a price
$rolldice=new RollDicePayload();
$rolldice->visitor=$visitorByProdId;
$rolldice->test_name='price_test_2020-10-02';
$variantAssigned=$client->rollDice($rolldice);  //will give the same result as on the marketing site
```

From here, you can run your test and pull the data from the DB at the end of the test and match it up against whatever goal you had in mind.

---

Server Setup:
1. Clone the repo: `git clone https://github.com/rizwanjiwan/probatio.git`
2. Go into project directory: `cd probatio`
3. Install dependencies using composer (https://getcomposer.org/). `composer install`
4. Create needed directories: `sh create_directories.sh` Note: this script sets very broad permissions on those directories to make sure the service works in all cases. Feel free to make them more restrictive (to your webserver user for example).
5. Setup your mysql database by creating a database and setting up the initial schema running the sql contained inside `db.sql` in your new databse.
6. Setup your config file by copying the exmple config and then modifying the values as you need (comments are inside the config file describing all the values). `cp config.example config` Be sure to set strong API keys.
7. Wire up your webserver to point to the www directory

Enjoy! Use the examples above to use the service or run test.php from the console to just make sure everything works.

Note: there's an .htaccess file in the www directory which will work on apache with modrewrite. If you're using something else, you'll have to figure out how to send all web requests to wwww/index.php.

---

Server Update:
1. Update code `git pull`
2. Update dependencies `composer install`
3. Update database `php vendor/propel/propel/bin/propel`

----

Client setup:

You can just make ReSt calls to the service using any language you want but there is a php client included in this code which makes your life easier.

1. Include this project in your composer.json file and pull the project into your vendor directory
2. Create a client with new Client(...). The documentation in AbstractClient.php and Client.php is quite clear.
