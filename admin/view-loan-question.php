<?php
include "header.php";
include "sidebar.php";
$id = isset($_GET['parentId'])?base64_decode($_GET['parentId']):"";
// echo $id;exit;
$parentId = isset($_GET['parentId'])?$_GET['parentId']:"";
if($id =='')
{
	header("location:view-loan.php");
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Loan Question List
			<a href="add-loan-question.php?parentId=<?php echo $parentId;?>" class="btn btn-primary pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i>&nbsp;Add Loan Question</a>
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
									<th>Question</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
							// echo "SELECT * FROM `serviceQuestions` where parentId = '{$id}'  ORDER BY `id` DESC";exit;
								$fetch_blog=mysqli_query($con,"SELECT * FROM `loanQuestions` where parentId = '{$id}'  ORDER BY `id` DESC") or die(mysqli_error($con));
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
											<a href="edit-loan-question.php?parentId=<?php echo $parentId;?>&id=<?php echo base64_encode($data['id']); ?>">
												<?php echo $data['question'];?>
											</a>
											
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
						 <button type="submit" class="btn btn-danger btn_fnt" name="btn_delete" id="btn_delete"><i class="icon dripicons-trash color_change"></i>Delete</button> 
						 <button type="submit" class="btn btn-primary btn_fnt" name="btn_publish" id="btn_publish"><i class="icon dripicons-trash color_change"></i>Publish</button>
						 <button type="submit" class="btn btn-warning btn_fnt" name="btn_unpublish" id="btn_unpublish"><i class="icon dripicons-trash color_change"></i>UnPublish</button>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div>
		</div>
	</section>
</div>	

<script>

var parentId = "<?php echo $parentId;?>";
$(".statusButton").click(function() {
	var dataid = $(this).attr('id');
	if(confirm("Do you really want to change the status of this record?")) {
		window.location = "loan-question-process.php?action=status&parentId="+parentId+"&id="+dataid;
	}
});

$(".deleteButton").click(function() {
	var dataid = $(this).attr('id');
	if(confirm("Do you really want to delete this record?")) {
		window.location = "loan-question-process.php?action=delete&parentId="+parentId+"&id="+dataid;
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

$('button[name=btn_delete]').click(function ()
	{
	  var id = [];
	$("input[name='ids[]']:checked").each(function (i)
	{
	  	id[i] = $(this).val();
	});
	if (id.length === 0) //tell you if the array is empty
	{
	  	alert("Please Select atleast one checkbox");
	}
	else
	{
	  	if (confirm("Are you sure you want to delete records on this page?"))
	  	{
	  		$.ajax(
	  		{
	  			url: "deleteLoanQuestion.php?parentId="+parentId,
	  			method: 'POST',
				dataType :"json",
	  			data:
	  			{
	  				id: id
	  			},
	  			success: function (res)
	  			{
					var code = res.code;
					var msg = res.msg;
					alert(msg);
					if(code==200)
					{
						location.reload();
					}
					return false;
				}
			});
	  	}
	  	else
	  	{
	  		return false;
	  	}
	}
});
$('button[name=btn_publish]').click(function ()
	{
	  var id = [];
	$("input[name='ids[]']:checked").each(function (i)
	{
	  	id[i] = $(this).val();
	});
	if (id.length === 0) //tell you if the array is empty
	{
	  	alert("Please Select atleast one checkbox");
	}
	else
	{
	  	if (confirm("Do you want to publish these records?"))
	  	{
	  		$.ajax(
	  		{
	  			url: "publishLoanQuestion.php?parentId="+parentId,
	  			method: 'POST',
				dataType :"json",
	  			data:
	  			{
	  				id: id
	  			},
	  			success: function (res)
	  			{
					var code = res.code;
					var msg = res.msg;
					alert(msg);
					if(code==200)
					{
						location.reload();
					}
					return false;
				}
			});
	  	}
	  	else
	  	{
	  		return false;
	  	}
	}
});
$('button[name=btn_unpublish]').click(function ()
	{
	  var id = [];
	$("input[name='ids[]']:checked").each(function (i)
	{
	  	id[i] = $(this).val();
	});
	if (id.length === 0) //tell you if the array is empty
	{
	  	alert("Please Select atleast one checkbox");
	}
	else
	{
	  	if (confirm("Do you want to unpublish these records?"))
	  	{
	  		$.ajax(
	  		{
	  			url: "unpublishLoanQuestion.php?parentId="+parentId,
	  			method: 'POST',
				dataType :"json",
	  			data:
	  			{
	  				id: id
	  			},
	  			success: function (res)
	  			{
					var code = res.code;
					var msg = res.msg;
					alert(msg);
					if(code==200)
					{
						location.reload();
					}
					return false;
				}
			});
	  	}
	  	else
	  	{
	  		return false;
	  	}
	}
});

</script>

<?php
include "footer.php";
?>