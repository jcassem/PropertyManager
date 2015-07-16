<?php
// TODO get landlord id

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
		echo "Success";
}
