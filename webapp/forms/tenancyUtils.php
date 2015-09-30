<?php

require_once "personUtils.php";

// ----------------
// TENANCY UTILS
// ----------------

function getTenancyFromId($id)
{
    return getSelectQueryResultAsAssocArray("SELECT * FROM tenancy WHERE tenancy_id=" . $id);
}

function tenancyToString($tenancy)
{
    $tenancyString = "";

    if (isset($tenancy['tenancy_id']))
        $tenancyString .= "id: " . $tenancy['tenancy_id'] . "<br>";

    if (isset($tenancy['property_id']))
        $tenancyString .= "<br>" . propertyToString(getPropertyFromId($tenancy['property_id'])) . "<br>";

    if (isset($tenancy['start_date']))
        $tenancyString .= $tenancy['start_date'] . "<br>";

    if (isset($tenancy['expiry_date']))
        $tenancyString .= $tenancy['expiry_date'] . "<br>";

    if (isset($tenancy['monthly_rent']))
        $tenancyString .= "£" . $tenancy['monthly_rent'] . "<br>";

    if (isset($tenancy['tenancy_type']))
        $tenancyString .= $tenancy['tenancy_type'] . "<br>";

    if (isset($tenancy['deposit_id']))
        $tenancyString .= "<br>" . depositToString(getDepositFromId($tenancy['deposit_id'])) . "<br>";

    if (isset($tenancy['notes']))
        $tenancyString .= $tenancy['notes'];

    $tenants = "<br>" . tenancyTenantsToString($tenancy['tenancy_id']);
    if (isset($tenants))
        $tenancyString .= $tenants;

    return $tenancyString;
}

function getStatusOTenancy($tenancy)
{
    $status = "VACANT";
    if (isset($tenancy['start_date'])) {
        if (isset($tenancy['expiry_date'])) {
            $startDate = strtotime($tenancy['start_date']);
            $endDate = strtotime($tenancy['expiry_date']);
            if (time() - $endDate < 0 && time() - $startDate > 0) {
                $status = "RENTED";
            }
        } else
            $status = "RENTED";
    }
    return $status;
}

// ----------------
// TENANT UTILS
// ----------------

function getTenantTenancyMappingsFromTenancyId($tenancy_id)
{
    return getSelectQueryResultAsAssocArray2("SELECT * FROM tenant_tenancy_mapping WHERE tenancy_id=" . $tenancy_id);
}

function getTenantsFromTenancyId($tenancyId)
{
    $tenantTenancyMaps = getTenantTenancyMappingsFromTenancyId($tenancyId);
    $tenants = array();
    if (is_array($tenantTenancyMaps[0])) {
        foreach ($tenantTenancyMaps as $tenantTenancyMap) {
            $tenantID = $tenantTenancyMap['person_id'];
            $tenant = getPersonFromId($tenantID);
            array_push($tenants, $tenant);
        }
    } else {
        $tenantID = $tenantTenancyMaps['person_id'];
        $tenant = getPersonFromId($tenantID);
        array_push($tenants, $tenant);
    }

    return $tenants;
}

function tenancyTenantsToString($tenancy)
{
    if (is_array($tenancy[0]))
        $tenants = getTenantTenancyMappingsFromTenancyId($tenancy[0]['tenancy_id']);
    else
        $tenants = getTenantTenancyMappingsFromTenancyId($tenancy['tenancy_id']);

    $tenantString = "";
    if (isset($tenants['person_id']))
        $tenantString .= personToSting(getPersonFromId($tenants['person_id']));
    else {
        for ($i = 0; $i < sizeof($tenants); $i++) {
            $tenant = $tenants[$i];
            $tenantString .= personToSting(getPersonFromId($tenant['person_id'])) . "<br><br>";
        }
    }

    return $tenantString;
}

// ----------------
// DEPOSIT UTILS
// ----------------

function getDepositFromId($id)
{
    return getSelectQueryResultAsAssocArray("SELECT * FROM deposit WHERE deposit_id=" . $id);
}

function depositToString($deposit)
{
    $depositString = "";

    if (isset($deposit['deposit_id']))
        $depositString = "id " . $deposit['deposit_id'] . ":<br>";

    if (isset($deposit['tenancy_id']))
        $depositString .= "Tenancy id:" . $deposit['tenancy_id'] . "<br>";

    if (isset($deposit['amount']))
        $depositString .= "£" . $deposit['amount'] . "<br>";

    if (isset($deposit['date_received'])) {
        $depositString .= $deposit['date_received'] . " - ";
        $depositString .= $deposit['date_returned'];
        $depositString .= "<br>";
    }

    if (isset($deposit['protection_scheme']))
        $depositString .= $deposit['protection_scheme'];

    return $depositString;
}

function getStatusOfDeposit($deposit)
{
    $status = "UNPROTECTED";
    if (isset($deposit['date_received'])) {
        if (isset($deposit['date_returned'])) {
            $startDate = strtotime($deposit['date_received']);
            $endDate = strtotime($deposit['date_returned']);
            if (time() - $endDate < 0 && time() - $startDate > 0)
                $status = "PROTECTED";
        } else
            $status = "PROTECTED";
    }
    return $status;
}