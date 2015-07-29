<?php

require_once "addDbData.php";
require_once "../dbAccess/dbLogin.php";

// <form action="addAddressTemplate.php" method="post"><pre>

echo <<<_END
House number* 		<input type="text" name="house_number">
Street name 		<input type="text" name="street_name">
Second line 		<input type="text" name="second_line">
City 			<input type="text" name="city">
County 			<input type="text" name="county">
Postcode*		<input type="text" name="postcode">
_END;

// <input name="submitButton" type="submit" value="Create"></pre></form>

function getAddress ()
{
	$address = array("house_number" => getPostField('house_number'),
		"street_name" => getPostField('street_name'),
		"second_line" => getPostField('second_line'),
		"city" => getPostField('city'),
		"county" => getPostField('county'),
		"postcode" => getPostField('postcode'));

	$address["error"] = validateAddress($address);

	return $address;
}

function validateAddress ($address)
{
	$error = validate_house_number($address["house_number"]);
	$error .= validate_postcode($address["postcode"]);

	return $error;
}

function validate_house_number ($house_number)
{
	if ($house_number == "")
		return "No house number was entered<br>";
	else if (!is_numeric($house_number))
		return "House number must contain numbers only<br>";

	return "";
}

function validate_postcode ($postcode)
{
	$postcode = strtoupper($postcode);

	if ($postcode == "")
		return "No postcode was entered<br>";
	else if (!preg_match("/^([a-zA-Z]{1,2}\d{1,2})\s*?(\d[a-zA-Z]{2})$/", $postcode))
		return "Postcode not of correct format<br>";

	return "";
}

function addAddress ($address)
{
	$query = "INSERT INTO address (house_number, street_name, second_line, city, county, postcode) VALUES (";
	$query .= "'" . $address['house_number'] . "'," . "'" . $address['street_name'] . "'," . "'";
	$query .= $address['second_line'] . "'," . "'" . $address['city'] . "'," . "'" . $address['county'] . "',";
	$query .= "'" . $address['postcode'] . "')";

	return getInsertQueryResultId($query);
}