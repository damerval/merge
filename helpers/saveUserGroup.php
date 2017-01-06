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
$groupName = $_POST['groupName'];
$startDate = $_POST['startDate'];
$endDate = (null != $_POST['endDate']) ? $_POST['endDate'] : null;
$createdBy = $_POST['userId'];
$editMode = $_POST['editMode'];
$key = $_POST['userGroupId'];

error_log($startDate);
error_log($endDate);

if ($editMode == 'insert') {
  $insertParams = array($employeeId, $groupName, $startDate, $endDate, $createdBy);
  echo runInsertSQL("
      INSERT INTO user_groups(user_number, group_name, start_date, end_date, createdBy, createdOn) 
      VALUES (?, ? ,?, ?, ?, getDate())"
      , $insertParams, getAuthConnection(), 'user_group_id');
} else if ($editMode == 'update') {
  $updateParams = array($employeeId, $clientId, $startDate, $endDate, $updatedBy);
  echo runUpdateSQL("
      UPDATE client_exclusions SET employeeID = ?, clientID = ?, startDate = ?, endDate = ?, updBy = ?, updOn = getDate()
      WHERE clientExclusionID = " . $key
      , $updateParams, getAuthConnection(), 'clientExclusionID');
} else if ($editMode == 'delete') {
  $deleteParams = array($key);
  echo runDeleteSQL("
      DELETE FROM client_exclusions WHERE clientExclusionID = ?"
      , $deleteParams, getAuthConnection(), 'clientExclusionID');
}
