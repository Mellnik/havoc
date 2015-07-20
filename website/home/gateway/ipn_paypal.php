<?php
// Sauce: https://github.com/paypal/ipn-code-samples/blob/master/paypal_ipn.php

error_reporting(-1);
ini_set("display_errors", 1);

define("DEBUG", 1);
define("USE_SANDBOX", 1);
define("ACCESS_LOG", "/var/cache/httpd/havoc_ipn_access.log");
define("DATA_LOG", "/var/cache/httpd/havoc_ipn_data.log");
define("_DONATION_REWARD", 200000);

include("../inc/mysql.inc.php");
include("../inc/mailer.inc.php");

// Read POST data
// reading posted data directly from $_POST causes serialization
// issues with array data in POST. Reading raw POST data from input stream instead.
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();

foreach ($raw_post_array as $keyval) {
	$keyval = explode('=', $keyval);
	if (count($keyval) == 2)
		$myPost[$keyval[0]] = urldecode($keyval[1]);
}
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
	$get_magic_quotes_exists = true;
}
foreach ($myPost as $key => $value) {
	if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
		$value = urlencode(stripslashes($value));
	} else {
		$value = urlencode($value);
	}
	$req .= "&$key=$value";
}

if (USE_SANDBOX == true) {
	$paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
} else {
	$paypal_url = "https://www.paypal.com/cgi-bin/webscr";
}

$ch = curl_init($paypal_url);
if ($ch == FALSE) {
	return FALSE;
}

curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

if (DEBUG == true) {
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
}

// Set TCP timeout to 30 seconds
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

// CONFIG: Please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path
// of the certificate as shown below. Ensure the file is readable by the webserver.
// This is mandatory for some environments.

//$cert = __DIR__ . "./cacert.pem";
//curl_setopt($ch, CURLOPT_CAINFO, $cert);

$res = curl_exec($ch);
if (curl_errno($ch) != 0) // cURL error
{
	if (DEBUG == true) {	
		error_log(date('[Y-m-d H:i e] '). "Can't connect to PayPal to validate IPN message: " . curl_error($ch) . PHP_EOL, 3, ACCESS_LOG);
	}
	curl_close($ch);
	exit;

} else {
	// Log the entire HTTP response if debug is switched on.
	if(DEBUG == true) {
		error_log(date('[Y-m-d H:i e] '). "HTTP request of validation request:". curl_getinfo($ch, CURLINFO_HEADER_OUT) ." for IPN payload: $req" . PHP_EOL, 3, ACCESS_LOG);
		error_log(date('[Y-m-d H:i e] '). "HTTP response of validation request: $res" . PHP_EOL, 3, ACCESS_LOG);
	}
	curl_close($ch);
}

$tokens = explode("\r\n\r\n", trim($res));
$res = trim(end($tokens));

