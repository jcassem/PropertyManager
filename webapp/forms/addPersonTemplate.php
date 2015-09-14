<?php

require_once "addDbData.php";
require_once "personUtils.php";
require_once "../dbAccess/dbAccessFactory.php";

// Person table enums
$salutations = array('Mr',
	'Mrs',
	'Miss',
	'Ms',
	'Dr',
	'Lord');

// <form action="addPersonTemplate.php" method="post"><pre>

echo 'Salutation*		<select name="salutation">';
foreach ($salutations as $sal)
	echo '<option value="' . $sal . '">' . $sal . '</option>';
echo "</select><br>";

echo <<<_END
First name* 		<input type="text" name="first_name">
Second name* 		<input type="text" name="last_name">
Email address* 		<input type="email" name="email_address">
Phone number* 		<input type="tel" name="mobile_number">
Company name 		<input type="text" name="company">
Notes			<input type="text" name="notes">
_END;

echo "<br><br>";

require_once 'addAddressTemplate.php';

// <input name="submitButton" type="submit" value="Create"></pre></form>