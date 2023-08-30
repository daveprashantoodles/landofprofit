<?php 
include "db_connect.php";
include_once "ImageResizeService.php";
$created_on = date("Y-m-d H:i:s");

// echo '<pre>';print_r($_REQUEST);exit;

if(isset($_POST['submit']) && $_POST['submit']=='Submit') {
	$id = !empty($_POST['id'])?$_POST['id']:'';
	$id=check_input($con,$id);
	// echo $id;exit;
	$id1 =check_input($con,base64_encode($id));
	
	 // var_dump($id1);exit;
	
	
	// echo '<pre>';print_r($_POST);exit;
	
	for($a=0;$a<count($_FILES['image']['name']);$a++){

		if (isset($_FILES['image']['name'][$a]) && !empty($_FILES['image']['name'][$a])) {
			$extension1 = strtolower(pathinfo($_FILES['image']['name'][$a], PATHINFO_EXTENSION)); 
			if($extension1 != "jpg" && $extension1 != "jpeg" && $extension1 !="png" && $extension1 !="gif") {
				echo '<script type="text/javascript">';
				echo 'alert("Only jpg, jpeg, png and gif files are allowed");';
				echo 'window.location.href = "view-more-property-image.php?id='.$id1.'"';
				echo '</script>';
				exit();
			} 
			$galleryImg ="property-photo-gallery";
			if(!file_exists(".." . DIRECTORY_SEPARATOR . $galleryImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $galleryImg)) {
				mkdir(".." . DIRECTORY_SEPARATOR . $galleryImg);
			}

			$fileName = $id."-".$_FILES['image']['name'][$a];
			$fpath=".." . DIRECTORY_SEPARATOR . $galleryImg . DIRECTORY_SEPARATOR . $fileName;

			if (move_uploaded_file($_FILES["image"]["tmp_name"][$a], $fpath)) {
				$img_stmt = $con->prepare('INSERT INTO `property_imgs` SET `property_id` = ?, `image` = ?, `created_on` = ? ');
				$img_stmt->bind_param('sss', $id,$fileName,$created_on);
				$img_stmt->execute(); 

				/* $resizeObj = new ImageResizeService($fpath);
				$resizeObj->resizeImage(170, 100, 'auto');
				$resizeObj->saveImage($fpath, 100);  */
			} 
		}
	}
// echo'<pre>';print_r($img_stmt);
 // exit;
	if($img_stmt) {
		$_SESSION['msg'] = 'data_uploaded';
		header("location: view-more-property-image.php?id=".$id1);
	}
	else {
		header("location: view-more-property-image.php?id=".$id1);exit;
	}
} 



if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='status'){
	$id = !empty($_REQUEST['id'])?$_REQUEST['id']:'';
	$id=check_input($con,base64_decode($id));
	$property_id = !empty($_REQUEST['property_id'])?base64_encode($_REQUEST['property_id']):'';
	$sts_stmt = $con->prepare('SELECT `status` FROM `property_imgs` WHERE `id` = ?');
	$sts_stmt->bind_param('s', $id);
	$sts_result = $sts_stmt->execute();
	$sts_stmt->store_result();
	$sts_stmt->bind_result($cstatus);
	$sts_stmt->fetch();

	if($cstatus=='1'){
		$status=0;
		$stmt = $con->prepare('UPDATE `property_imgs` SET `status` = ? WHERE `id` = ? ');
		$stmt->bind_param('ss', $status, $id);
		$result = $stmt->execute();
		$stmt->store_result();
	}

	if($cstatus=='0'){
		$status=1;
		$stmt = $con->prepare('UPDATE `property_imgs` SET `status` = ? WHERE `id` = ? ');
		$stmt->bind_param('ss', $status, $id);
		$result = $stmt->execute();
		$stmt->store_result();
	}

	if($stmt) {
		$_SESSION['msg'] = 'status_changed';
		header('location: view-more-property-image.php?id='.$property_id);exit;
	}
	else {
		header("location: view-more-property-image.php?id=".$property_id);exit;
	}

}

	
if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='delete'){
	$id = !empty($_REQUEST['id'])?$_REQUEST['id']:'';
	$id=check_input($con,base64_decode($id));
	$property_id = !empty($_REQUEST['property_id'])?base64_encode($_REQUEST['property_id']):'';
	$delete_stmt = $con->prepare('DELETE FROM `property_imgs` WHERE `id` = ? ');
	$delete_stmt->bind_param('s', $id);
	$delete_stmt->execute();
	
	if($delete_stmt) {
		$_SESSION['msg'] = 'delete_data';
		header('location: view-more-property-image.php?id='.$property_id);exit;
	}
	else {
		header("location: view-more-property-image.php?id=".$property_id);exit;
	}
}

?>