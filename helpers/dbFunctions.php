<?php
/**
 * Created in PhpStorm.
 * User: philippe
 * Date: 9/5/16
 * Time: 3:35 PM
 */

define('DB_ERROR_NO_CONNECTION', -1);
define('DB_ERROR_STMT_FAIL', -2);
define('DB_ERROR_UNKNOWN', -3);
define('DB_ERROR_BAD_CONTRACT', -4);

function getConnection() {
  $settings = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/merge/dbSettings.ini');
  $params = array('Database'=>$settings['dbName'], 'UID'=>$settings['userName'], 'PWD'=>$settings['password']);
  return sqlsrv_connect($settings['host'], $params);
}

function getAuthConnection() {
  $settings = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/merge/dbSettings_auth.ini');
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

function runSQL($sql, $params, $connection) {
  $return = "[]";
  
  $conn = isset($connection) ? $connection : getConnection();
  
  if (!$sql == "") {
    if ($conn) {
      $stmt = sqlsrv_query($conn, $sql, $params);
      $rows = array();
      if ($stmt) {
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
          $rows[] = $row;
        }
        sqlsrv_free_stmt($stmt);
      }
      $return = json_encode($rows);
      sqlsrv_close($conn);
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

function runInsertSQL($sql, $params, $connection, $key) {
  $return = 0;
  error_log('Entering insertSQL');
  
  if (!$sql == "") {
    $conn = isset($connection) ? $connection : getConnection();
    if ($conn) {
      $stmt = sqlsrv_query($conn, $sql, $params);
      error_log('Statement was successful');
      if ($stmt) {
        error_log('Statement is true');
        if (sqlsrv_next_result($stmt)) {
          error_log('Next result successful');
          $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
          error_log('The inserted key is ' . $row[$key]);
          $return = $row[$key];
        }
      } else {
        error_log(print_r(sqlsrv_errors(), true));
        return DB_ERROR_STMT_FAIL;
      }
    } else return DB_ERROR_NO_CONNECTION;
  } else return DB_ERROR_BAD_CONTRACT;
  
  return $return;
}

function runUpdateSQL($sql, $params, $connection, $key) {
  $return = 0;
  error_log('Entering updateSQL');

  if (!$sql == "") {
    $conn = isset($connection) ? $connection : getConnection();
    if ($conn) {
      $stmt = sqlsrv_query($conn, $sql, $params);
      error_log('Statement was successful');
      if ($stmt) {
        error_log('Statement is true');
        if (sqlsrv_next_result($stmt)) {
          error_log('Next result successful');
          $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
          error_log('The updated key is ' . $row[$key]);
          $return = $row[$key];
        }
      } else {
        error_log(print_r(sqlsrv_errors(), true));
        return DB_ERROR_STMT_FAIL;
      }
    } else return DB_ERROR_NO_CONNECTION;
  } else return DB_ERROR_BAD_CONTRACT;

  return $return;
}

function runDeleteSQL($sql, $params, $connection, $key) {
  $return = 0;
  error_log('Entering deleteSQL');

  if (!$sql == "") {
    $conn = isset($connection) ? $connection : getConnection();
    if ($conn) {
      $stmt = sqlsrv_query($conn, $sql, $params);
      error_log('Statement was successful');
      if ($stmt) {
        error_log('Statement is true');
        if (sqlsrv_next_result($stmt)) {
          error_log('Next result successful');
          $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
          error_log('The deleted key is ' . $row[$key]);
          $return = $row[$key];
        }
      } else {
        error_log(print_r(sqlsrv_errors(), true));
        return DB_ERROR_STMT_FAIL;
      }
    } else return DB_ERROR_NO_CONNECTION;
  } else return DB_ERROR_BAD_CONTRACT;

  return $return;
}