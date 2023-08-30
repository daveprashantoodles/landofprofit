<?php 
include "db_connect.php";

$create_time = date("Y-m-d H:i:s");

if(isset($_POST['submit']) && $_POST['submit']=='Submit') {
	$albumName = !empty($_POST['albumName'])?$_POST['albumName']:'';
	$albumName=check_input($con,$albumName);
	$insert_stmt = $con->prepare('INSERT INTO `c_banner` SET `album_name` = ?, `create_date_time` = ? ');
	$insert_stmt->bind_param("ss",$albumName,$create_time);
	$insert_stmt->execute();
	$lastInsertId=mysqli_insert_id($con);
 
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

		if(move_uploaded_file($_FILES["image"]["tmp_name"], $fpath)) {
			$img_stmt = $con->prepare('UPDATE `c_banner` SET `image` = ? WHERE `album_id` = ? ');
			$img_stmt->bind_param('ss', $fileName, $lastInsertId);
			$img_stmt->execute();
			$img_stmt->store_result();
		}
	}  

	if($insert_stmt) {
		$_SESSION['msg'] = 'data_uploaded';
		header("location: construction-banner.php");
	}
	else {
		header("location: construction-banner.php");exit;
	}
} 

if(isset($_POST['submit']) && $_POST['submit']=='Save Changes') {

	$id =check_input($con,base64_decode($_REQUEST['id']));
	$id1=check_input($con,$_REQUEST['id']);
	$albumName = !empty($_POST['albumName'])?$_POST['albumName']:'';
	$albumName=check_input($con,$albumName);
	$update_stmt = $con->prepare('UPDATE `c_banner` SET `album_name` = ? WHERE `album_id` = ? ');
	$update_stmt->bind_param("ss",$albumName,$id);
	$update_stmt->execute();
	$update_stmt->store_result();
	
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
	}
	
	//Unlink removed Destination image
	if (isset($_POST['existImage']) && $_POST['existImage'] == '') {
		if(isset($_POST['removedImage']) && $_POST['removedImage'] != '') {
			$rimg="../".$bannerImg."/".$_POST['removedImage'];
			if (file_exists($rimg)) { 
				unlink($rimg);
				$nimg="";
				$uimg_stmt = $con->prepare('UPDATE `c_banner` SET `image` = ? WHERE `album_id` = ? ');
				$uimg_stmt->bind_param("ss",$nimg,$id);
				$uimg_stmt->execute();
				$uimg_stmt->store_result();
			}
		}
	}

	if(isset($NameFile) && !empty($NameFile)) {

		if(!file_exists(".." . DIRECTORY_SEPARATOR . $bannerImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $bannerImg)) {
			mkdir(".." . DIRECTORY_SEPARATOR . $bannerImg);
		}

		$fileName = $NameFile;
		$fpath=".." . DIRECTORY_SEPARATOR . $bannerImg . DIRECTORY_SEPARATOR . $fileName;
		if(move_uploaded_file($_FILES["image"]["tmp_name"], $fpath)) {
			$nimg_stmt = $con->prepare('UPDATE `c_banner` SET `image` = ? WHERE `album_id` = ? ');
			$nimg_stmt->bind_param('ss', $fileName, $id);
			$nimg_stmt->execute();
			$nimg_stmt->store_result();
		}

	}  
  
	$ext = pathinfo($row_pslug['image'], PATHINFO_EXTENSION);
	$presentImg = basename($row_pslug['image'], ".".$ext); 
	$oldImg = ".." . DIRECTORY_SEPARATOR . $bannerImg . DIRECTORY_SEPARATOR . $presentImg . "." . $ext;
	$newImg = ".." . DIRECTORY_SEPARATOR . $bannerImg . DIRECTORY_SEPARATOR . $imgName . "." . $ext;

	if(($presentImg!=$imgName) && ($NameFile=='') && (file_exists($oldImg))) {
		if(!(rename($oldImg,$newImg))){
			echo '<script type="text/javascript">';
			echo 'alert("An error occurred during Rename Image.");';
			echo 'window.location.href = "construction-banner.php";';
			echo '</script>';
			exit();
		}

		$rName=$imgName.".".$ext;
		$rnimg_stmt = $con->prepare('UPDATE `c_banner` SET `image` = ? WHERE `album_id` = ? ');
		$rnimg_stmt->bind_param('ss', $rName, $id);
		$rnimg_stmt->execute();
		$rnimg_stmt->store_result();
	}
	
	if($update_stmt) {
		$_SESSION['msg'] = 'data_updated';
		header("location: construction-banner.php");
	}
	else {
		header("location: construction-banner.php");exit;
	}
}


if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='status'){
	$id=check_input($con,base64_decode($_REQUEST['id']));
	$sts_stmt = $con->prepare('SELECT `status` FROM `c_banner` WHERE `album_id` = ?');
	$sts_stmt->bind_param('s', $id);
	$sts_result = $sts_stmt->execute();
	$sts_stmt->store_result();
	$sts_stmt->bind_result($cstatus);
	$sts_stmt->fetch();

	if($cstatus=='1'){
		$status=0;
		$stmt = $con->prepare('UPDATE `c_banner` SET `status` = ? WHERE `album_id` = ? ');
		$stmt->bind_param('ss', $status, $id);
		$result = $stmt->execute();
		$stmt->store_result();
	}

	if($cstatus=='0'){
		$status=1;
		$stmt = $con->prepare('UPDATE `c_banner` SET `status` = ? WHERE `album_id` = ? ');
		$stmt->bind_param('ss', $status, $id);
		$result = $stmt->execute();
		$stmt->store_result();
	}

	if($stmt) {
		$_SESSION['msg'] = 'status_changed';
		header('location: construction-banner.php');exit;
	}
	else {
		header("location: construction-banner.php");exit;
	}
}

	
if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='delete'){
	$id=check_input($con,base64_decode($_REQUEST['id']));
	$delete_stmt = $con->prepare('DELETE FROM `c_banner` WHERE `album_id` = ? ');
	$delete_stmt->bind_param('s', $id);
	$delete_stmt->execute();
	
	if($delete_stmt) {
		$_SESSION['msg'] = 'delete_data';
		header('location: construction-banner.php');exit;
	}
	else {
		header("location: construction-banner.php");exit;
	}

}

?>