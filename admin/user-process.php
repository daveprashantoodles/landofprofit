<?php 
error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);
	include "db_connect.php";

	$create_time = date("Y-m-d H:i:s");
	
	// echo '<pre>';print_r($_FILES);echo'<pre>';
	// echo '<pre>';print_r($_POST);exit;

	if(isset($_POST['submit']) && $_POST['submit']=='Submit') {
		
		$fname = isset($_POST['fname'])?mysqli_real_escape_string($con,$_POST['fname']):"";
		$lname = isset($_POST['lname'])?mysqli_real_escape_string($con,$_POST['lname']):"";
		$phone = isset($_POST['phone'])?mysqli_real_escape_string($con,$_POST['phone']):"";
		$email = isset($_POST['email'])?mysqli_real_escape_string($con,$_POST['email']):"";
		$password = isset($_POST['password'])?mysqli_real_escape_string($con,$_POST['password']):"";
		$confirm_password = isset($_POST['confirm_password'])?mysqli_real_escape_string($con,$_POST['confirm_password']):"";
		$sector = isset($_POST['sector'])?mysqli_real_escape_string($con,$_POST['sector']):"";
		
		$hash_password = isset($_POST['password'])?md5($_POST['password']):"";
		
		$is_deleted = 0;
		$is_active = 1;
		$created_on = date("Y-m-d H:i:s");
		$updated_on = date("Y-m-d H:i:s");
		
		$sql ="insert into users (fname,lname,email,phone,sector,password,hash_password,is_active,is_deleted,created_on,updated_on) values ('$fname','$lname','$email','$phone','$sector','$password','$hash_password','$is_active','$is_deleted','$created_on','$updated_on')";
		
		
		$query = mysqli_query($con,$sql);
	
		$lastInsertId = mysqli_insert_id($con);
	
		$NameFile=$_FILES['image']['name'];
		
		if(isset($NameFile) && !empty($NameFile)) {
			
			$extension = strtolower(pathinfo($NameFile, PATHINFO_EXTENSION)); 
			if($extension != "jpg" && $extension != "jpeg" && $extension !="png" && $extension !="gif") {
				echo '<script type="text/javascript">';
				echo 'alert("Only jpg, jpeg, png and gif files are allowed");';
				echo 'window.location.href = "add-user.php";';
				echo '</script>';
				exit();
			}
			
			$filename = time().'.'.$extension;
			$fpath=".." . DIRECTORY_SEPARATOR . 'public/uploads/users_img' . DIRECTORY_SEPARATOR . $filename;
			if(!file_exists(".." . DIRECTORY_SEPARATOR . 'public/uploads/users_img') && !is_dir(".." . DIRECTORY_SEPARATOR . 'public/uploads/users_img')) {
				mkdir(".." . DIRECTORY_SEPARATOR . 'public/uploads/users_img');
			}

			if(move_uploaded_file($_FILES["image"]["tmp_name"], $fpath)) {
				$sql = "update users set image =  '{$filename}' where id = '{$lastInsertId}'";
				$query = mysqli_query($con,$sql);
			}
			else{
				echo 'ca';exit;
			}
		} 
      
		if($lastInsertId) {
			$_SESSION['msg'] = 'data_uploaded';
			header("location: view-user.php");
		} 
		else{
			header("location: view-user.php");exit;
		}
	} 

    if(isset($_POST['submit']) && $_POST['submit']=='Save Changes') {

		$id1 = isset($_REQUEST['id'])?$_REQUEST['id']:"";
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
	 
		$fname = isset($_POST['fname'])?mysqli_real_escape_string($con,$_POST['fname']):"";
		$lname = isset($_POST['lname'])?mysqli_real_escape_string($con,$_POST['lname']):"";
		$phone = isset($_POST['phone'])?mysqli_real_escape_string($con,$_POST['phone']):"";
		$email = isset($_POST['email'])?mysqli_real_escape_string($con,$_POST['email']):"";
		$password = isset($_POST['password'])?mysqli_real_escape_string($con,$_POST['password']):"";
		$confirm_password = isset($_POST['confirm_password'])?mysqli_real_escape_string($con,$_POST['confirm_password']):"";
		$sector = isset($_POST['sector'])?mysqli_real_escape_string($con,$_POST['sector']):"";
		
		$hash_password = isset($_POST['hash_password'])?md5($_POST['hash_password']):"";
		
		$updated_on = date("Y-m-d H:i:s");
		
		$sql = "update users set fname = '{$fname}',lname = '{$lname}',phone = '{$phone}',email = '{$email}',password = '{$password}',hash_password = '{$hash_password}',sector = '{$sector}' ,updated_on = '{$updated_on}' where id = '$id'";
		
		$upate = mysqli_query($con,$sql)or die(mysqli_error($con));
		
		$NameFile=$_FILES['image']['name'];
		if(isset($NameFile) && !empty($NameFile)){
			$extension = strtolower(pathinfo($NameFile, PATHINFO_EXTENSION)); 
			if($extension != "jpg" && $extension != "jpeg" && $extension !="png" && $extension !="gif") {
				echo '<script type="text/javascript">';
				echo 'alert("Only jpg, jpeg, png and gif files are allowed");';
				echo 'window.location.href = "view-user.php";';
				echo '</script>';
				exit();
			}
		}
           		
        if (isset($_POST['existImage']) && $_POST['existImage'] == '') {
			if(isset($_POST['removedImage']) && $_POST['removedImage'] != '') {
				$rimg="../".$blogImg."/".$_POST['removedImage'];
				if (file_exists($rimg)) { 
				   unlink($rimg);
				   $sql = "update users set image = '' where id = '$id'";
				   $query = mysqli_query($con,$sql);
			   }
			}
        }
      
		if(isset($NameFile) && !empty($NameFile)) {

			if(!file_exists(".." . DIRECTORY_SEPARATOR . 'public/uploads/users_img') && !is_dir(".." . DIRECTORY_SEPARATOR . 'public/uploads/users_img')) {
				mkdir(".." . DIRECTORY_SEPARATOR . 'public/uploads/users_img');
			}
         
			$fileName = time().".".$extension;
			$fpath=".." . DIRECTORY_SEPARATOR . 'public/uploads/users_img' . DIRECTORY_SEPARATOR . $fileName;
          
			if(move_uploaded_file($_FILES["image"]["tmp_name"], $fpath)) {
				$sql = "update blog set image = '{$fileName}' where id = '$id'";
				$query = mysqli_query($con,$sql);
			}
		}  
      
		if($upate){
			$_SESSION['msg'] = 'data_updated';
			header("location: view-user.php");
		}
		else 
		{
			header("location: view-user.php");exit;
		}
	}


	if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='status'){
		
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
		
		$sql = "select is_active from users where id = {$id} ";
		$query = mysqli_query($con,$sql);
		$result = mysqli_fetch_array($query,MYSQLI_ASSOC);
		
		if($result['is_active']==1)
		{
			$status=0;
		}
		
		if($result['is_active']==0)
		{
			$status=1;
		}
		
		$sql = "update users set is_active = {$status} where id = {$id}";
		$update = mysqli_query($con,$sql);
		
		if($update) {
			$_SESSION['msg'] = 'status_changed';
			header('location: view-user.php');exit;
		} 
		else {
			header("location: view-user.php");exit;
		}
		
	}

	if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='delete'){
		
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
		
		$sql = "update users set is_deleted = 1 where id = {$id}";
		$delete = mysqli_query($con,$sql);
		
		if($delete)
		{
			$_SESSION['msg'] = 'delete_data';
			header('location: view-user.php');exit;
		} 
		else{
			header("location: view-user.php");exit;
		}
		
	}
?>
