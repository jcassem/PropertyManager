<?php

require_once "dbAccess/login.php";
require_once "getTableAsString.php";

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
	die($conn->connect_error);
}

echo '<h1 style="text-align:center;">Tenancies</h1>';
printTenancyTable();

$conn->close();

function printTenancyTable ()
{
	echo <<< _END
<table border = "1" cellpadding="2" cellspacing="5" style="width:100%">
<tr>
<th>Id</th>
<th>Property</th>
<th>Start Date</th>
<th>Expiry Date</th>
<th>Monthly Rent (£)</th>
<th>Tenancy Type</th>
<th>Deposit</th>
<th>Tenants</th>
<th>Notes</th>
</tr>
_END;

	printTenancies();

	echo "</table>";
}

function printTenancies ()
{
	global $conn;
	$tenancyQuery = "SELECT * FROM tenancy";
	$tenancies = $conn->query($tenancyQuery);
	if (!$tenancies)
		echo $conn->error . "<br>";

	$rows = $tenancies->num_rows;
	for ($i = 0; $i < $rows; ++$i) {

		// fetch by row - MYSQLI_ASSOC returns a key reference
		$tenancies->data_seek($i);
		$tenancyResult = $tenancies->fetch_array(MYSQLI_ASSOC);

		echo "<tr>";

		echo "<td>" . $tenancyResult['tenancy_id'] . "</td>";

		echo "<td>" . getPropertyAsString($tenancyResult['property_id']) . "</td>";

		echo "<td>" . $tenancyResult['start_date'] . "</td>";

		echo "<td>" . $tenancyResult['expiry_date'] . "</td>";

		echo "<td>" . $tenancyResult['monthly_rent'] . "</td>";

		echo "<td>" . $tenancyResult['tenancy_type'] . "</td>";

		echo "<td>" . getDepositAsString($tenancyResult['deposit_id']) . "</td>";

		echo "<td>" . getTenantsInTenancyAsString($tenancyResult['tenancy_id']) . "</td>";

		echo "<td>" . $tenancyResult['notes'] . "</td>";

		echo "</tr>";
	}
	$tenancies->close();
}

function printAddress ($id)
{
	global $conn;
	$address = $conn->query("SELECT * FROM address WHERE address_id=" . $id);
	$address->data_seek(0);
	$addressResult = $address->fetch_array(MYSQLI_ASSOC);

	if (isset($addressResult['house_number']))
		echo $addressResult['house_number'] . " ";
	if (isset($addressResult['street_name']))
		echo $addressResult['street_name'] . ",<br>";
	if (isset($addressResult['second_line']))
		echo $addressResult['second_line'] . ",<br>";
	if (isset($addressResult['city']))
		echo $addressResult['city'] . ",<br>";
	if (isset($addressResult['county']))
		echo $addressResult['county'] . ",<br>";
	if (isset($addressResult['postcode']))
		echo $addressResult['postcode'];

	$address->close();
}

function printLandlord ($id)
{
	global $conn;
	$landlord = $conn->query("SELECT * FROM person WHERE person_id=" . $id);
	$landlord->data_seek(0);
	$landlordResult = $landlord->fetch_array(MYSQLI_ASSOC);

	if (isset($landlordResult['salutation']))
		echo $landlordResult['salutation'] . " ";
	if (isset($landlordResult['first_name']))
		echo $landlordResult['first_name'] . " ";
	if (isset($landlordResult['second_name']))
		echo $landlordResult['second_name'] . ",<br>";
	if (isset($landlordResult['company_name']))
		echo $landlordResult['company_name'] . ",<br>";
	if (isset($landlordResult['email_address']))
		echo $landlordResult['email_address'] . ",<br>";
	if (isset($landlordResult['mobile_number']))
		echo $landlordResult['mobile_number'] . ",<br>";
	if (isset($landlordResult['notes']))
		echo $landlordResult['notes'];

	$landlord->close();
}