<?php
	/*-- Start session to keey track of the messages --*/
  	session_start();
  	
  	require "./info.php";

  	/*-- validate user, hash generate, send user confirmation email --*/
  	if(isset($_POST["email"]) && isset($_POST["name"]))
  	{
  		/*-- validate email --*/
  		$validate = $mailgunValidate->get('address/validate', [
  				'address' => $_POST["email"]
  			])->http_response_body;
  		
  		/*-- Generate hash --*/
  		if($validate->is_valid)
  		{	
  			
  			$hash = $mailgunOptIn->generateHash('MAILGUN_LIST', 'MAILGUN_HASH', $_POST["email"]);
 
  			/*-- send email to the user -*/
  			$mailgun->sendmessage(MAILGUN_DOMAIN, [
  				'from' => 'confirmation@fobox.in',
  				'to' => $_POST['email'],
  				'subject' => 'Fobox email confirmation',
  				'html' => "
					<h2> Hi, {$_POST['name']}</h2>
					<h3>Welcome to Fobox, Your monthly suprise for body and mind</h3>
					<h4>Please click the link below to confirm your subscription</h4>
					<a href='http://localhost:8888/mailgun_validations/validation.php?hash=". urlencode($hash) ."''> LINK </a>
  				"
  				]);

  			$_SESSION["message"] = "Please confirm your email address";

  			
  			/*-- add user to the subscribers list --*/
  			$mailgun->post('lists/' . MAILGUN_LIST . '/members',[
  				"name" => $_POST["name"],
  				"address" => $_POST["email"],
  				"subscribe" => "no"
  				]);
  		}
  		header("Location: ../");
  	}

  	/*-- Validate Hash --*/
  	if(isset($_GET["hash"]))
  	{
  		$hash = $mailgunOptIn->validateHash('MAILGUN_HASH', $_GET["hash"]);
  		if(isset($hash["recipientAddress"]))
  		{
  			$mailgun->put("lists/". MAILGUN_LIST . "/members/" . $hash["recipientAddress"], [
  				"subscribe" => "yes"
  				]);
  		}
  		$_SESSION["message"] = "You have been sucessfully subscribed";
  		header("Location: ../");
  	}

  	/*-- admin can send message to everyone --*/
  	if(isset($_POST["subject"]) && isset($_POST["body"])) 
  	{
  		$mailgun->sendmessage(MAILGUN_DOMAIN, [
  			'from' => 'update@fobox.in',
  			'to' => MAILGUN_LIST,
  			'subject' => $_POST["subject"],
  			'html' => "
				<h3>Hellow %recipient_fname%</h3>
				<p>{$_POST['body']}</p>
  			"
  			]);
  		$_SESSION["message"] = "Juhi your message has been sent to everyone";
  		header('Location: ../');
  	}

?>
