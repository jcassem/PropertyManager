<?php

require_once 'validateUser.php';

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

