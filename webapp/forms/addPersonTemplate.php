<?php

require_once "addDbData.php";
require_once "../dbAccess/dbLogin.php";

// Person table enums
$salutations = array('Mr',
	'Mrs',
	'Miss',
	'Ms',
	'Dr',
	'Lord');

// <form action="addPersonTemplate.php" method="post"><pre>

echo 'Salutation*		<select name="salutation">';
foreach ($salutations as $sal)
	echo '<option value="' . $sal . '">' . $sal . '</option>';
echo "</select><br>";

echo <<<_END
First name* 		<input type="text" name="first_name">
Second name* 		<input type="text" name="second_name">
Email address* 		<input type="email" name="email">
Phone number* 		<input type="tel" name="mobile_number">
Company name 		<input type="text" name="company">
Notes			<input type="text" name="notes">
_END;

echo "<br><br>";

require_once 'addAddressTemplate.php';

// <input name="submitButton" type="submit" value="Create"></pre></form>

function getPerson ()
{
	$type = "";
	if (isset($_POST['type']))
		$type = $_POST['type'];

	$person = array("type" => $type,
		"salutation" => getPostField('salutation'),
		"first_name" => getPostField('first_name'),
		"second_name" => getPostField('second_name'),
		"email" => getPostField('email'),
		"mobile" => getPostField('mobile_number'),
		"company" => getPostField('company'),
		"notes" => getPostField('notes'),
		"address" => getAddress());

	$person["error"] = validatePerson($person);

	return $person;
}

function validatePerson ($person)
{
	$error = validate_type($person["type"]);
	$error .= validate_first_name($person["first_name"]);
	$error .= validate_second_name($person["second_name"]);
	$error .= validate_salutation($person["salutation"]);
	$error .= validate_email($person["email"]);
	$error .= validate_mobile($person["mobile"]);
	$error .= validateAddress($person['address']);

	return $error;
}

function validate_first_name ($first_name)
{
	return ($first_name == "") ? "No first name was entered<br>" : "";
}

function validate_second_name ($second_name)
{
	return ($second_name == "") ? "No second name was entered<br>" : "";
}

function validate_salutation ($salutation)
{
	global $salutations;

	if ($salutation == "")
		return "No salutation was selected<br>";
	else if (!in_array($salutation, $salutations))
		return "Invalid salutation selected<br>";

	return "";
}

function validate_email ($email)
{
	if ($email == "")
		return "No email was entered<br>";
	else if (!(strpos($email, ".") > 0 && (strpos($email, "@") > 0)) || preg_match("/[^a-zA-Z0-9.@_-]/", $email))
		return "Email is invalid<br>";

	return "";
}

function validate_type ($type)
{
	$person_types = array('TENANT',
		'LANDLORD',
		'AGENT',
		'CONTRACTOR',
		'OTHER');

	if ($type == "")
		return "No person type was selected<br>";
	else if (!in_array(strtoupper($type), $person_types))
		return "Person type is invalid<br>";

	return "";
}

function validate_mobile ($mobile)
{
	if ($mobile == "")
		return "No phone number was entered<br>";
	else if (!preg_match("/[0-9 +]/", $mobile))
		return "Phone number must only contain numbers<br>";

	return "";
}

function addPerson ($person)
{
	$addressId = addAddress($person['address']);

	if ($addressId) {
		$query = "INSERT INTO person ";
		$query .= "(type, first_name, last_name, salutation, company_name, email_address, mobile_number, notes, address_id)";
		$query .= " VALUES ('";
		$query .= $person['type'] . "','" . $person['first_name'] . "','" . $person['second_name'];
		$query .= "','" . $person['salutation'] . "','" . $person['company'] . "','" . $person['email'];
		$query .= "','" . $person['mobile'] . "','" . $person['notes'] . "','" . $addressId . "')";

		return getInsertQueryResultId($query);
	}
	else {
		$query = "INSERT INTO person ";
		$query .= "(type, first_name, last_name, salutation, company_name, email_address, mobile_number, notes)";
		$query .= " VALUES ('";
		$query .= $person['type'] . "','" . $person['first_name'] . "','" . $person['second_name'];
		$query .= "','" . $person['salutation'] . "','" . $person['company'] . "','" . $person['email'];
		$query .= "','" . $person['mobile'] . "','" . $person['notes'] . "')";

		return getInsertQueryResultId($query);
	}
}