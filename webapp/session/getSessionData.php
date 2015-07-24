<?php

require_once "sessionUtils.php";
require_once "cookieUtils.php";

function printSession ()
{
	echo "<br><h3>Session data</h3>";
	echo "<br>Last Activity Time: " . getLastActivityTimeFromSession();
	echo "<br>User Agent: " . getUaFromSession();
	echo "<br>IP: " . getIpFromSession();
	echo "<br>ID: " . getUsersIdFromSession();
	echo "<br>First name: " . getUsersFirstNameFromSession();
	echo "<br>Last name: " . getUsersLastNameFromSession();
	echo "<br>Username: " . getUsersUsernameFromSession();
	echo "<br>Password hash: " . getUsersPasswordHashFromSession();
	echo "<br>Email address: " . getUsersEmailFromSession();
	echo "<br>";
}

function getLastActivityTimeFromSession ()
{
	global $lastActivityTag;

	if (isset($_SESSION[$lastActivityTag]))
		return $_SESSION[$lastActivityTag];

	return "";
}

function getUaFromSession ()
{
	global $uaTag;

	if (isset($_SESSION[$uaTag]))
		return $_SESSION[$uaTag];

	return "";

}

function getIpFromSession ()
{
	global $ipTag;

	if (isset($_SESSION[$ipTag]))
		return $_SESSION[$ipTag];

	return "";
}

function getUsersIdFromSession ()
{
	global $userIdTag;

	if (isset($_SESSION[$userIdTag]))
		return $_SESSION[$userIdTag];
	else
		loginRequiredAlert();

	return "";
}

function getUsersFirstNameFromSession ()
{
	global $firstNameTag;

	if (isset($_SESSION[$firstNameTag]))
		return $_SESSION[$firstNameTag];
	else
		loginRequiredAlert();

	return "";
}

function getUsersLastNameFromSession ()
{
	global $lastNameTag;

	if (isset($_SESSION[$lastNameTag]))
		return $_SESSION[$lastNameTag];
	else
		loginRequiredAlert();

	return "";
}

function getUsersUsernameFromSession ()
{
	global $usernameTag;

	if (isset($_SESSION[$usernameTag]))
		return $_SESSION[$usernameTag];
	else
		loginRequiredAlert();

	return "";
}

function getUsersPasswordHashFromSession ()
{
	global $passwordTag;

	if (isset($_SESSION[$passwordTag]))
		return $_SESSION[$passwordTag];
	else
		loginRequiredAlert();

	return "";
}

function getUsersEmailFromSession ()
{
	global $emailTag;

	if (isset($_SESSION[$emailTag]))
		return $_SESSION[$emailTag];
	else
		loginRequiredAlert();

	return "";
}

function loginRequiredAlert ()
{
	echo "LOGIN REQUIRED";
}