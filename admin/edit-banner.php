<?php
include "header.php";
include "sidebar.php";
$id = check_input($con,base64_decode($_REQUEST['id']));
$id1 = check_input($con,$_REQUEST['id']);
$query = mysqli_query($con, "SELECT * FROM `banner` WHERE `id`='".$id."' ");
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
	$("#bannerform").validate({
		rules: {
			text1: {
				required: true,
			},
			text2: {
				required: true,
			},
			text3: {
				required: true,
			}
		},
		
		messages: {
			text1: {
				required: "This field is required.",
			},
			text2: {
				required: "This field is required.",
			},
			text3: {
				required: "This field is required.",
			}	
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<aside class="right-side">
	<section class="content-header">
		<h1>Banner<!--<small>Preview</small>--></h1>
	</section>
<!-- Main content -->
	<section class="content">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit Banner</h3><div class="pull-right" style="font-size:15px;"><span class="mandatory">*</span> indicates required field &nbsp;</div> 
            </div><!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                <form role="form" class="form-horizontal" name="bannerform" id="bannerform"  method="post" action="banner-process.php" autocomplete="off" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="text1" class="col-lg-4 control-label">
									Text #1
									<span class="mandatory">*</span>
								</label>
								<div class="col-lg-8">
									<input type="text" class="form-control isRequired" id="text1" name="text1" placeholder="Enter Text #1" value="<?php echo isset($data['text1'])?$data['text1']:"";?>"/>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="text2" class="col-lg-4 control-label">
									Text #2
									<span class="mandatory">*</span>
								</label>
								<div class="col-lg-8">
									<input type="text" class="form-control isRequired" id="text2" name="text2" placeholder="Enter Text #2" value="<?php echo isset($data['text2'])?$data['text2']:"";?>"/>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="text3" class="col-lg-4 control-label">
									Text #3
									<span class="mandatory">*</span>
								</label>
								<div class="col-lg-8">
									<textarea class="form-control isRequired" id="text3" name="text3" placeholder="Enter Text #3" rows="3"/><?php echo isset($data['text3'])?$data['text3']:"";?></textarea>
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
                                       <div><span>Image Width : <code>1520px</code> Height : <code> 450px</code></span></div>
                                        <div id="dvPreview" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">		
                                           <?php if (isset($data['image']) && $data['image'] != '') { ?>
                                                <img src="../<?php echo $bannerImg."/".$data['image']; ?>"/>
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