<?php 
include "db_connect.php";

$create_time = date("Y-m-d H:i:s");

if(isset($_POST['submit']) && $_POST['submit']=='Submit') {
	
	$NameFile=$_FILES['image']['name'];
	
	if(isset($NameFile) && !empty($NameFile)) {
		$extension = strtolower(pathinfo($NameFile, PATHINFO_EXTENSION)); 
		if($extension != "jpg" && $extension != "jpeg" && $extension !="png" && $extension !="gif") {
			echo '<script type="text/javascript">';
			echo 'alert("Only jpg, jpeg, png and gif files are allowed");';
			echo 'window.location.href = "construction-banner.php";';
			echo '</script>';
			exit();
		}
		
		
		$fileName = $NameFile;
		$fpath=".." . DIRECTORY_SEPARATOR . $bannerImg . DIRECTORY_SEPARATOR . $fileName;

		if(!file_exists(".." . DIRECTORY_SEPARATOR . $bannerImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $bannerImg)) {
			mkdir(".." . DIRECTORY_SEPARATOR . $bannerImg);
		}
		
		$status = 1;

		if(move_uploaded_file($_FILES["image"]["tmp_name"], $fpath)) {
			
			$sql = "Insert into c_work (`image`,`create_date_time`,`status`) values ('{$fileName}','$create_time','$status')";
			$query = mysqli_query($con,$sql);
			$last_id = mysqli_insert_id($con);
		}
	}  

	if(!empty($last_id)){
		$_SESSION['msg'] = 'data_uploaded';
		header("location: view-work-image.php");
	}
	else {
		header("location: view-work-image.php");exit;
	}
} 
	
if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='delete'){
	$id=check_input($con,base64_decode($_REQUEST['id']));
	$delete_stmt = $con->prepare('DELETE FROM `c_work` WHERE `album_id` = ? ');
	$delete_stmt->bind_param('s', $id);
	$delete_stmt->execute();
	
	if($delete_stmt) {
		$_SESSION['msg'] = 'delete_data';
		header('location: view-work-image.php');exit;
	}
	else {
		header("location: view-work-image.php");exit;
	}
}

?>