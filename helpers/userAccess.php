<?php
/**
 * Created in PhpStorm.
 * User: philippe
 * Date: 11/27/16
 * Time: 6:31 PM
 */

require_once("dbFunctions.php");

echo runSQL("
  select
    hrID, FirstName as fn, LastName as ln, emiID, jysID, USER_LOGIN as ul, USER_NUMBER as un, SQL_LOGIN as sl, dupes
  FROM vUserAccess
  where hrActive=1 order by EName
", null, getAuthConnection());
