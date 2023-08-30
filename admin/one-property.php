<?php
include "header.php";
include "sidebar.php";
$id = check_input($con,base64_decode($_REQUEST['id']));
$id1 = check_input($con,$_REQUEST['id']);
$query = mysqli_query($con, "SELECT * from property where id=".$id);
$data =mysqli_fetch_assoc($query);
if(!$data) {  die("".mysqli_error()); }

// echo '<pre>';print_r($data);exit;
?>
 
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css"/>
<link href="dist/css/jquery.multiselect.css" rel="stylesheet" type="text/css" media="screen" />
<link href="dist/css/jquery.fastconfirm.css" rel="stylesheet" type="text/css" media="screen" />
      
<style type="text/css">
label.error{
	color: #cc0000;
}	
</style>

<aside class="right-side">
	<section class="content-header">
		<h1>Property Detail</h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- general form elements -->
		<!--<div class="box box-primary">-->
			<!-- form start -->
			<div class="box-body">
			
				<div class="col-md-12">
					<div class="box box-info">
					<div class="box-header">
						<h3 class="box-title">Address</h3>
					</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="name" class="col-lg-4 control-label">House Number/Name</label>
							<div class="col-lg-8">
								<p><?php echo isset($data['house_number_name'])?$data['house_number_name']:''; ?></p>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="categorySlug" class="col-sm-4 control-label">Street </label>
							<div class="col-sm-8">
								<p><?php echo isset($data['street'])?$data['street']:''; ?></p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="name" class="col-lg-4 control-label">Town/City</label>
							<div class="col-lg-8">
								<p><?php echo isset($data['town_city'])?$data['town_city']:''; ?></p>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="categorySlug" class="col-sm-4 control-label">County</label>
							<div class="col-sm-8">
								<p><?php echo isset($data['county'])?$data['county']:''; ?></p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="name" class="col-lg-4 control-label">Postcode</label>
							<div class="col-lg-8">
								<p><?php echo isset($data['postcode'])?$data['postcode']:''; ?></p>
							</div>
						</div>
					</div>
					</div>
				</div>
				</div>
				
				
				<div class="col-md-12">
					<div class="box box-info">
					<div class="box-header">
						<h3 class="box-title">To Let</h3>
					</div>
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="name" class="col-lg-4 control-label">Rent Price £(PCM ) </label>
							<div class="col-lg-8">
								<p><?php echo isset($data['rent_price'])?number_format($data['rent_price'],2,'.',','):''; ?></p>
							</div>
						</div>
					</div>	
					<div class="col-md-6">
						<div class="form-group">
							<label for="categorySlug" class="col-sm-4 control-label">Deposit Amount(£)</label>
							<div class="col-sm-8">
								<p><?php echo isset($data['deposit_amount'])?number_format($data['deposit_amount'],2,'.',','):''; ?></p>
							</div>
						</div>
					</div>
					
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="categorySlug" class="col-sm-4 control-label">Guarantor Required?</label>
							<div class="col-sm-8">
								<p><?php echo isset($data['guarantor_required'])?(($data['guarantor_required']==1)?'Yes':'No'):''; ?></p>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="categorySlug" class="col-sm-4 control-label">Pets allowed?</label>
							<div class="col-sm-8">
								<p><?php echo isset($data['pets_allowed'])?(($data['pets_allowed']==1)?'Yes':'No'):''; ?></p>
							</div>
						</div>
					</div>
				</div>
				</div>
				</div>
				<div class="col-md-12">
					<div class="box box-info">
					<div class="box-header">
						<h3 class="box-title">To Sale</h3>
					</div>
					<div class="row">
				<div class="col-md-6">
						<div class="form-group">
							<label for="name" class="col-lg-4 control-label">Sale Price (£) </label>
							<div class="col-lg-8">
								<p><?php echo isset($data['sale_price'])?number_format($data['sale_price'],2,'.',','):''; ?></p>
							</div>
						</div>
					</div>	
					</div>	
					</div>	
					</div>	
					<div class="col-md-12">
					<div class="box box-info">
					<div class="box-header">
						<h3 class="box-title">General information </h3>
					</div>
					
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="name" class="col-lg-4 control-label">No of Bedrooms</label>
							<div class="col-lg-8">
								<p><?php echo isset($data['bedrooms'])?$data['bedrooms']:''; ?></p>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="name" class="col-lg-4 control-label">No of Bathrooms</label>
							<div class="col-lg-8">
								<p><?php echo isset($data['bathrooms'])?$data['bathrooms']:''; ?></p>
							</div>
						</div>
					</div>
					
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="name" class="col-lg-4 control-label">No of Reception Rooms</label>
							<div class="col-lg-8">
								<p><?php echo isset($data['reception_rooms'])?$data['reception_rooms']:''; ?></p>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="name" class="col-lg-4 control-label">Furnished / Unfurnished?</label>
							<div class="col-lg-8">
								<p><?php echo isset($data['isFurnished'])?(($data['isFurnished']==1)?'Yes':'No'):''; ?></p>
							</div>
						</div>
					</div>
					
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="name" class="col-lg-4 control-label">Does the property require a Gas Certificate?</label>
							<div class="col-lg-8">
								<p><?php echo isset($data['isGasRequired'])?(($data['isGasRequired']==1)?'Yes':'No'):''; ?></p>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="categorySlug" class="col-sm-4 control-label">Date Available</label>
							<div class="col-sm-8">
								<p><?php echo isset($data['date_available'])?date('d-m-Y',strtotime($data['date_available'])):''; ?></p>
							</div>
						</div>
					</div>
					
					
				</div>
				<div class="row">
				<div class="col-md-12">
						<div class="form-group">
							<label for="name" class="col-lg-2 control-label">Description</label>
							<div class="col-lg-10">
								<p><?php echo isset($data['mainDescription'])?html_entity_decode($data['mainDescription']):''; ?></p>
							</div>
						</div>
					</div>
					
				</div>
				</div>
				</div>
			</div><!-- /.box -->
		<!--</div>--><!--/.col (left) -->
	</section><!-- /.content -->
</aside>
<script type="text/javascript" src="dist/js/jquery.multiselect.js"></script>
<script type="text/javascript" src="dist/js/jquery.multiselect.filter.js"></script>
<script type="text/javascript" src="dist/js/jquery.fastconfirm.js"></script>
<script type="text/javascript" src="dist/js/slug.js"></script>
<script type="text/javascript" src="dist/js/jquery.blockUI.js"></script>
<script src="//cdn.ckeditor.com/4.5.9/full/ckeditor.js"></script>
<?php
include "footer.php";
?>