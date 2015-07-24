<?php

function validate_username ($username)
{
	if ($username == "")
		return "No Username was entered";
	else if (strlen($username) < 5)
		return "Username must be at least 5 characters";
	else if (preg_match("/[^a-zA-Z0-9_-]/", $username))
		return "Only letters, numbers, - and _ can be used in Username";

	return "";
}

function validate_password ($password)
{
	if ($password == "")
		return "No Password was entered";
	else if (strlen($password) < 6)
		return "Password must be at least 6 characters";
	else if (!preg_match("/[a-z]/", $password) || !preg_match("/[A-Z]/", $password) || !preg_match("/[0-9]/", $password))
		return "Password requires at least one of each; a-z, A-Z and 0-9";

	return "";
}