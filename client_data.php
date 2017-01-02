<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/17/16
 * Time: 9:05 AM
 */

session_start();

$return = array();

if (isset($_SESSION['credentials']) && !empty($_SESSION['credentials']) && isset($_GET['client_id']) && isset($_GET['widget_name'])) {

  $connection_info = array("database" => "jys_data_blue", "UID" => "jys", "PWD" => "jys");
  $conn_obj = sqlsrv_connect("BLUE", $connection_info);

  if ($conn_obj) {
    $client_id = $_GET['client_id'];
    $widget_name = $_GET['widget_name'];
    $user_id = $_SESSION['credentials']['user_id'];

    $sql = "select sql_stmt from vUserPermissions where widget_name=? and user_number=?";
    $params = array($widget_name,$user_id);
    $stmt = sqlsrv_query($conn_obj, $sql, $params);

    if ($stmt) {
      $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
      if (isset($row)) {
        $sql = $row['sql_stmt'];
      }
      sqlsrv_free_stmt($stmt);
      sqlsrv_close($conn_obj);

      if (!$sql == "") {
        $connection_info = array("database" => "jys_data_blue", "UID" => "jys", "PWD" => "jys");
        $conn_obj = sqlsrv_connect("BLUE", $connection_info);

        if ($conn_obj) {
          $params = array($client_id);
          $stmt = sqlsrv_query($conn_obj, $sql, $params);

          if ($stmt) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
              $return[] = $row;
            }
          }
        }
      }
    }
  }
};

/* Return a JSON representation of the array variable, which either contains data
 * or is empty if there was no session, a connection could not be obtained or the
 * the result set was empty.
 */

echo json_encode($return);