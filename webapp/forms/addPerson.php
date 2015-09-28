<?php

$person_types = array('TENANT', 'LANDLORD', 'AGENT', 'CONTRACTOR', 'OTHER');

echo '<form action="addPerson.php" method="post"><pre>';

echo 'Type*			<select name="type">';
foreach ($person_types as $type)
	echo '<option value="' . $type . '">' . ucfirst(strtolower($type)) . '</option>';
echo "</select><br>";

require_once "addPersonTemplate.php";

echo <<<_END
<br><input name="submitButton" type="submit" value="Create">
</pre>
</form>
_END;

if (isset($_POST['submitButton'])) {
	$person = getPersonFromForm();
	if ($person['error'] != "")
		echo "Error:<br>" . $person['error'];
	else {
		$personId = addPerson($person);
		if ($personId)
			echo "Person Id: " . $personId;
		else
			echo "Error: Person not added";
	}
}