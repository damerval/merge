<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 9/5/16
 * Time: 3:46 PM
 */
require_once ("dbFunctions.php");


//echo runSQL(getPermissionSQL(812,'sample_client_hist_grid'), array("3117"));

echo runSQL(getPermissionSQL(812,'admin_page_link'), null);
