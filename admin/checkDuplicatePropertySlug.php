<?php
include "db_connect.php";
$property_id = !empty($_GET['property_id'])?$_GET['property_id']:'';
$propertySlug = !empty($_GET['propertySlug'])?$_GET['propertySlug']:'';
$propertySlug=check_input($con,$propertySlug);
if($property_id >0){
	$SQL = "select propertySlug from property where  propertySlug = '$propertySlug' AND id <> $property_id";
	$RESULT = mysqli_query($con,$SQL);
	$rowcount=mysqli_num_rows($RESULT);
	if ($rowcount==0) {
		echo "true";exit;
	}
	else {
		echo "false";exit;
	}
}
else{
	$SQL = "select propertySlug from property where  propertySlug = '$propertySlug'";
	$RESULT = mysqli_query($con,$SQL);
	$rowcount=mysqli_num_rows($RESULT);
	if ($rowcount==0) {
		echo "true";exit;
	}
	else {
		echo "false";exit;
	}
}


?>