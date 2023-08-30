<?php
include "header.php";
include "sidebar.php";
$id = check_input($con,base64_decode($_REQUEST['id']));
$id1 = check_input($con,$_REQUEST['id']);
$query = mysqli_query($con, "SELECT * FROM `location` WHERE `id`='".$id."' ");
$data =mysqli_fetch_array($query);
if(!$data) {  
	die("".mysqli_error()); 
}
?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css"/>
<link href="dist/css/jquery.multiselect.css" rel="stylesheet" type="text/css" media="screen" />
<link href="dist/css/jquery.fastconfirm.css" rel="stylesheet" type="text/css" media="screen" />   
<script>
$(document).ready(function() {
	$("#loanform").validate({
		rules: {
			title: {
				required: true,
			},
			loan_title: {
				required: true,
			},
			titleSlug: {
				required: true,
				// remote: "checkDuplicateServiceTitle.php",
			},
		},
		
		messages: {
			title: {
				required: "This field cannot be blank.",
			},
			service_title: {
				required: "This field cannot be blank.",
			},
			titleSlug: {
				required: "This field cannot be blank.",
				remote: "Title already exist.",
			},
		}
	});
});

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
				if(size > 1024000)
				{
					alert("Exceed the Maximum Image Size");
					$(imgUpload).val("");
					dvPreview.innerHTML = "";
					return false;
				}
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
				} 
				else{
					alert(file.name + " is not a valid image file.");
					dvPreview.innerHTML = "";
					return false;
				}
			}
		} 
		else {
			alert("This browser does not support HTML5 FileReader.");
		}
	}
}     
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<aside class="right-side">
	<section class="content-header">
		<h1>Location<!--<small>Preview</small>--></h1>
	</section>
<!-- Main content -->
	<section class="content">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit Location</h3><div class="pull-right" style="font-size:15px;"><span class="mandatory">*</span> indicates required field &nbsp;</div> 
            </div><!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                <form role="form" class="form-horizontal" name="loanform" id="loanform"  method="post" action="location-process.php" autocomplete="off" enctype="multipart/form-data">
                 
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="location_title" class="col-lg-4 control-label">
									Location Title<span class="mandatory">*</span>
								</label>
								<div class="col-lg-8">
									<input type="text" class="form-control isRequired" id="location_title" name="location_title" placeholder="Enter Location Title" title="Please enter Location Title" value="<?php echo isset($data['location_title'])?$data['location_title']:"";?>" />
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="titleSlug" class="col-sm-3 control-label">
									Location Slug <span class="mandatory">*</span>
								</label>
								<div class="col-sm-9">
									<input type="text" class="form-control isRequired" id="titleSlug" name="titleSlug" placeholder="Location slug" title="Please enter Location Slug" value="<?php echo isset($data['titleSlug'])?$data['titleSlug']:"";?>"/>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="title" class="col-lg-2 control-label">
									Title<span class="mandatory">*</span>
								</label>
								<div class="col-lg-10">
									<input type="text" class="form-control isRequired" id="title" name="title" placeholder="Enter Title" title="Please enter Title" value="<?php echo isset($data['title'])?$data['title']:"";?>" />
								</div>
							</div>
						</div>
					</div>
					  
					<div class="row">
						<div class="col-md-6">
							<div class="form-group"> 
								<label class="control-label col-lg-4" for="productName">Upload Image</label>
								<div class="col-lg-8">
									<div class="fileinput fileinput-new fileinputCat" data-provides="fileinput">
										<!--<div><span>Maximum Image Upload Size is <code>1MB</code></span></div>-->
										<div><span>Image Width : <code>740px</code> Height : <code> 370px</code></span></div>
										<div id="dvPreview" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">		
											<?php 
												if (isset($data['image']) && $data['image'] != '') {
											?>
												<img src="../<?php echo $locationImg."/".$data['image']; ?>"/>
											<?php 
												}
												else{
											?>
												<img src="http://www.placehold.it/200x150/3c8dbc/fff&text=Image"/>
											<?php
												}
											?>
										</div>
										<div>
											<span class="btn btn-default btn-file"><span class="fileinput-new">Browse Image</span>
												<span class="fileinput-exists">Change</span>
												<input type="file" id="imgUpload" name="image" onclick="getImage();" accept=".jpg, .jpeg, .png, .gif" />
											</span>
											<?php 
												if (isset($data['image']) && $data['image'] != '')  
												{
											?>
												<a href="javascript:void(0);" class="btn btn-default" data-dismiss="fileupload" id="oldImage" onclick="clearImage()">Clear</a>
											<?php 
											}
											?>
											<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
										</div>
										<?php
										if (isset($data['image']) && $data['image'] != '')
										{ 
										?>
											<input type="hidden" name="existImage" id="existImage" value="<?php echo $data['image']; ?>"/>
											<input type="hidden" name="removedImage" id="removedImage" value="<?php echo $data['image']; ?>"/>
										<?php 
										} 
										?>
									</div>
								</div>
							</div>
						</div>
						  
						<div class="col-md-6">
							<p>&nbsp;</p>                
							<div class="form-group">
								<label for="categorySlug" class="col-sm-3 control-label">Image Alt</label>
								<div class="col-sm-9">
									<input type="text" class="form-control isRequired" id="imgAlt" name="imgAlt" value="<?php echo $data['image_alt']; ?>" />
								</div>
							</div>
							<div class="form-group">
								<label for="name" class="col-lg-3 control-label">Image Title</label>
								<div class="col-lg-9">
									<input type="text" class="form-control isRequired" id="imgTitle" name="imgTitle" value="<?php echo $data['image_title']; ?>" />
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
									<textarea class="form-control" id="mainDescription" name="mainDescription" rows="3" title="Please enter description"><?php echo $data['mainDescription']; ?></textarea>
								</div>
							</div>
						</div>
					</div>
					<br />
					<ul class="todo-list ui-sortable">
						<li style="font-size:20px;"><strong>SEO Description</strong></li>
					</ul>
					<br />

					<div class="form-group">   	
						<label class="col-sm-2 control-label">Title Tag</label>
						<div class="col-sm-8">
							<textarea name="titleTag" id="titleTag" class="form-control" rows="3"><?php echo $data['titleTag']; ?></textarea>
						</div>
					</div>

					<div class="form-group">   	
						<label class="col-sm-2 control-label">Meta Keywords</label>
						<div class="col-sm-8">
							<textarea name="metaKeyword" id="metaKeyword" class="form-control" rows="3"><?php echo $data['metaKeyword']; ?></textarea>
						</div>
					</div>

					<div class="form-group">   	
						<label class="col-sm-2 control-label">Meta Description</label>
						<div class="col-sm-8">
							<textarea name="metaDescription" id="metaDescription" class="form-control" rows="3"><?php echo $data['metaDescription']; ?></textarea>
						</div>
					</div> 

					<input type="hidden" name="id" id="id" value="<?php echo $id1; ?>" />

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
<script>
$(document).ready(function () {
	$("#location_title").stringToSlug({
		getPut: "#titleSlug"
	});
	CKEDITOR.replace('mainDescription');
	$(".textarea").wysihtml5();
});
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
<?php include "footer.php"; ?>