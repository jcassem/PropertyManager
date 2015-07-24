<?php

require_once "session/loginUser.php";
require_once "validateUser.php";
require_once "addDbData.php";

echo <<<_END
<form action="userLogin.php" method="post"><pre>
Username: 		<input type="text" name="un">
Password: 		<input type="password" name="pw">
<input name="loginButton" type="submit" value="Login"></pre></form>
_END;

$username = getPostField('un');
$password = getPostField('pw');

$error = validate_username($username);
//$error .= validate_password($password);

if (isset($_POST['loginButton'])) {
	if ($error != "")
		echo "Error:<br>" . $error;
	else
		loginUserWith($username, $password);
}