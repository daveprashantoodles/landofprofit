<?php 
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);
	include "db_connect.php";
	
	if(isset($_POST['submit']) && $_POST['submit']=='Submit') {
		
		$categoryTitle = isset($_POST['categoryTitle'])?mysqli_real_escape_string($con,$_POST['categoryTitle']):"";
		$titleSlug = isset($_POST['titleSlug'])?mysqli_real_escape_string($con,$_POST['titleSlug']):"";
		$status = 1;
		$createdOn = date("Y-m-d H:i:s");
		$sql = "insert into category (categoryTitle,titleSlug,publish,createdOn) values ('{$categoryTitle}','{$titleSlug}','{$status}','{$createdOn}')";
		$query = mysqli_query($con,$sql);
        $lastInsertId=mysqli_insert_id($con);
        
		if($lastInsertId) {
			$_SESSION['msg'] = 'data_uploaded';
			header("location: view-category.php");
		} 
		else {
			header("location: view-category.php");exit;
		}
	} 
	
    if(isset($_POST['submit']) && $_POST['submit']=='Save Changes') {
        
		$id =check_input($con,base64_decode($_REQUEST['id']));
        $id1=check_input($con,$_REQUEST['id']);
		$categoryTitle = isset($_POST['categoryTitle'])?$_POST['categoryTitle']:"";
		$titleSlug = isset($_POST['titleSlug'])?$_POST['titleSlug']:"";
		$updatedOn = date("Y-m-d H:i:s");
		
		$sql = "update category set categoryTitle = '{$categoryTitle}',titleSlug = '{$titleSlug}',updatedOn = '{$updatedOn}'  where id = '{$id}'";
		$query = mysqli_query($con,$sql);
		
		if($query)
		{
			$_SESSION['msg'] = 'data_updated';
			header("location: view-category.php");
		} 
		else{
			header("location: view-category.php");exit;
		}
		
	}

	if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='status'){
		
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
		
		$sql = "select publish from category where id = {$id} ";
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
		
		$sql = "update category set publish = {$status} where id = {$id}";
		$update = mysqli_query($con,$sql);
		
		if($update) {
			$_SESSION['msg'] = 'status_changed';
			header('location: view-category.php');exit;
		} 
		else {
			header("location: view-category.php");exit;
		}
		
	}

	if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='delete'){
		
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
		
		$sql = "delete from category where id = {$id}";
		
		$delete = mysqli_query($con,$sql);
		
		if($delete)
		{
			$_SESSION['msg'] = 'delete_data';
			header('location: view-category.php');exit;
		} 
		else{
			header("location: view-category.php");exit;
		}
		
	}

?>