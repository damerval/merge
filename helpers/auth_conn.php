<?php
# FileName="auth_conn.php"
# Type="SQLSRV"
# HTTP="true"

require("host.php");
$connectionInfo = array( "Database"=> "jys_auth", "UID"=>"jys_authadmin", "PWD"=>"QWE!@#123qwe.");
$conn_auth=sqlsrv_connect(getDataHost(), $connectionInfo);
if( !$conn_auth ) {
	echo "Connection could not be established.<br />";
	die( print_r( sqlsrv_errors(), true));
}

?>