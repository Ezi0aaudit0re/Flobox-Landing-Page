<?php
	require "../vendor/autoload.php";

	define('MAILGUN_KEY', '#');
	define('MAILGUN_PBKEY', '#');
	define('MAILGUN_DOMAIN', '#');
	define('MAILGUN_HASH', '#');
	define('MAILGUN_LIST', '#');

	/*-- Two instances one for public key and one for private key --*/
	$mailgun = new Mailgun\Mailgun(MAILGUN_KEY);
	$mailgunValidate = new Mailgun\Mailgun(MAILGUN_PBKEY);

	/*--- OPT IN HANDLERS --*/

	$mailgunOptIn = $mailgun->OptInHandler();
?>