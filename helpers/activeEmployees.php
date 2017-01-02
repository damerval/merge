<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 10/7/16
 * Time: 11:17 PM
 */

require_once("dbFunctions.php");

echo runSQL("
  select EmployeeNumber uid,
    LastName + ', ' + FirstName + (CASE WHEN MiddleName is null THEN '' ELSE ' ' + MiddleName END ) as en,
    FirstName fn, MiddleName mn, LastName ln, eMail em
  from hr.tbl_Employees where Active=1 order by ln, fn"
  , null, getConnection()
);