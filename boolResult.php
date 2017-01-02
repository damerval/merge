<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 9/22/16
 * Time: 9:57 PM
 */

require_once("dbFunctions.php");

//****** Require user number, widget name and parameter array GET params
if (!isset($_SESSION['credentials']['user_id']) || !isset($_GET['widgetName'])) {
  echo "0";
} else {
  echo runBooleanSQL(getPermissionSQL($_SESSION['credentials']['user_id'], $_GET['widgetName']), null) ? "1" : "0";
}