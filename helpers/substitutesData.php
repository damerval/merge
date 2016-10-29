<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 9/25/16
 * Time: 12:50 PM
 */

require_once ("../dbFunctions.php");

echo runSQL(
    "SELECT p.ProgramKey, Name = (e.LastName + ', ' + e.FirstName), progs.Description as Program, pos.Description as Position, "
    . "p.StartDate, p.EndDate FROM HR.tbl_Programs p inner join HR.employeeXRef e on p.SSN=e.SSN "
    . "inner join (select JYSCode, Description from hr.CodexRef where CodeType='HrProgram') progs "
    . "on progs.JYSCode=p.DepartmentKey inner join (select JYSCode, Description from HR.CodexRef "
    . "where CodeType='HrPosition') pos on pos.JYSCode=p.PositionKey order by p.StartDate desc"
  , null);