<?php

require_once "loginUser.php";
require_once "../validateUser.php";
require_once "../forms/sanitiseFormData.php";

echo <<<_END
<html>
<head><title>Generate Password Token</title></head>
<body>
<h3>Generate Password Token</h3>
<form action="_generateToken.php" method="post"><pre>
Plain text password: 		<input type="text" name="ptpw">
<input name="tokenButton" type="submit" value="Generate">
<input name="validateButton" type="submit" value="Validate & Generate"></pre></form>
<br>
_END;

if (isset($_POST['tokenButton'])) {
	$pass = getPostField('ptpw');
	echo "Token: " . getToken($pass);
}

if (isset($_POST['validateButton'])) {
	$pass = getPostField('ptpw');
	$error = validate_password($pass);
	if ($error != "")
		echo "Error " . $error;
	else
		echo "Token: " . getToken($pass);
}

echo "</body></html>";