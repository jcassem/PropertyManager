<?php

require_once "dbLogin.php";

function getSelectQueryResultAsAssocArray ($query)
{
    global $hn, $db, $un, $pw;

    $result = mysqli_query(mysqli_connect($hn, $un, $pw, $db), $query);

    if(mysqli_num_rows($result) > 0)
        return mysqli_fetch_assoc($result);
    else
        return returnFailedQuery();
}

function returnFailedQuery()
{
    return false;
}

function getSelectQueryResultId($query)
{
    global $hn, $db, $un, $pw;

    $result = mysqli_query(mysqli_connect($hn, $un, $pw, $db), $query);

    if(mysqli_num_rows($result) > 0)
        return mysqli_data_seek($result, 0);
    else
        return returnFailedQuery();
}

function getInsertQueryResultId($query)
{
    global $hn, $db, $un, $pw;

    mysql_connect($hn, $un, $pw);
    mysql_select_db($db);
    mysql_query($query);

    return mysql_insert_id();
}


function runInsertQuery($query)
{
    global $hn, $db, $un, $pw;

    mysql_connect($hn, $un, $pw);
    mysql_select_db($db);
    return mysql_query($query);
}