if (strcmp($res, "VERIFIED") == 0) 
{
	// check whether the payment_status is Completed
	// check that txn_id has not been previously processed
	// check that receiver_email is your PayPal email
	// check that payment_amount/payment_currency are correct
	// process payment and mark item as paid.

	$item_number = $_POST['item_number1'];		// z.B: HAVOC-VIP-FREEROAM
	$payment_status = $_POST['payment_status'];	// zahlungsstatus
	$payment_amount = $_POST['mc_gross'];		// Wie viel er donated hat
	$payment_currency = $_POST['mc_currency'];
	$txn_id = $mysqli->real_escape_string($_POST['txn_id']);				// Transaction ID
	$receiver = $_POST['custom'];											// Account ID
	$payer_email = $mysqli->real_escape_string($_POST['payer_email']);		// The email of the donator
	
	if(!is_numeric($receiver))
		$receiver = 0;	
	
	if(DEBUG == true)
	{
		error_log(date('[Y-m-d H:i e] '). "recv: $item_number, $payment_status, $payment_amount, $payment_currency, $txn_id, $receiver, $payer_email " . PHP_EOL, 3, DATA_LOG);
		error_log(date('[Y-m-d H:i e] '). "Verified IPN: $req ". PHP_EOL, 3, ACCESS_LOG);
	}
	
	if($item_number == "HAVOC-VIP-FREEROAM") 
	{
		$q = $mysqli->query("SELECT `id` FROM `donations` WHERE `txn_id` = '$txn_id' LIMIT 1;");
		
		if ($q->num_rows != 0)
		{
			$mysqli->query("INSERT INTO `donations` VALUES (NULL, 'DONATION_VIP', '$txn_id', '$payer_email', $payment_amount, 'unknown', $receiver, 'P_PAYPAL', 'TXN_ID_EXISTS');");
			return 0;
		}
		
		$q = $mysqli->query("SELECT `name`, `vip`, `email` FROM `accounts` WHERE `id` = $receiver LIMIT 1;");
		
		if ($q->num_rows == 0)
		{
			$mysqli->query("INSERT INTO `donations` VALUES (NULL, 'DONATION_VIP', '$txn_id', '$payer_email', $payment_amount, 'unknown', $receiver, 'P_PAYPAL', 'USER_NOT_FOUND');");
			return 0;
		}
		
		$r = $q->fetch_row();
		$name = $r[0];
		$vip = $r[1];
		$email = $r[2];
		
		if ($vip == 1)
		{
			$mysqli->query("INSERT INTO `donations` VALUES (NULL, 'DONATION_VIP', '$txn_id', '$payer_email', $payment_amount, 'unknown', $receiver, 'P_PAYPAL', 'USER_ALREADY_VIP');");
			return 0;
		}
		
		// PAYMENT VALIDATED AS VIP
		$mysqli->query("INSERT INTO `queue` VALUES (NULL, 1, UNIX_TIMESTAMP(), '$receiver,$payment_amount');");
		$mysqli->query("INSERT INTO `donations` VALUES (NULL, 'DONATION_VIP', '$txn_id', '$payer_email', $payment_amount, '$name', $receiver, 'P_PAYPAL', 'OK');");
		
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
		{
			send_mail("Thank you!",
			"Dear $name,<br><br>we have successfully received your VIP donation. Our system will set your VIP status in-game within 5 minutes.<br>Please contact Mellnik or Higgs on the Havoc Forums to receive your forum badge.<br><br>If you have any question please contact: dev@havocserver.com<br><br>Thank you and enjoy playing at Havoc!<br>The Havoc Server Team",
			$email);
		}
	}
	else if($item_number == "HAVOC-CUSTOM-FREEROAM")
	{
		$q = $mysqli->query("SELECT `id` FROM `donations` WHERE `txn_id` = '$txn_id' LIMIT 1;");
		
		if ($q->num_rows != 0)
		{
			$mysqli->query("INSERT INTO `donations` VALUES (NULL, 'DONATION_CUSTOM', '$txn_id', '$payer_email', $payment_amount, 'unknown', $receiver, 'P_PAYPAL', 'TXN_ID_EXISTS');");
			return 0;
		}
		
		$q = $mysqli->query("SELECT `name`, `email` FROM `accounts` WHERE `id` = $receiver LIMIT 1;");
		
		if ($q->num_rows == 0)
		{
			$mysqli->query("INSERT INTO `donations` VALUES (NULL, 'DONATION_CUSTOM', '$txn_id', '$payer_email', $payment_amount, 'unknown', $receiver, 'P_PAYPAL', 'USER_NOT_FOUND');");
			return 0;
		}
		
		$r = $q->fetch_row();
		$name = $r[0];
		$email = $r[1];
		$cashamount = floor($payment_amount * _DONATION_REWARD);
		
		// PAYMENT VALIDATED
		$mysqli->query("INSERT INTO `queue` VALUES (NULL, 2, UNIX_TIMESTAMP(), '$receiver,$cashamount');");
		$mysqli->query("INSERT INTO `donations` VALUES (NULL, 'DONATION_CUSTOM', '$txn_id', '$payer_email', $payment_amount, '$name', $receiver, 'P_PAYPAL', 'OK');");
		
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
		{
			send_mail("Thank you!", 
			"Dear $name,<br><br>we have successfully received your custom donation. Our system will credit your account $$cashamount within the next 5 minutes.<br><br>If you have any question please contact: dev@havocserver.com<br><br>Thank you and enjoy playing at Havoc!<br>The Havoc Server Team",
			$email);
		}
	}
	else
	{
		$mysqli->query("INSERT INTO `donations` VALUES (NULL, 'DONATION_VIP', '$txn_id', '$payer_email', $payment_amount, 'unknown', $receiver, 'P_PAYPAL', 'UNKNOWN_ITEM');");
	}
} 
else 
{
	if(DEBUG == true) 
		error_log(date('[Y-m-d H:i e] '). "Invalid IPN: $req" . PHP_EOL, 3, ACCESS_LOG);
}
?>