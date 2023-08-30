<?php 

	include "db_connect.php";

	// $create_time = date("Y-m-d H:i:s");

	if(isset($_POST['submit']) && $_POST['submit']=='Submit') {
		
		$vtourTitle = isset($_POST['vtourTitle'])?mysqli_real_escape_string($con,$_POST['vtourTitle']):"";
		$vtourTitle2 = isset($_POST['vtourTitle2'])?mysqli_real_escape_string($con,$_POST['vtourTitle2']):"";
		$vtLink = isset($_POST['vtLink'])?mysqli_real_escape_string($con,$_POST['vtLink']):"";
		$titleSlug = isset($_POST['titleSlug'])?mysqli_real_escape_string($con,$_POST['titleSlug']):"";
		$imgAlt = isset($_POST['imgAlt'])?mysqli_real_escape_string($con,$_POST['imgAlt']):"";
		$imgTitle = isset($_POST['imgTitle'])?mysqli_real_escape_string($con,$_POST['imgTitle']):"";
		$mainDescription = isset($_POST['mainDescription'])?mysqli_real_escape_string($con,$_POST['mainDescription']):"";
		$titleTag = isset($_POST['titleTag'])?mysqli_real_escape_string($con,$_POST['titleTag']):"";
		$metaKeyword = isset($_POST['metaKeyword'])?mysqli_real_escape_string($con,$_POST['metaKeyword']):"";
		$metaDescription = isset($_POST['metaDescription'])?mysqli_real_escape_string($con,$_POST['metaDescription']):"";
		$publish = 1;
		
		$sql = "insert into vtour (vtourTitle,vtourTitle2,vtLink,titleSlug,mainDescription,titleTag,metaKeyword,metaDescription,publish,createdOn,updatedOn)values('{$vtourTitle}','{$vtourTitle2}','{$vtLink}','{$titleSlug}','{$mainDescription}','{$titleTag}','{$metaKeyword}','{$metaDescription}','{$publish}','{$create_time}','{$create_time}')";
		$query = mysqli_query($con,$sql);
		$lastInsertId = mysqli_insert_id($con);
		
		$NameFile=$_FILES['image']['name'];
		
		if(isset($NameFile) && !empty($NameFile)) {
			
			$extension = strtolower(pathinfo($NameFile, PATHINFO_EXTENSION)); 
			if($extension != "jpg" && $extension != "jpeg" && $extension !="png" && $extension !="gif") {
				echo '<script type="text/javascript">';
				echo 'alert("Only jpg, jpeg, png and gif files are allowed");';
				echo 'window.location.href = "add-vtour.php";';
				echo '</script>';
				exit();
			}
			
			$filename = time().'.'.$extension;
			$fpath=".." . DIRECTORY_SEPARATOR . $vtourImg . DIRECTORY_SEPARATOR . $filename;
			if(!file_exists(".." . DIRECTORY_SEPARATOR . $vtourImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $vtourImg)) {
				mkdir(".." . DIRECTORY_SEPARATOR . $vtourImg);
			}

			if(move_uploaded_file($_FILES["image"]["tmp_name"], $fpath)) {
				$sql = "update vtour set image =  '{$filename}',imgAlt = '{$imgAlt}',imgTitle = '{$imgTitle}' where id = '{$lastInsertId}'";
				$query = mysqli_query($con,$sql);
			}
		} 
      
		if($lastInsertId) {
			$_SESSION['msg'] = 'data_uploaded';
			header("location: view-vtour.php");
		} 
		else{
			header("location: view-vtour.php");exit;
		}
	} 

    if(isset($_POST['submit']) && $_POST['submit']=='Save Changes') {

		$id1 = isset($_REQUEST['id'])?$_REQUEST['id']:"";
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
	 
		$titleSlug = isset($_POST['titleSlug'])?mysqli_real_escape_string($con,$_POST['titleSlug']):"";
        
		$fetch_pslug=mysqli_query($con,"SELECT `titleSlug`,`image` FROM `vtour` WHERE `id`='".$id."' ") or die(mysqli_error($con));
		
		$row_pslug=mysqli_fetch_array($fetch_pslug);

		$presentslug=$row_pslug['titleSlug'];

		if($presentslug!=$titleSlug)
		{
			$fetch_pslug=mysqli_query($con,"SELECT `titleSlug` FROM `vtour` WHERE `titleSlug`='".$titleSlug."' ") or die(mysqli_error($con));
			if(mysqli_num_rows($fetch_pslug)==1) {
				echo '<script type="text/javascript">';
				echo 'alert("Vtour Slug already exist. Please Enter another Vtour.!!");';
				echo 'window.location.href = "view-vtour.php";';
				echo '</script>';
				exit;
			}
		}
		
		$vtourTitle = isset($_POST['vtourTitle'])?mysqli_real_escape_string($con,$_POST['vtourTitle']):"";
		$vtourTitle2 = isset($_POST['vtourTitle2'])?mysqli_real_escape_string($con,$_POST['vtourTitle2']):"";
		$vtLink = isset($_POST['vtLink'])?mysqli_real_escape_string($con,$_POST['vtLink']):"";
		$imgAlt = isset($_POST['imgAlt'])?mysqli_real_escape_string($con,$_POST['imgAlt']):"";
		$imgTitle = isset($_POST['imgTitle'])?mysqli_real_escape_string($con,$_POST['imgTitle']):"";
		$mainDescription = isset($_POST['mainDescription'])?mysqli_real_escape_string($con,$_POST['mainDescription']):"";
		$titleTag = isset($_POST['titleTag'])?mysqli_real_escape_string($con,$_POST['titleTag']):"";
		$metaKeyword = isset($_POST['metaKeyword'])?mysqli_real_escape_string($con,$_POST['metaKeyword']):"";
		$metaDescription = isset($_POST['metaDescription'])?mysqli_real_escape_string($con,$_POST['metaDescription']):"";
		
		$sql = "update vtour set vtourTitle = '{$vtourTitle}',vtourTitle2 = '{$vtourTitle2}',vtLink = '{$vtLink}',mainDescription = '{$mainDescription}',titleTag = '{$titleTag}',metaKeyword = '{$metaKeyword}',metaDescription = '{$metaDescription}' ,imgAlt = '{$imgAlt}',imgTitle = '{$imgTitle}',updatedOn = '{$create_time}' where id = '$id'";
		
		$upate = mysqli_query($con,$sql)or die(mysqli_error($con));
		
		$NameFile=$_FILES['image']['name'];
		if(isset($NameFile) && !empty($NameFile)){
			$extension = strtolower(pathinfo($NameFile, PATHINFO_EXTENSION)); 
			if($extension != "jpg" && $extension != "jpeg" && $extension !="png" && $extension !="gif") {
				echo '<script type="text/javascript">';
				echo 'alert("Only jpg, jpeg, png and gif files are allowed");';
				echo 'window.location.href = "view-vtour.php";';
				echo '</script>';
				exit();
			}
		}
           		
        if (isset($_POST['existImage']) && $_POST['existImage'] == '') {
			if(isset($_POST['removedImage']) && $_POST['removedImage'] != '') {
				$rimg="../".$vtourImg."/".$_POST['removedImage'];
				if (file_exists($rimg)) { 
				   unlink($rimg);
				   $sql = "update vtour set image = '' where id = '$id'";
				   $query = mysqli_query($con,$sql);
			   }
			}
        }
      
		if(isset($NameFile) && !empty($NameFile)) {

			if(!file_exists(".." . DIRECTORY_SEPARATOR . $vtourImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $vtourImg)) {
				mkdir(".." . DIRECTORY_SEPARATOR . $vtourImg);
			}
         
			$fileName = time().".".$extension;
			$fpath=".." . DIRECTORY_SEPARATOR . $vtourImg . DIRECTORY_SEPARATOR . $fileName;
          
			if(move_uploaded_file($_FILES["image"]["tmp_name"], $fpath)) {
				$sql = "update vtour set image = '{$fileName}' where id = '$id'";
				$query = mysqli_query($con,$sql);
			}
		}  
      
		if($upate){
			$_SESSION['msg'] = 'data_updated';
			header("location: view-vtour.php");
		}
		else 
		{
			header("location: view-vtour.php");exit;
		}
	}


	if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='status'){
		
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
		
		$sql = "select publish from vtour where id = {$id} ";
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
		
		$sql = "update vtour set publish = {$status} where id = {$id}";
		$update = mysqli_query($con,$sql);
		
		if($update) {
			$_SESSION['msg'] = 'status_changed';
			header('location: view-vtour.php');exit;
		} 
		else {
			header("location: view-vtour.php");exit;
		}
		
	}

	if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='delete'){
		
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
		
		$sql = "delete from vtour where id = {$id}";
		$delete = mysqli_query($con,$sql);
		
		if($delete)
		{
			$_SESSION['msg'] = 'delete_data';
			header('location: view-vtour.php');exit;
		} 
		else{
			header("location: view-vtour.php");exit;
		}
		
	}
?>
