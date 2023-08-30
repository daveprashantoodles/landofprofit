<?php 

// error_reporting(E_ALL);
// ini_set('display_errors', '1');
include "db_connect.php";
include_once "ImageResizeService.php";
$created_on = date("Y-m-d H:i:s");

if(isset($_POST['submit']) && $_POST['submit']=='Submit') {
	
	$postcode = isset($_POST['postcode'])?mysqli_real_escape_string($con,$_POST['postcode']):'';
	$propertySlug = isset($_POST['propertySlug'])?mysqli_real_escape_string($con,$_POST['propertySlug']):'';
	$house_number_name = isset($_POST['house_number_name'])?mysqli_real_escape_string($con,$_POST['house_number_name']):'';
	$street  = isset($_POST['street'])?mysqli_real_escape_string($con,$_POST['street']):'';
	$town_city = isset($_POST['town_city'])?mysqli_real_escape_string($con,$_POST['town_city']):'';
	$county = isset($_POST['county'])?mysqli_real_escape_string($con,$_POST['county']):'';
	$rent_price = isset($_POST['rent_price'])?mysqli_real_escape_string($con,$_POST['rent_price']):'';
	$sale_price = isset($_POST['sale_price'])?mysqli_real_escape_string($con,$_POST['sale_price']):'';
	$deposit_amount = isset($_POST['deposit_amount'])?mysqli_real_escape_string($con,$_POST['deposit_amount']):'';
	$date_available = isset($_POST['date_available'])?mysqli_real_escape_string($con,$_POST['date_available']):'';
	$guarantor_required  = isset($_POST['guarantor_required'])?mysqli_real_escape_string($con,$_POST['guarantor_required']):'';
	$pets_allowed = isset($_POST['pets_allowed'])?mysqli_real_escape_string($con,$_POST['pets_allowed']):'';
	$bedrooms = isset($_POST['bedrooms'])?mysqli_real_escape_string($con,$_POST['bedrooms']):'';
	$bathrooms = isset($_POST['bathrooms'])?mysqli_real_escape_string($con,$_POST['bathrooms']):'';
	$reception_rooms = isset($_POST['reception_rooms'])?mysqli_real_escape_string($con,$_POST['reception_rooms']):'';
	$isFurnished = isset($_POST['isFurnished'])?mysqli_real_escape_string($con,$_POST['isFurnished']):'';
	$isGasRequired = isset($_POST['isGasRequired'])?mysqli_real_escape_string($con,$_POST['isGasRequired']):'';
	$mainDescription = isset($_POST['mainDescription'])?mysqli_real_escape_string($con,$_POST['mainDescription']):'';
	$sale_rent_flag = isset($_POST['sale_rent_flag'])?mysqli_real_escape_string($con,$_POST['sale_rent_flag']):'';
	$latitude = isset($_POST['latitude'])?mysqli_real_escape_string($con,$_POST['latitude']):'';
	$longitude = isset($_POST['longitude'])?mysqli_real_escape_string($con,$_POST['longitude']):'';
	$map_iframe = isset($_POST['map_iframe'])?mysqli_real_escape_string($con,$_POST['map_iframe']):'';
	$area = isset($_POST['area'])?mysqli_real_escape_string($con,$_POST['area']):'';
	$built_in = isset($_POST['built_in'])?mysqli_real_escape_string($con,$_POST['built_in']):'';
	$gross_yield = isset($_POST['gross_yield'])?mysqli_real_escape_string($con,$_POST['gross_yield']):'';
	$cap_rate = isset($_POST['cap_rate'])?mysqli_real_escape_string($con,$_POST['cap_rate']):'';
	$hoa = isset($_POST['hoa'])?mysqli_real_escape_string($con,$_POST['hoa']):'';
	$is_verify = "y";

	$status = 1;
	
	$SQL = "INSERT INTO `property` (map_iframe,latitude,longitude,sale_rent_flag,postcode,propertySlug,house_number_name,street,town_city,county,rent_price,sale_price,deposit_amount,date_available,guarantor_required,pets_allowed,bedrooms,bathrooms,reception_rooms,isFurnished,isGasRequired,mainDescription,area,built_in,gross_yield,cap_rate,hoa,status,created_on,is_verify)values('$map_iframe','$latitude','$longitude','$sale_rent_flag','$postcode','$propertySlug','$house_number_name','$street','$town_city','$county','$rent_price','$sale_price','$deposit_amount','$date_available','$guarantor_required','$pets_allowed','$bedrooms','$bathrooms','$reception_rooms','$isFurnished','$isGasRequired','$mainDescription','$area','$built_in','$gross_yield','$cap_rate','$hoa','$status','$created_on','$is_verify')";
	
	$INSERT = mysqli_query($con,$SQL);
	
	$lastInsertId=mysqli_insert_id($con);

	$NameFile3=$_FILES['featured_image']['name'];
	if(isset($NameFile3) && !empty($NameFile3)) {
		$extension = strtolower(pathinfo($NameFile3, PATHINFO_EXTENSION)); 
		if($extension != "jpg" && $extension != "jpeg" && $extension !="png" && $extension !="gif") {
		echo '<script type="text/javascript">';
		echo 'alert("Only jpg, jpeg, png and gif files are allowed");';
		echo 'window.location.href = "add-property.php";';
		echo '</script>';
		exit();
	}
	// print_r("hello ji fir");die;
	$featureImg = "feature-Img"; 
	$fileName3 = $NameFile3;
	
	$imageext = end((explode(".", $fileName3)));
	$img_temp = current(explode(".", $fileName3));
	$img1 =  current(explode(".", $fileName3));
	
	// Get count of records having same name image 
	$myquery = "SELECT count(*) as Total FROM property WHERE feature_image LIKE '%".$img1."%'";
	$Result = mysqli_query($con,$myquery);
	$Row = mysqli_fetch_assoc($Result);
	$checkImage=$Row['Total'];
	
	$imagesuffix  ='';
	if($checkImage>0){
		$count = $checkImage + 1;
		$imagesuffix="(".$count.")";
	}
	
	$Picture_Temp= $_FILES["featured_image"]["tmp_name"];
	$Picture=$img_temp.$imagesuffix.'.'.$imageext;
	
	if(!file_exists(".." . DIRECTORY_SEPARATOR . $featureImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $featureImg)) {
		mkdir(".." . DIRECTORY_SEPARATOR . $featureImg);
	}

	$fpath=".." . DIRECTORY_SEPARATOR . $featureImg . DIRECTORY_SEPARATOR . $Picture;
	
	if(move_uploaded_file($Picture_Temp, $fpath)) {
		$img_stmt = $con->prepare('UPDATE `property` SET `feature_image` = ? WHERE `id` = ? ');
		$img_stmt->bind_param('ss', $Picture,$lastInsertId);
		$img_stmt->execute();
		$img_stmt->store_result();
	}

		/*
		$resizeObj = new ImageResizeService($fpath);
		$resizeObj->resizeImage(730, 380, 'auto');
		$resizeObj->saveImage($fpath, 100);
		*/
	} 

	
	/*brochure*/	
	$NameFile2=$_FILES['brochure']['name'];
	if(isset($NameFile2) && !empty($NameFile2)) {
		$extension = strtolower(pathinfo($NameFile2, PATHINFO_EXTENSION)); 
		$brochureImg = "brochure-Img"; 
	
		$imageext = end((explode(".", $NameFile2)));
		$img_temp = current(explode(".", $NameFile2));
		$img1 =  current(explode(".", $NameFile2));
	
		// Get count of records having same name image 
		$myquery = "SELECT count(*) as Total FROM property WHERE brochure LIKE '%".$img1."%'";
		$Result = mysqli_query($con,$myquery);
		$Row = mysqli_fetch_assoc($Result);
		$checkImage=$Row['Total'];
	
		$imagesuffix  ='';
		if($checkImage>0){
			$count = $checkImage + 1;
			$imagesuffix="(".$count.")";
		}
		
		$Picture_Temp= $_FILES["brochure"]["tmp_name"];
		$Picture=$img_temp.$imagesuffix.'.'.$imageext;
		
		if(!file_exists(".." . DIRECTORY_SEPARATOR . $brochureImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $brochureImg)) {
			mkdir(".." . DIRECTORY_SEPARATOR . $brochureImg);
		}

		$fpath=".." . DIRECTORY_SEPARATOR . $brochureImg . DIRECTORY_SEPARATOR . $Picture;
		
		if(move_uploaded_file($Picture_Temp, $fpath)) {
			$img_stmt = $con->prepare('UPDATE `property` SET `brochure` = ? WHERE `id` = ? ');
			$img_stmt->bind_param('ss', $Picture,$lastInsertId);
			$img_stmt->execute();
			$img_stmt->store_result();
		}
	}
	
	/*Price List*/	
	$NameFile1=$_FILES['pricelist']['name'];
	if(isset($NameFile1) && !empty($NameFile1)) {
		$extension = strtolower(pathinfo($NameFile1, PATHINFO_EXTENSION)); 
		$pricelistImg = "pricelist-Img"; 
	
		$imageext = end((explode(".", $NameFile1)));
		$img_temp = current(explode(".", $NameFile1));
		$img1 =  current(explode(".", $NameFile1));
	
		// Get count of records having same name image 
		$myquery = "SELECT count(*) as Total FROM property WHERE pricelist LIKE '%".$img1."%'";
		$Result = mysqli_query($con,$myquery);
		$Row = mysqli_fetch_assoc($Result);
		$checkImage=$Row['Total'];
	
		$imagesuffix  ='';
		if($checkImage>0){
			$count = $checkImage + 1;
			$imagesuffix="(".$count.")";
		}
		
		$Picture_Temp= $_FILES["pricelist"]["tmp_name"];
		$Picture=$img_temp.$imagesuffix.'.'.$imageext;
		
		if(!file_exists(".." . DIRECTORY_SEPARATOR . $pricelistImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $pricelistImg)) {
			mkdir(".." . DIRECTORY_SEPARATOR . $pricelistImg);
		}

		$fpath=".." . DIRECTORY_SEPARATOR . $pricelistImg . DIRECTORY_SEPARATOR . $Picture;
		
		if(move_uploaded_file($Picture_Temp, $fpath)) {
			$img_stmt = $con->prepare('UPDATE `property` SET `pricelist` = ? WHERE `id` = ? ');
			$img_stmt->bind_param('ss', $Picture,$lastInsertId);
			$img_stmt->execute();
			$img_stmt->store_result();
		}
	} 	
	
	if($INSERT){
		$_SESSION['msg'] = 'data_uploaded';
		header("location: view-property.php");
	}else {
		header("location: add-property.php");exit;
	}
}

