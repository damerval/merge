<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 10/7/16
 * Time: 11:17 PM
 */

require_once("dbFunctions.php");

echo runSQL(
    "SELECT group_name gn, group_description gd FROM groups ORDER BY group_hierarchy",
  null, getAuthConnection()
);