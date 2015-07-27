<?php

function getCookieName ()
{
	return "testCookie";
	//	return session_name();
}

function getCookieValue ($user)
{
	return $user['user_id'] . ':' . $user['username'];
}

function getCookieExpiryTime ()
{
	return time() + getCookieLength();
}

function getCookieLength ()
{
	return 60 * 60 * 24 * 7;
}

function getCookieServerPath ()
{
	return "/";
}

function cookieIsValid ()
{
	return getCookieExpiryTime() < getCookieLength();
}