if(isset($_POST['submit']) && $_POST['submit']=='Save Changes') {
    
	$id =check_input($con,base64_decode($_REQUEST['id']));
	$id1=check_input($con,$_REQUEST['id']);
	
	$postcode = isset($_POST['postcode'])?mysqli_real_escape_string($con,$_POST['postcode']):'';
	$propertySlug = isset($_POST['propertySlug'])?mysqli_real_escape_string($con,$_POST['propertySlug']):'';
	$house_number_name = isset($_POST['house_number_name'])?mysqli_real_escape_string($con,$_POST['house_number_name']):'';
	$street  = isset($_POST['street'])?mysqli_real_escape_string($con,$_POST['street']):'';
	$town_city = isset($_POST['town_city'])?mysqli_real_escape_string($con,$_POST['town_city']):'';
	$county = isset($_POST['county'])?mysqli_real_escape_string($con,$_POST['county']):'';
	$rent_price = isset($_POST['rent_price'])?mysqli_real_escape_string($con,$_POST['rent_price']):'';
	$sale_price = isset($_POST['sale_price'])?mysqli_real_escape_string($con,$_POST['sale_price']):'';
	$deposit_amount = isset($_POST['deposit_amount'])?mysqli_real_escape_string($con,$_POST['deposit_amount']):'';
	$date_available = isset($_POST['date_available'])?mysqli_real_escape_string($con,$_POST['date_available']):'';
	$guarantor_required  = isset($_POST['guarantor_required'])?mysqli_real_escape_string($con,$_POST['guarantor_required']):'';
	$pets_allowed = isset($_POST['pets_allowed'])?mysqli_real_escape_string($con,$_POST['pets_allowed']):'';
	$bedrooms = isset($_POST['bedrooms'])?mysqli_real_escape_string($con,$_POST['bedrooms']):'';
	$bathrooms = isset($_POST['bathrooms'])?mysqli_real_escape_string($con,$_POST['bathrooms']):'';
	$reception_rooms = isset($_POST['reception_rooms'])?mysqli_real_escape_string($con,$_POST['reception_rooms']):'';
	$isFurnished = isset($_POST['isFurnished'])?mysqli_real_escape_string($con,$_POST['isFurnished']):'';
	$isGasRequired = isset($_POST['isGasRequired'])?mysqli_real_escape_string($con,$_POST['isGasRequired']):'';
	$mainDescription = isset($_POST['mainDescription'])?mysqli_real_escape_string($con,$_POST['mainDescription']):'';
	$sale_rent_flag = isset($_POST['sale_rent_flag'])?mysqli_real_escape_string($con,$_POST['sale_rent_flag']):'';
	$latitude = isset($_POST['latitude'])?mysqli_real_escape_string($con,$_POST['latitude']):'';
	$longitude = isset($_POST['longitude'])?mysqli_real_escape_string($con,$_POST['longitude']):'';
	$map_iframe = isset($_POST['map_iframe'])?mysqli_real_escape_string($con,$_POST['map_iframe']):'';
	$area = isset($_POST['area'])?mysqli_real_escape_string($con,$_POST['area']):'';
	$built_in = isset($_POST['built_in'])?mysqli_real_escape_string($con,$_POST['built_in']):'';
	$gross_yield = isset($_POST['gross_yield'])?mysqli_real_escape_string($con,$_POST['gross_yield']):'';
	$cap_rate = isset($_POST['cap_rate'])?mysqli_real_escape_string($con,$_POST['cap_rate']):'';
	$hoa = isset($_POST['hoa'])?mysqli_real_escape_string($con,$_POST['hoa']):'';
	
	$SQL = "UPDATE `property` SET map_iframe = '$map_iframe',area = '$area',built_in = '$built_in',gross_yield = '$gross_yield',cap_rate = '$cap_rate',hoa = '$hoa',latitude = '$latitude',longitude = '$longitude',sale_rent_flag = '$sale_rent_flag',postcode = '$postcode',propertySlug = '$propertySlug',house_number_name = '$house_number_name',street = '$street',town_city = '$town_city',county = '$county',rent_price = '$rent_price',sale_price = '$sale_price',deposit_amount = '$deposit_amount',date_available = '$date_available',guarantor_required = '$guarantor_required',pets_allowed = '$pets_allowed',bedrooms = '$bedrooms',bathrooms = '$bathrooms',reception_rooms = '$reception_rooms',isFurnished = '$isFurnished',isGasRequired = '$isGasRequired',mainDescription = '$mainDescription' WHERE id=".$id;
	$UPDATE = mysqli_query($con,$SQL);
	
	if($UPDATE){
		$query_desc = mysqli_query($con,"Delete from property_type_checklist where property_id = '".$id."'");
	/*	$propertype_checklist=$_POST['propertype_checklist'];
		foreach($propertype_checklist as $property_type_id){
			$insert_stmt = $con->prepare('INSERT INTO `property_type_checklist` SET `property_id` = ?,`type_id` = ?');
			$insert_stmt->bind_param("ss",$id,$property_type_id);
			$insert_stmt->execute();
		}
		
		$query_desc = mysqli_query($con,"Delete from property_feature_checklist where property_id = '".$id."'");
		
		$proper_feature_checklist=$_POST['property_feature_checklist'];
			
		foreach($proper_feature_checklist as $property_feature_id){
			$insert_stmt = $con->prepare('INSERT INTO `property_feature_checklist` SET `property_id` = ?,`feature_id` = ?');
			$insert_stmt->bind_param("ss",$id,$property_feature_id);
			$insert_stmt->execute();
		}
		
		// IMGs code started 
		
		$myquery = "SELECT  epc_image,gas_image,feature_image FROM property WHERE id = '".$id."'";
		$Result = mysqli_query($con,$myquery);
		$Row = mysqli_fetch_assoc($Result);
		$epc_image = $Row['epc_image'];
		$gas_image = $Row['gas_image'];
		$feature_image = $Row['feature_image'];
		
		$NameFile1=$_FILES['epc_image']['name'];
		if(isset($NameFile1) && !empty($NameFile1)) {
			$extension = strtolower(pathinfo($NameFile1, PATHINFO_EXTENSION)); 
			if($extension != "jpg" && $extension != "jpeg" && $extension !="png" && $extension !="gif") {
				echo '<script type="text/javascript">';
				echo 'alert("Only jpg, jpeg, png and gif files are allowed");';
				echo 'window.location.href = "edit-property.php";';
				echo '</script>';
				exit();
			}
			
			//Unlink removed Destination image	
			$epcImg = "epc-Img";
			if (isset($_POST['existImage1']) && $_POST['existImage1'] == '') {
				if(isset($_POST['removedImage1']) && $_POST['removedImage1'] != '') {
					$rimg1="../".$epcImg."/".$_POST['removedImage1'];
					if (file_exists($rimg1)) {
						unlink($rimg1);
						$nimg1="";
						$uimg_stmt1 = $con->prepare('UPDATE `property` SET `epc_image` = ? WHERE `id` = ? ');
						$uimg_stmt1->bind_param("ss",$nimg1,$id);
						$uimg_stmt1->execute();
						$uimg_stmt1->store_result();
					}
				}
			}
			
			
			
			$fileName1 = $NameFile1;
			$imageext = end((explode(".", $fileName1)));
			$img_temp = current(explode(".", $fileName1));
			$img1 =  current(explode(".", $fileName1));
			
			// Get count of records having same name image 
			$myquery = "SELECT count(*) as Total FROM property WHERE epc_image LIKE '%".$img1."%' AND id<>".$id;
			$Result = mysqli_query($con,$myquery);
			$Row = mysqli_fetch_assoc($Result);
			$checkImage=$Row['Total'];
			
			// var_dump($checkImage);exit;
			
			$imagesuffix  ='';
			if($checkImage>0){
				$count = $checkImage + 1;
				$imagesuffix="(".$count.")";
			}
			
			
			$Picture_Temp= $_FILES["epc_image"]["tmp_name"];
			$Picture=$img_temp.$imagesuffix.'.'.$imageext;
			
			if(!file_exists(".." . DIRECTORY_SEPARATOR . $epcImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $epcImg)) {
				mkdir(".." . DIRECTORY_SEPARATOR . $epcImg);
			}
			
			
			$fpath=".." . DIRECTORY_SEPARATOR . $epcImg . DIRECTORY_SEPARATOR . $Picture;

			if(move_uploaded_file($Picture_Temp, $fpath)) {
				$nimg_stmt = $con->prepare('UPDATE `property` SET `epc_image` = ? WHERE `id` = ? ');
				$nimg_stmt->bind_param('ss', $Picture, $id);
				$nimg_stmt->execute();
				$nimg_stmt->store_result();
				
				$resizeObj = new ImageResizeService($fpath);
				$resizeObj->resizeImage(730, 380, 'auto');
				$resizeObj->saveImage($fpath, 100);
			
			}
			
		}
		
		$NameFile2=$_FILES['gas_image']['name'];
		if(isset($NameFile2) && !empty($NameFile2)) {
			$extension = strtolower(pathinfo($NameFile2, PATHINFO_EXTENSION)); 
			if($extension != "jpg" && $extension != "jpeg" && $extension !="png" && $extension !="gif") {
				echo '<script type="text/javascript">';
				echo 'alert("Only jpg, jpeg, png and gif files are allowed");';
				echo 'window.location.href = "edit-property.php";';
				echo '</script>';
				exit();
			}
			
			//Unlink removed Destination image	
			$gasImg = "gas-Img";
			if (isset($_POST['existImage2']) && $_POST['existImage2'] == '') {
				if(isset($_POST['removedImage2']) && $_POST['removedImage2'] != '') {
					$rimg1="../".$gasImg."/".$_POST['removedImage2'];
					if (file_exists($rimg1)) {
						unlink($rimg1);
						$nimg1="";
						$uimg_stmt1 = $con->prepare('UPDATE `property` SET `gas_image` = ? WHERE `id` = ? ');
						$uimg_stmt1->bind_param("ss",$nimg1,$id);
						$uimg_stmt1->execute();
						$uimg_stmt1->store_result();
					}
				}
			}
			
			
			$fileName2 = $NameFile2;
			$imageext = end((explode(".", $fileName2)));
			$img_temp = current(explode(".", $fileName2));
			$img1 =  current(explode(".", $fileName2));
			
			// Get count of records having same name image 
			$myquery = "SELECT count(*) as Total FROM property WHERE gas_image LIKE '%".$img1."%' AND id<>".$id;
			$Result = mysqli_query($con,$myquery);
			$Row = mysqli_fetch_assoc($Result);
			$checkImage=$Row['Total'];
			
			$imagesuffix  ='';
			if($checkImage>0){
				$count = $checkImage + 1;
				$imagesuffix="(".$count.")";
			}
			
			$Picture_Temp= $_FILES["gas_image"]["tmp_name"];
			$Picture=$img_temp.$imagesuffix.'.'.$imageext;
			
			if(!file_exists(".." . DIRECTORY_SEPARATOR . $gasImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $gasImg)) {
				mkdir(".." . DIRECTORY_SEPARATOR . $gasImg);
			}
			
			
			$fpath=".." . DIRECTORY_SEPARATOR . $gasImg . DIRECTORY_SEPARATOR . $Picture;

			if(move_uploaded_file($Picture_Temp, $fpath)) {
				$nimg_stmt = $con->prepare('UPDATE `property` SET `gas_image` = ? WHERE `id` = ? ');
				$nimg_stmt->bind_param('ss', $Picture, $id);
				$nimg_stmt->execute();
				$nimg_stmt->store_result();
				
				$resizeObj = new ImageResizeService($fpath);
				$resizeObj->resizeImage(730, 380, 'auto');
				$resizeObj->saveImage($fpath, 100);
				
			}
		}*/
		
		
		$NameFile3=$_FILES['featured_image']['name'];
		if(isset($NameFile3) && !empty($NameFile3)) {
			$extension = strtolower(pathinfo($NameFile3, PATHINFO_EXTENSION)); 
			if($extension != "jpg" && $extension != "jpeg" && $extension !="png" && $extension !="gif") {
				echo '<script type="text/javascript">';
				echo 'alert("Only jpg, jpeg, png and gif files are allowed");';
				echo 'window.location.href = "edit-property.php";';
				echo '</script>';
				exit();
			}
			
			//Unlink removed Destination image	
			$featureImg = "feature-Img";
			if (isset($_POST['existImage3']) && $_POST['existImage3'] == '') {
				if(isset($_POST['removedImage3']) && $_POST['removedImage3'] != '') {
					$rimg1="../".$featureImg."/".$_POST['removedImage3'];
					if (file_exists($rimg1)) {
						unlink($rimg1);
						$nimg1="";
						$uimg_stmt1 = $con->prepare('UPDATE `property` SET `feature_image` = ? WHERE `id` = ? ');
						$uimg_stmt1->bind_param("ss",$nimg1,$id);
						$uimg_stmt1->execute();
						$uimg_stmt1->store_result();
					}
				}
			}
			
		
			
			$fileName3 = $NameFile3;
			$imageext = end((explode(".", $fileName3)));
			$img_temp = current(explode(".", $fileName3));
			$img1 =  current(explode(".", $fileName3));
			
			// Get count of records having same name image 
			$myquery = "SELECT count(*) as Total FROM property WHERE feature_image LIKE '%".$img1."%' AND id<>".$id;
			$Result = mysqli_query($con,$myquery);
			$Row = mysqli_fetch_assoc($Result);
			$checkImage=$Row['Total'];
			
			$imagesuffix  ='';
			if($checkImage>0){
				$count = $checkImage + 1;
				$imagesuffix="(".$count.")";
			}
			
			$Picture_Temp= $_FILES["featured_image"]["tmp_name"];
			$Picture=$img_temp.$imagesuffix.'.'.$imageext;
			
			if(!file_exists(".." . DIRECTORY_SEPARATOR . $featureImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $featureImg)) {
				mkdir(".." . DIRECTORY_SEPARATOR . $featureImg);
			}
			
			$fpath=".." . DIRECTORY_SEPARATOR . $featureImg . DIRECTORY_SEPARATOR . $Picture;

			if(move_uploaded_file($Picture_Temp, $fpath)) {
				$nimg_stmt = $con->prepare('UPDATE `property` SET `feature_image` = ? WHERE `id` = ? ');
				$nimg_stmt->bind_param('ss', $Picture, $id);
				$nimg_stmt->execute();
				$nimg_stmt->store_result();
			
			}
		}
		
		
		/*brochure*/	
		$NameFile2=$_FILES['brochure']['name'];
		if(isset($NameFile2) && !empty($NameFile2)) {
			$extension = strtolower(pathinfo($NameFile2, PATHINFO_EXTENSION)); 
			$brochureImg = "brochure-Img"; 
		
			$imageext = end((explode(".", $NameFile2)));
			$img_temp = current(explode(".", $NameFile2));
			$img1 =  current(explode(".", $NameFile2));
		
			// Get count of records having same name image 
			$myquery = "SELECT count(*) as Total FROM property WHERE brochure LIKE '%".$img1."%'";
			$Result = mysqli_query($con,$myquery);
			$Row = mysqli_fetch_assoc($Result);
			$checkImage=$Row['Total'];
		
			$imagesuffix  ='';
			if($checkImage>0){
				$count = $checkImage + 1;
				$imagesuffix="(".$count.")";
			}
			
			$Picture_Temp= $_FILES["brochure"]["tmp_name"];
			$Picture=$img_temp.$imagesuffix.'.'.$imageext;
			
			if(!file_exists(".." . DIRECTORY_SEPARATOR . $brochureImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $brochureImg)) {
				mkdir(".." . DIRECTORY_SEPARATOR . $brochureImg);
			}

			$fpath=".." . DIRECTORY_SEPARATOR . $brochureImg . DIRECTORY_SEPARATOR . $Picture;
			
			if(move_uploaded_file($Picture_Temp, $fpath)) {
				$img_stmt = $con->prepare('UPDATE `property` SET `brochure` = ? WHERE `id` = ? ');
				$img_stmt->bind_param('ss', $Picture,$id);
				$img_stmt->execute();
				$img_stmt->store_result();
			}
		}
		
		/*Price List*/	
		$NameFile1=$_FILES['pricelist']['name'];
		if(isset($NameFile1) && !empty($NameFile1)) {
			$extension = strtolower(pathinfo($NameFile1, PATHINFO_EXTENSION)); 
			$pricelistImg = "pricelist-Img"; 
		
			$imageext = end((explode(".", $NameFile1)));
			$img_temp = current(explode(".", $NameFile1));
			$img1 =  current(explode(".", $NameFile1));
		
			// Get count of records having same name image 
			$myquery = "SELECT count(*) as Total FROM property WHERE pricelist LIKE '%".$img1."%'";
			$Result = mysqli_query($con,$myquery);
			$Row = mysqli_fetch_assoc($Result);
			$checkImage=$Row['Total'];
		
			$imagesuffix  ='';
			if($checkImage>0){
				$count = $checkImage + 1;
				$imagesuffix="(".$count.")";
			}
			
			$Picture_Temp= $_FILES["pricelist"]["tmp_name"];
			$Picture=$img_temp.$imagesuffix.'.'.$imageext;
			
			if(!file_exists(".." . DIRECTORY_SEPARATOR . $pricelistImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $pricelistImg)) {
				mkdir(".." . DIRECTORY_SEPARATOR . $pricelistImg);
			}

			$fpath=".." . DIRECTORY_SEPARATOR . $pricelistImg . DIRECTORY_SEPARATOR . $Picture;
			
			if(move_uploaded_file($Picture_Temp, $fpath)) {
				$img_stmt = $con->prepare('UPDATE `property` SET `pricelist` = ? WHERE `id` = ? ');
				$img_stmt->bind_param('ss', $Picture,$id);
				$img_stmt->execute();
				$img_stmt->store_result();
			}
		} 
		
		$_SESSION['msg'] = 'data_updated';
		header("location: view-property.php");
	}else {
		header("location: edit-property.php?id=".$id1);exit;
	}
}

