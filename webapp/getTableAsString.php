<?php

require_once "dbAccess/login.php";

function getPropertyAsString ($id)
{
	global $hostname, $un, $pw, $db;
	$conn = new mysqli($hostname, $un, $pw, $db);
	if ($conn->connect_error)
		return $conn->connect_error;

	$properties = $conn->query("SELECT * FROM property WHERE property_id=" . $id);
	if (!$properties)
		echo $conn->error . "<br>";

	// fetch by row - MYSQLI_ASSOC returns a key reference
	$properties->data_seek(0);
	$propertyResult = $properties->fetch_array(MYSQLI_ASSOC);

	$propertyString = "";

	if (isset($propertyResult['property_id']))
		$propertyString .= "id " . $propertyResult['property_id'] . ":<br>";

	$address = "<br>" . getAddressAsString($propertyResult['address_id']);
	if (isset($address))
		$propertyString .= "<br>Address " . $address . "<br>";

	$landlord = "<br>" . getPersonAsString($propertyResult['landlord_id']);
	if (isset($landlord))
		$propertyString .= "<br>Landlord " . $landlord . "<br>";

	if (isset($propertyResult['key_number']))
		$propertyString .= $propertyResult['key_number'] . "</br>";

	if (isset($propertyResult['notes']))
		$propertyString .= $propertyResult['notes'];

	$properties->close();
	$conn->close();

	return $propertyString;
}

function getAddressAsString ($id)
{
	global $hostname, $un, $pw, $db;
	$conn = new mysqli($hostname, $un, $pw, $db);
	if ($conn->connect_error)
		return $conn->connect_error;

	$address = $conn->query("SELECT * FROM address WHERE address_id=" . $id);

	if (!$address)
		return $conn->error;

	$address->data_seek(0);
	$addressResult = $address->fetch_array(MYSQLI_ASSOC);

	$addressString = "";

	if (isset($addressResult['address_id']))
		$addressString .= "id " . $addressResult['address_id'] . ":<br>";

	if (isset($addressResult['house_number']))
		$addressString .= $addressResult['house_number'] . " ";

	if (isset($addressResult['street_name']))
		$addressString .= $addressResult['street_name'] . ",<br>";

	if (isset($addressResult['second_line']))
		$addressString .= $addressResult['second_line'] . ",<br>";

	if (isset($addressResult['city']))
		$addressString .= $addressResult['city'] . ",<br>";

	if (isset($addressResult['county']))
		$addressString .= $addressResult['county'] . ",<br>";

	if (isset($addressResult['postcode']))
		$addressString .= $addressResult['postcode'];

	$address->close();
	$conn->close();

	return $addressString;
}

function getPersonAsString ($id)
{
	global $hostname, $un, $pw, $db;
	$conn = new mysqli($hostname, $un, $pw, $db);
	if ($conn->connect_error)
		return $conn->connect_error;

	$landlord = $conn->query("SELECT * FROM person WHERE person_id=" . $id);

	if (!$landlord)
		return $conn->error;

	$landlord->data_seek(0);
	$landlordResult = $landlord->fetch_array(MYSQLI_ASSOC);

	$personString = "";

	if (isset($landlordResult['person_id']))
		$personString .= "id " . $landlordResult['person_id'] . ": ";

	if (isset($landlordResult['type']))
		$personString .= "(" . $landlordResult['type'] . ")<br>";

	if (isset($landlordResult['salutation']))
		$personString .= $landlordResult['salutation'] . " ";

	if (isset($landlordResult['first_name']))
		$personString .= $landlordResult['first_name'] . " ";

	if (isset($landlordResult['second_name']))
		$personString .= $landlordResult['second_name'] . ",<br>";

	if (isset($landlordResult['company_name']))
		$personString .= $landlordResult['company_name'] . ",<br>";

	if (isset($landlordResult['email_address']))
		$personString .= $landlordResult['email_address'] . ",<br>";

	if (isset($landlordResult['mobile_number']))
		$personString .= $landlordResult['mobile_number'] . ",<br>";

	if (isset($landlordResult['notes']))
		$personString .= $landlordResult['notes'];

	$landlord->close();
	$conn->close();

	return $personString;
}

