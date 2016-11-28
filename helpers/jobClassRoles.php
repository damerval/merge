<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 10/7/16
 * Time: 11:28 PM
 */

require_once("dbFunctions.php");


echo runSQL("
  select
    prv.uid id, prv.program prg, prv.jobClass, 
    CASE ISNUMERIC(prv.[view]) WHEN 0 THEN prv.[view] ELSE 'view' + RTRIM(LTRIM(STR(prv.[view]))) END AS grp
  FROM HR.program_role_views prv  
", null, getConnection());