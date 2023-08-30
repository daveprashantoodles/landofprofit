<?php 

	include "db_connect.php";

	$create_time = date("Y-m-d H:i:s");

	if(isset($_POST['submit']) && $_POST['submit']=='Submit') {
		
		$parentId1 = isset($_POST['parentId'])?$_POST['parentId']:"";
		$parentId = isset($_POST['parentId'])?base64_decode($_POST['parentId']):"";
		$question = isset($_POST['question'])?mysqli_real_escape_string($con,$_POST['question']):"";
		$answer = isset($_POST['answer'])?mysqli_real_escape_string($con,$_POST['answer']):"";
		$publish = 1;
		
		$sql = "insert into loanQuestions (parentId,question,answer,publish,createdOn,updatedOn)values('{$parentId}','{$question}','{$answer}','{$publish}','{$create_time}','{$create_time}')";
		$query = mysqli_query($con,$sql);
		$lastInsertId = mysqli_insert_id($con);
		
		if($lastInsertId) {
			$_SESSION['msg'] = 'data_uploaded';
			header("location: view-loan-question.php?parentId=".$parentId1);
		} 
		else{
			header("location: view-loan-question.php?parentId=".$parentId1);exit;
		}
	} 

    if(isset($_POST['submit']) && $_POST['submit']=='Save Changes') {

		$id1 = isset($_REQUEST['id'])?$_REQUEST['id']:"";
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
		$parentId1 = isset($_POST['parentId'])?$_POST['parentId']:"";
		$parentId = isset($_POST['parentId'])?base64_decode($_POST['parentId']):"";
		$question = isset($_POST['question'])?mysqli_real_escape_string($con,$_POST['question']):"";
		$answer = isset($_POST['answer'])?mysqli_real_escape_string($con,$_POST['answer']):"";
		
		$sql = "update loanQuestions set parentId = '{$parentId}',question = '{$question}',answer = '{$answer}',updatedOn = '{$create_time}' where id = '$id'";
		
		$upate = mysqli_query($con,$sql)or die(mysqli_error($con));
		
		if($upate){
			$_SESSION['msg'] = 'data_updated';
			header("location: view-loan-question.php?parentId=".$parentId1);exit;
		}
		else 
		{
			header("location: view-loan-question.php?parentId=".$parentId1);exit;
		}
	}


	if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='status'){
		
		// echo '<pre>';print_r($_GET);exit;
		
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
		$parentId1 = isset($_GET['parentId'])?$_GET['parentId']:"";
		$parentId = isset($_GET['parentId'])?base64_decode($_GET['parentId']):"";
		
		$sql = "select publish from loanQuestions where id = {$id} ";
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
		
		$sql = "update loanQuestions set publish = {$status} where id = {$id}";
		$update = mysqli_query($con,$sql);
		
		if($update) {
			$_SESSION['msg'] = 'status_changed';
			header("location: view-loan-question.php?parentId=".$parentId1);exit;
		} 
		else {
			header("location: view-loan-question.php?parentId=".$parentId1);exit;
		}
		
	}

	if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='delete'){
		
		// echo ''
		
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
		$parentId1 = isset($_REQUEST['parentId'])?$_REQUEST['parentId']:"";
		$parentId = isset($_REQUEST['parentId'])?base64_decode($_REQUEST['parentId']):"";
		
		$sql = "delete from loanQuestions where id = {$id}";
		$delete = mysqli_query($con,$sql);
		
		if($delete)
		{
			$_SESSION['msg'] = 'delete_data';
			header("location: view-loan-question.php?parentId=".$parentId1);exit;
		} 
		else{
			header("location: view-loan-question.php?parentId=".$parentId1);exit;
		}
		
	}

?>