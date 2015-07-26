<?php

session_start();

require_once "dbAccess/dbLogin.php";
require_once "session/sessionUtils.php";
require_once "session/getSessionData.php";
require_once "addDbData.php";

echo '<form action="addProperty.php" method="post"><pre>';

require_once "addAddressTemplate.php";

echo <<<_END
<br>Key number 		<input type="text" name="key">
Notes			<input type="text" name="notes">
<br><input name="submitButton" type="submit" value="Create">
</pre>
</form>
_END;

// Initialise
$address = getAddress();
$key = getPostField('key');
$notes = getPostField('notes');

// Validate
$error = $address["error"];

// Give result if submit button has been clicked
if (isset($_POST['submitButton'])) {
	if ($error != "")
		echo "Error:<br>" . $error;
	else
		echo addProperty($address, $key, $notes);
}

function addProperty ($address, $key, $notes)
{
	$landlordId = getUsersIdFromSession();
	$addressId = addAddress($address);

	$query = "INSERT INTO property (address_id, landlord_id, key_number, notes)";
	$query .= " VALUES ('$addressId', '$landlordId', '$key', '$notes')";

	$propId = getInsertQueryResultId($query);

	return $propId ? "Property Id: " . $propId : "ERROR: Property not added";
}