<?php
	// Sauce: https://developers.fortumo.com/cross-platform-mobile-payments/receipt-verification-for-web-apps/

	define("DONATION_VIP", 1);
	define("DONATION_CUSTOM", 2);
	define("_DONATION_REWARD", 200000);
	$donation_type = 0;
	$vip_secret = 'e88a363c73d7185186645292430001ac';
	$custom_secret = '45beaa37a5e8fa59ac759d8c2dabe47a';

	// check that the request comes from Fortumo server
	if(!in_array($_SERVER['REMOTE_ADDR'],
		array('79.125.125.1', '79.125.5.205', '79.125.5.95', '54.72.6.126', '54.72.6.27', '54.72.6.17', '54.72.6.23'))) 
	{
		header("HTTP/1.0 403 Forbidden");
		die("Error: Unknown IP");
	}
	
	include("../inc/mysql.inc.php");
	include("../inc/mailer.inc.php");
 
	if(!empty($vip_secret) && check_signature($_GET, $vip_secret))
	{
		$donation_type = DONATION_VIP;
	}
	else if(!empty($custom_secret) && check_signature($_GET, $custom_secret))
	{
		$donation_type = DONATION_CUSTOM;
	}
	else
	{
		header("HTTP/1.0 404 Not Found");
		die("Error: Invalid signature");
	}
	
	$sender = $mysqli->real_escape_string($_GET['sender']); //phone num.
	$amount = $_GET['amount']; //credit
	$price = $_GET['price'];
	$cuid = $_GET['cuid']; //resource i.e. user
	$payment_id = $mysqli->real_escape_string($_GET['payment_id']); //unique id

	if(!is_numeric($cuid))
		$cuid = 0;
	
	// hint: find or create payment by payment_id
	// additional parameters: operator, price, user_share, country

	if(preg_match("/failed/i", $_GET['status'])) 
	{
		// mark payment as failed
		$mysqli->query("INSERT INTO `donations` VALUES (NULL, 'DONATION_VIP', '$payment_id', '$sender', $price, 'unknown', $cuid, 'P_SMS', 'PAYMENT_FAILED');");
	} 
	else 
	{
		// mark payment successful
		if ($donation_type == DONATION_VIP)
		{
			$q = $mysqli->query("SELECT `name`, `vip`, `email` FROM `accounts` WHERE `id` = $cuid LIMIT 1;");
			
			if ($q->num_rows == 0)
			{
				$mysqli->query("INSERT INTO `donations` VALUES (NULL, 'DONATION_VIP', '$payment_id', '$sender', $price, 'unknown', $cuid, 'P_SMS', 'USER_NOT_FOUND');");
				return 0;
			}
			
			$r = $q->fetch_row();
			$name = $r[0];
			$vip = $r[1];
			$email = $r[2];

			if ($vip == 1)
			{
				$mysqli->query("INSERT INTO `donations` VALUES (NULL, 'DONATION_VIP', '$payment_id', '$sender', $price, 'unknown', $cuid, 'P_SMS', 'USER_ALREADY_VIP');");
				return 0;
			}
			
			// PAYMENT VALIDATED AS VIP
			$mysqli->query("INSERT INTO `queue` VALUES (NULL, 1, UNIX_TIMESTAMP(), '$cuid,$price');");
			$mysqli->query("INSERT INTO `donations` VALUES (NULL, 'DONATION_VIP', '$payment_id', '$sender', $price, '$name', $cuid, 'P_SMS', 'OK');");
			
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
			{
				send_mail("Thank you!", 
				"Dear $name,<br><br>we have successfully received your VIP donation. Our system will set your VIP status in-game within 5 minutes.<br>Please contact Mellnik or Higgs on the Havoc Forums to receive your forum badge.<br><br>If you have any question please contact: dev@havocserver.com<br><br>Thank you and enjoy playing at Havoc!<br>The Havoc Server Team",
				$email);
			}
		}
		else if ($donation_type == DONATION_CUSTOM)
		{
			$q = $mysqli->query("SELECT `name`, `email` FROM `accounts` WHERE `id` = $cuid LIMIT 1;");
			
			if ($q->num_rows == 0)
			{
				$mysqli->query("INSERT INTO `donations` VALUES (NULL, 'DONATION_CUSTOM', '$payment_id', '$sender', $price, 'unknown', $cuid, 'P_SMS', 'USER_NOT_FOUND');");
				return 0;
			}
			
			$r = $q->fetch_row();
			$name = $r[0];
			$email = $r[1];
			$cashamount = floor($price * _DONATION_REWARD);
			
			// PAYMENT VALIDATED
			$mysqli->query("INSERT INTO `queue` VALUES (NULL, 2, UNIX_TIMESTAMP(), '$cuid,$cashamount');");
			$mysqli->query("INSERT INTO `donations` VALUES (NULL, 'DONATION_CUSTOM', '$payment_id', '$sender', $price, '$name', $cuid, 'P_SMS', 'OK');");
			
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
			{
				send_mail("Thank you!", 
				"Dear $name,<br><br>we have successfully received your custom donation. Our system will credit your account $$cashamount within the next 5 minutes.<br><br>If you have any question please contact: dev@havocserver.com<br><br>Thank you and enjoy playing at Havoc!<br>The Havoc Server Team",
				$email);
			}
		}
	}
 
	function check_signature($params_array, $secret) 
	{
		ksort($params_array);

		$str = '';
		foreach ($params_array as $k=>$v) 
		{
			if($k != 'sig') 
			{
				$str .= "$k=$v";
			}
		}
		$str .= $secret;
		$signature = md5($str);

		return ($params_array['sig'] == $signature);
	}
?>