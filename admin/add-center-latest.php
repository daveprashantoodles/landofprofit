<?php
include "header.php";
include "sidebar.php";
?>
 
 <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css"/>
 <link href="dist/css/jquery.multiselect.css" rel="stylesheet" type="text/css" media="screen" />
 <link href="dist/css/jquery.fastconfirm.css" rel="stylesheet" type="text/css" media="screen" />      
       
<script type="text/javascript">
$(document).ready(function() {
	$("#newsform").validate({
		rules: {
		newsTitle: {
				required: true,
			},
		video_path: {
			required: true,
		},
		location: {
				required: true,
				// remote: "checkDuplicateCenterLatest.php",
			},
		},
		
		messages: {
			newsTitle: {
				required: "This field cannot be blank.",
			},
			video_path: {
				required: "This field cannot be blank.",
			},
			location: {
				required: "This field cannot be blank.",
				// remote: "Title Slug already exist.",
			},
		}
	});
});
</script>

<script language="javascript" type="text/javascript">
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
    <h1>Service<!--<small>Preview</small>--></h1>
</section>
<!-- Main content -->
<section class="content">

    <!-- left column -->
    <div class="">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Add Service</h3><div class="pull-right" style="font-size:15px;"><span class="mandatory">*</span> indicates required field &nbsp;</div> 
            </div><!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                <form role="form" class="form-horizontal" name="newsform" id="newsform"  method="post" action="center-latest-process.php" autocomplete="off" enctype="multipart/form-data">
           
                 <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                     <label for="name" class="col-lg-4 control-label">Title<span class="mandatory">*</span></label>
                     <div class="col-lg-8">
                      <input type="text" class="form-control isRequired" id="newsTitle" name="newsTitle" placeholder="Enter Title" title="Please enter Title" />
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
                                       <!--<div><span>Image Width : <code>728px</code> Height : <code> 378px</code></span></div>-->
                                        <div id="dvPreview" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                           <img src="http://www.placehold.it/200x150/3c8dbc/fff&text=Image"/>
                                        </div>
                                        <div>
                                            <span class="btn btn-default btn-file"><span class="fileinput-new">Browse Image</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" id="imgUpload" name="image" onclick="getImage();" accept=".jpg, .jpeg, .png, .gif" /></span>
                                            
                                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                        
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
                            <textarea class="form-control" id="mainDescription" name="mainDescription" rows="3" title="Please enter description"></textarea>
                     </div>
                    </div>
                  </div>
                 </div>
                    <div class="box-footer">
                        <input type="submit" name="submit" class="btn btn-info" value="Submit">
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
	


<script type="text/javascript" >
 
  
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('mainDescription');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
        
      });
</script>

<?php
include "footer.php";
?>