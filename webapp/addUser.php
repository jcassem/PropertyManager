<?php

$_POST['type'] = 'LANDLORD';

echo '<form action="addUser.php" method="post"><pre>';

echo "<h3>Person:</h3>";
require_once "addPersonTemplate.php";

echo "<br><h3>Address:</h3>";
require_once "addAddressTemplate.php";

echo <<<_END
<br><h3>Login:</h3>
Username* 		<input type="text" name="un">
Password*		<input type="password" name="pw">
<br><input name="submitButton" type="submit" value="Create">
</pre>
</form>
_END;

// Initialise
$person = getPerson();
$address = getAddress();
$username = getPostField('un');
$password = getPostField('pw');

// Validate
$error = $person["error"];
$error .= $address["error"];
$error .= validate_username($username);
$error .= validate_password($password);

// Give result if submit button has been clicked
if (isset($_POST['submitButton'])) {
	if ($error != "")
		echo "Error:<br>" . $error;
	else
		echo "Success";
}

function validate_username ($username)
{
	if ($username == "")
		return "No Username was entered";
	else if (strlen($username) < 5)
		return "Username must be at least 5 characters";
	else if (preg_match("/[^a-zA-Z0-9_-]/", $username))
		return "Only letters, numbers, - and _ can be used in Username";

	return "";
}

function validate_password ($password)
{
	if ($password == "")
		return "No Password was entered";
	else if (strlen($password) < 6)
		return "Password must be at least 6 characters";
	else if (!preg_match("/[a-z]/", $password) || !preg_match("/[A-Z]/", $password) || !preg_match("/[0-9]/", $password))
		return "Password requires at least one of each; a-z, A-Z and 0-9";

	return "";
}