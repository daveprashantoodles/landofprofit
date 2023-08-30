<?php 

	include "db_connect.php";

	$create_time = date("Y-m-d H:i:s");

	if(isset($_POST['submit']) && $_POST['submit']=='Submit') {
		
		$title = isset($_POST['title'])?mysqli_real_escape_string($con,$_POST['title']):"";
		$slug = isset($_POST['slug'])?mysqli_real_escape_string($con,$_POST['slug']):"";
		$mainDescription = isset($_POST['mainDescription'])?mysqli_real_escape_string($con,$_POST['mainDescription']):"";
		$titleTag = isset($_POST['titleTag'])?mysqli_real_escape_string($con,$_POST['titleTag']):"";
		$metaKeyword = isset($_POST['metaKeyword'])?mysqli_real_escape_string($con,$_POST['metaKeyword']):"";
		$metaDescription = isset($_POST['metaDescription'])?mysqli_real_escape_string($con,$_POST['metaDescription']):"";
		$publish = 1;
		
		$sql = "insert into page (title,slug,mainDescription,titleTag,metaKeyword,metaDescription,publish,createdOn,updatedOn)values('{$title}','{$slug}','{$mainDescription}','{$titleTag}','{$metaKeyword}','{$metaDescription}','{$publish}','{$create_time}','{$create_time}')";
			
		$query = mysqli_query($con,$sql);
		$lastInsertId = mysqli_insert_id($con)or mysqli_error($con);
		
		if($lastInsertId) {
			$_SESSION['msg'] = 'data_uploaded';
			header("location: view-page.php");
		} 
		else{
			header("location: view-page.php");exit;
		}
	} 

    if(isset($_POST['submit']) && $_POST['submit']=='Save Changes') {

		$id1 = isset($_REQUEST['id'])?$_REQUEST['id']:"";
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
	 
		$slug = isset($_POST['slug'])?mysqli_real_escape_string($con,$_POST['slug']):"";
        
		$fetch_pslug=mysqli_query($con,"SELECT `slug` FROM `page` WHERE `id`='".$id."' ") or die(mysqli_error($con));
		
		$row_pslug=mysqli_fetch_array($fetch_pslug);

		$presentslug=$row_pslug['slug'];

		if($presentslug!=$slug)
		{
			$fetch_pslug=mysqli_query($con,"SELECT `slug` FROM `page` WHERE `slug`='".$slug."' ") or die(mysqli_error($con));
			if(mysqli_num_rows($fetch_pslug)==1) {
				echo '<script type="text/javascript">';
				echo 'alert("page Slug already exist. Please Enter another slug.!!");';
				echo 'window.location.href = "view-page.php";';
				echo '</script>';
				exit;
			}
		}
		
		$title = isset($_POST['title'])?mysqli_real_escape_string($con,$_POST['title']):"";
		$mainDescription = isset($_POST['mainDescription'])?mysqli_real_escape_string($con,$_POST['mainDescription']):"";
		$titleTag = isset($_POST['titleTag'])?mysqli_real_escape_string($con,$_POST['titleTag']):"";
		$metaKeyword = isset($_POST['metaKeyword'])?mysqli_real_escape_string($con,$_POST['metaKeyword']):"";
		$metaDescription = isset($_POST['metaDescription'])?mysqli_real_escape_string($con,$_POST['metaDescription']):"";
		
		$sql = "update page set title = '{$title}',slug = '{$slug}',mainDescription = '{$mainDescription}',titleTag = '{$titleTag}',metaKeyword = '{$metaKeyword}',metaDescription = '{$metaDescription}',updatedOn = '{$create_time}' where id = '$id'";
		
		$upate = mysqli_query($con,$sql)or die(mysqli_error($con));
		
		if($upate){
			$_SESSION['msg'] = 'data_updated';
			header("location: view-page.php");
		}
		else 
		{
			header("location: view-page.php");exit;
		}
	}


	if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='status'){
		
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
		
		$sql = "select publish from page where id = {$id} ";
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
		
		$sql = "update page set publish = {$status} where id = {$id}";
		$update = mysqli_query($con,$sql);
		
		if($update) {
			$_SESSION['msg'] = 'status_changed';
			header('location: view-page.php');exit;
		} 
		else {
			header("location: view-page.php");exit;
		}
		
	}

	if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='delete'){
		
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
		
		$sql = "delete from page where id = {$id}";
		
		$delete = mysqli_query($con,$sql);
		
		if($delete)
		{
			$_SESSION['msg'] = 'delete_data';
			header('location: view-page.php');exit;
		} 
		else{
			header("location: view-page.php");exit;
		}
		
	}

?>