<?php

require_once "../forms/propertyUtils.php";
require_once "../forms/addressUtils.php";
require_once "cardTemplate.php";

function getPropertyCard($propertyId)
{
    $property = getPropertyFromId($propertyId);
    $address = getAddressFromId($property['address_id']);
    $addressFirstLine = getFirstLineOf($address);
    $keyNumber = "Key: " . $property['key_number'];
    $notes = "Notes: " . $property['notes'];
    $landlordId = "Landlord Id: " . $property['landlord_id'];

    displayCard($addressFirstLine, addressToSting($address), $landlordId, $keyNumber, $notes);
}