<?php
include "header.php";
include "sidebar.php";
?>



<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

	<!-- Content Header (Page header) -->

	<section class="content-header">

	  <h1>Latest Launch List

        <a href="add-latest-launch.php" class="btn btn-primary pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i>&nbsp;Add Latest launch</a>

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
							
							<th>Title</th>

							<th>Image</th>

							<th>Status</th>

							<th>Action</th>

						  </tr>

						</thead>

						<tbody>

						<?php

							$fetch_latest_launch=mysqli_query($con,"SELECT latest_launch.* FROM `latest_launch`  ORDER BY latest_launch.id DESC") or die(mysqli_error($con));

							$i=1;

							if(mysqli_num_rows($fetch_latest_launch) > 0) {

							while($data = mysqli_fetch_array($fetch_latest_launch)) {

						?>

						  <tr>

							<td><?php echo $i;?></td>

							<td><a href="edit-latest-launch.php?id=<?php echo base64_encode($data['id']); ?>"><?php echo $data['latestlaunchTitle'];?></a></td>
							<td>
								<?php 
									
									$imgfileSource = ".." . DIRECTORY_SEPARATOR . $latestLaunchImg . DIRECTORY_SEPARATOR . $data['image1'];

									if(!empty($data['image1'])){
								 
								?>

										<img src="<?php echo $imgfileSource; ?>" style="width:100px; height:100px;" />
								
								<?php 
									} 
								?>

							</td>
                            <td>

								<?php 
								
								if($data['publish']=="1"){
								
								?>

									<a title="Click here to Disable Record" class="show-pointer"><span class="label label-success statusButton" id="<?php echo base64_encode($data['id']);?>">Active</span></a>	

								<?php	
								}

								if($data['publish']=="0"){
								
								?>

									<a title="Click here to Active This Record" class="show-pointer"><span class="label label-warning statusButton" id="<?php echo base64_encode($data['id']);?>">Deactive</span></a>	

								<?php	
									
									}
									
								?>

							</td>

							<td>
								<a title="Click here to Delete This Record" class="show-pointer"><span class="label label-danger deleteButton" id="<?php echo base64_encode($data['id']);?>"><i class="fa fa-trash"> Delete</i></span></a>
							</td>
						  </tr>

						<?php

							$i++;

							}    }

						?>

						

						</tbody>

					  </table>
						<!-- <button type="submit" class="btn btn-danger btn_fnt" name="btn_delete" id="btn_delete"><i class="icon dripicons-trash color_change"></i>Delete</button>  -->
						<!-- <button type="submit" class="btn btn-primary btn_fnt" name="btn_publish" id="btn_publish"><i class="icon dripicons-trash color_change"></i>Publish</button>
						<button type="submit" class="btn btn-warning btn_fnt" name="btn_unpublish" id="btn_unpublish"><i class="icon dripicons-trash color_change"></i>UnPublish</button> -->

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

		window.location = "latest-launch-process.php?action=status&id="+dataid;

	}

});



$(".deleteButton").click(function() {

	var dataid = $(this).attr('id');

	if(confirm("Do you really want to delete this record?")) {

		window.location = "latest-launch-process.php?action=delete&id="+dataid;

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