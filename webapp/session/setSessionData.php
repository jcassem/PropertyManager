<?php

require_once "sessionUtils.php";

function setSessionLastActivityTime ()
{
	global $lastActivityTag;

	$_SESSION[$lastActivityTag] = time();
}

function setSessionIP ()
{
	global $ipTag;

	$_SESSION[$ipTag] = $_SERVER['REMOTE_ADDR'];
}

function setSessionUA ()
{
	global $uaTag;

	$_SESSION[$uaTag] = $_SERVER['HTTP_USER_AGENT'];
}

function setSessionUserId ($userId)
{
	global $userIdTag;

	$_SESSION[$userIdTag] = $userId;
}

function setSessionPersonId ($person_id)
{
	global $personIdTag;

	$_SESSION[$personIdTag] = $person_id;
}

function setSessionFirstName ($firstName)
{
	global $firstNameTag;

	$_SESSION[$firstNameTag] = $firstName;
}

function setSessionLastName ($lastName)
{
	global $lastNameTag;

	$_SESSION[$lastNameTag] = $lastName;
}

function setSessionUsername ($username)
{
	global $usernameTag;

	$_SESSION[$usernameTag] = $username;
}

function setSessionPasswordHash ($passwordHash)
{
	global $passwordTag;

	$_SESSION[$passwordTag] = $passwordHash;
}

function setSessionEmail ($email)
{
	global $emailTag;

	$_SESSION[$emailTag] = $email;
}
