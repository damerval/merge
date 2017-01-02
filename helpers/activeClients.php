<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 10/7/16
 * Time: 11:17 PM
 */

require_once("dbFunctions.php");

echo runSQL("
  SELECT CLIENT_ID uid, CLIENT_FULL_NAME cf FROM vClients order by LAST_NAME, FIRST_NAME, CLIENT_ID desc",
  null, getConnection()
);