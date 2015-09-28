<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/webapp/dbAccess/dbAccessFactory.php";
require_once "addressUtils.php";

function getPersonFromForm()
{
    $type = "";
    if (isset($_POST['type']))
        $type = $_POST['type'];

    $person = array("type" => $type,
        "salutation" => getPostField('salutation'),
        "first_name" => getPostField('first_name'),
        "last_name" => getPostField('last_name'),
        "email_address" => getPostField('email_address'),
        "mobile_number" => getPostField('mobile_number'),
        "company" => getPostField('company'),
        "notes" => getPostField('notes'),
        "address" => getAddressFromForm());

    $person["error"] = validatePerson($person);

    return $person;
}

function getPersonFromId($id)
{
    return getSelectQueryResultAsAssocArray("SELECT * FROM person WHERE person_id = " . $id);
}

function personToSting($person)
{
    $personString = "";

    if (isset($person['person_id']))
        $personString .= "id:" . $person['person_id'];

    if (isset($person['type']))
        $personString .= " (" . $person['type'] . ")";

    $personString .= "<br>";

    if (isset($person['salutation']))
        $personString .= $person['salutation'] . " ";

    if (isset($person['first_name']))
        $personString .= $person['first_name'] . " ";

    if (isset($person['last_name']))
        $personString .= $person['last_name'] . ",<br>";

    if (isset($person['company_name']))
        $personString .= $person['company_name'] . ",<br>";

    if (isset($person['email_address']))
        $personString .= $person['email_address'] . ",<br>";

    if (isset($person['mobile_number']))
        $personString .= $person['mobile_number'] . ",<br>";

    if (isset($person['notes']))
        $personString .= $person['notes'];

    return $personString;
}


function validatePerson ($person)
{
    $error = "";
    $error .= validate_type($person["type"]);
    $error .= validate_first_name($person["first_name"]);
    $error .= validate_last_name($person["last_name"]);
    $error .= validate_salutation($person["salutation"]);
    $error .= validate_email($person["email_address"]);
    $error .= validate_mobile($person["mobile_number"]);
    $error .= validateAddress($person['address']);

    echo $person['email_address'];

    return $error;
}

function validate_first_name ($first_name)
{
    return ($first_name == "") ? "No first name was entered<br>" : "";
}

function validate_last_name ($last_name)
{
    return ($last_name == "") ? "No second name was entered<br>" : "";
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
        $query .= $person['type'] . "','" . $person['first_name'] . "','" . $person['last_name'];
        $query .= "','" . $person['salutation'] . "','" . $person['company'] . "','" . $person['email_address'];
        $query .= "','" . $person['mobile_number'] . "','" . $person['notes'] . "','" . $addressId . "')";

        return getInsertQueryResultId($query);
    } else {
        $query = "INSERT INTO person ";
        $query .= "(type, first_name, last_name, salutation, company_name, email_address, mobile_number, notes)";
        $query .= " VALUES ('";
        $query .= $person['type'] . "','" . $person['first_name'] . "','" . $person['last_name'];
        $query .= "','" . $person['salutation'] . "','" . $person['company'] . "','" . $person['email_address'];
        $query .= "','" . $person['mobile_number'] . "','" . $person['notes'] . "')";

        return getInsertQueryResultId($query);
    }
}