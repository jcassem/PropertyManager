<?php

function getPostField ($field)
{
	if (isset($_POST[$field]))
		return fix_string($_POST[$field]);
	else
		return "";
}

function fix_string ($string)
{
	if (get_magic_quotes_gpc())
		$string = stripslashes($string);

	return htmlentities($string);
}
