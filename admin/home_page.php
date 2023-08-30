<?php
include "header.php";
if(isset($_POST['submit'])&&$_POST['submit']=="submit"){
	
	// echo '<pre>';print_r($_POST);exit;
	
	$title = !empty($_POST['title'])?$_POST['title']:'';
	$text1 = !empty($_POST['text1'])?$_POST['text1']:'';
	$text2 = !empty($_POST['text2'])?$_POST['text2']:'';
	$imgAlt = !empty($_POST['imgAlt'])?$_POST['imgAlt']:'';
	$imgTitle = !empty($_POST['imgTitle'])?$_POST['imgTitle']:'';
	$titleTag = !empty($_POST['titleTag'])?$_POST['titleTag']:'';
	$metaKeyword = !empty($_POST['metaKeyword'])?$_POST['metaKeyword']:'';
	$metaDescription = !empty($_POST['metaDescription'])?$_POST['metaDescription']:'';
	$image = !empty($_POST['image'])?$_POST['image']:'';
	$desc = !empty($_POST['desc'])?$_POST['desc']:'';
	$desc=check_input($con,$desc);
	$SQL = "Update home_page set `text1`='".$text1."',`text2`='".$text2."',`title`='".$title."',`titleTag`='".$titleTag."',`description`='".$desc."',`imgAlt`='".$imgAlt."',`imgTitle`='".$imgTitle."',`metaKeyword`='".$metaKeyword."',`metaDescription`='".$metaDescription."' where `id`=1";
	$Update = mysqli_query($con,$SQL) or mysqli_error($con);
	if($Update){
		$NameFile=$_FILES['image']['name'];
		if(isset($NameFile) && !empty($NameFile)) {
			$extension = strtolower(pathinfo($NameFile, PATHINFO_EXTENSION)); 
			if($extension != "jpg" && $extension != "jpeg" && $extension !="png" && $extension !="gif") {
				echo '<script type="text/javascript">';
				echo 'alert("Only jpg, jpeg, png and gif files are allowed");';
				echo 'window.location.href = "home_page.php";';
				echo '</script>';
				exit();
			}
			$fileName =time().'.'.$extension;
			$fpath=".." . DIRECTORY_SEPARATOR . $home_pageImg . DIRECTORY_SEPARATOR . $fileName;
			if(!file_exists(".." . DIRECTORY_SEPARATOR . $home_pageImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $home_pageImg)) {
				mkdir(".." . DIRECTORY_SEPARATOR . $home_pageImg);
			}
			if(move_uploaded_file($_FILES["image"]["tmp_name"], $fpath)) {
				$id =1;
				$img_stmt = $con->prepare('UPDATE `home_page` SET `image` = ? WHERE `id` = ? ');
				$img_stmt->bind_param('ss', $fileName,$id);
				$img_stmt->execute();
				$img_stmt->store_result();
			}
		} 
		
		// $NameFile=$_FILES['image1']['name'];
		// if(isset($NameFile) && !empty($NameFile)) {
			// $extension = strtolower(pathinfo($NameFile, PATHINFO_EXTENSION)); 
			// if($extension != "jpg" && $extension != "jpeg" && $extension !="png" && $extension !="gif") {
				// echo '<script type="text/javascript">';
				// echo 'alert("Only jpg, jpeg, png and gif files are allowed");';
				// echo 'window.location.href = "home_page.php";';
				// echo '</script>';
				// exit();
			// }
			// $time = time()+1;
			// $fileName1 =$time.'.'.$extension;
			// $fpath=".." . DIRECTORY_SEPARATOR . $home_pageImg . DIRECTORY_SEPARATOR . $fileName1;
			// if(!file_exists(".." . DIRECTORY_SEPARATOR . $home_pageImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $home_pageImg)) {
				// mkdir(".." . DIRECTORY_SEPARATOR . $home_pageImg);
			// }
			// if(move_uploaded_file($_FILES["image1"]["tmp_name"], $fpath)) {
				// $id =1;
				// $img_stmt = $con->prepare('UPDATE `home_page` SET `image1` = ? WHERE `id` = ? ');
				// $img_stmt->bind_param('ss', $fileName1,$id);
				// $img_stmt->execute();
				// $img_stmt->store_result();
			// }
		// }  
		$_SESSION['msg'] = "data_updated";
	}
	else{
		$_SESSION['msg'] = "";
	}
}
$SQL = "select * from home_page where id='1'";
$EXE = mysqli_query($con,$SQL);
$data = mysqli_fetch_assoc($EXE);
include "sidebar.php";
?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css"/>
<link href="dist/css/jquery.multiselect.css" rel="stylesheet" type="text/css" media="screen" />
<link href="dist/css/jquery.fastconfirm.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript">
$(document).ready(function() {
	$("#main_form").validate({
		rules: {
			slug: {
				required: true,
			},

		},
		messages: {
			slug: {
				required: "This field cannot be blank.",
			},
		}
	});
});
</script>
<script>
        window.onload = function () {
            var imgUpload = document.getElementById("imgUpload");
            
           imgUpload.onchange = function () {
                if (typeof (FileReader) != "undefined") {
                    var dvPreview = document.getElementById("dvPreview");
                    dvPreview.innerHTML = "";
                    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                    for (var i = 0; i < imgUpload.files.length; i++) {
                        var file = imgUpload.files[i];
                        var size=imgUpload.files[i].size;
                        // if(size > 1024000)
                        // {
									// alert("Exceed the Maximum Image Size");
									// $(imgUpload).val("");
									// dvPreview.innerHTML = "";
									// return false;
								// }
								
                        if (regex.test(file.name.toLowerCase())) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var img = document.createElement("IMG");
                                img.height = "100";
                                img.width = "100";
                                img.src = e.target.result;
                                dvPreview.appendChild(img);
                            }
                            reader.readAsDataURL(file);
                        } else {
                            alert(file.name + " is not a valid image file.");
                            dvPreview.innerHTML = "";
                            return false;
                        }
                    }
                } else {
                    alert("This browser does not support HTML5 FileReader.");
                }
            }
}     
</script>
<aside class="right-side">
	<section class="content-header">
		<h1>Home Page <!--<small>Preview</small>--></h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- left column -->
		<div class="">
			<!-- general form elements -->
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Update page</h3><div class="pull-right" style="font-size:15px;"><span class="mandatory">*</span> indicates required field &nbsp;</div> 
				</div><!-- /.box-header -->
				<!-- form start -->
				<div class="box-body">
				
					<?php if(isset($_SESSION['msg']) && $_SESSION['msg']=='data_updated') { ?>
	                  	<div class="row">
			                <div class="col-sm-6">
				                <div class="alert alert-success alert-dismissible">
			                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                    Data Updated successfully!!.
			                   </div>
		                  	</div>
	                  	</div>
	                  	<?php 
	                  	$_SESSION['msg'] = '';
	                  	} 
	                ?>
					<form role="form" class="form-horizontal" name="main_form" id="main_form"  method="post" action="" autocomplete="off" enctype="multipart/form-data">								<div class="row"> <div class="col-md-12">	
						<div class="form-group">   		                     
							<label class="col-sm-2 control-label">Title</label>	                      
							<div class="col-sm-10">	                    		
								<input type="text" name="title" id="title" class="form-control" value="<?php echo isset($data['title'])?$data['title']:"";?>"/>
							</div>
						</div>
					</div>
					
						 <div class="col-md-6">
                         <div class="form-group"> 
                                	<label class="control-label col-lg-4" for="productName">Image</label>
                                <div class="col-lg-8">

                                    <div class="fileinput fileinput-new fileinputCat" data-provides="fileinput">
                                     <!--  <div><span>Maximum Image Upload Size is <code>1MB</code></span></div>
                                      
									   -->
									    <div><span>Image Width : <code>400px</code> Height : <code> 360px</code></span></div>
                                        <div id="dvPreview" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                           <?php if (isset($data['image']) && $data['image'] != '') { ?>
                                                <img src="../<?php echo $home_pageImg."/".$data['image']; ?>"/>
                                            <?php } else { ?>
                                                <img src="http://www.placehold.it/200x150/3c8dbc/fff&text=Image"/>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div>
                                            <span class="btn btn-default btn-file"><span class="fileinput-new">Browse Image</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" id="imgUpload" name="image" onclick="getImage();" accept=".jpg, .jpeg, .png, .gif" /></span>
                                            <?php if (isset($data['image']) && $data['image'] != '')  { ?>
                                                <a href="javascript:void(0);" class="btn btn-default" data-dismiss="fileupload" id="oldImage" onclick="clearImage()">Clear</a>
                                            <?php } ?>
                                            
                                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                        <?php if (isset($data['image']) && $data['image'] != '') { ?>
                                            <input type="hidden" name="existImage" id="existImage" value="<?php echo $data['image']; ?>"/>
                                            <input type="hidden" name="removedImage" id="removedImage" value="<?php echo $data['image']; ?>"/>
                                        <?php } ?>
                                        
                                     </div>
                                 </div>
                        </div>
                      </div>
					</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="name" class="col-lg-2 control-label">Description</label>
									<div class="col-lg-9">
										<p> <strong>Please note </strong>: Do not copy and paste content from Microsoft Word or Google Docs, the formatting might come out badly. Paste content in a notepad and then paste here and then do formatting in the editor below</p>	
										<textarea class="form-control" id="desc" name="desc" rows="3" title="Please enter description"><?php if(isset($data['description'])){if($data['description'] !=''){echo $data['description'];}} ?></textarea>
									</div>
								</div>
							</div>
						</div>	
						
						<div class="box-footer">
							<input type="submit" name="submit" class="btn btn-info" value="submit">
							<input type="reset" name="reset" class="btn bg-primary" value="Reset">
						</div>
					</form>		<!-- /.box -->
				</div><!--/.col (left) -->
			</div>
		</div>
	</section><!-- /.content -->
</aside>	
<script type="text/javascript" src="dist/js/jquery.multiselect.js"></script>
<script type="text/javascript" src="dist/js/jquery.multiselect.filter.js"></script>
<script type="text/javascript" src="dist/js/jquery.fastconfirm.js"></script>
<script type="text/javascript" src="dist/js/slug.js"></script>
<script type="text/javascript" src="dist/js/jquery.blockUI.js"></script>
<script src="//cdn.ckeditor.com/4.5.9/full/ckeditor.js"></script>
<script type="text/javascript" >
$(function () {
// Replace the <textarea id="editor1"> with a CKEditor
// instance, using default configuration.
CKEDITOR.replace('desc');
//bootstrap WYSIHTML5 - text editor
$(".textarea").wysihtml5();
});

</script>
<script>
function clearImage() {
	$('.fileinputCat').fileinput('clear');
	$("#oldImage").addClass("hide");
	$('#existImage').val('');
}

function getImage() {
	$('.fileinputCat').fileinput('clear');
	$("#oldImage").addClass("hide");
	$('#existImage').val('');
} 

</script>
<?php
include "footer.php";
?>