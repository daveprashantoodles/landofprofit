<?php
include "db_connect.php";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']) && $_POST['submit']=='Change Password') {
	
	 $newPassword = !empty($_POST['newPassword'])?$_POST['newPassword']:'';
  $newPassword=check_input($con,$newPassword);
  $newPassword =md5($newPassword);
	  
	  $stmt = $con->prepare('UPDATE `ahq_adm_login` SET `plus_password` = ? WHERE `plus_login_id` = ? ');
   $stmt->bind_param('ss', $newPassword, $_SESSION['userid']);

  $result = $stmt->execute();
  $stmt->store_result();
  
  if($stmt) {
			$_SESSION['msg'] = 'data_updated';
			header("location: change-password.php");
	 } else {
			header("location: change-password.php");exit;
	 }
	
  $stmt->close();
   
} 
?>