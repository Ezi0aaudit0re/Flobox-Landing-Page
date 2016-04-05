<?php

	if(!(isset($_POST["email"]) && $_POST["email"] == "#" && isset($_POST["password"]) && $_POST["password"]== "#"))
	{
		header("Location: ./");
	}	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mail all</title>
	<link rel="stylesheet" href="index.css">
</head>
<body>
	<h1>Please enter what do you want to mail to everyone, JUHI</h1>
	<form action="./mailgun_validations/validation.php" method="post">
		<input type="text" name="subject" placeholder="SUBJECT"><br>
		<input type="text" name="body" placeholder="BODY" size="55" style="height: 200px"><br>
		<input type="submit" value="SEND" style="background-color: #5bc0de">
	</form>
</body>
</html>