function getDepositAsString ($id)
{
	global $hostname, $un, $pw, $db;
	$conn = new mysqli($hostname, $un, $pw, $db);
	if ($conn->connect_error)
		return $conn->connect_error;

	$deposit = $conn->query("SELECT * FROM deposit WHERE deposit_id=" . $id);

	if (!$deposit)
		return $conn->error;

	$deposit->data_seek(0);
	$depositResult = $deposit->fetch_array(MYSQLI_ASSOC);

	$depositString = "";

	if (isset($depositResult['deposit_id']))
		$depositString = "id " . $depositResult['deposit_id'] . ":<br>";

	if (isset($depositResult['tenancy_id']))
		$depositString .= "Tenancy id:" . $depositResult['tenancy_id'] . "<br>";

	if (isset($depositResult['amount']))
		$depositString .= "£" . $depositResult['amount'] . "<br>";

	if (isset($depositResult['date_received'])) {
		$depositString .= $depositResult['date_received'] . " - ";

		if (isset($depositResult['date_returned']))
			$depositString .= $depositResult['date_returned'];
		else
			$depositString .= "?";

		$depositString .= "<br>";
	}

	if (isset($depositResult['protection_scheme']))
		$depositString .= $depositResult['protection_scheme'];

	$deposit->close();
	$conn->close();

	return $depositString;
}

function getTenancyAsString ($id)
{
	global $hostname, $un, $pw, $db;
	$conn = new mysqli($hostname, $un, $pw, $db);
	if ($conn->connect_error)
		return $conn->connect_error;

	$tenancy = $conn->query("SELECT * FROM tenancy WHERE tenancy_id=" . $id);

	if (!$tenancy)
		return $conn->error;

	$tenancy->data_seek(0);
	$tenancyResult = $tenancy->fetch_array(MYSQLI_ASSOC);

	$tenancyString = "";

	if (isset($tenancyResult['tenancy_id']))
		$tenancyString .= "id " . $tenancyResult['tenancy_id'] . ":<br>";

	if (isset($tenancyResult['property_id']))
		$tenancyString .= "<br>" . getPropertyAsString($tenancyResult['property_id']) . "<br>";

	if (isset($tenancyResult['start_date']))
		$tenancyString .= $tenancyResult['start_date'] . "<br>";

	if (isset($tenancyResult['expiry_date']))
		$tenancyString .= $tenancyResult['expiry_date'] . "<br>";

	if (isset($tenancyResult['monthly_rent']))
		$tenancyString .= "£" . $tenancyResult['monthly_rent'] . "<br>";

	if (isset($tenancyResult['tenancy_type']))
		$tenancyString .= $tenancyResult['tenancy_type'] . "<br>";

	if (isset($tenancyResult['deposit_id']))
		$tenancyString .= "<br>" . getDepositAsString($tenancyResult['deposit_id']) . "<br>";

	if (isset($tenancyResult['notes']))
		$tenancyString .= $tenancyResult['notes'];

	$tenants = "<br>" . getTenantsInTenancyAsString($id);
	if (isset($tenants))
		$tenancyString .= $tenants;

	$tenancy->close();
	$conn->close();

	return $tenancyString;
}

function getTenantsInTenancyAsString ($tenancy_id)
{
	global $hostname, $un, $pw, $db;
	$conn = new mysqli($hostname, $un, $pw, $db);
	if ($conn->connect_error)
		return $conn->connect_error;

	$tenants = $conn->query("SELECT * FROM tenant_tenancy_mapping WHERE tenancy_id=" . $tenancy_id);

	if (!$tenants)
		return $conn->error;

	$tenantString = "";
	$num_rows = $tenants->num_rows;

	for ($i = 0; $i < $num_rows; $i++) {
		$tenants->data_seek($i);
		$tenantsResult = $tenants->fetch_array(MYSQLI_ASSOC);

		if (isset($tenantsResult['person_id'])) {
			$tenantString .= "Tenant " . ($i + 1) . ":<br>";
			$tenantString .= "<br>" . getPersonAsString($tenantsResult['person_id']) . "<br><br>";
		}
	}

	$tenants->close();
	$conn->close();

	return $tenantString;
}