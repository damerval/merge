<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 10/12/16
 * Time: 9:51 PM
 */

require_once("dbFunctions.php");

echo runSQL("
  select
    clientExclusionID uid,
    employeeID eid,
    clientID cid,
    startDate \"exStart\",
    endDate \"exEnd\"
  from client_exclusions
", null, getAuthConnection());