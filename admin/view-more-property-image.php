<?php
include "header.php";
include "sidebar.php";

$id = check_input($con,base64_decode($_REQUEST['id']));
$id1 = check_input($con,($_REQUEST['id']));

// echo $id;exit;
?>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css"/>
<link href="dist/css/jquery.multiselect.css" rel="stylesheet" type="text/css" media="screen" />
<link href="dist/css/jquery.fastconfirm.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<aside class="right-side">
<section class="content-header">
    <h1>Property Photos<!--<small>Preview</small>--></h1>
</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Add Property Photo</h3>
					</div><!-- /.box-header -->

					<div class="box-body">
						<?php if(isset($_SESSION['msg']) && $_SESSION['msg']=='data_uploaded') { ?>
							<div class="row">
							<div class="col-sm-6">
							<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							Image Uploaded successfully!!.
							</div>
							</div>
							</div>
						<?php 
							$_SESSION['msg'] = '';
						} 
						?>	

					<!-- form start -->
						<form class="form-horizontal" name="albumform" id="albumform" enctype="multipart/form-data"  method="post" action="property-img-process.php" autocomplete="off">

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="col-sm-2 control-label">Upload Image<span style="color: red; margin-left: 5px;">*</span></label>
										<div class="col-sm-7">
											<div class="fileUpload btn btn-primary">
											<input type="file" class="upload" id="fileupload" name="image[]" multiple="" accept=".jpg, .jpeg, .png, .gif" required />
											</div>
											<span>Multiple Photos Upload<!-- Maximum Image Upload Size is 1MB--></span>		
											<div id="dvPreview"></div>
										</div>
									</div>
								</div>
							</div>
							<br />
							<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />  
							<div class="box-footer">
								<input type="submit" name="submit" class="btn btn-info" value="Submit">
								<input type="reset" name="reset" class="btn bg-primary" value="Reset">
							</div>
						</form>
					</div>
				</div>
			</div>             
		</div>             
	</section>
	

	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	     Images
	    <!--<small>...</small>-->
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
							<th>Image</th>
							<th>Created On</th>
							<th>Status</th>
							<th>Delete</th>
						</tr>
						</thead>
						<tbody>
						<?php
							// echo "SELECT * FROM `property_imgs` where property_id='".$id."' ORDER BY `created_on` DESC";exit;
						
							$fetch_blog=mysqli_query($con,"SELECT * FROM `property_imgs` where property_id='".$id."' ORDER BY `created_on` DESC")or die(mysqli_error($con));
							$i=1;
							if(mysqli_num_rows($fetch_blog)>0) {
							while($data = mysqli_fetch_array($fetch_blog)) {
						?>
						  <tr>
							<td><?php echo $i;?></td>
							<?php $albumImg='property-photo-gallery';?>
							<td><?php $imgfileSource = ".." . DIRECTORY_SEPARATOR . $albumImg . DIRECTORY_SEPARATOR . $data['image'];
							// echo $imgfileSource;
			                  if(file_exists($imgfileSource)){ ?>
							<img src="<?php echo $imgfileSource; ?>" style="width:150px; height:150px;" /><?php } ?>
							</td>
							<td><?php echo date('d-m-Y',strtotime($data['created_on']));?></td>
							<td>
							<?php if($data['status']=="1"){?>
							<a title="Click here to Disable Record" class="show-pointer"><span class="label label-success statusButton"  id="<?php echo base64_encode($data['id']);?>">Active</span></a>	
						<?php	}
						 if($data['status']=="0"){?>
							<a title="Click here to Active This Record" class="show-pointer"><span class="label label-warning statusButton" id="<?php echo base64_encode($data['id']);?>">Deactive</span></a>	
						<?php	}?>
						   </td>
						   
						   <td>
						  <a title="Click here to Delete This Record" class="show-pointer"><span class="label label-danger deleteButton" id="<?php echo base64_encode($data['id']);?>">Delete</span></a>
						 </td>
						  </tr>
						<?php
							$i++;
							}    }
						?>
						
						</tbody>
					  </table>
					</div><!-- /.box-body -->
				  </div><!-- /.box -->
			</div>
		</div>
	</section>

</aside>

<script type="text/javascript" src="dist/js/slug.js"></script>
<script>
var id = $('#id').val();
console.log(id);
$(".statusButton").click(function() {
	var dataid = $(this).attr('id');
	console.log(dataid);
	if(confirm("Do you really want to change the status of this record?")) {
		window.location = "property-img-process.php?action=status&id="+dataid+"&property_id="+id;
	}
});

$(".deleteButton").click(function() {
	var dataid = $(this).attr('id');
	if(confirm("Do you really want to delete this record?")) {
		window.location = "property-img-process.php?action=delete&id="+dataid+"&property_id="+id;
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