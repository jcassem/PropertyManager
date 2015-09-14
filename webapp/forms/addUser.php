<?php

require_once '../validateUser.php';
require_once "../dbAccess/dbAccessFactory.php";
require_once "../session/sessionUtils.php";

$_POST['type'] = 'LANDLORD';

echo '<form action="addUser.php" method="post"><pre>';

require_once "addPersonTemplate.php";

echo <<<_END
<br>
Username* 		<input type="text" name="un">
Password*		<input type="password" name="pw">
<br><input name="submitButton" type="submit" value="Create">
</pre>
</form>
_END;

// Initialise
$person = getPerson();
$address = $person['address'];
$username = getPostField('un');
$password = getPostField('pw');

// Validate
$error = $person["error"];
$error .= $address["error"];
$error .= validate_username($username);
$error .= validate_password($password);

if (isset($_POST['submitButton'])) {
	if ($error != "")
		echo "Error:<br>" . $error;
	else
		echo addUser($person, $username, $password);
}

function addUser ($person, $username, $password)
{
	$personResult = addPerson($person);

	if ($personResult) {
		$query = "INSERT INTO user (username, password, person_id, account_type) VALUES (";
		$query .= "'" . $username . "'," . "'" . getToken($password) . "',";
		$query .= "'" . $personResult . "'," . "'FREE')";

		$userId = getInsertQueryResultId($query);

		return $userId ? "User Id: " . $userId : "Person added, user not added";
	}
	else
		return "Person and user not added";
}
