<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 10/16/16
 * Time: 4:57 PM
 */

require_once ("../dbFunctions.php");

echo runSQL("
  SELECT
    group_name gName, group_description gDesc
  from hr.groups
", null);