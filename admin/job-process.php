<?php 

	include "db_connect.php";

	$create_time = date("Y-m-d H:i:s");
	
	if(isset($_POST['submit']) && $_POST['submit']=='Submit') {
		
		$title = isset($_POST['title'])?mysqli_real_escape_string($con,$_POST['title']):"";
		$duration = isset($_POST['duration'])?mysqli_real_escape_string($con,$_POST['duration']):"";
		$location = isset($_POST['location'])?mysqli_real_escape_string($con,$_POST['location']):"";
		$positions = isset($_POST['positions'])?$_POST['positions']:"";
		$last_date = isset($_POST['last_date'])?date("Y-m-d",strtotime($_POST['last_date'])):"";
		$packages = isset($_POST['packages'])?mysqli_real_escape_string($con,$_POST['packages']):"";
		$publish = 1;
		
		$sql = "insert into job (title,duration,location,positions,last_date,packages,publish,createdOn,updatedOn)values('{$title}','{$duration}','{$location}','{$positions}','{$last_date}','{$packages}','{$publish}','{$create_time}','{$create_time}')";
			
		$query = mysqli_query($con,$sql);
		$lastInsertId = mysqli_insert_id($con)or mysqli_error($con);
		
		if($lastInsertId) {
			$_SESSION['msg'] = 'data_uploaded';
			header("location: view-job.php");
		} 
		else{
			header("location: view-job.php");exit;
		}
	} 

    if(isset($_POST['submit']) && $_POST['submit']=='Save Changes') {

		echo '<pre>';print_r($_POST);

		$id1 = isset($_REQUEST['id'])?$_REQUEST['id']:"";
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
	 
		
		$title = isset($_POST['title'])?mysqli_real_escape_string($con,$_POST['title']):"";
		$duration = isset($_POST['duration'])?mysqli_real_escape_string($con,$_POST['duration']):"";
		$location = isset($_POST['location'])?mysqli_real_escape_string($con,$_POST['location']):"";
		$positions = isset($_POST['positions'])?$_POST['positions']:"";
		
		$last_date = isset($_POST['last_date'])?date("Y-m-d",strtotime($_POST['last_date'])):"";
		$packages = isset($_POST['packages'])?mysqli_real_escape_string($con,$_POST['packages']):"";
		
		$sql = "update job set title = '{$title}',duration = '{$duration}',location = '{$location}',positions = '{$positions}',last_date = '{$last_date}',packages = '{$packages}',updatedOn = '{$create_time}' where id = '$id'";
		
		
		$upate = mysqli_query($con,$sql)or die(mysqli_error($con));
		
		if($upate){
			$_SESSION['msg'] = 'data_updated';
			header("location: view-job.php");
		}
		else 
		{
			header("location: view-job.php");exit;
		}
	}


	if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='status'){
		
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
		
		$sql = "select publish from job where id = {$id} ";
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
		
		$sql = "update job set publish = {$status} where id = {$id}";
		$update = mysqli_query($con,$sql);
		
		if($update) {
			$_SESSION['msg'] = 'status_changed';
			header('location: view-job.php');exit;
		} 
		else {
			header("location: view-job.php");exit;
		}
	}

	if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='delete'){
		
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
		
		$sql = "delete from job where id = {$id}";
		
		$delete = mysqli_query($con,$sql);
		
		if($delete)
		{
			$_SESSION['msg'] = 'delete_data';
			header('location: view-job.php');exit;
		} 
		else{
			header("location: view-job.php");exit;
		}
		
	}

?>