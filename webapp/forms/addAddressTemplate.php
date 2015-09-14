<?php

require_once "addDbData.php";
require_once "../dbAccess/dbAccessFactory.php";
require_once "addressUtils.php";

// <form action="addAddressTemplate.php" method="post"><pre>

echo <<<_END
House number* 		<input type="text" name="house_number">
Street name 		<input type="text" name="street_name">
Second line 		<input type="text" name="second_line">
City 			<input type="text" name="city">
County 			<input type="text" name="county">
Postcode*		<input type="text" name="postcode">
_END;

// <input name="submitButton" type="submit" value="Create"></pre></form>
