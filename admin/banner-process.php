<?php 

	include "db_connect.php";

	$create_time = date("Y-m-d H:i:s");
	
	if(isset($_POST['submit']) && $_POST['submit']=='Submit') {
		
		$text1 = isset($_POST['text1'])?mysqli_real_escape_string($con,$_POST['text1']):"";
		$text2 = isset($_POST['text2'])?mysqli_real_escape_string($con,$_POST['text2']):"";
		$text3 = isset($_POST['text3'])?mysqli_real_escape_string($con,$_POST['text3']):"";
		$publish = 1;
		
		$sql = "insert into banner (text1,text2,text3,publish,createdOn,updatedOn)values('{$text1}','{$text2}','{$text3}','{$publish}','{$create_time}','{$create_time}')";
			
		$query = mysqli_query($con,$sql);
		$lastInsertId = mysqli_insert_id($con)or mysqli_error($con);
		
		$NameFile=$_FILES['image']['name'];
		
		if(isset($NameFile) && !empty($NameFile)) {
			
			$extension = strtolower(pathinfo($NameFile, PATHINFO_EXTENSION)); 
			if($extension != "jpg" && $extension != "jpeg" && $extension !="png" && $extension !="gif") {
				echo '<script type="text/javascript">';
				echo 'alert("Only jpg, jpeg, png and gif files are allowed");';
				echo 'window.location.href = "add-banner.php";';
				echo '</script>';
				exit();
			}
			
			$filename = time().'.'.$extension;
			$fpath=".." . DIRECTORY_SEPARATOR . $bannerImg . DIRECTORY_SEPARATOR . $filename;
			if(!file_exists(".." . DIRECTORY_SEPARATOR . $bannerImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $bannerImg)) {
				mkdir(".." . DIRECTORY_SEPARATOR . $bannerImg);
			}

			if(move_uploaded_file($_FILES["image"]["tmp_name"], $fpath)) {
				$sql = "update banner set image =  '{$filename}' where id = '{$lastInsertId}'";
				$query = mysqli_query($con,$sql);
			}
		} 
		
		if($lastInsertId) {
			$_SESSION['msg'] = 'data_uploaded';
			header("location: view-banner.php");
		} 
		else{
			header("location: view-banner.php");exit;
		}
	} 

    if(isset($_POST['submit']) && $_POST['submit']=='Save Changes') {

		$id1 = isset($_REQUEST['id'])?$_REQUEST['id']:"";
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
	 
		$text1 = isset($_POST['text1'])?mysqli_real_escape_string($con,$_POST['text1']):"";
		$text2 = isset($_POST['text2'])?mysqli_real_escape_string($con,$_POST['text2']):"";
		$text3 = isset($_POST['text3'])?mysqli_real_escape_string($con,$_POST['text3']):"";
		
		$sql = "update banner set text1 = '{$text1}',text2 = '{$text2}',text3 = '{$text3}',updatedOn = '{$create_time}' where id = '$id'";
		
		$upate = mysqli_query($con,$sql)or die(mysqli_error($con));
		
		$NameFile=$_FILES['image']['name'];
		if(isset($NameFile) && !empty($NameFile)){
			$extension = strtolower(pathinfo($NameFile, PATHINFO_EXTENSION)); 
			if($extension != "jpg" && $extension != "jpeg" && $extension !="png" && $extension !="gif") {
				echo '<script type="text/javascript">';
				echo 'alert("Only jpg, jpeg, png and gif files are allowed");';
				echo 'window.location.href = "view-banner.php";';
				echo '</script>';
				exit();
			}
		}
           		
        if (isset($_POST['existImage']) && $_POST['existImage'] == '') {
			if(isset($_POST['removedImage']) && $_POST['removedImage'] != '') {
				$rimg="../".$bannerImg."/".$_POST['removedImage'];
				if (file_exists($rimg)) { 
				   unlink($rimg);
				   $sql = "update banner set image = '' where id = '$id'";
				   $query = mysqli_query($con,$sql);
			   }
			}
        }
      
		if(isset($NameFile) && !empty($NameFile)) {

			if(!file_exists(".." . DIRECTORY_SEPARATOR . $bannerImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $bannerImg)) {
				mkdir(".." . DIRECTORY_SEPARATOR . $bannerImg);
			}
         
			$fileName = time().".".$extension;
			$fpath=".." . DIRECTORY_SEPARATOR . $bannerImg . DIRECTORY_SEPARATOR . $fileName;
          
			if(move_uploaded_file($_FILES["image"]["tmp_name"], $fpath)) {
				$sql = "update banner set image = '{$fileName}' where id = '$id'";
				$query = mysqli_query($con,$sql);
			}
		}  
      
		if($upate){
			$_SESSION['msg'] = 'data_updated';
			header("location: view-banner.php");
		}
		else 
		{
			header("location: view-banner.php");exit;
		}
	}


	if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='status'){
		
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
		
		$sql = "select publish from banner where id = {$id} ";
		$query = mysqli_query($con,$sql);
		$result = mysqli_fetch_array($query,MYSQLI_ASSOC);
		
		if($result['publish']==1)
		{
			$status=0;
		}
		
		if($result['publish']==0)
		{
			$status=1;
		}
		
		$sql = "update banner set publish = {$status} where id = {$id}";
		$update = mysqli_query($con,$sql);
		
		if($update) {
			$_SESSION['msg'] = 'status_changed';
			header('location: view-banner.php');exit;
		} 
		else {
			header("location: view-banner.php");exit;
		}
	}

	if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='delete'){
		
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
		
		$sql = "delete from banner where id = {$id}";
		
		$delete = mysqli_query($con,$sql);
		
		if($delete)
		{
			$_SESSION['msg'] = 'delete_data';
			header('location: view-banner.php');exit;
		} 
		else{
			header("location: view-banner.php");exit;
		}
		
	}

?>