<?php

require_once "../forms/tenancyUtils.php";
require_once "../forms/propertyUtils.php";
require_once "../forms/personUtils.php";
require_once "../forms/addressUtils.php";

require_once "cardTemplate.php";

function getTenancyCard($tenancyId)
{
    $tenancy = getTenancyFromId($tenancyId);

    $property = getPropertyFromId($tenancy['property_id']);
    $address = getAddressFromId($property['address_id']);
    $addressFirstLine = getFirstLineOf($address);

    $tenants = getTenantsFromTenancyId($tenancyId);
    $tenantsString = "";
    foreach ($tenants as $tenant)
        $tenantsString .= personToSting($tenant) . "<br><br>";

    $deposit = getDepositFromId($tenancy['deposit_id']);
    $depositString = "<br>Deposit:</b> " . depositToString($deposit);

    $notes = "<b>Notes:</b> " . $tenancy['notes'];

    displayCard($addressFirstLine, getBasicTenancyString($tenancy), $tenantsString, $depositString, $notes);
}


function getBasicTenancyString($tenancy)
{
    $status = getStatusOTenancy($tenancy);
    $rent = '£' . $tenancy['monthly_rent'];
    $dates = $tenancy['start_date'] . " - " . $tenancy['expiry_date'];

    $deposit = getDepositFromId($tenancy['deposit_id']);
    $depositStatus = getStatusOfDeposit($deposit);
    $depositAmount = $deposit['amount'];

    $depositString = "£" . $depositAmount . " (" . $depositStatus . ")";

    $tenancyString = "<b>Status:</b> " . $status . "<br>";
    $tenancyString .= "<b>Monthly Rent:</b> " . $rent . "<br>";
    $tenancyString .= "<b>Dates:</b> " . $dates . "<br>";
    $tenancyString .= "<b>Deposit:</b> " . $depositString . "<br>";

    return $tenancyString;
}
