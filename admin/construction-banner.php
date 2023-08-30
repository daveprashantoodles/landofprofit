<?php
include "header.php";
include "sidebar.php";
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
			}
		},
		messages: {
			albumName: {
				required: "This is required Field.",
			}
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
		<h1>Add Banner<!--<small>Preview</small>--></h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-info">
	                <div class="box-header with-border">
	                  <h3 class="box-title">Add Banner</h3>
	                </div><!-- /.box-header -->
	                
	                <div class="box-body">
	                <?php if(isset($_SESSION['msg']) && $_SESSION['msg']=='data_uploaded') { ?>
	                  	<div class="row">
			                <div class="col-sm-6">
				                <div class="alert alert-success alert-dismissible">
			                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                    Banner Uploaded successfully!!.
			                   </div>
		                  	</div>
	                  	</div>
	                  	<?php 
	                  	$_SESSION['msg'] = '';
	                  	} 
	                  	?>	
	                  	
	                <!-- form start -->
	                <form class="form-horizontal" name="albumform" id="albumform" enctype="multipart/form-data"  method="post" action="contruction-banner-process.php" autocomplete="off">
	                  
	                  	<div class="row">
						  <div class="col-md-12">
							<div class="form-group">
							 <label for="name" class="col-lg-2 control-label"> Banner info <span class="mandatory">*</span></label>
							 <div class="col-lg-10">
							  <input type="text" class="form-control isRequired" id="albumName" name="albumName" placeholder="Enter info"/>
							 </div>
							</div>
						  </div>
                 
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group"> 
									<label class="control-label col-lg-4" for="productName">Upload Banner</label>
									<div class="col-lg-8">
										<div class="fileinput fileinput-new fileinputCat" data-provides="fileinput">
											<div><span>Maximum Image Upload Size is <code>1MB</code></span></div>
											<!-- <div><span>Image Width : <code>125px</code> Height : <code> 270px</code></span></div>-->
											<div id="dvPreview" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
												<img src="http://www.placehold.it/200x150/3c8dbc/fff&text=Image"/>
											</div>
											<div>
												<span class="btn btn-default btn-file"><span class="fileinput-new">Browse Image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" id="imgUpload" name="image" onclick="getImage();" accept=".jpg, .jpeg, .png, .gif" />
												</span>
												<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<br />	
	                  </div><!-- /.box-body -->
	                  <div class="box-footer">
                        <input type="submit" name="submit" class="btn btn-info" value="Submit">
                        <input type="reset" name="reset" class="btn bg-primary" value="Reset">
					  </div>
	                </form>
				</div>
			</div>
		</div>             
	</section>
	
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	     Banner List
	  </h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box">
					<div class="box-header">
					  <h3 class="box-title">Image Detail</h3>
					</div><!-- /.box-header -->
					
					<div class="box-body">
					
						<?php if(isset($_SESSION['msg']) && $_SESSION['msg']=='data_updated') { ?>
						<div class="row">
							<div class="col-sm-6">
								<div class="alert alert-success alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								Image Updated successfully!!.
							   </div>
							</div>
						</div>
						<?php 
						$_SESSION['msg'] = '';
						} 
						?>
							
						<?php if(isset($_SESSION['msg']) && $_SESSION['msg']=='status_changed') { ?>
							<div class="row">
								<div class="col-sm-6">
									<div class="alert alert-success alert-dismissible">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									Status changed successfully!!.
									</div>
								</div>
							</div>
							<?php 
							
							$_SESSION['msg'] = '';
						} ?>
					
						<?php if(isset($_SESSION['msg']) && $_SESSION['msg']=='delete_data') { ?>
							<div class="row">
								<div class="col-sm-6">
									<div class="alert alert-success alert-dismissible">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									Image Deleted !!.
									</div>
								</div>
							</div>
							<?php 
							
							$_SESSION['msg'] = '';
						} ?>
						<table id="employee-role-table" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th># Sr. No.</th>
									<th>Banner Info</th>
									<th>Banner</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$fetch_blog=mysqli_query($con,"SELECT * FROM `c_banner` ORDER BY `album_id` ASC")or die(mysqli_error($con));
								$i=1;
								if(mysqli_num_rows($fetch_blog)>0) {
									while($data = mysqli_fetch_array($fetch_blog)) {
							?>
								  <tr>
									<td><?php echo $i;?></td>
									<td><?php echo $data['album_name'];?></td>
									<td>
										<?php 
											$imgfileSource = ".." . DIRECTORY_SEPARATOR . $bannerImg . DIRECTORY_SEPARATOR . $data['image'];
											if(file_exists($imgfileSource)){ 
										?>
												<img src="<?php echo $imgfileSource; ?>" style="width:150px; height:150px;" />
										<?php } ?>
									</td>
									<td>
										<a href="edit-contruction-banner.php?id=<?php echo base64_encode($data['album_id']); ?>" class="btn btn-default" style="margin-right:2px;margin-bottom:6px;" title="Edit"><i class="fa fa-pencil"> Edit</i></a>
									</td>
									<td>
										<a title="Click here to Delete This Record" class="show-pointer"><span class="label label-danger deleteButton" id="<?php echo base64_encode($data['album_id']);?>">Delete</span></a>
									</td>
								  </tr>
							<?php
									$i++;
									}    
								}
							?>
							</tbody>
						</table>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div>
		</div>
	</section>
</aside>
<script>
$(".deleteButton").click(function() {
	var dataid = $(this).attr('id');
	if(confirm("Do you really want to delete this record?")) {
		window.location = "construction-banner-process.php?action=delete&id="+dataid;
	}
});
$(function () {
	$('#employee-role-table').DataTable({
	  "paging": true,
	  "lengthChange": true,
	  "searching": true,
	  "ordering": true,
	  "info": true,
	  "autoWidth": false
	});
});
</script>			
<?php
include "footer.php";
?>