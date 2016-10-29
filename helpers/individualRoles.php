<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 10/12/16
 * Time: 9:51 PM
 */

require_once ("../dbFunctions.php");

echo runSQL("
  SELECT
    ug.user_group_id ugId,
    ug.user_number userNum,
    ug.group_name grp,
    ug.start_date startDate,
    ug.end_date endDate
  from HR.user_groups ug
", null);