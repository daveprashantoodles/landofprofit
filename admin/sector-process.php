<?php 

	include "db_connect.php";

	$create_time = date("Y-m-d H:i:s");

	if(isset($_POST['submit']) && $_POST['submit']=='Submit') {
		
		$title = isset($_POST['title'])?mysqli_real_escape_string($con,$_POST['title']):"";
		$sector_title = isset($_POST['sector_title'])?mysqli_real_escape_string($con,$_POST['sector_title']):"";
		$titleSlug = isset($_POST['titleSlug'])?mysqli_real_escape_string($con,$_POST['titleSlug']):"";
		$imgAlt = isset($_POST['imgAlt'])?mysqli_real_escape_string($con,$_POST['imgAlt']):"";
		$imgTitle = isset($_POST['imgTitle'])?mysqli_real_escape_string($con,$_POST['imgTitle']):"";
		$mainDescription = isset($_POST['mainDescription'])?mysqli_real_escape_string($con,$_POST['mainDescription']):"";
		$titleTag = isset($_POST['titleTag'])?mysqli_real_escape_string($con,$_POST['titleTag']):"";
		$metaKeyword = isset($_POST['metaKeyword'])?mysqli_real_escape_string($con,$_POST['metaKeyword']):"";
		$metaDescription = isset($_POST['metaDescription'])?mysqli_real_escape_string($con,$_POST['metaDescription']):"";
		$publish = 1;
		
		$sql = "insert into sector (title,sector_title,titleSlug,mainDescription,titleTag,metaKeyword,metaDescription,publish,createdOn,updatedOn)values('{$title}','{$sector_title}','{$titleSlug}','{$mainDescription}','{$titleTag}','{$metaKeyword}','{$metaDescription}','{$publish}','{$create_time}','{$create_time}')";
			
		$query = mysqli_query($con,$sql);
		$lastInsertId = mysqli_insert_id($con)or mysqli_error($con);
		
		$NameFile=$_FILES['image']['name'];
		
		if(isset($NameFile) && !empty($NameFile)) {
			
			$extension = strtolower(pathinfo($NameFile, PATHINFO_EXTENSION)); 
			if($extension != "jpg" && $extension != "jpeg" && $extension !="png" && $extension !="gif") {
				echo '<script type="text/javascript">';
				echo 'alert("Only jpg, jpeg, png and gif files are allowed");';
				echo 'window.location.href = "add-sector.php";';
				echo '</script>';
				exit();
			}
			
			$filename = time().'.'.$extension;
			$fpath=".." . DIRECTORY_SEPARATOR . $sectorImg . DIRECTORY_SEPARATOR . $filename;
			if(!file_exists(".." . DIRECTORY_SEPARATOR . $sectorImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $sectorImg)) {
				mkdir(".." . DIRECTORY_SEPARATOR . $sectorImg);
			}

			if(move_uploaded_file($_FILES["image"]["tmp_name"], $fpath)) {
				$sql = "update sector set image =  '{$filename}',image_alt = '{$imgAlt}',image_title = '{$imgTitle}' where id = '{$lastInsertId}'";
				$query = mysqli_query($con,$sql);
			}
		} 
      
		if($lastInsertId) {
			$_SESSION['msg'] = 'data_uploaded';
			header("location: view-sector.php");
		} 
		else{
			header("location: view-sector.php");exit;
		}
	} 

    if(isset($_POST['submit']) && $_POST['submit']=='Save Changes') {

		$id1 = isset($_REQUEST['id'])?$_REQUEST['id']:"";
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
	 
		$titleSlug = isset($_POST['titleSlug'])?mysqli_real_escape_string($con,$_POST['titleSlug']):"";
        
		$fetch_pslug=mysqli_query($con,"SELECT `titleSlug`,`image` FROM `sector` WHERE `id`='".$id."' ") or die(mysqli_error($con));
		
		$row_pslug=mysqli_fetch_array($fetch_pslug);

		$presentslug=$row_pslug['titleSlug'];

		if($presentslug!=$titleSlug)
		{
			$fetch_pslug=mysqli_query($con,"SELECT `titleSlug` FROM `sector` WHERE `titleSlug`='".$titleSlug."' ") or die(mysqli_error($con));
			if(mysqli_num_rows($fetch_pslug)==1) {
				echo '<script type="text/javascript">';
				echo 'alert("sector Slug already exist. Please Enter another sector title.!!");';
				echo 'window.location.href = "view-sector.php";';
				echo '</script>';
				exit;
			}
		}
		
		$title = isset($_POST['title'])?mysqli_real_escape_string($con,$_POST['title']):"";
		$sector_title = isset($_POST['sector_title'])?mysqli_real_escape_string($con,$_POST['sector_title']):"";
		$imgAlt = isset($_POST['imgAlt'])?mysqli_real_escape_string($con,$_POST['imgAlt']):"";
		$imgTitle = isset($_POST['imgTitle'])?mysqli_real_escape_string($con,$_POST['imgTitle']):"";
		$mainDescription = isset($_POST['mainDescription'])?mysqli_real_escape_string($con,$_POST['mainDescription']):"";
		$titleTag = isset($_POST['titleTag'])?mysqli_real_escape_string($con,$_POST['titleTag']):"";
		$metaKeyword = isset($_POST['metaKeyword'])?mysqli_real_escape_string($con,$_POST['metaKeyword']):"";
		$metaDescription = isset($_POST['metaDescription'])?mysqli_real_escape_string($con,$_POST['metaDescription']):"";
		
		$sql = "update sector set title = '{$title}',sector_title = '{$sector_title}',titleSlug = '{$titleSlug}',mainDescription = '{$mainDescription}',titleTag = '{$titleTag}',metaKeyword = '{$metaKeyword}',metaDescription = '{$metaDescription}' ,image_alt = '{$imgAlt}',image_title = '{$imgTitle}',updatedOn = '{$create_time}' where id = '$id'";
		
		$upate = mysqli_query($con,$sql)or die(mysqli_error($con));
		
		$NameFile=$_FILES['image']['name'];
		if(isset($NameFile) && !empty($NameFile)){
			$extension = strtolower(pathinfo($NameFile, PATHINFO_EXTENSION)); 
			if($extension != "jpg" && $extension != "jpeg" && $extension !="png" && $extension !="gif") {
				echo '<script type="text/javascript">';
				echo 'alert("Only jpg, jpeg, png and gif files are allowed");';
				echo 'window.location.href = "view-sector.php";';
				echo '</script>';
				exit();
			}
		}
           		
        if (isset($_POST['existImage']) && $_POST['existImage'] == '') {
			if(isset($_POST['removedImage']) && $_POST['removedImage'] != '') {
				$rimg="../".$sectorImg."/".$_POST['removedImage'];
				if (file_exists($rimg)) { 
				   unlink($rimg);
				   $sql = "update sector set image = '' where id = '$id'";
				   $query = mysqli_query($con,$sql);
			   }
			}
        }
      
		if(isset($NameFile) && !empty($NameFile)) {

			if(!file_exists(".." . DIRECTORY_SEPARATOR . $sectorImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $sectorImg)) {
				mkdir(".." . DIRECTORY_SEPARATOR . $sectorImg);
			}
         
			$fileName = time().".".$extension;
			$fpath=".." . DIRECTORY_SEPARATOR . $sectorImg . DIRECTORY_SEPARATOR . $fileName;
          
			if(move_uploaded_file($_FILES["image"]["tmp_name"], $fpath)) {
				$sql = "update sector set image = '{$fileName}' where id = '$id'";
				$query = mysqli_query($con,$sql);
			}
		}  
      
		if($upate){
			$_SESSION['msg'] = 'data_updated';
			header("location: view-sector.php");
		}
		else 
		{
			header("location: view-sector.php");exit;
		}
	}


	if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='status'){
		
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
		
		$sql = "select publish from sector where id = {$id} ";
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
		
		$sql = "update sector set publish = {$status} where id = {$id}";
		$update = mysqli_query($con,$sql);
		
		if($update) {
			$_SESSION['msg'] = 'status_changed';
			header('location: view-sector.php');exit;
		} 
		else {
			header("location: view-sector.php");exit;
		}
		
	}

	if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='delete'){
		
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
		
		$sql = "delete from sector where id = {$id}";
		
		$delete = mysqli_query($con,$sql);
		
		if($delete)
		{
			$_SESSION['msg'] = 'delete_data';
			header('location: view-sector.php');exit;
		} 
		else{
			header("location: view-sector.php");exit;
		}
		
	}

?>