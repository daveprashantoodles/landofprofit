<?php
include "header.php";
include "sidebar.php";
?>
 
 <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css"/>
 <link href="dist/css/jquery.multiselect.css" rel="stylesheet" type="text/css" media="screen" />
 <link href="dist/css/jquery.fastconfirm.css" rel="stylesheet" type="text/css" media="screen" />
      
       
<script>
$(document).ready(function() {
	$("#projectform").validate({
		rules: {
		latestlaunchTitle: {
				required: true,
			},
		titleSlug: {
				required: true,
				// remote: "checkDuplicatelatestlaunchTitle.php",
			},
		},
		
		messages: {
			latestlaunchTitle: {
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
    <h1>latest launch<!--<small>Preview</small>--></h1>
</section>
<!-- Main content -->
<section class="content">

    <!-- left column -->
    <div class="">
	
    <form role="form" class="form-horizontal" name="latestlaunchform" id="latestlaunchform"  method="post" action="latest-launch-process.php" autocomplete="off" enctype="multipart/form-data">
                
        <!-- general form elements -->
		<div class="box box-primary">
			<div class="box-header">
                <h3 class="box-title">Primary section</h3><div class="pull-right" style="font-size:15px;"><span class="mandatory">*</span> indicates required field &nbsp;</div> 
            </div>
			<div class="box-body">
				<div class="row">				  
					<div class="col-md-6">
						<div class="form-group">
							<label for="name" class="col-lg-4 control-label">latest launch Title<span class="mandatory">*</span></label>
							<div class="col-lg-8">
								<input type="text" class="form-control isRequired" id="latestlaunchTitle" name="latestlaunchTitle" placeholder="Enter latest launch Title" title="Please enter latest launch Title" />
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="categorySlug" class="col-sm-3 control-label">latest launch Slug <span class="mandatory">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control isRequired" id="titleSlug" name="titleSlug" placeholder="latest launch slug" title="Please enter latest launch Slug" />
							</div>
						</div>
					</div>
                </div>
			</div>
		</div>
		<div class="box box-primary">
			<div class="box-header">
                <h3 class="box-title">Section 1</h3>	
            </div>
			<div class="box-body">
			<div class="row">				  
				<div class="col-md-6">
					<div class="form-group">
						<label for="section1Heading" class="col-lg-4 control-label">Heading<span class="mandatory">*</span></label>
						<div class="col-lg-8">
							<input type="text" class="form-control isRequired" id="section1Heading" name="section1Heading" placeholder="Enter latest launch Title" title="Please enter latest launch Title" />
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="section1brochure" class="col-sm-3 control-label">Brochure<span class="mandatory">*</span></label>
						<div class="col-sm-9">
							<input type="file" class="form-control isRequired" id="section1brochure" name="section1brochure" placeholder="latest launch slug" title="Please enter latest launch Slug" accept= ".pdf" />
						</div>
					</div>
				</div>
				
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
				<div class="col-md-12 pb-15px">
					<div class="form-group">
						<label for="section1Content" class="col-sm-2 control-label">Content<span class="mandatory">*</span></label>
						<div class="col-sm-8">
							<textarea class="form-control isRequired" id="section1Content" name="section1Content" placeholder="latest launch slug" title="Please enter latest launch Slug" rows="5" /></textarea>
						</div>
					</div>
				</div>
				<br>
			</div>			
			</div>			
		</div>
		<div class="box box-primary">
			<div class="box-header">
                <h3 class="box-title">Section 2</h3>	
            </div>
			<div class="box-body">
			<div class="row">				  
				<div class="col-md-6">
					<div class="form-group">
						<label for="Section2Heading" class="col-lg-4 control-label">Heading<span class="mandatory">*</span></label>
						<div class="col-lg-8">
							<input type="text" class="form-control isRequired" id="Section2Heading" name="Section2Heading" placeholder="Enter latest launch Title" title="Please enter latest launch Title" />
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group"> 
						<label class="control-label col-lg-4" for="productName">Upload Image</label>
						<div class="col-lg-8">
							<div class="fileinput fileinput-new fileinputCat1" data-provides="fileinput">
								<div><span>Maximum Image Upload Size is <code>1MB</code></span></div>
								<div><span>Image Width : <code>748px</code> Height : <code> 380px</code></span></div>
								<div id="dvPreview" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
									<img src="http://www.placehold.it/200x150/3c8dbc/fff&text=Image"/>
								</div>
								<div>
									<span class="btn btn-default btn-file"><span class="fileinput-new">Browse Image</span>
									<span class="fileinput-exists">Change</span>
									<input type="file" id="imgUpload" name="image1" onclick="getImage1();" accept=".jpg, .jpeg, .png, .gif" /></span>
									<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 pb-15px">
					<div class="form-group">
						<label for="section2Content" class="col-sm-2 control-label">Content<span class="mandatory">*</span></label>
						<div class="col-sm-8">
							<textarea class="form-control isRequired" id="section2Content" name="section2Content" placeholder="latest launch slug" title="Please enter latest launch Slug" rows="5" />
							</textarea>
						</div>
					</div>
				</div>
			</div>
			</div>
			
		</div>
		<div class="box box-primary">
			<div class="box-header">
                <h3 class="box-title">Section 3</h3>	
            </div>
			<div class="box-body">
			<div class="row">				  
				<div class="col-md-6">
					<div class="form-group">
						<label for="Section3Heading" class="col-lg-4 control-label">Heading<span class="mandatory">*</span></label>
						<div class="col-lg-8">
							<input type="text" class="form-control isRequired" id="Section3Heading" name="Section3Heading" placeholder="Enter latest launch Title" title="Please enter latest launch Title" />
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group"> 
						<label class="control-label col-lg-4" for="productName">Upload Image</label>
						<div class="col-lg-8">
							<div class="fileinput fileinput-new fileinputCat2" data-provides="fileinput">
								<div><span>Maximum Image Upload Size is <code>1MB</code></span></div>
								<div><span>Image Width : <code>748px</code> Height : <code> 380px</code></span></div>
								<div id="dvPreview" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
									<img src="http://www.placehold.it/200x150/3c8dbc/fff&text=Image"/>
								</div>
								<div>
									<span class="btn btn-default btn-file"><span class="fileinput-new">Browse Image</span>
									<span class="fileinput-exists">Change</span>
									<input type="file" id="imgUpload" name="image2" onclick="getImage2();" accept=".jpg, .jpeg, .png, .gif" /></span>
									<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 pb-15px">
					<div class="form-group">
						<label for="section3Content" class="col-sm-2 control-label">Content<span class="mandatory">*</span></label>
						<div class="col-sm-8">
							<textarea class="form-control isRequired" id="section3Content" name="section3Content" placeholder="latest launch slug" title="Please enter latest launch Slug" rows="5" /></textarea>
						</div>
					</div>
				</div>
			</div>			
			</div>			
		</div>
		<div class="box box-primary">
			<div class="box-header">
                <h3 class="box-title">Section 4</h3>	
            </div>
			<div class="box-body">
			<div class="row">				  
				<div class="col-md-6">
					<div class="form-group">
						<label for="Section4Heading" class="col-lg-4 control-label">Heading<span class="mandatory">*</span></label>
						<div class="col-lg-8">
							<input type="text" class="form-control isRequired" id="Section4Heading" name="Section4Heading" placeholder="Enter latest launch Title" title="Please enter latest launch Title" />
						</div>
					</div>
				</div>
				<div class="col-md-12 mt-15px mb-15px">
					<div class="form-group">
						<label for="section4Content" class="col-sm-2 control-label">Content<span class="mandatory">*</span></label>
						<div class="col-sm-8">
							<textarea class="form-control isRequired" id="section4Content" name="section4Content" placeholder="latest launch slug" title="Please enter latest launch Slug" rows="5" /></textarea>
						</div>
					</div>
				</div>
				<br>
				<hr>
				<div class="col-md-12">
					<div class="row">
						<h4 class="col-md-2">Sub List</h4>
						<div class="table-responsive col-md-10">						
							<table class="table table-hover" cellpadding="0" cellspacing="0">
								<thead>
									<tr>
										<th>Title</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="DefaultTable">
								
									<tr>
										<td>
											<input type="text" name="section4subtitle[]" placeholder="Enter Title" title="please enter title" class="form-control" />
										</td>
										<td>
											<a class="btn btn-xs btn-primary" href="javascript:void(0);" onclick="insRow();">
												<i class="fa fa-plus"></i>
											</a>&nbsp;
											<a class="btn btn-xs btn-danger" href="javascript:void(0);" onclick="removeRow(this.parentNode.parentNode);">
												<i class="fa fa-minus"></i>
											</a>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>					
				</div>
				
			</div>			
			</div>			
		</div>
		<div class="box box-primary">
			<div class="box-header">
                <h3 class="box-title">Gallery Section 1</h3>	
            </div>
			<div class="box-body">
			<div class="row">				  
				<div class="col-md-6">
					<div class="form-group">
						<label for="galley1SectionHeding" class="col-lg-4 control-label">Heading<span class="mandatory">*</span></label>
						<div class="col-lg-8">
							<input type="text" class="form-control isRequired" id="galley1SectionHeding" name="galley1SectionHeding" placeholder="Enter latest launch Title" title="Please enter latest launch Title" />
						</div>
					</div>
				</div>
				<div class="col-md-12 mt-15px mb-15px">
					<div class="form-group">
						<label for="galley1SectionContent" class="col-sm-2 control-label">Content<span class="mandatory">*</span></label>
						<div class="col-sm-8">
							<textarea class="form-control isRequired" id="galley1SectionContent" name="galley1SectionContent" placeholder="latest launch slug" title="Please enter latest launch Slug" rows="5" /></textarea>
						</div>
					</div>
				</div>
				
				<div class="col-md-12">
					<div class="form-group">
						<label for="gallery1Imgs" class="col-sm-2 control-label">Imgs<span class="mandatory">*</span></label>
						<div class="col-lg-8">
							<input type="file" class="form-control isRequired" id="gallery1Imgs" name="gallery1Imgs[]" placeholder="Enter latest launch Title" title="Please enter latest launch Title" multiple />
						</div>
					</div>
				</div>
				
			</div>			
			</div>			
		</div>
		<div class="box box-primary">
		
			<div class="box-header">
                <h3 class="box-title">Gallery Section 2</h3>	
            </div>
			<div class="box-body">
			<div class="row">				  
				<div class="col-md-6">
					<div class="form-group">
						<label for="galley2SectionHeding" class="col-lg-4 control-label">Heading<span class="mandatory">*</span></label>
						<div class="col-lg-8">
							<input type="text" class="form-control isRequired" id="galley2SectionHeding" name="galley2SectionHeding" placeholder="Enter latest launch Title" title="Please enter latest launch Title" />
						</div>
					</div>
				</div>
				<div class="col-md-12 mt-15px mb-15px">
					<div class="form-group">
						<label for="galley2SectionContent" class="col-sm-2 control-label">Content<span class="mandatory">*</span></label>
						<div class="col-sm-8">
							<textarea class="form-control isRequired" id="galley2SectionContent" name="galley2SectionContent" placeholder="latest launch slug" title="Please enter latest launch Slug" rows="5" /></textarea>
						</div>
					</div>
				</div>
				
				<div class="col-md-12">
					<div class="form-group">
						<label for="gallery2Imgs" class="col-sm-2 control-label">Imgs<span class="mandatory">*</span></label>
						<div class="col-lg-8">
							<input type="file" class="form-control isRequired" id="gallery2Imgs" name="gallery2Imgs[]" placeholder="Enter latest launch Title" title="Please enter latest launch Title" multiple />
						</div>
					</div>
				</div>
			</div>			
			</div>			
		</div>
		<div class="box box-primary">
			<div class="box-header">
                <h3 class="box-title">Section 5</h3>	
            </div>
			<div class="box-body">
			<div class="row">				  
				<div class="col-md-6">
					<div class="form-group">
						<label for="Section5Heading" class="col-lg-4 control-label">Heading<span class="mandatory">*</span></label>
						<div class="col-lg-8">
							<input type="text" class="form-control isRequired" id="Section5Heading" name="Section5Heading" placeholder="Enter latest launch Title" title="Please enter latest launch Title" />
						</div>
					</div>
				</div>
				<div class="col-md-12 mt-15px mb-15px">
					<div class="form-group">
						<label for="section5Content" class="col-sm-2 control-label">Content<span class="mandatory">*</span></label>
						<div class="col-sm-8">
							<textarea class="form-control isRequired" id="section5Content" name="section5Content" placeholder="latest launch slug" title="Please enter latest launch Slug" rows="5" /></textarea>
						</div>
					</div>
				</div>
				<br>				
				<hr>
				<div class="col-md-12">
					<div class="row">
						<h4 class="col-md-2">Sub List</h4>
						<div class="table-responsive col-md-10">
							<table class="table table-hover" cellpadding="0" cellspacing="0">
								<thead>
									<tr>
										<th>Title</th>
										<th>Icon</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="DefaultTable1">
									<tr>
										<td>
											<input type="text" name="title[]" placeholder="Enter Title" title="please enter title" class="form-control"  />
										</td>
										<td>
											<input type="file" name="icon[]" class="form-control" accept=".pdf,.doc"/>
										</td>
										<td>
											<a class="btn btn-xs btn-primary" href="javascript:void(0);" onclick="insRow1();">
												<i class="fa fa-plus"></i>
											</a>&nbsp;
											<a class="btn btn-xs btn-danger" href="javascript:void(0);" onclick="removeRow1(this.parentNode.parentNode);">
												<i class="fa fa-minus"></i>
											</a>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>					
				</div>
				
			</div>			
			</div>			
		</div>
		<div class="box box-primary">
			<div class="box-header">
                <h3 class="box-title">Section 6</h3>	
            </div>
			<div class="box-body">
				<div class="row">				  
					<div class="col-md-12">
						<div class="form-group">
							<label for="section6maps" class="col-lg-2 control-label">Maps<span class="mandatory">*</span></label>
							<div class="col-lg-8">
								<textarea  class="form-control isRequired" id="section6maps" name="section6maps" rows="4" /></textarea>
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
			</div>
        </div>                   
		<div class="box-footer">
			<input type="submit" name="submit" class="btn btn-info" value="Submit">
			<input type="reset" name="reset" class="btn bg-primary" value="Reset">
		</div>
	</form>
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
        $("#latestlaunchTitle").stringToSlug({
            getPut: "#titleSlug"
        });
    })


function getImage() {
    $('.fileinputCat').fileinput('clear');
    $("#oldImage").addClass("hide");
    $('#existImage').val('');
}
function getImage1() {
    $('.fileinputCat1').fileinput('clear');
    $("#oldImage").addClass("hide");
    $('#existImage').val('');
}
function getImage2() {
    $('.fileinputCat2').fileinput('clear');
    $("#oldImage").addClass("hide");
    $('#existImage').val('');
}

// function getImage() {	$('.fileinputPan').fileinput('clear');	$("#oldImage").addClass("hide");	$('#existImage').val('');}   

 function insRow() 
	{
        var ExistingRow = document.getElementById("DefaultTable").rows.length;
        var Row = document.getElementById("DefaultTable").insertRow(ExistingRow);
        Row.setAttribute("style", "display:none;");
        Row.setAttribute("class", "data");
        var a = Row.insertCell(0);
        var b = Row.insertCell(1);  
        ExistingRow = document.getElementById("DefaultTable").rows.length - 1;
        a.innerHTML = '<input type="text" name="section4subtitle[]" class="input-medium form-control" placeholder="Enter Title" title="please enter title"  />';
        b.innerHTML = '<a class="btn-xs btn-primary btn" href="javascript:void(0);" onclick="insRow();"><i class="fa fa-plus icon-white"></i></a> <a class="btn-xs btn-danger btn" href="javascript:void(0);" onclick="removeRow(this.parentNode.parentNode);"><i class="fa fa-minus icon-white"></i></a>';
        $(Row).fadeIn(800);
    }

    function removeRow(el) {
        $(el).fadeOut("slow", function () {
            el.parentNode.removeChild(el);
            rl = document.getElementById("DefaultTable1").rows.length;
            if (rl == 0) {
                insRow()
            }
        });
    }
	
	function insRow1() 
	{
        var ExistingRow = document.getElementById("DefaultTable1").rows.length;
        var Row = document.getElementById("DefaultTable1").insertRow(ExistingRow);
        Row.setAttribute("style", "display:none;");
        Row.setAttribute("class", "data");
        var a = Row.insertCell(0);
        var b = Row.insertCell(1);  
        var c = Row.insertCell(2);  
        ExistingRow = document.getElementById("DefaultTable1").rows.length - 1;
        a.innerHTML = '<input type="text" name="curriculum[title][]" class="input-medium form-control" placeholder="Enter Title" title="please enter title"  />';
		b.innerHTML = '<input type="file" name="curriculum[]" class="form-control" accept=".pdf,.doc"/>';
        c.innerHTML = '<a class="btn-xs btn-primary btn" href="javascript:void(0);" onclick="insRow();"><i class="fa fa-plus icon-white"></i></a> <a class="btn-xs btn-danger btn" href="javascript:void(0);" onclick="removeRow1(this.parentNode.parentNode);"><i class="fa fa-minus icon-white"></i></a>';
        $(Row).fadeIn(800);
    }

    function removeRow1(el) {
        $(el).fadeOut("slow", function () {
            el.parentNode.removeChild(el);
            rl = document.getElementById("DefaultTable1").rows.length;
            if (rl == 0) {
                insRow()
            }
        });
    }
</script>

<?php
include "footer.php";
?>