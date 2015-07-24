<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/webapp/dbAccess/dbLogin.php";
require_once "sessionUtils.php";
require_once "cookieUtils.php";
require_once "setSessionData.php";

function checkUserSession ()
{
	if (!sessionIsValid())
		destroy_session_and_data();
}

function loginUserWith ($username, $password)
{
	$user = getUser($username, $password);

	if (isset($user))
		startSession($user);
	else
		echo "USER DOES NOT EXIST";
}

function getUser ($username, $password)
{
	$token = getToken($password);

	return getQueryResultAsAssocArray("SELECT * FROM USER WHERE USERNAME='$username' AND PASSWORD='$token'");
}

function startSession ($user)
{
	destroy_session_and_data();
	session_start();

	session_name($user['user_id'] . ':' . $user['username']);
	setSessionLastActivityTime();
	setSessionIP();
	setSessionUA();

	setSessionUserId($user['user_id']);
	setSessionPersonId($user['person_id']);
	setSessionUsername($user['username']);
	setSessionPasswordHash($user['password']);

	$person = getPerson($user['person_id']);
	setSessionFirstName($person['first_name']);
	setSessionLastName($person['last_name']);
	setSessionEmail($person['email_address']);

	issueCookie($user);
}

function getPerson ($person_id)
{
	return getQueryResultAsAssocArray("SELECT * FROM person WHERE person_id=$person_id");
}

function issueCookie ($user)
{
	if (!isset($_COOKIE[session_name()]))
		setcookie(session_name(), getCookieValue($user), getCookieExpiryTime(), getCookieServerPath());
}