<?php
/**
 * Created in PhpStorm.
 * User: philippe
 * Date: 9/4/16
 * Time: 3:39 PM
 */

$myVar = 2;

$myVar *= 10;

$myVar /= 3.14159;

$dbInfo = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . "merge/dbSettings.ini");

$connParms = array('Database' => $dbInfo['dbName'], 'UID' => $dbInfo['userName'], 'PWD' => "jys");

$conn = sqlsrv_connect($dbInfo['host'], $connParms);

var_dump($dbInfo);

echo ($conn) ? "Connection" : "No connection" ;