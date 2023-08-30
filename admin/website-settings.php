<?php
include "header.php";
include "sidebar.php";
if(isset($_POST['submit'])&&$_POST['submit']=="Save Changes"){

	$support_email = isset($_POST['support_email'])?mysqli_real_escape_string($con,$_POST['support_email']):"";
	$landline_no = isset($_POST['landline_no'])?mysqli_real_escape_string($con,$_POST['landline_no']):"";
	$whatsapp_no = isset($_POST['whatsapp_no'])?mysqli_real_escape_string($con,$_POST['whatsapp_no']):"";
	$linkedin = isset($_POST['linkedin'])?mysqli_real_escape_string($con,$_POST['linkedin']):"";
	$facebook = isset($_POST['facebook'])?mysqli_real_escape_string($con,$_POST['facebook']):"";
	$instagram = isset($_POST['instagram'])?mysqli_real_escape_string($con,$_POST['instagram']):"";
	$tweeter = isset($_POST['tweeter'])?mysqli_real_escape_string($con,$_POST['tweeter']):"";
	$officehours = isset($_POST['officehours'])?mysqli_real_escape_string($con,$_POST['officehours']):"";
	$office_address = isset($_POST['office_address'])?mysqli_real_escape_string($con,$_POST['office_address']):"";
	
	$SQL = "Update website_settings set `support_email`='".$support_email."',`landline_no`='".$landline_no."',`whatsapp_no`='".$whatsapp_no."',`linkedin`='".$linkedin."',`facebook`='".$facebook."',`instagram`='".$instagram."',`tweeter`='".$tweeter."',`officehours`='".$officehours."',`office_address`='".$office_address."' where `id`=1";
	
	$Update = mysqli_query($con,$SQL) or mysqli_error($con);
	if($Update){
		$NameFile=$_FILES['image']['name'];
		if(isset($NameFile) && !empty($NameFile)) {
			$extension = strtolower(pathinfo($NameFile, PATHINFO_EXTENSION)); 
			if($extension != "jpg" && $extension != "jpeg" && $extension !="png" && $extension !="gif") {
				echo '<script type="text/javascript">';
				echo 'alert("Only jpg, jpeg, png and gif files are allowed");';
				echo 'window.location.href = "website-settings.php";';
				echo '</script>';
				exit();
			}
			$fileName =time().'.'.$extension;
			$fpath=".." . DIRECTORY_SEPARATOR . $logoImg . DIRECTORY_SEPARATOR . $fileName;
			if(!file_exists(".." . DIRECTORY_SEPARATOR . $logoImg) && !is_dir(".." . DIRECTORY_SEPARATOR . $logoImg)) {
				mkdir(".." . DIRECTORY_SEPARATOR . $logoImg);
			}
			if(move_uploaded_file($_FILES["image"]["tmp_name"], $fpath)) {
				$id =1;
				$img_stmt = $con->prepare('UPDATE `website_settings` SET `image` = ? WHERE `id` = ? ');
				$img_stmt->bind_param('ss', $fileName,$id);
				$img_stmt->execute();
				$img_stmt->store_result();
			}
		}  
		$_SESSION['msg'] = "data_updated";
	}
	else{
		$_SESSION['msg'] = "";
	}
}
$data = array();
$SQL = "select * from website_settings where id='1'";
$EXE = mysqli_query($con,$SQL);
$data = mysqli_fetch_assoc($EXE);
?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css"/>
<link href="dist/css/jquery.multiselect.css" rel="stylesheet" type="text/css" media="screen" />
<link href="dist/css/jquery.fastconfirm.css" rel="stylesheet" type="text/css" media="screen" />   
<script>
$(document).ready(function() {
	$("#jobform").validate({
		rules: {
			support_email: {
				required: true,
			},
			landline_no: {
				required: true,
			},
			// whatsapp_no: {
				// required: true,
			// },
			linkedin: {
				required: true,
			},
			facebook: {
				required: true,
			},
			instagram: {
				required: true,
			},
			tweeter: {
				required: true,
			},
			officehours: {
				required: true,
			},
			
		},
		
		messages: {
			support_email: {
				required: "This field is required.",
			},
			landline_no: {
				required: "This field is required.",
			},
			// whatsapp_no: {
				// required: "This field is required.",
			// },
			linkedin: {
				required: "This field is required.",
			},
			facebook: {
				required: "This field is required.",
			},
			instagram: {
				required: "This field is required.",
			},
			tweeter: {
				required: "This field is required.",
			},
			officehours: {
				required: "This field is required.",
			},
			
		}
	});
});   
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<aside class="right-side">
	<section class="content-header">
		<h1>Website settings<!--<small>Preview</small>--></h1>
	</section>
