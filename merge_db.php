<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/13/16
 * Time: 11:05 PM
 */

function get_db_connection() {
  $db_name = "jys_data_blue";
  $instance_name = "BLUE";
  $conn_params = array('Database' => $db_name, 'UID' => "jys", 'PWD' => "jys");
  $conn = sqlsrv_connect($instance_name, $conn_params);
  if (!$conn) {
    //die("Unable to get connection to database. Exiting page.");
    return false;
  } else return $conn;
}