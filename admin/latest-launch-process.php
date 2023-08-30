<?php 

	include "db_connect.php";

	$create_time = date("Y-m-d H:i:s");

	if(isset($_POST['submit']) && $_POST['submit']=='Submit') {
		
		$latestlaunchTitle = isset($_POST['latestlaunchTitle'])?mysqli_real_escape_string($con,$_POST['latestlaunchTitle']):"";
		$titleSlug = isset($_POST['titleSlug'])?mysqli_real_escape_string($con,$_POST['titleSlug']):"";

		$section1Heading = isset($_POST['section1Heading'])?mysqli_real_escape_string($con,$_POST['section1Heading']):"";
		$section1Content = isset($_POST['section1Content'])?mysqli_real_escape_string($con,$_POST['section1Content']):"";

		$Section2Heading = isset($_POST['Section2Heading'])?mysqli_real_escape_string($con,$_POST['Section2Heading']):"";
		$section2Content = isset($_POST['section2Content'])?mysqli_real_escape_string($con,$_POST['section2Content']):"";

		$Section3Heading = isset($_POST['Section3Heading'])?mysqli_real_escape_string($con,$_POST['Section3Heading']):"";
		$section3Content = isset($_POST['section3Content'])?mysqli_real_escape_string($con,$_POST['section3Content']):"";

		$Section4Heading = isset($_POST['Section4Heading'])?mysqli_real_escape_string($con,$_POST['Section4Heading']):"";
		$section4Content = isset($_POST['section4Content'])?mysqli_real_escape_string($con,$_POST['section4Content']):"";

        $galley1SectionHeding = isset($_POST['galley1SectionHeding'])?mysqli_real_escape_string($con,$_POST['galley1SectionHeding']):"";
		$galley1SectionContent = isset($_POST['galley1SectionContent'])?mysqli_real_escape_string($con,$_POST['galley1SectionContent']):"";

        $galley2SectionHeding = isset($_POST['galley2SectionHeding'])?mysqli_real_escape_string($con,$_POST['galley2SectionHeding']):"";
		$galley2SectionContent = isset($_POST['galley2SectionContent'])?mysqli_real_escape_string($con,$_POST['galley2SectionContent']):"";

        $Section5Heading = isset($_POST['Section5Heading'])?mysqli_real_escape_string($con,$_POST['Section5Heading']):"";
		$section5Content = isset($_POST['section5Content'])?mysqli_real_escape_string($con,$_POST['section5Content']):"";

		$section6maps = isset($_POST['section6maps'])?mysqli_real_escape_string($con,$_POST['section6maps']):"";

		$titleTag = isset($_POST['titleTag'])?mysqli_real_escape_string($con,$_POST['titleTag']):"";
		$metaKeyword = isset($_POST['metaKeyword'])?mysqli_real_escape_string($con,$_POST['metaKeyword']):"";
		$metaDescription = isset($_POST['metaDescription'])?mysqli_real_escape_string($con,$_POST['metaDescription']):"";
		$publish = 1;
		
		$sql = "insert into latest_launch (latestlaunchTitle, titleSlug, fsectionHeading, fsectionContent, 2SectionHeading, 2sectionContent, 3SectionHeading, 3sectionContent, 4SectionHeading, 4sectionContent, 1galleySectionHeding, 1galleySectionContent, 2galleySectionHeding, 2galleySectionContent, 5SectionHeading, 5sectionContent, 6maps, titleTag, metaKeyword, metaDescription, created_at)values('{$latestlaunchTitle}','{$titleSlug}','{$section1Heading}','{$section1Content}','{$Section2Heading}','{$section2Content}','{$Section3Heading}','{$section3Content}','{$Section4Heading}','{$section4Content}','{$galley1SectionHeding}','{$galley1SectionContent}','{$galley2SectionHeding}','{$galley2SectionContent}','{$Section5Heading}','{$section5Content}','{$section6maps}','{$titleTag}','{$metaKeyword}','{$metaDescription}','{$create_time}')";

		$query = mysqli_query($con,$sql);
		$lastInsertId = mysqli_insert_id($con);
		
		$brochure=$_FILES['section1brochure']['name'];
		
		if(isset($brochure) && !empty($brochure)) {
			
			$extension = strtolower(pathinfo($brochure, PATHINFO_EXTENSION)); 
			// if($extension != "jpg" && $extension != "jpeg" && $extension !="png" && $extension !="gif") {
			// 	echo '<script type="text/javascript">';
			// 	echo 'alert("Only jpg, jpeg, png and gif files are allowed");';
			// 	echo 'window.location.href = "add-latest-launch.php";';
			// 	echo '</script>';
			// 	exit();
			// }
			
			$bfilename = time().'.'.$extension;
			$fpath=".." . DIRECTORY_SEPARATOR . $latestLaunchImg . DIRECTORY_SEPARATOR . $bfilename;
			if(!file_exists(".." . DIRECTORY_SEPARATOR . $latestLaunchImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $latestLaunchImg)) {
				mkdir(".." . DIRECTORY_SEPARATOR . $latestLaunchImg);
			}

			if(move_uploaded_file($_FILES["section1brochure"]["tmp_name"], $fpath)) {
				$sql = "update latest_launch set fsectionbrochure =  '{$bfilename}' where id = '{$lastInsertId}'";
				$query = mysqli_query($con,$sql);
			}
		}
		
		
		$NameFile=$_FILES['image']['name'];
		
		if(isset($NameFile) && !empty($NameFile)) {
			
			$extension = strtolower(pathinfo($NameFile, PATHINFO_EXTENSION)); 
			if($extension != "jpg" && $extension != "jpeg" && $extension !="png" && $extension !="gif") {
				echo '<script type="text/javascript">';
				echo 'alert("Only jpg, jpeg, png and gif files are allowed");';
				echo 'window.location.href = "add-latest-launch.php";';
				echo '</script>';
				exit();
			}
			
			$filename = time().'.'.$extension;
			$fpath=".." . DIRECTORY_SEPARATOR . $latestLaunchImg . DIRECTORY_SEPARATOR . $filename;
			if(!file_exists(".." . DIRECTORY_SEPARATOR . $latestLaunchImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $latestLaunchImg)) {
				mkdir(".." . DIRECTORY_SEPARATOR . $latestLaunchImg);
			}

			if(move_uploaded_file($_FILES["image"]["tmp_name"], $fpath)) {
				$sql = "update latest_launch set image1 =  '{$filename}' where id = '{$lastInsertId}'";
				$query = mysqli_query($con,$sql);
			}
		}

        $NameFile=$_FILES['image1']['name'];
		if(isset($NameFile) && !empty($NameFile)) {
			$extension = strtolower(pathinfo($NameFile, PATHINFO_EXTENSION)); 
			if($extension != "jpg" && $extension != "jpeg" && $extension !="png" && $extension !="gif") {
				echo '<script type="text/javascript">';
				echo 'alert("Only jpg, jpeg, png and gif files are allowed");';
				echo 'window.location.href = "add-latest-launch.php";';
				echo '</script>';
				exit();
			}
			$time = time()+1;
			$fileName1 =$time.'.'.$extension;
			$fpath=".." . DIRECTORY_SEPARATOR . $latestLaunchImg . DIRECTORY_SEPARATOR . $fileName1;
			if(!file_exists(".." . DIRECTORY_SEPARATOR . $latestLaunchImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $latestLaunchImg)) {
				mkdir(".." . DIRECTORY_SEPARATOR . $latestLaunchImg);
			}
			if(move_uploaded_file($_FILES["image1"]["tmp_name"], $fpath)) {
				$img_stmt = $con->prepare('UPDATE `latest_launch` SET `image2` = ? WHERE `id` = ? ');
				$img_stmt->bind_param('ss', $fileName1,$lastInsertId);
				$img_stmt->execute();
				$img_stmt->store_result();
			}
		}  


        $NameFile=$_FILES['image2']['name'];
		if(isset($NameFile) && !empty($NameFile)) {
			$extension = strtolower(pathinfo($NameFile, PATHINFO_EXTENSION)); 
			if($extension != "jpg" && $extension != "jpeg" && $extension !="png" && $extension !="gif") {
				echo '<script type="text/javascript">';
				echo 'alert("Only jpg, jpeg, png and gif files are allowed");';
				echo 'window.location.href = "add-latest-launch.php";';
				echo '</script>';
				exit();
			}
			$time = time()+2;
			$fileName1 =$time.'.'.$extension;
			$fpath=".." . DIRECTORY_SEPARATOR . $latestLaunchImg . DIRECTORY_SEPARATOR . $fileName1;
			if(!file_exists(".." . DIRECTORY_SEPARATOR . $latestLaunchImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $latestLaunchImg)) {
				mkdir(".." . DIRECTORY_SEPARATOR . $latestLaunchImg);
			}
			if(move_uploaded_file($_FILES["image2"]["tmp_name"], $fpath)) {
				$id =1;
				$img_stmt = $con->prepare('UPDATE `latest_launch` SET `image3` = ? WHERE `id` = ? ');
				$img_stmt->bind_param('ss', $fileName1,$lastInsertId);
				$img_stmt->execute();
				$img_stmt->store_result();
			}
		}  

        foreach ($_FILES['gallery1Imgs']['name'] as $key => $val) {
            $NameFile = $val;
    
            $fpath = ".." . DIRECTORY_SEPARATOR . $latestLaunchGallery . DIRECTORY_SEPARATOR . $NameFile;
    
            if (!file_exists(".." . DIRECTORY_SEPARATOR . $latestLaunchGallery) && !is_dir(".." . DIRECTORY_SEPARATOR . $latestLaunchGallery)) {
                mkdir(".." . DIRECTORY_SEPARATOR . $latestLaunchGallery);
            }
    
            if (move_uploaded_file($_FILES["gallery1Imgs"]["tmp_name"][$key], $fpath)) {
                $img_stmt = $con->prepare('INSERT INTO `latest_launch_gallery_1` SET `image` = ?, `latest_launch_id`= ?, `created_on`= ? ');
                $img_stmt->bind_param('sss', $NameFile, $lastInsertId, $create_time);
                $img_stmt->execute();
                // $img_stmt->store_result();
            }
        }

        foreach ($_FILES['gallery2Imgs']['name'] as $key => $val) {
            $NameFile = $val;
    
            $fpath = ".." . DIRECTORY_SEPARATOR . $latestLaunchGallery . DIRECTORY_SEPARATOR . $NameFile;
    
            if (!file_exists(".." . DIRECTORY_SEPARATOR . $latestLaunchGallery) && !is_dir(".." . DIRECTORY_SEPARATOR . $latestLaunchGallery)) {
                mkdir(".." . DIRECTORY_SEPARATOR . $latestLaunchGallery);
            }
    
            if (move_uploaded_file($_FILES["gallery2Imgs"]["tmp_name"][$key], $fpath)) {
                $img_stmt = $con->prepare('INSERT INTO `latest_launch_gallery_2` SET `image` = ?, `latest_launch_id`= ?, `created_on`= ? ');
                $img_stmt->bind_param('sss', $NameFile, $lastInsertId, $create_time);
                $img_stmt->execute();
                // $img_stmt->store_result();
            }
        }

        $sec4Subtitle = count($_POST['section4subtitle']);
        for ($a = 0; $a < $sec4Subtitle; $a++) {
            if ($_POST['section4subtitle'][$a] != '') {
                $querySection=mysqli_query($con,"INSERT INTO `latest_launch_section4_sublist` SET `latest_launch_id`='".$lastInsertId."',`title`='".$_POST['section4subtitle'][$a]."' ") or die(mysqli_error($con));
                
            }
        }
      
		if($lastInsertId) {
			$_SESSION['msg'] = 'data_uploaded';
			header("location: view-latest-launch.php");
		} 
		else{
			header("location: view-latest-launch.php");exit;
		}
	} 

    if(isset($_POST['submit']) && $_POST['submit']=='Save Changes') {

		$id1 = isset($_REQUEST['id'])?$_REQUEST['id']:"";
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
	 
		$latestlaunchTitle = isset($_POST['latestlaunchTitle'])?mysqli_real_escape_string($con,$_POST['latestlaunchTitle']):"";
		$titleSlug = isset($_POST['titleSlug'])?mysqli_real_escape_string($con,$_POST['titleSlug']):"";

		$section1Heading = isset($_POST['section1Heading'])?mysqli_real_escape_string($con,$_POST['section1Heading']):"";
		$section1Content = isset($_POST['section1Content'])?mysqli_real_escape_string($con,$_POST['section1Content']):"";

		$Section2Heading = isset($_POST['Section2Heading'])?mysqli_real_escape_string($con,$_POST['Section2Heading']):"";
		$section2Content = isset($_POST['section2Content'])?mysqli_real_escape_string($con,$_POST['section2Content']):"";

		$Section3Heading = isset($_POST['Section3Heading'])?mysqli_real_escape_string($con,$_POST['Section3Heading']):"";
		$section3Content = isset($_POST['section3Content'])?mysqli_real_escape_string($con,$_POST['section3Content']):"";

		$Section4Heading = isset($_POST['Section4Heading'])?mysqli_real_escape_string($con,$_POST['Section4Heading']):"";
		$section4Content = isset($_POST['section4Content'])?mysqli_real_escape_string($con,$_POST['section4Content']):"";

        $galley1SectionHeding = isset($_POST['galley1SectionHeding'])?mysqli_real_escape_string($con,$_POST['galley1SectionHeding']):"";
		$galley1SectionContent = isset($_POST['galley1SectionContent'])?mysqli_real_escape_string($con,$_POST['galley1SectionContent']):"";

        $galley2SectionHeding = isset($_POST['galley2SectionHeding'])?mysqli_real_escape_string($con,$_POST['galley2SectionHeding']):"";
		$galley2SectionContent = isset($_POST['galley2SectionContent'])?mysqli_real_escape_string($con,$_POST['galley2SectionContent']):"";

        $Section5Heading = isset($_POST['Section5Heading'])?mysqli_real_escape_string($con,$_POST['Section5Heading']):"";
		$section5Content = isset($_POST['section5Content'])?mysqli_real_escape_string($con,$_POST['section5Content']):"";

		$section6maps = isset($_POST['section6maps'])?mysqli_real_escape_string($con,$_POST['section6maps']):"";

		$titleTag = isset($_POST['titleTag'])?mysqli_real_escape_string($con,$_POST['titleTag']):"";
		$metaKeyword = isset($_POST['metaKeyword'])?mysqli_real_escape_string($con,$_POST['metaKeyword']):"";
		$metaDescription = isset($_POST['metaDescription'])?mysqli_real_escape_string($con,$_POST['metaDescription']):"";
        
		$fetch_pslug=mysqli_query($con,"SELECT * FROM `latest_launch` WHERE `id`='".$id."' ") or die(mysqli_error($con));
		
		$row_pslug=mysqli_fetch_array($fetch_pslug);

		$presentslug=$row_pslug['titleSlug'];

		if($presentslug!=$titleSlug)
		{
			$fetch_pslug=mysqli_query($con,"SELECT `titleSlug` FROM `latest_launch` WHERE `titleSlug`='".$titleSlug."' ") or die(mysqli_error($con));
			if(mysqli_num_rows($fetch_pslug)==1) {
				echo '<script type="text/javascript">';
				echo 'alert("Vtour Slug already exist. Please Enter another Vtour.!!");';
				echo 'window.location.href = "view-latest-launch.php";';
				echo '</script>';
				exit;
			}
		}
		
		$sql = "update `latest_launch` set latestlaunchTitle = '{$latestlaunchTitle}', titleSlug = '{$titleSlug}',fsectionHeading = '{$section1Heading}',fsectionContent = '{$section1Content}',2SectionHeading = '{$Section2Heading}',2sectionContent = '{$section2Content}',3SectionHeading = '{$Section3Heading}',3sectionContent = '{$section3Content}',4SectionHeading = '{$Section4Heading}',4sectionContent = '{$section4Content}',1galleySectionHeding = '{$galley1SectionHeding}',1galleySectionContent = '{$galley1SectionContent}',2galleySectionHeding = '{$galley2SectionHeding}',2galleySectionContent = '{$galley2SectionContent}',5SectionHeading = '{$Section5Heading}',5sectionContent = '{$section5Content}',6maps = '{$section6maps}',titleTag = '{$titleTag}',metaKeyword = '{$metaKeyword}',metaDescription = '{$metaDescription}' where id = '$id'";
		
		$upate = mysqli_query($con,$sql)or die(mysqli_error($con));


		$brochure=$_FILES['section1brochure']['name'];

		if(isset($_POST['removedBrochure']) && $_POST['removedBrochure'] != '') {
			$rBrochure="../".$latestLaunchImg."/".$_POST['removedBrochure'];
			if (file_exists($rBrochure)) { 
			   unlink($rBrochure);
			   $sql = "update `latest_launch` set fsectionbrochure = '' where id = '$id'";
			   $query = mysqli_query($con,$sql);
		   }
		}
		
		if(isset($brochure) && !empty($brochure)) {
			
			$extension = strtolower(pathinfo($brochure, PATHINFO_EXTENSION)); 

			$bfilename = time().'.'.$extension;
			$fpath=".." . DIRECTORY_SEPARATOR . $latestLaunchImg . DIRECTORY_SEPARATOR . $bfilename;
			if(!file_exists(".." . DIRECTORY_SEPARATOR . $latestLaunchImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $latestLaunchImg)) {
				mkdir(".." . DIRECTORY_SEPARATOR . $latestLaunchImg);
			}

			if(move_uploaded_file($_FILES["section1brochure"]["tmp_name"], $fpath)) {
				$sql = "update latest_launch set fsectionbrochure =  '{$bfilename}' where id = '{$id}'";
				$query = mysqli_query($con,$sql);
			}
		}
		
		$NameFile=$_FILES['image']['name'];
		if(isset($NameFile) && !empty($NameFile)){
			$extension = strtolower(pathinfo($NameFile, PATHINFO_EXTENSION)); 
			if($extension != "jpg" && $extension != "jpeg" && $extension !="png" && $extension !="gif") {
				echo '<script type="text/javascript">';
				echo 'alert("Only jpg, jpeg, png and gif files are allowed");';
				echo 'window.location.href = "view-latest-launch.php";';
				echo '</script>';
				exit();
			}
		}
           		
        if (isset($_POST['existImage']) && $_POST['existImage'] == '') {
			if(isset($_POST['removedImage']) && $_POST['removedImage'] != '') {
				$rimg="../".$latestLaunchImg."/".$_POST['removedImage'];
				if (file_exists($rimg)) { 
				   unlink($rimg);
				   $sql = "update `latest_launch` set image1 = '' where id = '$id'";
				   $query = mysqli_query($con,$sql);
			   }
			}
        }
      
		if(isset($NameFile) && !empty($NameFile)) {

			if(!file_exists(".." . DIRECTORY_SEPARATOR . $latestLaunchImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $latestLaunchImg)) {
				mkdir(".." . DIRECTORY_SEPARATOR . $latestLaunchImg);
			}
         
			$fileName = time().".".$extension;
			$fpath=".." . DIRECTORY_SEPARATOR . $latestLaunchImg . DIRECTORY_SEPARATOR . $fileName;
          
			if(move_uploaded_file($_FILES["image"]["tmp_name"], $fpath)) {
				$sql = "update `latest_launch` set image1 = '{$fileName}' where id = '$id'";
				$query = mysqli_query($con,$sql);
			}
		}

        $NameFile1=$_FILES['image1']['name'];

		if(isset($NameFile1) && !empty($NameFile1)){
			$extension1 = strtolower(pathinfo($NameFile1, PATHINFO_EXTENSION)); 
			if($extension1 != "jpg" && $extension1 != "jpeg" && $extension1 !="png" && $extension1 !="gif") {
				echo '<script type="text/javascript">';
				echo 'alert("Only jpg, jpeg, png and gif files are allowed");';
				echo 'window.location.href = "view-latest-launch.php";';
				echo '</script>';
				exit();
			}
		}
           		
        if (isset($_POST['existImage1']) && $_POST['existImage1'] == '') {
			if(isset($_POST['removedImage1']) && $_POST['removedImage1'] != '') {
				$rimg1="../".$latestLaunchImg."/".$_POST['removedImage1'];
				if (file_exists($rimg1)) { 
				   unlink($rimg1);
				   $sql = "update `latest_launch` set image2 = '' where id = '$id'";
				   $query = mysqli_query($con,$sql);
			   }
			}
        }
      
		if(isset($NameFile1) && !empty($NameFile1)) {

			if(!file_exists(".." . DIRECTORY_SEPARATOR . $latestLaunchImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $latestLaunchImg)) {
				mkdir(".." . DIRECTORY_SEPARATOR . $latestLaunchImg);
			}
         
			$fileName1 = time().".".$extension1;
			$fpath=".." . DIRECTORY_SEPARATOR . $latestLaunchImg . DIRECTORY_SEPARATOR . $fileName1;
          
			if(move_uploaded_file($_FILES["image1"]["tmp_name"], $fpath)) {
				$sql = "update `latest_launch` set image2 = '{$fileName1}' where id = '$id'";
				$query = mysqli_query($con,$sql);
			}
		}
        
        $NameFile2=$_FILES['image2']['name'];
		if(isset($NameFile2) && !empty($NameFile2)){
			$extension2 = strtolower(pathinfo($NameFile2, PATHINFO_EXTENSION)); 
			if($extension2 != "jpg" && $extension2 != "jpeg" && $extension2 !="png" && $extension2 !="gif") {
				echo '<script type="text/javascript">';
				echo 'alert("Only jpg, jpeg, png and gif files are allowed");';
				echo 'window.location.href = "view-latest-launch.php";';
				echo '</script>';
				exit();
			}
		}
           		
        if (isset($_POST['existImage2']) && $_POST['existImage2'] == '') {
			if(isset($_POST['removedImage2']) && $_POST['removedImage2'] != '') {
				$rimg2="../".$latestLaunchImg."/".$_POST['removedImage2'];
				if (file_exists($rimg2)) { 
				   unlink($rimg2);
				   $sql = "update `latest_launch` set image3 = '' where id = '$id'";
				   $query = mysqli_query($con,$sql);
			   }
			}
        }
      
		if(isset($NameFile2) && !empty($NameFile2)) {

			if(!file_exists(".." . DIRECTORY_SEPARATOR . $latestLaunchImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $latestLaunchImg)) {
				mkdir(".." . DIRECTORY_SEPARATOR . $latestLaunchImg);
			}
         
			$fileName2 = time().".".$extension2;
			$fpath=".." . DIRECTORY_SEPARATOR . $latestLaunchImg . DIRECTORY_SEPARATOR . $fileName2;
          
			if(move_uploaded_file($_FILES["image2"]["tmp_name"], $fpath)) {
				$sql = "update `latest_launch` set image3 = '{$fileName2}' where id = '$id'";
				$query = mysqli_query($con,$sql);
			}
		}

		//mutiple Images gallery 1
        foreach ($_FILES['gallery1Imgs']['name'] as $key => $val) {
            $NameFile = $val;
    
            $fpath = ".." . DIRECTORY_SEPARATOR . $latestLaunchGallery . DIRECTORY_SEPARATOR . $NameFile;
    
            if (!file_exists(".." . DIRECTORY_SEPARATOR . $latestLaunchGallery) && !is_dir(".." . DIRECTORY_SEPARATOR . $latestLaunchGallery)) {
                mkdir(".." . DIRECTORY_SEPARATOR . $latestLaunchGallery);
            }
    
            if (move_uploaded_file($_FILES["gallery1Imgs"]["tmp_name"][$key], $fpath)) {
                $img_stmt = $con->prepare('INSERT INTO `latest_launch_gallery_1` SET `image` = ?, `latest_launch_id`= ?, `created_on`= ? ');
                $img_stmt->bind_param('sss', $NameFile, $id, $create_time);
                $img_stmt->execute();
                // $img_stmt->store_result();
            }
        }

		// Gallery 2 Multiple Images 

		foreach ($_FILES['gallery2Imgs']['name'] as $key => $val) {
            $NameFile = $val;
    
            $fpath = ".." . DIRECTORY_SEPARATOR . $latestLaunchGallery . DIRECTORY_SEPARATOR . $NameFile;
    
            if (!file_exists(".." . DIRECTORY_SEPARATOR . $latestLaunchGallery) && !is_dir(".." . DIRECTORY_SEPARATOR . $latestLaunchGallery)) {
                mkdir(".." . DIRECTORY_SEPARATOR . $latestLaunchGallery);
            }
    
            if (move_uploaded_file($_FILES["gallery2Imgs"]["tmp_name"][$key], $fpath)) {
                $img_stmt = $con->prepare('INSERT INTO `latest_launch_gallery_2` SET `image` = ?, `latest_launch_id`= ?, `created_on`= ? ');
                $img_stmt->bind_param('sss', $NameFile, $id, $create_time);
                $img_stmt->execute();
                // $img_stmt->store_result();
            }
        }


		// Section 4 SubTitle 

        $deleteIdsection4subTitle = explode(',', $_POST['deleteIdsection4subTitle'][0]);
        if(isset($_POST['deleteIdsection4subTitle'][0]) && $_POST['deleteIdsection4subTitle'][0]!=''){
            $countDeleteIdsection4subTitle = count($deleteIdsection4subTitle);
            for ($k = 0; $k < $countDeleteIdsection4subTitle; $k++) {
                $delteId=mysqli_query($con,"DELETE FROM `latest_launch_section4_sublist` WHERE `id`='".check_input($con,$deleteIdsection4subTitle[$k])."'") or die(mysqli_error($con));
            }
        }

        $sec4Subtitle = count($_POST['section4subtitle']);

        for ($a = 0; $a < $sec4Subtitle; $a++) {
            if ($_POST['section4subtitle'][$a] != '') {
                $sublistId=$_POST['sublistId'][$a];
               
                if (isset($sublistId) && $sublistId != '') {
                   
                    $uSection4Sublist=mysqli_query($con,"UPDATE `latest_launch_section4_sublist` SET `title`='".$_POST['section4subtitle'][$a]."' WHERE `id`='".$sublistId."' ") or die(mysqli_error($con));
                   
                }  else {
                    $iSection4Sublist=mysqli_query($con,"INSERT INTO `latest_launch_section4_sublist` SET `latest_launch_id`='".$id."',`title`='".$_POST['section4subtitle'][$a]."' ") or die(mysqli_error($con));
                        
                }
            }
        }


        $deleteIdsection5Id = explode(',', $_POST['deleteIdsection5Id'][0]);
        if(isset($_POST['deleteIdsection5Id'][0]) && $_POST['deleteIdsection5Id'][0]!=''){
            $countdeleteIdsection5Id = count($deleteIdsection5Id);
            for ($l = 0; $l < $countdeleteIdsection5Id; $l++) {
                $delteId=mysqli_query($con,"DELETE FROM `latest_launch_section5_sublist` WHERE `id`='".check_input($con,$deleteIdsection5Id[$l])."'") or die(mysqli_error($con));
            }
        }

        $sec5Subtitle = count($_POST['section5subtitle']);

        for ($b = 0; $b < $sec5Subtitle; $b++) {
            if ($_POST['section5subtitle'][$b] != '') {
                $section5sublistId=$_POST['section5sublistId'][$b];
               
                if (isset($section5sublistId) && $section5sublistId != '') {
                    $uSection5Sublist=mysqli_query($con,"UPDATE `latest_launch_section5_sublist` SET `title`='".$_POST['section5subtitle'][$b]."' WHERE `id`='".$section5sublistId."' ") or die(mysqli_error($con));
                   
                }  else {
                    $iSection5Sublist=mysqli_query($con,"INSERT INTO `latest_launch_section5_sublist` SET `latest_launch_id`='".$id."',`title`='".$_POST['section5subtitle'][$b]."' ") or die(mysqli_error($con));
                        
                }
            }
        }


		if($upate){
			$_SESSION['msg'] = 'data_updated';
			header("location: view-latest-launch.php");
		}
		else 
		{
			header("location: view-latest-launch.php");exit;
		}
	}


	if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='status'){
		
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
		
		$sql = "select publish from latest_launch where id = {$id} ";
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
		
		$sql = "update latest_launch set publish = {$status} where id = {$id}";
		$update = mysqli_query($con,$sql);
		
		if($update) {
			$_SESSION['msg'] = 'status_changed';
			header('location: view-latest-launch.php');exit;
		} 
		else {
			header("location: view-latest-launch.php");exit;
		}
		
	}

	if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='delete'){
		
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
		
		$sql = "delete from latest_launch where id = {$id}";
		$delete = mysqli_query($con,$sql);
		
		if($delete)
		{
			$_SESSION['msg'] = 'delete_data';
			header('location: view-latest-launch.php');exit;
		} 
		else{
			header("location: view-latest-launch.php");exit;
		}
		
	}

	if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='deleteGalley1Img'){

		
		
		
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";
		$imageName = isset($_REQUEST['imageName'])? ($_REQUEST['imageName']):"";
		if(isset($imageName) && $imageName != '') {
			$rGallery1Img="../".$latestLaunchGallery."/".$imageName;
			if (file_exists($rGallery1Img)) {
				unlink($rGallery1Img);
			}
		}
		
		$sql = "delete from latest_launch_gallery_1 where id = {$id}";
		$delete = mysqli_query($con,$sql);
		
		if($delete)
		{
			$_SESSION['msg'] = 'delete_data';
			header('location: view-latest-launch.php');exit;
		} 
		else{
			header("location: view-latest-launch.php");exit;
		}
		
	}

	if($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET['action']) && $_GET['action']=='deleteGalley2Img'){
		
		$id = isset($_REQUEST['id'])?base64_decode($_REQUEST['id']):"";

		$imageName = isset($_REQUEST['imageName'])? ($_REQUEST['imageName']):"";
		if(isset($imageName) && $imageName != '') {
			$rGallery2Img="../".$latestLaunchGallery."/".$imageName;
			if (file_exists($rGallery2Img)) {
				unlink($rGallery2Img);
			}
		}
		
		$sql = "delete from latest_launch_gallery_2 where id = {$id}";
		$delete = mysqli_query($con,$sql);
		
		if($delete)
		{
			$_SESSION['msg'] = 'delete_data';
			header('location: view-latest-launch.php');exit;
		} 
		else{
			header("location: view-latest-launch.php");exit;
		}
		
	}
?>
