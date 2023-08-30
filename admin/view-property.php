<?php
include "header.php";
include "sidebar.php";
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>Property List
        <a href="add-property.php" class="btn btn-primary pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i>&nbsp;Add Property</a>
    </h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box">
					
					<div class="box-body">
					    
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
			                   Record Status changed successfully!!.
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
	            
						
					  <table id="employee-role-table" class="table table-bordered table-striped">
						<thead>
						  <tr>
							<th># Sr. No.</th>
							<th>User</th>
							<th>Address</th>
							<th>Sale/Rent</th>
							<th>Featured Image</th>
							<th>Image</th>
							<!--
							<th>Offer</th>
							<th>Book</th>
							-->
							<th>Verify</th>
							<th>Status</th>
							<th colspan="2">Action</th>
							<th>Created On</th>
						  </tr>
						</thead>
						<tbody>
						<?php
							$fetch_blog=mysqli_query($con,"SELECT id,postcode,house_number_name,street,town_city,county,sale_rent_flag,created_on,status,feature_image,is_verify,user_id FROM `property`  ORDER BY `created_on` DESC") or die(mysqli_error($con));
							$i=1;
							if(mysqli_num_rows($fetch_blog)>0) {
							while($data = mysqli_fetch_array($fetch_blog)) {
								
						?>
						  <tr>
							<td><?php echo $i;?></td>
						
							<?php 
							if(!empty($data['user_id']))
							{
							?>
							<td>
								<a href="<?php echo $base_url."/admin/edit-user.php?id=".base64_encode($data['user_id']); ?>" target="_blank">
									<?php echo getUserNameById($data['user_id']);?>
								</a>	
							</td>
							<?php
							}
							else{
							?>	
							<td><a href="javascript:void(0);">Admin</a></td>							
							<?php
							}
							?>
							<td>
							<?php 
							
							$Address = $data['house_number_name'].' ';
							$Address .= $data['street'].' <br>';
							$Address .= $data['town_city'].' <br>';
							$Address .= $data['postcode'].' <br>';
							$Address .= $data['county'].' <br>';
							
							echo $Address;
							
							?>
							</td>
							
							<td><?php echo isset($data['sale_rent_flag'])?(($data['sale_rent_flag']==1)?'Sale':'Rent'):'N/A';?></td>
							<!--<td><!--Img Tag comes here</td>-->
							<?php $blogImg = "feature-Img";?>
							
							<td><?php $imgfileSource = ".." . DIRECTORY_SEPARATOR . $blogImg . DIRECTORY_SEPARATOR . $data['feature_image'];
			                  if(file_exists($imgfileSource)){ ?>
							<img src="<?php echo $imgfileSource; ?>" style="width:100px; height:100px;" /><?php } ?>
							</td>
							
							<td>
							 <a href="view-more-property-image.php?id=<?php echo base64_encode($data['id']); ?>" class="label label-default"  title="view">View More Images</a>
							 </td>
							 <!--
							 <td>
								<?php 
								// $sql13 = "select * from mst_offers where property_id = '".$data['id']."'";
								// $query13 = mysqli_query($con,$sql13);
								// $offered = mysqli_num_rows($query13);
								?>
								<a href="view-offered.php?id=<?php //echo base64_encode($data['id']); ?>" class="btn btn-default"  title="view"><?php //echo !empty($offered)?$offered:0;?></a>
							 </td>
							  <td>
								<?php 
								// $sql12 = "select * from bookings where property_id = '".$data['id']."'";
								// $query12 = mysqli_query($con,$sql12);
								// $booked = mysqli_num_rows($query12);
								?>
							 
								<a href="view-booked.php?id=<?php //echo base64_encode($data['id']); ?>" class="btn btn-default"  title="view"><?php //echo !empty($booked)?$booked:0;?></a>
							 </td>
							 -->
							<td>
								<?php if($data['is_verify']=="y"){?>
									Verified
								<?php	}
								if($data['is_verify']=="n"){?>
									Not Verified
									
								<?php	}
								if($data['is_verify']=="p"){?>
									<a title="Click here to Accept" class="show-pointer"><span class="label label-success verifyButton" data-status="y" id="<?php echo base64_encode($data['id']);?>">Accept</span></a>	
									<a title="Click here to Reject" class="show-pointer"><span class="label label-warning verifyButton" data-status="n" id="<?php echo base64_encode($data['id']);?>">Reject</span></a>
									
								<?php	}
								
								?>
							</td>
							<td>
							<?php if($data['status']=="1"){?>
							<a title="Click here to Disable Record" class="show-pointer"><span class="label label-success statusButton" id="<?php echo base64_encode($data['id']);?>">Active</span></a>	
						<?php	}
						 if($data['status']=="0"){?>
							<a title="Click here to Active This Record" class="show-pointer"><span class="label label-warning  statusButton" id="<?php echo base64_encode($data['id']);?>">Deactive</span></a>	
						<?php	}?>
						</td>
						
						<td>
							 <a href="edit-property.php?id=<?php echo base64_encode($data['id']); ?>" class="label label-default"  title="Edit"><i class="fa fa-pencil"> Edit</i></a>
						</td>
						<td>
						  <a title="Click here to Delete This Record" class="show-pointer"><span class="label label-danger deleteButton" id="<?php echo base64_encode($data['id']);?>"><i class="fa fa-trash"> Delete</i></span></a>
						 </td>
						 
							<td><?php echo date('d-m-Y',strtotime($data['created_on']));?></td>
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
</div>	

<script>
$(".statusButton").click(function() {
	var dataid = $(this).attr('id');
	if(confirm("Do you really want to change the status of this record?")) {
		window.location = "property-process.php?action=status&id="+dataid;
	}
});

$(".verifyButton").click(function() {
	var dataid = $(this).attr('id');
	var status = $(this).attr('data-status');
	if(confirm("Do you really want to change the status of this record?")) {
		window.location = "property-process.php?action=verify&id="+dataid+"&status="+status;
	}
});

$(".deleteButton").click(function() {
	var dataid = $(this).attr('id');
	if(confirm("Do you really want to delete this record?")) {
		window.location = "property-process.php?action=delete&id="+dataid;
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