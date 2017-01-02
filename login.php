<?php
	include_once("helpers/h_login.inc.php");
	include_once("helpers/utils.inc.php");
	
	if (isset($_POST['username'])) {
	//If the username form field is set, the user tried to login: process
	//Lookup the user name and determine if there is a login in the database for it.
	//If so, if the password is good, go to the rest of the app after storing session variable array.
		$lkpRow = jys_lookupUser($_POST['username']);
	if ($lkpRow) {
	  if (jys_authenticate($lkpRow['SQL_LOGIN'], $_POST['password'])) {
		jys_gotoPage('buttons.html');
	  } else {
				if (isset($lkpRow['principal_id'])) {
		  $loc_LoginError = 'Bad password';
				} else {
					jys_gotoPage('passwordConfirm.php');
				}
	  }
	} else {
	  $loc_LoginError = 'Bad user name';
	}
	} else {													//If not, the page was called direct, so log out
		unset($_SESSION['credentials']);
		unset($_SESSION['s_altcurdate']);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Service Log Authentication</title>
<link href="css/login.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container">
	<div id="header">
  	<div id="logo">
      <img id="logo_image" src="images/jyslogo.png" width="87" height="84"  alt="" />
    </div>
    <div id="title">
      <h1>JYS WEB DATA SYSTEM</h1>
    </div>
  </div>
  <div id="middle">&nbsp;
  	<div id="loginbox">
      <form id="form1" name="form1" method="post" action="">
      	<div>Please login to access the JYS Web Data system:</div>
        <div class="formtip">(<strong>Bold</strong> indicates required field)</div>
        <div class="inputpair">
        	<label for="username">User name: </label>
          <input name="username" type="text" id="username" />
        </div>
        <div class="inputpair">
        	<label for="password">Password: </label>
					<input type="password" id="password" name="password" />
          <div class="formtip">(LEAVE BLANK if signing in for the first time.)</div>
				</div>
        <div class="inputpair">
        	<label style="width:270px">&nbsp;</label>
          <input type="submit" name="login_submit" id="login_submit" value="Log me in" style="width:100px" />
          <br />
				</div>
        <div class="errormsg"><?php if (isset($loc_LoginError)) { echo $loc_LoginError; } ?></div>
	    </form>
    </div>
  </div>
  <div id="footer">
		<?php include("helpers/footer.php"); ?>
  </div>
</div>
</body>
</html>

<!--
<body class="twoColElsLtHdr">
<div id="container">
  <div id="header"> 
  	<img class="fltlft" src="images/jyslogo.png" width="87" height="84" />
    <div class="fltlft">
      <div style="padding-top:15px; padding-left:85px">
        <h1>JYS SERVICES LOG</h1>
      </div>
    </div>
    <!-- end #header 
  </div>
  <div id="mainContent">
    <div id="LoginBox">
      <form id="form1" name="form1" method="post" action="">
      	<div>Please login to access the JYS Service Log system:</div>
        <div class="formtip">(<b>Bold</b> indicates required field)</div>
        <div class="inputpair">
        	<label for="username">User name: </label>
          <input name="username" type="text" id="username" />
        </div>
        <div class="inputpair">
        	<label for="password">Password: </label>
					<input type="password" id="password" name="password" />
          <div class="formtip">(LEAVE BLANK if signing in for the first time.)</div>
				</div>
        <div class="inputpair">
        	<label style="width:270px">&nbsp;</label>
          <input type="submit" name="login_submit" id="login_submit" value="Log me in" style="width:100px" />
          <br />
				</div>
        <div class="errormsg"><?php if (isset($loc_LoginError)) { echo $loc_LoginError; } ?></div>
	    </form>
    </div>
  </div>
  <br class="clearfloat" />
  <div id="footer">
    <?php include("helpers/footer.php"); ?>
  </div>
</div>
</body>
-->