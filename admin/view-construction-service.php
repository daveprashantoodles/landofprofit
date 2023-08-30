<?php
include "header.php";
include "sidebar.php";
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Construction Service List
			<a href="add-construction-service.php" class="btn btn-primary pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i>&nbsp;Add Construction Service</a>
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
	            
							
						<table id="employee-role-table" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>
										<span class="icon">
											<input type="checkbox" onclick="checkAll('chkgrow')" id="checkAll" name="chkall_agt" />
										</span>
									</th>
									<th># Sr. No.</th>
									<th>Title</th>
									<th>Image</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$fetch_blog=mysqli_query($con,"SELECT * FROM `construction_services` ORDER BY `id` asc") or die(mysqli_error($con));
								$i=1;
								if(mysqli_num_rows($fetch_blog)>0) {
									while($data = mysqli_fetch_array($fetch_blog)) {
							?>
									<tr>
										<td>
											<input type="checkbox" name="ids[]" class="checkboxes" value="<?php echo $data['id']; ?>">
										</td>
										<td><?php echo $i;?></td>
										<td>
											<a href="edit-construction-service.php?id=<?php echo base64_encode($data['id']); ?>">
												<?php echo $data['service_title'];?>
											</a>
										</td>
										<td>
										<?php
											$imgfileSource = ".." . DIRECTORY_SEPARATOR . $serviceImg . DIRECTORY_SEPARATOR . $data['image'];
											if(file_exists($imgfileSource)){ 
										?>
												<img src="<?php echo $imgfileSource; ?>" style="width:100px; height:100px;" />
										<?php 
											}
										?>
										</td>
										<td>
											<?php if($data['publish']=="1"){?>
												<a title="Click here to Disable Record" class="show-pointer"><span class="label label-success statusButton" id="<?php echo base64_encode($data['id']);?>">Active</span></a>	
											<?php	}
											if($data['publish']=="0"){?>
												<a title="Click here to Active This Record" class="show-pointer"><span class="label label-warning statusButton" id="<?php echo base64_encode($data['id']);?>">Deactive</span></a>	
											<?php	}?>
										</td>
										<td>
											<a title="Click here to Delete This Record" class="show-pointer"><span class="label label-danger deleteButton" id="<?php echo base64_encode($data['id']);?>"><i class="fa fa-trash"> Delete</i></span></a>
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
</div>	

<script>


$(".statusButton").click(function() {
	var dataid = $(this).attr('id');
	if(confirm("Do you really want to change the status of this record?")) {
		window.location = "service-construction-process.php?action=status&id="+dataid;
	}
});

$(".deleteButton").click(function() {
	var dataid = $(this).attr('id');
	if(confirm("Do you really want to delete this record?")) {
		window.location = "service-construction-process.php?action=delete&id="+dataid;
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
$('#checkAll').click(function (e) {
        $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
});
</script>
<?php
include "footer.php";
?>