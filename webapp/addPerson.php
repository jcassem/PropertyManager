<?php

$person_types = array('TENANT', 'LANDLORD', 'AGENT', 'CONTRACTOR', 'OTHER');

echo 'Type*				<select name="type">';
foreach ($person_types as $type)
	echo '<option value="' . $type . '">' . ucfirst($type) . '</option>';
echo "</select><br>";

require_once "addPersonTemplate.php";

echo <<<_END
<br><input name="submitButton" type="submit" value="Create">
</pre>
</form>
_END;

// Give result if submit button has been clicked
if (isset($_POST['submitButton'])) {
	if ($error != "")
		echo "Error:<br>" . $error;
	else
		echo "Success";
}