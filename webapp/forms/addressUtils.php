<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/webapp/dbAccess/dbAccessFactory.php";

function getAddressFromForm()
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

function getAddressFromId($id)
{
    return getSelectQueryResultAsAssocArray("SELECT * FROM address WHERE address_id=" . $id);
}

function addressToSting($address)
{
    $addressString = "";

    if (isset($address['address_id']))
        $addressString .= "id: " . $address['address_id'] . "<br>";

    if (isset($address['house_number']))
        $addressString .= $address['house_number'] . " ";

    if (isset($address['street_name']))
        $addressString .= $address['street_name'] . ",<br>";

    if (isset($address['second_line']))
        $addressString .= $address['second_line'] . ",<br>";

    if (isset($address['city']))
        $addressString .= $address['city'] . ",<br>";

    if (isset($address['county']))
        $addressString .= $address['county'] . ",<br>";

    if (isset($address['postcode']))
        $addressString .= $address['postcode'];

    return $addressString;
}

function getFirstLineOf($address)
{
    return $address['house_number'] . " " . $address['street_name'];
}

function validateAddress ($address)
{
    $error = "";
    $error .= validate_house_number($address["house_number"]);
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