<!-- Main content -->
	<section class="content">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Update</h3><div class="pull-right" style="font-size:15px;"><span class="mandatory">*</span> indicates required field &nbsp;</div> 
            </div><!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                <form role="form" class="form-horizontal" name="jobform" id="jobform"  method="post" autocomplete="off" enctype="multipart/form-data">
                 
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="support_email" class="col-lg-4 control-label">
									Support Email
									<span class="mandatory">*</span>
								</label>
								<div class="col-lg-8">
									<input type="email" class="form-control isRequired" id="support_email" name="support_email" placeholder="email@address.com" title="Please " value="<?php echo isset($data['support_email'])?$data['support_email']:"";?>" />
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="duration" class="col-lg-4 control-label">
									Landline No
									<span class="mandatory">*</span>
								</label>
								<div class="col-lg-8">
									<input type="text" class="form-control isRequired" id="landline_no" name="landline_no" placeholder="Enter Landline No" value="<?php echo isset($data['landline_no'])?$data['landline_no']:"";?>"/>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="whatsapp_no" class="col-lg-4 control-label">
									Whatsapp No
								</label>
								<div class="col-lg-8">
									<input type="text" class="form-control isRequired" id="whatsapp_no" name="whatsapp_no" placeholder="Enter Whatsapp No" value="<?php echo isset($data['whatsapp_no'])?$data['whatsapp_no']:"";?>"  data-toggle="tooltip" data-placement="bottom"  title="Use full phone number in international format. Omit any zeroes, brackets, or dashes when adding the phone number in international format."/>
									
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="linkedin" class="col-lg-4 control-label">
									LinkedIn Page Url
									<span class="mandatory">*</span>
								</label>
								<div class="col-lg-8">
									<input type="url" class="form-control isRequired" id="linkedin" name="linkedin" value="<?php echo isset($data['linkedin'])?$data['linkedin']:"";?>" />
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="facebook" class="col-lg-4 control-label">
									Facebook Page Url
									<span class="mandatory">*</span>
								</label>
								<div class="col-lg-8">
									<input type="url" class="form-control isRequired" id="facebook" name="facebook" value="<?php echo isset($data['facebook'])?$data['facebook']:"";?>" />
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="instagram" class="col-lg-4 control-label">
									Instagram Page Url
									<span class="mandatory">*</span>
								</label>
								<div class="col-lg-8">
									<input type="url" class="form-control isRequired" id="instagram" name="instagram"  value="<?php echo isset($data['instagram'])?$data['instagram']:"";?>" />
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="tweeter" class="col-lg-4 control-label">
									Twitter Page Url
									<span class="mandatory">*</span>
								</label>
								<div class="col-lg-8">
									<input type="url" class="form-control isRequired" id="tweeter" name="tweeter" value="<?php echo isset($data['tweeter'])?$data['tweeter']:"";?>" />
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="officehours" class="col-lg-4 control-label">
									Office Hours
									<span class="mandatory">*</span>
								</label>
								<div class="col-lg-8">
									<input type="text" class="form-control isRequired" id="officehours" name="officehours" value="<?php echo isset($data['officehours'])?$data['officehours']:"";?>" />
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="tweeter" class="col-lg-4 control-label">
									Office Address
									<span class="mandatory">*</span>
								</label>
								<div class="col-lg-8">
									<textarea class="form-control isRequired" id="office_address" name="office_address" rows="3" /><?php echo isset($data['office_address'])?$data['office_address']:"";?></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
					 <div class="col-md-6">
                         <div class="form-group"> 
                                	<label class="control-label col-lg-4" for="productName">Logo</label>
                                <div class="col-lg-8">

                                    <div class="fileinput fileinput-new fileinputCat" data-provides="fileinput">
                                     <!--  <div><span>Maximum Image Upload Size is <code>1MB</code></span></div>
                                       <div><span>Image Width : <code>748px</code> Height : <code> 380px</code></span></div>
									   -->
                                        <div id="dvPreview" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                           <?php if (isset($data['image']) && $data['image'] != '') { ?>
                                                <img src="../<?php echo $logoImg."/".$data['image']; ?>"/>
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
					<div class="box-footer">
						<input type="submit" name="submit" class="btn btn-info" value="Save Changes">
						<input type="reset" name="reset" class="btn bg-primary" value="Reset">
					</div>
                </form>
            </div><!-- /.box -->
        </div><!--/.col (left) -->
	</section><!-- /.content -->
</aside>
<script type="text/javascript" src="dist/js/jquery.multiselect.js"></script>
<script type="text/javascript" src="dist/js/jquery.multiselect.filter.js"></script>
<script type="text/javascript" src="dist/js/jquery.fastconfirm.js"></script>
<script type="text/javascript" src="dist/js/slug.js"></script>
<script src="//cdn.ckeditor.com/4.5.9/full/ckeditor.js"></script>	
<?php include "footer.php"; ?>