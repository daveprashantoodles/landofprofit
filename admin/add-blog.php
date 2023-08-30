<?php
include "header.php";
include "sidebar.php";
?>
 
 <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css"/>
 <link href="dist/css/jquery.multiselect.css" rel="stylesheet" type="text/css" media="screen" />
 <link href="dist/css/jquery.fastconfirm.css" rel="stylesheet" type="text/css" media="screen" />
      
       
<script>
$(document).ready(function() {
	$("#blogform").validate({
		rules: {
		blogTitle: {
				required: true,
			},
		titleSlug: {
				required: true,
				// remote: "checkDuplicateblogTitle.php",
			},
		},
		
		messages: {
			blogTitle: {
				required: "This field cannot be blank.",
			},
			titleSlug: {
				required: "This field cannot be blank.",
				remote: "Title already exist.",
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

<aside class="right-side">
<section class="content-header">
    <h1>Blog<!--<small>Preview</small>--></h1>
</section>
<!-- Main content -->
<section class="content">

    <!-- left column -->
    <div class="">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Add Blog</h3><div class="pull-right" style="font-size:15px;"><span class="mandatory">*</span> indicates required field &nbsp;</div> 
            </div><!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                <form role="form" class="form-horizontal" name="blogform" id="blogform"  method="post" action="blog-process.php" autocomplete="off" enctype="multipart/form-data">
                <!-- 
				  <div class="row">
					<div class="col-md-6">
					 <div class="form-group">
					   <label for="name" class="col-lg-4 control-label">Blog Category<span class="mandatory">*</span></label>
					   <div class="col-lg-8">
						 <select class="select2" id="categoryId" name="categoryId" style="width:100%;" required >							
						  <option value="">--choose--</option>							
						  <?php 							
							// $sql = "select categoryTitle,id from category where publish = 1 ";
							// $query = mysqli_query($con,$sql);							
							// if(mysqli_num_rows($query)>0)							
							// {								
							  // while($row = mysqli_fetch_assoc($query))								
							  // {							
						  ?>								
								<option value="<?php //echo isset($row['id'])?$row['id']:"";?>">
								<?php //echo isset($row['categoryTitle'])?$row['categoryTitle']:"";?>
								</option>							
						  <?php								
							  // }							
							// }							
						 ?>						
						 </select>
					   </div>
					 </div>
					</div>                  
				  </div>
				-->				  

				  <div class="row">				  <div class="col-md-6">
                    <div class="form-group">
                     <label for="name" class="col-lg-4 control-label">Blog Title<span class="mandatory">*</span></label>
                     <div class="col-lg-8">
                      <input type="text" class="form-control isRequired" id="blogTitle" name="blogTitle" placeholder="Enter Blog Title" title="Please enter Blog Title" />
                     </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                       <label for="categorySlug" class="col-sm-3 control-label">Blog Slug <span class="mandatory">*</span></label>
                       <div class="col-sm-9">
                         <input type="text" class="form-control isRequired" id="titleSlug" name="titleSlug" placeholder="Blog slug" title="Please enter Blog Slug" />
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
                      
                      <div class="col-md-6">
                        <p>&nbsp;</p>
                  
                        <div class="form-group">
                           <label for="categorySlug" class="col-sm-3 control-label">Image Alt</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control isRequired" id="imgAlt" name="imgAlt" />
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="name" class="col-lg-3 control-label">Image Title</label>
                           <div class="col-lg-9">
                              <input type="text" class="form-control isRequired" id="imgTitle" name="imgTitle" />
                           </div>
                        </div>
                    </div>
                      
                </div>
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                     <label for="name" class="col-lg-4 control-label">Date</label>
                     <div class="col-lg-8">
                           <input type="text" id="blogDate" name="blogDate" class="form-control" value="<?php echo date("d-m-Y");?>" />
                     </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                     <label for="name" class="col-lg-4 control-label">Author</label>
                     <div class="col-lg-8">
                           <input type="text" id="blogAuthor" name="blogAuthor" class="form-control" />
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
                
                  <br />
                  <ul class="todo-list ui-sortable">
                     <li style="font-size:20px;"><strong>SEO Description</strong></li>
                  </ul>
                  <br />
                    
	                     
							<div class="form-group">   	
	                      <label class="col-sm-2 control-label">Title Tag</label>
	                      <div class="col-sm-8">
	                    		<textarea name="titleTag" id="titleTag" class="form-control" rows="3"></textarea>
	                    	 </div>
	                  </div>
	                  
	                  <div class="form-group">   	
	                      <label class="col-sm-2 control-label">Meta Keywords</label>
	                      <div class="col-sm-8">
	                    		<textarea name="metaKeyword" id="metaKeyword" class="form-control" rows="3"></textarea>
	                    	 </div>
	                  </div>
	                  
	                  <div class="form-group">   	
	                      <label class="col-sm-2 control-label">Meta Description</label>
	                      <div class="col-sm-8">
	                    		<textarea name="metaDescription" id="metaDescription" class="form-control" rows="3"></textarea>
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
	

<script>
var basr_url ="<?php echo $base_url;?>";
  $(document).ready(function () {
        $("#blogTitle").stringToSlug({
            getPut: "#titleSlug"
        });
    })
  $(function () {
    $(".select2").select2();
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
  });
  
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('mainDescription', {
			on: {
				instanceReady: function() {
					this.document.appendStyleSheet( basr_url+'/assets/css/style.css' );
				}
			}
		} );
		// config.contentsCss = '/css/mysitestyles.css';
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
        
      });
</script>

<script>
$("#blogDate").datepicker( {
	dateFormat:"dd-mm-yy",
});function getImage() {	$('.fileinputPan').fileinput('clear');	$("#oldImage").addClass("hide");	$('#existImage').val('');}   
</script>

<?php
include "footer.php";
?>