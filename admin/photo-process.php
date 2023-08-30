<?php 
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
include "db_connect.php";
$create_time = date("Y-m-d H:i:s");
if(isset($_POST['submit']) && $_POST['submit']=='Submit') {
	$galleryImg = 'photos';
	
	// echo '<pre>';print_r($_FILES);exit;
	$status = 1;
	for($a=0;$a<count($_FILES['image']['name']);$a++){
		if (isset($_FILES['image']['name'][$a]) && !empty($_FILES['image']['name'][$a])) {
			$extension1 = strtolower(pathinfo($_FILES['image']['name'][$a], PATHINFO_EXTENSION)); 
			if($extension1 != "jpg" && $extension1 != "jpeg" && $extension1 !="png" && $extension1 !="gif") {
				echo '<script type="text/javascript">';
				echo 'alert("Only jpg, jpeg, png and gif files are allowed");';
				echo 'window.location.href = "add-photo.php";';
				echo '</script>';
				exit();
			} 

			if(!file_exists(".." . DIRECTORY_SEPARATOR . $galleryImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $galleryImg)) {
				mkdir(".." . DIRECTORY_SEPARATOR . $galleryImg);
			}

			$rtImg = $_FILES['image']['name'][$a];
			$fpath=".." . DIRECTORY_SEPARATOR . $galleryImg . DIRECTORY_SEPARATOR . $rtImg;
			if (move_uploaded_file($_FILES["image"]["tmp_name"][$a],$fpath)) {
				$img_stmt = $con->prepare('INSERT INTO `idf_photo` SET  `image` = ?,`status` = ?, `created_on` = ? ');
				$img_stmt->bind_param('sss',$rtImg,$status,$create_time);
				$img_stmt->execute(); 
				// echo mysqli_error($con);exit;
				// $resizeObj = new ImageResizeService($fpath);
				// $resizeObj->resizeImage(170, 160, 'auto');
				// $resizeObj->saveImage($fpath, 160); 
			} 
		}
	}
	 
	if($img_stmt) {
		$_SESSION['msg'] = 'data_uploaded';
		header("location: add-photo.php");
	}
	else {
		header("location: add-photo.php");exit;
	}
}

if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='status'){
	$id=check_input($con,base64_decode($_REQUEST['id']));
	$sts_stmt = $con->prepare('SELECT `status` FROM `idf_photo` WHERE `id` = ?');
	$sts_stmt->bind_param('s', $id);
	$sts_result = $sts_stmt->execute();
	$sts_stmt->store_result();
	$sts_stmt->bind_result($cstatus);
	$sts_stmt->fetch();

	if($cstatus=='1'){
		$status=0;
		$stmt = $con->prepare('UPDATE `idf_photo` SET `status` = ? WHERE `id` = ? ');
		$stmt->bind_param('ss', $status, $id);
		$result = $stmt->execute();
		$stmt->store_result();
	}

	if($cstatus=='0'){
		$status=1;
		$stmt = $con->prepare('UPDATE `idf_photo` SET `status` = ? WHERE `id` = ? ');
		$stmt->bind_param('ss', $status, $id);
		$result = $stmt->execute();
		$stmt->store_result();
	}

	if($stmt) {
		$_SESSION['msg'] = 'status_changed';
		header('location: add-photo.php');exit;
	}
	else {
		header("location: add-photo.php");exit;
	}
}

if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='delete'){
	$id=check_input($con,base64_decode($_REQUEST['id']));
	$delete_stmt = $con->prepare('DELETE FROM `idf_photo` WHERE `id` = ? ');
	$delete_stmt->bind_param('s', $id);
	$delete_stmt->execute();
	if($delete_stmt) {
		$_SESSION['msg'] = 'delete_data';
		header('location: add-photo.php');exit;
	}
	else {
		header("location: add-photo.php");exit;
	}
}

?>