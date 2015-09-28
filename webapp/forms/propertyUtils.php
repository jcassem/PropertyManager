<?php

require_once "addressUtils.php";

function getPropertyFromId($id)
{
    return getSelectQueryResultAsAssocArray("SELECT * FROM property WHERE property_id=" . $id);
}

function propertyToString($property)
{
    $propertyString = "";

    if (isset($property['property_id']))
        $propertyString .= "id " . $property['property_id'] . ":<br>";

    $address = "<br>" . addressToSting(getAddressFromId($property['address_id']));
    if (isset($address))
        $propertyString .= "<br>Address " . $address . "<br>";

    $landlord = "<br>" . personToSting(getPersonFromId($property['landlord_id']));
    if (isset($landlord))
        $propertyString .= "<br>Landlord " . $landlord . "<br>";

    if (isset($property['key_number']))
        $propertyString .= $property['key_number'] . "</br>";

    if (isset($property['notes']))
        $propertyString .= $property['notes'];

    return $propertyString;
}
