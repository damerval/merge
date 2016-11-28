<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 10/7/16
 * Time: 11:17 PM
 */

require_once("dbFunctions.php");

echo runSQL("
  SELECT DISTINCT * FROM (SELECT distinct
    x.group4 code, x.group4 [desc]
  from HR.CodexRef x
  where x.CodeType='HrPosition'
  union
  SELECT DISTINCT
    xr.JYSCode code, xr.Description [desc]
  FROM HR.CodexRef xr
  WHERE xr.CodeType='HrPosition') tunion
  order by [desc] 
", null, getConnection()
);