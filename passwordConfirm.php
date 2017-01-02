<?php
	if(session_status() != 2) {session_start();}
  include_once("helpers/h_login.inc.php");
	include_once("helpers/utils.inc.php");
	include("helpers/auth_conn.php");
	
	/* If we're here it means the current user needs a login in SQL server. If there is a user in the session,
	** but there is no POST, do nothing and display the page. If not, go back to login. If there is a POST record,
	** add a new user to SQL server by calling the stored procedure after the password has been verified by the UI.
	*/
	if (!isset($_SESSION['credentials']['sql_login'])) {
		jys_gotoPage('login.php');
	} else {
		if (isset($_POST['p1'])) {
			$sql = "exec create_jys_user '" . $_SESSION['credentials']['sql_login'] . "', '" . $_POST['pconfirm'] . "'";
			$res = sqlsrv_query($conn_auth, $sql);
			echo "<!--- " . ("exec create_jys_user '" . $_SESSION['credentials']['sql_login'] . "', '" . $_POST['pconfirm'] . "'") . " --> ";
			if ($res) {
				if (jys_authenticate($_SESSION['credentials']['sql_login'], $_POST['pconfirm'])) {
  	 			jys_gotoPage('clientPicker.php');
				}
				sqlsrv_free_stmt($res);
			} else {
				print("SQL INSERT statement failed with error:\n");
				print_r(sqlsrv_errors());
				echo "\n - Statement: " . $sql . "\n" ;
			}
			sqlsrv_close($conn_auth);			
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>JYS Web Data System authentication page</title>
<link href="css/login.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
</head>
<body class="twoColElsLtHdr">
<div id="container">
	<div id="header">
  	<div id="logo">
      <img id="logo_image" src="images/jyslogo.png" width="87" height="84" />
    </div>
    <div id="title">
      <h1>JYS WEB DATA SYSTEM</h1>
    </div>
  </div>
  <div id="middle">&nbsp;
    <div id="loginbox">
      <form id="form1" name="form1" method="post" action="">
      <div>Please choose a password, and enter it again to confirm: </div>
        <div class="inputpair"> <span id="sprypassword1">
          <label for="p1" style="width:135px">Enter password: </label>
          <input type="password" name="p1" id="p1" />
          <span class="passwordRequiredMsg">A value is required.</span>
          <span class="passwordMinCharsMsg">Needs at least 6 characters.</span>
         	</span> </div>
        <div class="inputpair">	<span id="spryconfirm1">
        	<label for="pconfirm" style="width:135px">Confirm password: </label>
        	<input type="password" name="pconfirm" id="pconfirm" />
	       	<span class="confirmRequiredMsg">Required</span>
          <span class="confirmInvalidMsg">Password do not match.</span>
          </span> </div>
        <div class="inputpair">
        	<label style="width:260px">&nbsp;</label>
          <input type="submit" name="login_submit" id="login_submit" value="Confirm password" style="width:120px" />
          <br />
        </div>
      </form>
    </div>
  </div>
  <div id="footer">
		<?php include("helpers/footer.php"); ?>
  </div>
</div>
<script type="text/javascript">
<!--
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {minChars:6, validateOn:["blur"]});
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "p1", {validateOn:["blur"]});
//-->
</script>
</body>
</html>
