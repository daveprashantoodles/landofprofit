<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
include "header.php";
include "sidebar.php";
?>
 
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css"/>
<link href="dist/css/jquery.multiselect.css" rel="stylesheet" type="text/css" media="screen" />
<link href="dist/css/jquery.fastconfirm.css" rel="stylesheet" type="text/css" media="screen" />      

<aside class="right-side">
	<section class="content-header">
		<h1>Banners<!--<small>Preview</small>--></h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- left column -->
		<div class="">
		<!-- general form elements -->
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Add Banner</h3><div class="pull-right" style="font-size:15px;"><span class="mandatory">*</span> indicates required field &nbsp;</div> 
			</div><!-- /.box-header -->
			<!-- form start -->
			<div class="box-body">
				<form role="form" class="form-horizontal" name="newsform" id="newsform"  method="post" action="photo-process.php" autocomplete="off" enctype="multipart/form-data">
					
					
					
					<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="col-sm-2 control-label">Upload Banner<span style="color: red; margin-left: 5px;">*</span></label>
										<div class="col-sm-7">
											<div class="fileUpload btn btn-primary">
											<input type="file" class="upload" id="fileupload" name="image" accept=".jpg, .jpeg, .png, .gif" required />
											</div>
											<span>Upload image<!-- Maximum Image Upload Size is 1MB--></span>		
											<div id="dvPreview"></div>
										</div>
									</div>
								</div>
							</div>
					<div class="box-footer">
						<input type="submit" name="submit" class="btn btn-info" value="Submit">
						<input type="reset" name="reset" class="btn bg-primary" value="Reset">
					</div>

				</form>
				
				 
					    <?php if(isset($_SESSION['msg']) && $_SESSION['msg']=='data_uploaded') { ?>
	                  	<div class="row">
			                <div class="col-sm-6">
				                <div class="alert alert-success alert-dismissible">
			                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                    Record Added successfully!!.
			                   </div>
		                  	</div>
	                  	</div>
	                  	<?php 
	                  	$_SESSION['msg'] = '';
	                  	} ?>
	                 	
						<?php if(isset($_SESSION['msg']) && $_SESSION['msg']=='data_updated') { ?>
	                  	<div class="row">
			                <div class="col-sm-6">
				                <div class="alert alert-warning alert-dismissible">
			                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                    Record Updated successfully!!.
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
				                <div class="alert alert-info alert-dismissible">
			                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                   Record	Status changed successfully!!.
			                  	</div>
		                  	</div>
	                  	</div>
	                  	<?php 
	                  	
	                  	$_SESSION['msg'] = '';
	            	} ?>
	            
	            	<?php if(isset($_SESSION['msg']) && $_SESSION['msg']=='delete_data') { ?>
	                  	<div class="row">
			                <div class="col-sm-6">
				                <div class="alert alert-danger alert-dismissible">
			                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                   	Record Deleted !!.
			                  	</div>
		                  	</div>
	                  	</div>
	                  	<?php 
	                  	
	                  	$_SESSION['msg'] = '';
	            	} ?>
	            	
	            	<?php if(isset($_SESSION['msg']) && $_SESSION['msg']=='order_data') { ?>
	                  	<div class="row">
			                <div class="col-sm-6">
				                <div class="alert alert-success alert-dismissible">
			                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                   	Record Order Change !!.
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
							<th>Created On</th>
							<th>Banner</th>
							<th>Status</th>
							<th>Action</th>
						  </tr>
						</thead>
						<tbody>
						<?php   $fetch_blog=mysqli_query($con,"SELECT photo.* FROM `idf_photo` photo ORDER BY photo.created_on Desc") or die(mysqli_error($con));
							$i=1;
							if(mysqli_num_rows($fetch_blog)>0) {
							while($data = mysqli_fetch_array($fetch_blog)) {
						?>
						  <tr>
							<td><?php echo $i;?></td>
							<td><?php echo date('d-m-Y',strtotime($data['created_on']));?></td>
							<?php $ProImg = "photos";?>
							<td><?php $imgfileSource = ".." . DIRECTORY_SEPARATOR . $ProImg . DIRECTORY_SEPARATOR . $data['image'];
			                  if(file_exists($imgfileSource)){ ?>
							<img src="<?php echo $imgfileSource; ?>" style="width:100px; height:100px;" /><?php } ?>
							</td>
							
							
							
							<td>
							<?php if($data['status']=="1"){?>
							<a title="Click here to Disable Record" class="show-pointer"><span class="label label-success statusButton" id="<?php echo base64_encode($data['id']);?>">Active</span></a>	
						<?php	}
						 if($data['status']=="0"){?>
							<a title="Click here to Active This Record" class="show-pointer"><span class="label label-warning statusButton" id="<?php echo base64_encode($data['id']);?>">Deactive</span></a>	
						<?php	}?>
						</td>
						
						<td>
						  <a title="Click here to Delete This Record" class="show-pointer"><span class="btn btn-danger deleteButton" id="<?php echo base64_encode($data['id']);?>"><i class="fa fa-trash"> Delete</i></span></a>
						 </td>

						  </tr>
						<?php
							$i++;
							}    }
						?>
						
						</tbody>
					  </table>
				
				
				
			</div><!-- /.box -->
		</div><!--/.col (left) -->
	</section><!-- /.content -->
</aside>	
	
<script type="text/javascript" src="dist/js/jquery.multiselect.js"></script>
<script type="text/javascript" src="dist/js/jquery.multiselect.filter.js"></script>
<script type="text/javascript" src="dist/js/jquery.fastconfirm.js"></script>
<script type="text/javascript" src="dist/js/slug.js"></script>
<script type="text/javascript" src="dist/js/jquery.blockUI.js"></script>
<script>
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
$(".statusButton").click(function() {
	var dataid = $(this).attr('id');
	if(confirm("Do you really want to change the status of this record?")) {
		window.location = "photo-process.php?action=status&id="+dataid;
	}
});

$(".deleteButton").click(function() {
	var dataid = $(this).attr('id');
	if(confirm("Do you really want to delete this record?")) {
		window.location = "photo-process.php?action=delete&id="+dataid;
	}
});
</script>

<?php
include "footer.php";
?>