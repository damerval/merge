<?php
/**
 * Created in PhpStorm.
 * User: philippe
 * Date: 9/5/16
 * Time: 3:35 PM
 */

function getConnection() {
  $settings = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/merge/dbSettings.ini');
  $params = array('Database'=>$settings['dbName'], 'UID'=>$settings['userName'], 'PWD'=>$settings['password']);
  return sqlsrv_connect($settings['host'], $params);
}

function getPermissionSQL($userNum, $widgetName) {
  $return = "";
  $conn = getConnection();

  if ($conn) {
    $sql = "select sql_stmt from vUserPermissions where widget_name=? and user_number=?";
    $params = array($widgetName, $userNum);
    $stmt = sqlsrv_query($conn, $sql, $params);
  
    if ($stmt) {
      $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
      if (isset($row)) {
        $return = $row['sql_stmt'];
      }
      sqlsrv_free_stmt($stmt);
      sqlsrv_close($conn);
    }
  }
  
  return $return;
}

function runSQL($sql, $params) {
  $return = "[]";
  
  if (!$sql == "") {
    $conn = getConnection();
    if ($conn) {
      $stmt = sqlsrv_query($conn, $sql, $params);
      $rows = array();
      if ($stmt) {
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
          $rows[] = $row;
        }
      }
      $return = json_encode($rows);
    }
  }
  
  return $return;
}

function runBooleanSQL($sql, $params) {
  $return = false;
  
  if (!$sql == "") {
    $conn = getConnection();
    if ($conn) {
      $stmt = sqlsrv_query($conn, $sql, $params);
      if ($stmt) {
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        $return = (isset($row['result']) && ($row['result'] != 0 || $row['result'] != ""));
      }
    }
  }
  
  return $return;
}
