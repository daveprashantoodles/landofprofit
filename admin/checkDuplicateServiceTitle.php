<?php
include "db_connect.php";

$titleSlug = !empty($_GET['titleSlug'])?$_GET['titleSlug']:'';
$titleSlug=check_input($con,$titleSlug);
 	
$stmt = $con->prepare('SELECT `title_slug` FROM `ahq_blog` WHERE `title_slug` = ? ');
$stmt->bind_param('s', $titleSlug);

  $result = $stmt->execute();
  $stmt->store_result();
  
  if ($stmt->num_rows == 0) {
  	echo "true";exit;
  } else {
	  echo "false";exit;
  }
  
  $stmt->close();
?>