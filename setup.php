<?php

/**********************
* Account information
***********************/

define('GOOGLE_APPLICATION_NAME', 
	'Allison Road Game Analytics');
define('GOOGLE_CLIENT_EMAIL', 
	'nikolai.ishan@gmail.com');
define('GOOGLE_USER_EMAIL', 
	'nikolai.ishan@gmail.com');

// Appears under "View Settings" in "Admin" section for your analytics as "View ID"
define('GOOGLE_ANALYTICS_PROFILE_ID', 
	'104066322');

// Appears at the end of the URL when logged into your Analytics page. Example:
// https://www.google.com/analytics/web/?hl=en#report/visitors-overview/a1111111w2222222p3333333/
define('GOOGLE_ANALYTICS_WEB_ID', 
	'a64260969w100163327p104066322');

// Make an incoming webhook here: 
// https://YOURSLACK.slack.com/services/new/incoming-webhook
define('SLACK_WEBHOOK_URL', 
	'https://hooks.slack.com/services/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');
define('YOUR_DOMAIN', 
	'http://lilithltd.com');


set_include_path( get_include_path() . PATH_SEPARATOR . dirname(__FILE__) );

require_once 'Google/Client.php';
require_once 'Google/Service/Analytics.php';

session_start();

$client = new Google_Client();
$client->setApplicationName(GOOGLE_APPLICATION_NAME);


// Replace this with the service you are using.
$analytics = new Google_Service_Analytics($client);

$key_file_location = dirname(__FILE__).'/privatekey.p12';
// This file location should point to the private key file.
$key = file_get_contents($key_file_location);
$cred = new Google_Auth_AssertionCredentials(
  // Replace this with the email address from the client.
  GOOGLE_CLIENT_EMAIL,
  // Replace this with the scopes you are requesting.
  array('https://www.googleapis.com/auth/analytics.readonly'),
  $key
);
$cred->sub = GOOGLE_USER_EMAIL;
$client->setAssertionCredentials($cred);

?>