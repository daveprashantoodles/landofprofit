<?php 
	include "db_connect.php";
	$create_time = date("Y-m-d H:i:s");
	if(isset($_POST['submit']) && $_POST['submit']=='Submit') {
		
        $newsTitle = !empty($_POST['newsTitle'])?$_POST['newsTitle']:'';
        $mainDescription = !empty($_POST['mainDescription'])?$_POST['mainDescription']:'';
        $newsTitle=check_input($con,$newsTitle);
        $mainDescription=check_input($con,$mainDescription);
      
		
        $insert_stmt = $con->prepare('INSERT INTO `ifd_center_latest` SET `title` = ?,`create_date_time` = ? ');
        $insert_stmt->bind_param("ss",$newsTitle,$create_time);

        $insert_stmt->execute();
        $lastInsertId=mysqli_insert_id($con);
		
        $query_desc = mysqli_query($con, "UPDATE `ifd_center_latest` SET `description`='".$mainDescription."' WHERE `center_latest_id`='".$lastInsertId."'") or die(mysqli_error($con));
      
		$NameFile=$_FILES['image']['name'];
		if(isset($NameFile) && !empty($NameFile)) {
			$extension = strtolower(pathinfo($NameFile, PATHINFO_EXTENSION)); 
			if($extension != "jpg" && $extension != "jpeg" && $extension !="png" && $extension !="gif") {
				echo '<script type="text/javascript">';
				echo 'alert("Only jpg, jpeg, png and gif files are allowed");';
				echo 'window.location.href = "add-news.php";';
				echo '</script>';
				exit();
			}

			$fileName = $NameFile;
			$fpath=".." . DIRECTORY_SEPARATOR . $clatestImg . DIRECTORY_SEPARATOR . $fileName;

			if(!file_exists(".." . DIRECTORY_SEPARATOR . $clatestImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $clatestImg)) {
				mkdir(".." . DIRECTORY_SEPARATOR . $clatestImg);
			}

			if(move_uploaded_file($_FILES["image"]["tmp_name"], $fpath)) {
				$img_stmt = $con->prepare('UPDATE `ifd_center_latest` SET `image` = ? WHERE `center_latest_id` = ? ');
				$img_stmt->bind_param('ss', $fileName,$lastInsertId);
				$img_stmt->execute();
				$img_stmt->store_result();
				
				  // $resizeObj = new ImageResizeService($fpath);
                    // $resizeObj->resizeImage(1300, 700, 'auto');
                    // $resizeObj->saveImage($fpath, 700); 
				
			}
		}  

		if($insert_stmt) {
			$_SESSION['msg'] = 'data_uploaded';
			header("location: view-center-latest.php");
		} else {
			header("location: view-center-latest.php");exit;
		}
	} 

    
    
    if(isset($_POST['submit']) && $_POST['submit']=='Save Changes') {

		$id =check_input($con,base64_decode($_REQUEST['id']));
		$id1=check_input($con,$_REQUEST['id']);
		$newsTitle = !empty($_POST['newsTitle'])?$_POST['newsTitle']:'';
		$mainDescription = !empty($_POST['mainDescription'])?$_POST['mainDescription']:'';
		$newsTitle=check_input($con,$newsTitle);
		$mainDescription=check_input($con,$mainDescription);
		
		$update_stmt = $con->prepare('UPDATE `ifd_center_latest` SET `title` = ? WHERE `center_latest_id` = ? ');
		$update_stmt->bind_param("ss",$newsTitle,$id);
		$update_stmt->execute();
		$update_stmt->store_result();

		$query_desc = mysqli_query($con, "UPDATE `ifd_center_latest` SET `description`='".$mainDescription."' WHERE `center_latest_id`='".$id."' ") or die(mysqli_error($con));


		$NameFile=$_FILES['image']['name'];
		if(isset($NameFile) && !empty($NameFile)) {
			$extension = strtolower(pathinfo($NameFile, PATHINFO_EXTENSION)); 
				if($extension != "jpg" && $extension != "jpeg" && $extension !="png" && $extension !="gif") {
				echo '<script type="text/javascript">';
				echo 'alert("Only jpg, jpeg, png and gif files are allowed");';
				echo 'window.location.href = "view-center-latest.php";';
				echo '</script>';
				exit();
			}
		}
	   
        //Unlink removed Destination image
		if (isset($_POST['existImage']) && $_POST['existImage'] == '') {
			if(isset($_POST['removedImage']) && $_POST['removedImage'] != '') {
				$rimg="../".$clatestImg."/".$_POST['removedImage'];
				if (file_exists($rimg)) { 
					unlink($rimg);
					$nimg="";
					$uimg_stmt = $con->prepare('UPDATE `ifd_center_latest` SET `image` = ? WHERE `center_latest_id` = ? ');
					$uimg_stmt->bind_param("ss",$nimg,$id);
					$uimg_stmt->execute();
					$uimg_stmt->store_result();
				}
			}
		}
      
		if(isset($NameFile) && !empty($NameFile)) {
			if(!file_exists(".." . DIRECTORY_SEPARATOR . $clatestImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $clatestImg)) {
				mkdir(".." . DIRECTORY_SEPARATOR . $clatestImg);
			}
			$fileName =$NameFile;
			$fpath=".." . DIRECTORY_SEPARATOR . $clatestImg . DIRECTORY_SEPARATOR . $fileName;
			if(move_uploaded_file($_FILES["image"]["tmp_name"], $fpath)) {
				$nimg_stmt = $con->prepare('UPDATE `ifd_center_latest` SET `image` = ? WHERE `center_latest_id` = ? ');
				$nimg_stmt->bind_param('ss', $fileName, $id);
				$nimg_stmt->execute();
				$nimg_stmt->store_result();
				 // $resizeObj = new ImageResizeService($fpath);
                    // $resizeObj->resizeImage(1300, 700, 'auto');
                    // $resizeObj->saveImage($fpath, 700);
			}
		}  
     
		if($update_stmt) {
			$_SESSION['msg'] = 'data_updated';
			header("location: view-center-latest.php");
		}
		else {
			header("location: view-center-latest.php");exit;
		}
	}


	if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='status'){
		$id=check_input($con,base64_decode($_REQUEST['id']));
		$sts_stmt = $con->prepare('SELECT `status` FROM `ifd_center_latest` WHERE `center_latest_id` = ?');
		$sts_stmt->bind_param('s', $id);
		$sts_result = $sts_stmt->execute();
		$sts_stmt->store_result();
		$sts_stmt->bind_result($cstatus);
		$sts_stmt->fetch();

		if($cstatus=='1'){
			$status=0;
			$stmt = $con->prepare('UPDATE `ifd_center_latest` SET `status` = ? WHERE `center_latest_id` = ? ');
			$stmt->bind_param('ss', $status, $id);
			$result = $stmt->execute();
			$stmt->store_result();
		}

		if($cstatus=='0'){
			$status=1;
			$stmt = $con->prepare('UPDATE `ifd_center_latest` SET `status` = ? WHERE `center_latest_id` = ? ');
			$stmt->bind_param('ss', $status, $id);
			$result = $stmt->execute();
			$stmt->store_result();
		}

		if($stmt) {
			$_SESSION['msg'] = 'status_changed';
			header('location: view-center-latest.php');exit;
		} 
		else {
			header("location: view-center-latest.php");exit;
		}
	}
	
	if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='delete'){
		$id=check_input($con,base64_decode($_REQUEST['id']));
		$delete_stmt = $con->prepare('DELETE FROM `ifd_center_latest` WHERE `center_latest_id` = ? ');
		$delete_stmt->bind_param('s', $id);
		$delete_stmt->execute();

		if($delete_stmt) {
			$_SESSION['msg'] = 'delete_data';
			header('location: view-center-latest.php');exit;
		} 
		else {
			header("location: view-center-latest.php");exit;
		}
	}

?>