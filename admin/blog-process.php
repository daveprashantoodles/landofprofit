<?php 

	include "db_connect.php";

	$create_time = date("Y-m-d H:i:s");

	if(isset($_POST['submit']) && $_POST['submit']=='Submit') {
		
		$categoryId = isset($_POST['categoryId'])?mysqli_real_escape_string($con,$_POST['categoryId']):"";
		$blogTitle = isset($_POST['blogTitle'])?mysqli_real_escape_string($con,$_POST['blogTitle']):"";
		$titleSlug = isset($_POST['titleSlug'])?mysqli_real_escape_string($con,$_POST['titleSlug']):"";
		$imgAlt = isset($_POST['imgAlt'])?mysqli_real_escape_string($con,$_POST['imgAlt']):"";
		$imgTitle = isset($_POST['imgTitle'])?mysqli_real_escape_string($con,$_POST['imgTitle']):"";
		$blogDate = isset($_POST['blogDate'])?date("Y-m-d H:i:s",strtotime($_POST['blogDate'])):"";
		$blogAuthor = isset($_POST['blogAuthor'])?mysqli_real_escape_string($con,$_POST['blogAuthor']):"";
		$mainDescription = isset($_POST['mainDescription'])?mysqli_real_escape_string($con,$_POST['mainDescription']):"";
		$titleTag = isset($_POST['titleTag'])?mysqli_real_escape_string($con,$_POST['titleTag']):"";
		$metaKeyword = isset($_POST['metaKeyword'])?mysqli_real_escape_string($con,$_POST['metaKeyword']):"";
		$metaDescription = isset($_POST['metaDescription'])?mysqli_real_escape_string($con,$_POST['metaDescription']):"";
		$publish = 1;
		
		$sql = "insert into blog (categoryId,blogTitle,titleSlug,blogDate,blogAuthor,mainDescription,titleTag,metaKeyword,metaDescription,publish,createdOn,updatedOn)values('{$categoryId}','{$blogTitle}','{$titleSlug}','{$blogDate}','{$blogAuthor}','{$mainDescription}','{$titleTag}','{$metaKeyword}','{$metaDescription}','{$publish}','{$create_time}','{$create_time}')";
		$query = mysqli_query($con,$sql);
		$lastInsertId = mysqli_insert_id($con);
		
		$NameFile=$_FILES['image']['name'];
		
		if(isset($NameFile) && !empty($NameFile)) {
			
			$extension = strtolower(pathinfo($NameFile, PATHINFO_EXTENSION)); 
			if($extension != "jpg" && $extension != "jpeg" && $extension !="png" && $extension !="gif") {
				echo '<script type="text/javascript">';
				echo 'alert("Only jpg, jpeg, png and gif files are allowed");';
				echo 'window.location.href = "add-blog.php";';
				echo '</script>';
				exit();
			}
			
			$filename = time().'.'.$extension;
			$fpath=".." . DIRECTORY_SEPARATOR . $blogImg . DIRECTORY_SEPARATOR . $filename;
			if(!file_exists(".." . DIRECTORY_SEPARATOR . $blogImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $blogImg)) {
				mkdir(".." . DIRECTORY_SEPARATOR . $blogImg);
			}

			if(move_uploaded_file($_FILES["image"]["tmp_name"], $fpath)) {
				$sql = "update blog set image =  '{$filename}',imgAlt = '{$imgAlt}',imgTitle = '{$imgTitle}' where id = '{$lastInsertId}'";
				$query = mysqli_query($con,$sql);
			}
		} 
      
		if($lastInsertId) {
			$_SESSION['msg'] = 'data_uploaded';
			header("location: view-blog.php");
		} 
		else{
			header("location: view-blog.php");exit;
		}
	} 

    if(isset($_POST['submit']) && $_POST['submit']=='Save Changes') {

		$id1 = isset($_REQUEST['id'])?$_REQUEST['id']:"";
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
	 
		$titleSlug = isset($_POST['titleSlug'])?mysqli_real_escape_string($con,$_POST['titleSlug']):"";
        
		$fetch_pslug=mysqli_query($con,"SELECT `titleSlug`,`image` FROM `blog` WHERE `id`='".$id."' ") or die(mysqli_error($con));
		
		$row_pslug=mysqli_fetch_array($fetch_pslug);

		$presentslug=$row_pslug['titleSlug'];

		if($presentslug!=$titleSlug)
		{
			$fetch_pslug=mysqli_query($con,"SELECT `titleSlug` FROM `blog` WHERE `titleSlug`='".$titleSlug."' ") or die(mysqli_error($con));
			if(mysqli_num_rows($fetch_pslug)==1) {
				echo '<script type="text/javascript">';
				echo 'alert("Blog Slug already exist. Please Enter another Blog.!!");';
				echo 'window.location.href = "view-blog.php";';
				echo '</script>';
				exit;
			}
		}
		
		$categoryId = isset($_POST['categoryId'])?mysqli_real_escape_string($con,$_POST['categoryId']):"";
		$blogTitle = isset($_POST['blogTitle'])?mysqli_real_escape_string($con,$_POST['blogTitle']):"";
		$imgAlt = isset($_POST['imgAlt'])?mysqli_real_escape_string($con,$_POST['imgAlt']):"";
		$imgTitle = isset($_POST['imgTitle'])?mysqli_real_escape_string($con,$_POST['imgTitle']):"";
		$blogDate = isset($_POST['blogDate'])?date("Y-m-d H:i:s",strtotime($_POST['blogDate'])):"";
		$blogAuthor = isset($_POST['blogAuthor'])?mysqli_real_escape_string($con,$_POST['blogAuthor']):"";
		$mainDescription = isset($_POST['mainDescription'])?mysqli_real_escape_string($con,$_POST['mainDescription']):"";
		$titleTag = isset($_POST['titleTag'])?mysqli_real_escape_string($con,$_POST['titleTag']):"";
		$metaKeyword = isset($_POST['metaKeyword'])?mysqli_real_escape_string($con,$_POST['metaKeyword']):"";
		$metaDescription = isset($_POST['metaDescription'])?mysqli_real_escape_string($con,$_POST['metaDescription']):"";
		
		$sql = "update blog set categoryId = '{$categoryId}',blogTitle = '{$blogTitle}',blogDate = '{$blogDate}',blogAuthor = '{$blogAuthor}',mainDescription = '{$mainDescription}',titleTag = '{$titleTag}',metaKeyword = '{$metaKeyword}',metaDescription = '{$metaDescription}' ,imgAlt = '{$imgAlt}',imgTitle = '{$imgTitle}',updatedOn = '{$create_time}' where id = '$id'";
		
		$upate = mysqli_query($con,$sql)or die(mysqli_error($con));
		
		$NameFile=$_FILES['image']['name'];
		if(isset($NameFile) && !empty($NameFile)){
			$extension = strtolower(pathinfo($NameFile, PATHINFO_EXTENSION)); 
			if($extension != "jpg" && $extension != "jpeg" && $extension !="png" && $extension !="gif") {
				echo '<script type="text/javascript">';
				echo 'alert("Only jpg, jpeg, png and gif files are allowed");';
				echo 'window.location.href = "view-blog.php";';
				echo '</script>';
				exit();
			}
		}
           		
        if (isset($_POST['existImage']) && $_POST['existImage'] == '') {
			if(isset($_POST['removedImage']) && $_POST['removedImage'] != '') {
				$rimg="../".$blogImg."/".$_POST['removedImage'];
				if (file_exists($rimg)) { 
				   unlink($rimg);
				   $sql = "update blog set image = '' where id = '$id'";
				   $query = mysqli_query($con,$sql);
			   }
			}
        }
      
		if(isset($NameFile) && !empty($NameFile)) {

			if(!file_exists(".." . DIRECTORY_SEPARATOR . $blogImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $blogImg)) {
				mkdir(".." . DIRECTORY_SEPARATOR . $blogImg);
			}
         
			$fileName = time().".".$extension;
			$fpath=".." . DIRECTORY_SEPARATOR . $blogImg . DIRECTORY_SEPARATOR . $fileName;
          
			if(move_uploaded_file($_FILES["image"]["tmp_name"], $fpath)) {
				$sql = "update blog set image = '{$fileName}' where id = '$id'";
				$query = mysqli_query($con,$sql);
			}
		}  
      
		if($upate){
			$_SESSION['msg'] = 'data_updated';
			header("location: view-blog.php");
		}
		else 
		{
			header("location: view-blog.php");exit;
		}
	}


	if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='status'){
		
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
		
		$sql = "select publish from blog where id = {$id} ";
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
		
		$sql = "update blog set publish = {$status} where id = {$id}";
		$update = mysqli_query($con,$sql);
		
		if($update) {
			$_SESSION['msg'] = 'status_changed';
			header('location: view-blog.php');exit;
		} 
		else {
			header("location: view-blog.php");exit;
		}
		
	}

	if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='delete'){
		
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
		
		$sql = "delete from blog where id = {$id}";
		$delete = mysqli_query($con,$sql);
		
		if($delete)
		{
			$_SESSION['msg'] = 'delete_data';
			header('location: view-blog.php');exit;
		} 
		else{
			header("location: view-blog.php");exit;
		}
		
	}
?>
