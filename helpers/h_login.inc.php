<?php
	if(session_status() != 2) {session_start();}

	if (!function_exists("jys_gotoPage")) {
		function jys_gotoPage($pageName, $args = "") {
			$host  = $_SERVER['HTTP_HOST'];
			$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			$extra = $pageName;
			header("Location: http://$host$uri/$extra$args");
			exit;
		}
	}

  if (!function_exists("jys_lookupUser")) {
		function jys_lookupUser($ulogin) {
			// Get connection to jys_auth database and store it in $conn_auth
			include("helpers/auth_conn.php");
			
			//Initialize return to false
			$theValue = false;
			$sql = "SELECT DISTINCT SQL_LOGIN, USER_FNAME, USER_LNAME, USER_NUMBER, sys.server_principals.principal_id,
							CASE WHEN UPPER(PC.ContactType) IN ('PC', 'PD', 'SS') THEN 'SS' ELSE '00' END AS Supervisor, USER_LOGIN,
							UPPER(PC.ContactType) AS Ctype
							FROM JYS_USERS
							LEFT JOIN sys.server_principals ON SQL_LOGIN COLLATE DATABASE_DEFAULT = sys.server_principals.[name]  COLLATE DATABASE_DEFAULT
							LEFT JOIN jys_data_blue.dbo.ProjectContact PC ON PC.Employee=USER_NUMBER and UPPER(PC.ContactType) IN ('SS', 'PC', 'PD', 'IT') AND PC
							.Active<>0
							LEFT JOIN jys_data_blue.dbo.EMPLOYEE ON USER_NUMBER=jys_data_blue.dbo.EMPLOYEE.EMPLOYEE_ID
						  WHERE USER_LOGIN = '" . $ulogin . "'";
			$res = sqlsrv_query($conn_auth, $sql);
			if ($res) {
				$row = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC);
				if (isset($row)) {
					$_SESSION['credentials']['full_name'] = $row['USER_FNAME'] . ' ' . $row['USER_LNAME'];
					$_SESSION['credentials']['user_id'] = $row['USER_NUMBER'];
					$_SESSION['credentials']['sql_login'] = $row['SQL_LOGIN'];
					$_SESSION['credentials']['isSupervisor'] = ($row['Supervisor'] == 'SS') ? true : false ;
					$_SESSION['credentials']['isAdmin'] = ($row['Ctype'] == 'IT') ? true : false ;
					$theValue = $row;
				}
				sqlsrv_free_stmt($res);
				sqlsrv_close($conn_auth);
			} else {
				echo "<!--";
				print("SQL INSERT statement failed with error:\n");
				print_r(sqlsrv_errors());
				echo "\n - Statement: " . $sql . "\n" ;
				echo " --> ";
			}
			return $theValue;
		}
	}

	if (!function_exists("jys_authenticate")) {
		function jys_authenticate($uname, $pword) {
			require_once("host.php");
			$connectionInfo = array( "Database"=> "jys_auth", "UID"=>$uname, "PWD"=>$pword);
			//var_dump($connectionInfo);
			$conn_temp = sqlsrv_connect(getDataHost(), $connectionInfo);
			if (!$conn_temp) {
				return FALSE;
			} else {
				$_SESSION['credentials']['upword'] = $pword; 
				return TRUE;
			}
		}
	}
?>