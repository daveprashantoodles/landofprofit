<?php
include "header.php";
include "sidebar.php";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Constrution Inquiry list</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box">
					<div class="box-body">
						<table id="employee-role-table" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th><span class="icon">
										<!--<input type="checkbox" onclick="checkAll('chkgrow')" id="checkAll" name="chkall_agt" />-->
									</span></th>
									<th># Sr. No.</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Email</th>
									<th>Contact Number</th>
									<th>Message</th>									
									<th>Created On</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$fetch_blog=mysqli_query($con,"SELECT * FROM `c_inquiry` ORDER BY create_date_time DESC") or die(mysqli_error($con));
								$i=1;
								if(mysqli_num_rows($fetch_blog)>0) {
								while($data = mysqli_fetch_array($fetch_blog)) {
							?>
								<tr>
									<td><input type="checkbox" name="ids[]" class="checkboxes" value="<?php echo $data['id']; ?>"></td>
									<td><?php echo $i;?></td>
									<td><?php echo $data['fname'];?></td>
									<td><?php echo $data['lname'];?></td>
									<td><?php echo $data['email'];?></td>
									<td><?php echo $data['contact'];?></td>																		<td><?php echo $data['message'];?></td>
									<td><?php echo date('d-m-Y',strtotime($data['create_date_time']))?></td>
								</tr>
							<?php $i++;   } }    ?>
							
							</tbody>
						</table>
						 <button type="submit" class="btn btn-danger btn_fnt" name="btn_delete" id="btn_delete"><i class="icon dripicons-trash color_change"></i>Delete</button>
					</div><!-- /.box-body -->
				  </div><!-- /.box -->
			</div>
		</div>
	</section>
</div>	

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


$('button[name=btn_delete]').click(function ()
	{
	  // alert(window.location.href)
	  var modulename = $('#module').val();
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
	  			url: "deleteInquiryList.php",
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

$('#checkAll').click(function (e) {
        $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
});
</script>

<?php
include "footer.php";
?>