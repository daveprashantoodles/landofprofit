<?php
include "header.php";
include "sidebar.php";
$id = check_input($con,base64_decode($_REQUEST['id']));
$id1 = check_input($con,($_REQUEST['id']));

$query = mysqli_query($con, "SELECT * FROM `ifd_album` WHERE `album_id`='".$id."' ");
$data =mysqli_fetch_array($query);
if(!$data) {  die("".mysqli_error()); }

$ext = pathinfo($data['image'], PATHINFO_EXTENSION);
$imgName = basename($data['image'], ".".$ext);
?>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css"/>
<link href="dist/css/jquery.multiselect.css" rel="stylesheet" type="text/css" media="screen" />
<link href="dist/css/jquery.fastconfirm.css" rel="stylesheet" type="text/css" media="screen" />
   
<script type="text/javascript">
$(document).ready(function() {
	$("#albumform").validate({
		rules: {
		albumName: {
				required: true,
		},
		albumSlug: {
				required: true,
		},
		},
		messages: {
			albumName: {
				required: "This field cannot be blank.",
			},
			albumSlug: {
				required: "This field cannot be blank.",
			},
			
		}
	});
});
</script>

<script language="javascript" type="text/javascript">
        window.onload = function () {
            var fileUpload = document.getElementById("imgUpload");
            
           fileUpload.onchange = function () {
                if (typeof (FileReader) != "undefined") {
                    var dvPreview = document.getElementById("dvPreview");
                    dvPreview.innerHTML = "";
                    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                    for (var i = 0; i < fileUpload.files.length; i++) {
                        var file = fileUpload.files[i];
                        var size=fileUpload.files[i].size;
                        if(size > 1024000)
                        {
									alert("Exceed the Maximum Image Size");
									document.albumform.submit.disabled = true;
									return false;
		        				}
								else
								{
									document.albumform.submit.disabled = false;
									return true;
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
        };
</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<aside class="right-side">
	<section class="content-header">
		<h1>Edit Album<!--<small>Preview</small>--></h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-info">
	                <div class="box-header with-border">
						<h3 class="box-title">Album Details</h3>
	                </div><!-- /.box-header -->
	                
	                <div class="box-body">
	                  	
						<!-- form start -->
						<form class="form-horizontal" name="albumform" id="albumform" enctype="multipart/form-data"  method="post" action="album-process.php" autocomplete="off">
						  
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="name" class="col-lg-4 control-label">Album Name <span class="mandatory">*</span></label>
										<div class="col-lg-8">
											<input type="text" class="form-control isRequired" id="albumName" name="albumName" value="<?php echo $data['album_name']; ?>" placeholder="Enter Album Name" title="Please enter Album name" />
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
												<div><span>Maximum Image Upload Size is <code>1MB</code></span></div>
												<!--<div><span>Image Width : <code>125px</code> Height : <code> 270px</code></span></div>-->
												<div id="dvPreview" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
													<?php 
													$albumImg = 'school-photo-gallery';

													if (isset($data['image']) && $data['image'] != '') { ?>
													<img src="../<?php echo $albumImg."/".$data['image']; ?>"/>
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
							<br />
							<input type="hidden" name="id" id="id" value="<?php echo $id1; ?>"/>
							<div class="box-footer">
								<input type="submit" name="submit" class="btn btn-info" value="Save Changes">
								<input type="reset" name="reset" class="btn bg-primary" value="Reset">
							</div>
						</form>		
					</div><!-- /.box-body -->
	            </div>
			</div>
		</div>             
	</section>
</aside>

<script type="text/javascript" src="dist/js/slug.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
        $("#albumName").stringToSlug({
            getPut: "#albumSlug"
        });
    })
   $(document).ready(function () {
        $("#albumName").stringToSlug({
            getPut: "#imgName"
        });
   })    
</script>

<script type="text/javascript" >
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