<?php

require_once "dbAccess/login.php";

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
	die($conn->connect_error);
}

echo '<h1 style="text-align:center;">Properties</h1>';
printPropertyTable();

$conn->close();

function printPropertyTable ()
{
	echo <<< _END
<table border = "1" cellpadding="2" cellspacing="5" style="width:100%">
<tr>
<th>Id</th>
<th>Address</th>
<th>Landlord</th>
<th>Key Number</th>
<th>Notes</th>
</tr>
_END;

	printProperties();

	echo "</table>";
}

function printProperties ()
{
	global $conn;
	$propertyQuery = "SELECT * FROM property";
	$properties = $conn->query($propertyQuery);
	if (!$properties)
		echo $conn->error . "<br>";

	$rows = $properties->num_rows;
	for ($i = 0; $i < $rows; ++$i) {
		// fetch by row - MYSQLI_ASSOC returns a key reference
		$properties->data_seek($i);
		$propertyResult = $properties->fetch_array(MYSQLI_ASSOC);

		echo "<tr>";
		echo "<td>" . $propertyResult['property_id'] . "</td>";

		// Get Address (fetch by seek)
		echo "<td>id:" . $propertyResult['address_id'] . "<br>";
		printAddress($propertyResult['address_id']);
		echo "</td>";

		if (!$properties)
			echo $conn->error . "<br>";

		echo "<td>id:" . $propertyResult['landlord_id'] . "<br>";
		printLandlord($propertyResult['landlord_id']);
		echo "</td>";

		echo "<td>" . $propertyResult['key_number'] . "</td>";

		echo "<td>" . $propertyResult['notes'] . "</td>";

		echo "</tr>";
	}
	$properties->close();
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