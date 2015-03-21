<?php
include("/var/www/html/havocserver.com/home/inc/mandrill/src/Mandrill.php");

function send_mail($subject, $nachricht, $receiver)
{
	$mandrill = new Mandrill('mm3a-tGMRCWbuwz30uzA_A');
	try
	{
		$message = array(
			'subject' => $subject,
			'html' => $nachricht,
			'from_email' => 'noreply@havocserver.com',
			'from_name' => 'Havoc Server',
			'to' => array(
					array(
						'email' => $receiver,
						'type' => 'to'
						)
			)
		);

		$result = $mandrill->messages->send($message);
		return true;
	} 
	catch(Mandrill_Error $e) 
	{
		return false;
	}
}
?>