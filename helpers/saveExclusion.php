<?php
/**
 * Created in PhpStorm.
 * User: philippe
 * Date: 10/7/16
 * Time: 11:17 PM
 */

require_once("dbFunctions.php");

error_log('endDate is ' . ((isset($_POST['endDate'])) ? '' : 'not ') . 'defined');
error_log('endDate is ' . ((null == $_POST['endDate']) ? '' : 'not ') . 'null');
error_log('endDate is ' . (('' === $_POST['endDate']) ? '' : 'not ') . 'empty');

$employeeId = $_POST['employeeId'];
$clientId = $_POST['clientId'];
$startDate = $_POST['startDate'];
$endDate = (null != $_POST['endDate']) ? $_POST['endDate'] : null;
$createdBy = $_POST['createdBy'];
$updatedBy = $_POST['updatedBy'];
$editMode = $_POST['editMode'];
$key = $_POST['clientExclusionID'];

error_log($startDate);
error_log($endDate);

if ($editMode == 'insert') {
  $insertParams = array($employeeId, $clientId, $startDate, $endDate, $createdBy);
  echo runInsertSQL("
  INSERT INTO client_exclusions(employeeID, clientID, startDate, endDate, createdBy, createdOn) 
  VALUES (?, ? ,?, ?, ?, getDate())
", $insertParams, getAuthConnection(), 'clientExclusionID');
} else if ($editMode == 'update') {
  $updateParams = array($employeeId, $clientId, $startDate, $endDate, $updatedBy);
  echo runUpdateSQL("
  UPDATE client_exclusions SET employeeID = ?, clientID = ?, startDate = ?, endDate = ?, updBy = ?, updOn = getDate()
  WHERE clientExclusionID = " . $key
  , $updateParams, getAuthConnection(), 'clientExclusionID');
}