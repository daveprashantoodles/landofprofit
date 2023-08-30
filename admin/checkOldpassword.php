<?php
include "db_connect.php";

$oldPassword = !empty($_GET['oldPassword'])?$_GET['oldPassword']:'';
$oldPassword=check_input($con,$oldPassword);
$oldPassword =md5($oldPassword);
 	
$stmt = $con->prepare('SELECT `plus_password` FROM `ahq_adm_login` WHERE `plus_password` = ? AND `plus_login_id` = ? ');
$stmt->bind_param('ss', $oldPassword, $_SESSION['userid']);

  $result = $stmt->execute();
  $stmt->store_result();
  
  if ($stmt->num_rows == 1) {
  	echo "true";exit;
  } else {
	  echo "false";exit;
  }
  
  $stmt->close();
?>