if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='status'){
	$id=check_input($con,base64_decode($_REQUEST['id']));
	$sts_stmt = $con->prepare('SELECT `status` FROM `property` WHERE `id` = ?');
	$sts_stmt->bind_param('s', $id);
	$sts_result = $sts_stmt->execute();
	$sts_stmt->store_result();
	$sts_stmt->bind_result($cstatus);
	$sts_stmt->fetch();

	if($cstatus=='1'){
		$status=0;
		$stmt = $con->prepare('UPDATE `property` SET `status` = ? WHERE `id` = ? ');
		$stmt->bind_param('ss', $status, $id);
		$result = $stmt->execute();
		$stmt->store_result();
	}

	if($cstatus=='0'){
		$status=1;
		$stmt = $con->prepare('UPDATE `property` SET `status` = ? WHERE `id` = ? ');
		$stmt->bind_param('ss', $status, $id);
		$result = $stmt->execute();
		$stmt->store_result();
	}

	if($stmt) {
		$_SESSION['msg'] = 'status_changed';
		header('location: view-property.php');exit;
	}
	else {
		header("location: view-property.php");exit;
	}

}

	
if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='delete'){
	$id=check_input($con,base64_decode($_REQUEST['id']));
	$delete_stmt = $con->prepare('DELETE FROM `property` WHERE `id` = ? ');
	$delete_stmt->bind_param('s', $id);
	$delete_stmt->execute();
	
	if($delete_stmt) {
		$_SESSION['msg'] = 'delete_data';
		header('location: view-property.php');exit;
	}
	else {
		header("location: view-property.php");exit;
	}

}

if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='verify'){
		
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
		$status = isset($_REQUEST['status'])?$_REQUEST['status']:"";
		
		$sql = "update property set is_verify = '".$status."' WHERE id = {$id}";
		$update = mysqli_query($con,$sql);
		
		if($update)
		{
			$_SESSION['msg'] = 'status_changed';
			header('location: view-property.php');exit;
		} 
		else{
			header("location: view-property.php");exit;
		}
		
	}

