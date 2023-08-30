<?php
include "header.php";
include "sidebar.php";
$id = check_input($con,base64_decode($_REQUEST['id']));
$id1 = check_input($con,$_REQUEST['id']);
$query = mysqli_query($con, "SELECT * FROM `users` WHERE `id`='".$id."' ");
$data =mysqli_fetch_array($query);
if(!$data) {  die("".mysqli_error()); }
?>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css"/>
<link href="dist/css/jquery.multiselect.css" rel="stylesheet" type="text/css" media="screen" />
<link href="dist/css/jquery.fastconfirm.css" rel="stylesheet" type="text/css" media="screen" />
 
<script>
$(document).ready(function() {
	$("#form").validate({
		rules: {
			fname: {
				required: true,
			},
			lname: {
				required: true,
			},
			email: {
				required: true,
				email: true,
			},
			phone: {
				required: true,
			},
			password: {
				required: true,
			},
			confirm_password: {
				equalTo : "#password"
			},
		},
		
		messages: {
			fname: {
				required: "Required Field.",
			},
			lname: {
				required: "Required Field.",
			},
			email: {
				required: "Required Field.",
				email: "Invalid Email.",
			},
			phone: {
				required: "Required Field.",
			},
			password: {
				required: "Required Field.",
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
    <h1>User<!--<small>Preview</small>--></h1>
</section>
<!-- Main content -->
<section class="content">

    <!-- left column -->
    <div class="">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit User</h3><div class="pull-right" style="font-size:15px;"><span class="mandatory">*</span> indicates required field &nbsp;</div> 
            </div><!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                <form role="form" class="form-horizontal" name="form" id="form"  method="post" action="user-process.php" autocomplete="off" enctype="multipart/form-data">
					<div class="row">				  
					<div class="col-md-6">
						<div class="form-group">
							<label for="fname" class="col-lg-4 control-label">First Name<span class="mandatory">*</span></label>
							<div class="col-lg-8">
								<input type="text" class="form-control isRequired" id="fname" name="fname" placeholder="Enter First Name" title="Please enter First Name" value="<?php echo $data['fname'];?>" />
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="lname" class="col-sm-3 control-label">Last Name<span class="mandatory">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control isRequired" id="lname" name="lname" placeholder="Enter Last Name" title="Please Last Name" value="<?php echo $data['lname'];?>" />
							</div>
						</div>
					</div>
				</div>
				<div class="row">				  
					<div class="col-md-6">
						<div class="form-group">
							<label for="phone" class="col-lg-4 control-label">Phone No<span class="mandatory">*</span></label>
							<div class="col-lg-8">
								<input type="text" class="form-control isRequired" id="phone" name="phone" placeholder="Enter Phone No" title="Please enter Phone No" value="<?php echo $data['phone'];?>" />
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="email" class="col-sm-3 control-label">Email<span class="mandatory">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control isRequired" id="email" name="email" placeholder="Enter Email" title="Enter Email" value="<?php echo $data['email'];?>" />
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">				  
					<div class="col-md-6">
						<div class="form-group">
							<label for="phone" class="col-lg-4 control-label">Password<span class="mandatory">*</span></label>
							<div class="col-lg-8">
								<input type="password" class="form-control isRequired" id="password" name="password" placeholder="Enter Password" title="Enter Password" value="<?php echo $data['password'];?>" />
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="email" class="col-sm-3 control-label">Confirm Password<span class="mandatory">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control isRequired" id="confirm_password" name="confirm_password" placeholder="Enter Confirm Password" value="<?php echo $data['password'];?>" />
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
                                       <div><span>Image Width : <code>748px</code> Height : <code> 380px</code></span></div>
                                        <div id="dvPreview" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">											<?php $blogImg="public/uploads/users_img";?>
                                           <?php if (isset($data['image']) && $data['image'] != '') { ?>
                                                <img src="../<?php echo $blogImg."/".$data['image']; ?>"/>
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
	<script type="text/javascript" src="dist/js/jquery.blockUI.js"></script>
	<script src="//cdn.ckeditor.com/4.5.9/full/ckeditor.js"></script>
	
<script>
	var basr_url ="<?php echo $base_url;?>"; 
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