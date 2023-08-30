<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "header.php";
include "sidebar.php";
$id = check_input($con,base64_decode($_REQUEST['id']));
$id1 = check_input($con,$_REQUEST['id']);
$query = mysqli_query($con, "SELECT * FROM `property` WHERE `id`='".$id."' ");
$data =mysqli_fetch_array($query);
if(!$data) {  die("".mysqli_error()); } 
// echo '<pre>';print_r($data);exit;
?>
 <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css"/>
 <link href="dist/css/jquery.multiselect.css" rel="stylesheet" type="text/css" media="screen" />
 <link href="dist/css/jquery.fastconfirm.css" rel="stylesheet" type="text/css" media="screen" />      
<script>
$(document).ready(function() {
	$("#main_form").validate({
		rules: {
			postcode: {
				required: true,
			},
			propertySlug: {
				required: true,
				remote:{
					 url: 'checkDuplicatePropertySlug.php',
					data: { property_id: $('#property_id').val()}
				}
			},
			house_number_name: {
				required: true,
			},
			street: {
				required: true,
			},
			town_city: {
				required: true,
			},
			county: {
				required: true,
			},
			// bedrooms: {
				// required: true,
			// },
			// bathrooms: {
				// required: true,
			// },
		},
		
		messages: {
			postcode: {
				required: "This field cannot be blank.",
			},
			propertySlug: {
				required: "This field cannot be blank.",
				remote: "Slug is already exist.",
			},
			house_number_name: {
				required: "This field cannot be blank.",
			},
			street: {
				required: "This field cannot be blank.",
			},
			town_city: {
				required: "This field cannot be blank.",
			},
			county: {
				required: "This field cannot be blank.",
			},
			// bedrooms: {
				// required: "This field cannot be blank.",
			// },
			// bathrooms: {
				// required: "This field cannot be blank.",
			// },
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
    <h1>Edit Property<!--<small>Preview</small>--></h1>
</section>
<!-- Main content -->
<section class="content">

    <!-- left column -->
    <div class="">
        <!-- general form elements -->
        <div class="box">
            <!-- form start -->
            <div class="box-body">
                <form role="form" class="form-horizontal" name="main_form" id="main_form"  method="post" action="property-process.php" autocomplete="off" enctype="multipart/form-data">
				
				<div class="col-md-12">
					<div class="box box-info">
					<div class="box-header">
						<h3 class="box-title">Address</h3>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="postcode" class="col-lg-4 control-label">Postcode<span class="mandatory">*</span></label>
								<div class="col-lg-8">
									<input type="text" class="form-control PlaceAutoComplete pac-target-input" id="postcode" name="postcode" placeholder="Enter a Postcode	" autocomplete="off" value="<?php if(isset($data['postcode'])){if($data['postcode']!=''){echo $data['postcode'];}} ?>">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="propertySlug" class="col-sm-4 control-label">Property Slug <span class="mandatory">*</span></label>
								<div class="col-sm-8">
									<input type="text" class="form-control isRequired" id="propertySlug" name="propertySlug" placeholder="Property slug" title="Please enter Property Slug"  value="<?php if(isset($data['propertySlug'])){if($data['propertySlug']!=''){echo $data['propertySlug'];}} ?>" />
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="house_number_name" class="col-lg-4 control-label">House number/name<span class="mandatory">*</span></label>
								<div class="col-lg-8">
									<input type="text" class="form-control" id="house_number_name" name="house_number_name" placeholder="Enter House number/name" autocomplete="off" value="<?php if(isset($data['house_number_name'])){if($data['house_number_name']!=''){echo $data['house_number_name'];}} ?>" >
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="street" class="col-sm-4 control-label">Street<span class="mandatory">*</span></label>
								<div class="col-sm-8">
									<input type="text" class="form-control isRequired" id="street" name="street" placeholder="Enter Street" title="Please enter Street" value="<?php if(isset($data['street'])){if($data['street']!=''){echo $data['street'];}}?>"/>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="town_city" class="col-lg-4 control-label">Town/city<span class="mandatory">*</span></label>
								<div class="col-lg-8">
									<input type="text" class="form-control" id="town_city" name="town_city" placeholder="Enter Town/city" title="Enter Town/city" autocomplete="off"  value="<?php if(isset($data['town_city'])){if($data['town_city']!=''){echo $data['town_city'];}}?>"/>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="county" class="col-sm-4 control-label">County<span class="mandatory">*</span></label>
								<div class="col-sm-8">
									<input type="text" class="form-control isRequired" id="county" name="county" placeholder="Enter County" title="Please enter County" value="<?php if(isset($data['county'])){if($data['county']!=''){echo $data['county'];}}?>" />
								</div>
							</div>
						</div>
					</div>
					<input type="hidden" name="propertyAddress" id="propertyAddress" value="">
					</div>
					</div>
					
					<!--
					<div class="col-md-12">
					<div class="box box-info">
					<div class="box-header">
						<h3 class="box-title">Geo Location</h3>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="latitude" class="col-sm-4 control-label">Latitude<span class="mandatory"></span></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="latitude" name="latitude" placeholder="Enter Latitude" title="Please enter Latitude" value="<?php if(isset($data['latitude'])){if($data['latitude']!=''){echo $data['latitude'];}}?>"/>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="longitude" class="col-sm-4 control-label">Longitude<span class="mandatory"></span></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="longitude" name="longitude" placeholder="Enter Longitude" title="Please enter Longitude" value="<?php if(isset($data['longitude'])){if($data['longitude']!=''){echo $data['longitude'];}}?>"/>
								</div>
							</div>
						</div>
					</div>
					
					
					
					</div>
					</div>
					-->
					
					<div class="col-md-12">
					<div class="box box-info">
					<div class="box-header">
						<h3 class="box-title">Maps</h3>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="latitude" class="col-sm-2 control-label">Iframe<span class="mandatory"></span></label>
								<div class="col-sm-10">
									<textarea class="form-control" id="map_iframe" name="map_iframe" rows="3" title="Please enter iframe"><?php if(isset($data['map_iframe'])){if($data['map_iframe']!=''){echo $data['map_iframe'];}}?></textarea>
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
								<label for="rent_price" class="col-lg-4 control-label">Rent Price(PCM) <span class="mandatory"></span></label>
								<div class="col-lg-8">
									<input type="text" class="form-control" id="rent_price" name="rent_price" placeholder="Enter Rent Price(PCM) " title="Enter Rent Price(PCM) " autocomplete="off" value="<?php if(isset($data['rent_price'])){if($data['rent_price']!=''){echo number_format($data['rent_price'],2,'.','');}}?>">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="deposit_amount" class="col-lg-4 control-label">Deposit Amount<span class="mandatory"></span></label>
								<div class="col-lg-8">
									<input type="text" class="form-control" id="deposit_amount" name="deposit_amount" placeholder="Enter Deposit Amount " title="Enter Deposit Amount" autocomplete="off" value="<?php if(isset($data['deposit_amount'])){if($data['deposit_amount']!=''){echo number_format($data['deposit_amount'],2,'.','');}}?>" >
								</div>
							</div>
						</div>
						
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="guarantor_required" class="col-lg-4 control-label">Guarantor Required?<span class="mandatory"></span></label>
								<div class="col-lg-8">
									<select name="guarantor_required" id="guarantor_required" class="select2" style="width:100%;">
										<option value=""> --select--</option>
										<option value="1" <?php if(isset($data['guarantor_required'])){if($data['guarantor_required']==1){echo 'selected';}}?>>Yes</option>
										<option value="0" <?php if(isset($data['guarantor_required'])){if($data['guarantor_required']==0){echo 'selected';}}?>>No</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="pets_allowed" class="col-lg-4 control-label">Pets allowed?<span class="mandatory"></span></label>
								<div class="col-lg-8">
									<select name="pets_allowed" id="pets_allowed" class="select2" style="width:100%;">
										<option value=""> --select--</option>
										<option value="1" <?php if(isset($data['pets_allowed'])){if($data['pets_allowed']==1){echo 'selected';}}?>>Yes</option>
										<option value="0" <?php if(isset($data['pets_allowed'])){if($data['pets_allowed']==0){echo 'selected';}}?>>No</option>
									
									</select>
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
								<label for="sale_price" class="col-sm-4 control-label">Sale Price<span class="mandatory"></span></label>
								<div class="col-sm-8">
									<input type="text" class="form-control isRequired" id="sale_price" name="sale_price" placeholder="Enter Sale Price" title="Please enter Sale Price"  value="<?php if(isset($data['sale_price'])){if($data['sale_price']!=''){echo number_format($data['sale_price'],2,'.','');}}?>" />
								</div>
							</div>
						</div>
						</div>
					</div>
				</div>
					<div class="col-md-12">
					<div class="box box-info">
					<div class="box-header">
						<h3 class="box-title">General information</h3>
					</div>	
						
					
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="bedrooms" class="col-lg-4 control-label">No of Bedrooms</label>
								<div class="col-lg-8">
									<input type="number" class="form-control" id="bedrooms" name="bedrooms" placeholder="Enter the number of bedrooms in your property" title="Enter the number of bedrooms in your property" min="1" autocomplete="off" value="<?php if(isset($data['bedrooms'])){if($data['bedrooms']!=''){echo $data['bedrooms'];}}?>" >
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="bathrooms" class="col-sm-4 control-label">No of Bathrooms</label>
								<div class="col-sm-8">
									<input type="number" class="form-control isRequired" id="bathrooms" name="bathrooms" placeholder="Enter the number of bathrooms in your property " title="Enter the number of bathrooms in your property" min="1" value="<?php if(isset($data['bathrooms'])){if($data['bathrooms']!=''){echo $data['bathrooms'];}}?>" />
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
					<!--
						<div class="col-md-6">
							<div class="form-group">
								<label for="reception_rooms" class="col-lg-4 control-label">No of Reception Rooms<span class="mandatory"></span></label>
								<div class="col-lg-8">
									<input type="number" class="form-control" id="reception_rooms" name="reception_rooms" placeholder="Enter the number of Reception Rooms in your property" title="Enter the number of Reception Rooms in your property" autocomplete="off" value="<?php if(isset($data['reception_rooms'])){if($data['reception_rooms']!=''){echo $data['reception_rooms'];}}?>">
								</div>
							</div>
						</div>
						-->
						<div class="col-md-6">
							<div class="form-group">
								<label for="isFurnished" class="col-lg-4 control-label">Furnished / Unfurnished?<span class="mandatory"></span></label>
								<div class="col-lg-8">
									<select name="isFurnished" id="isFurnished" class="select2" style="width:100%;">
										<option value=""> --select--</option>
										<option value="1" <?php if(isset($data['isFurnished'])){if($data['isFurnished']==1){echo 'selected';}}?>>Yes</option>
										<option value="0" <?php if(isset($data['isFurnished'])){if($data['isFurnished']==0){echo 'selected';}}?>>No</option>
									
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
					<div class="col-md-6">
							<div class="form-group">
								<label for="isGasRequired" class="col-lg-4 control-label">Does the property require a Gas Certificate?<span class="mandatory"></span></label>
								<div class="col-lg-8">
									<select name="isGasRequired" id="isGasRequired" class="select2" style="width:100%;">
										<option value=""> --select--</option>
										<option value="1" <?php if(isset($data['isGasRequired'])){if($data['isGasRequired']==1){echo 'selected';}}?>>Yes</option>
										<option value="0" <?php if(isset($data['isGasRequired'])){if($data['isGasRequired']==0){echo 'selected';}}?>>No</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="sale_rent_flag" class="col-lg-4 control-label">Sale/Rent<span class="mandatory"></span></label>
								<div class="col-lg-8">
									<select name="sale_rent_flag" id="sale_rent_flag" class="select2" style="width:100%;">
										<option value=""> --select--</option>
										<option value="1" <?php if(isset($data['sale_rent_flag'])){if($data['sale_rent_flag']==1){echo 'selected';}}?>>Sale</option>
										<option value="0" <?php if(isset($data['sale_rent_flag'])){if($data['sale_rent_flag']==0){echo 'selected';}}?>>Rent</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="deposit_amount" class="col-sm-4 control-label">Date Available<span class="mandatory"></span></label>
								<div class="col-sm-8">
									<input type="text" class="form-control isRequired" id="date_available" name="date_available" placeholder="Enter the date the property will become available" title="Enter the date the property will become available" value="<?php if(isset($data['deposit_amount'])){if($data['deposit_amount']!=''){echo date('d-m-Y',strtotime($data['deposit_amount']));}}?>" />
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="built_in" class="col-lg-4 control-label">Built In<span class="mandatory"></span></label>
								<div class="col-lg-8">
                                <input type="text" class="form-control isRequired" id="built_in" name="built_in" placeholder="ex: 2023" value="<?php if(isset($data['built_in'])){if($data['built_in']!=''){echo $data['built_in'];}}?>"/>
								
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="gross_yield" class="col-lg-4 control-label">Gross Yield(%)<span class="mandatory"></span></label>
								<div class="col-lg-8">
                                <input type="text" class="form-control isRequired" id="gross_yield" name="gross_yield" placeholder="ex: 8.3"  value="<?php if(isset($data['gross_yield'])){if($data['gross_yield']!=''){echo $data['gross_yield'];}}?>"/>
								
								</div>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label for="cap_rate" class="col-lg-4 control-label">Cap Rate(%)<span class="mandatory"></span></label>
								<div class="col-lg-8">
									<input type="text" class="form-control isRequired" id="cap_rate" name="cap_rate" placeholder="ex: 8.3"  value="<?php if(isset($data['cap_rate'])){if($data['cap_rate']!=''){echo $data['cap_rate'];}}?>"/>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="hoa" class="col-lg-4 control-label">HOA<span class="mandatory"></span></label>
								<div class="col-lg-8">
									<select name="hoa" id="hoa" class="select2" style="width:100%;">
										<option value="y" <?php echo ($data['hoa']=="y")?"selected":"";?>>Yes</option>
										<option value="n" <?php echo ($data['hoa']=="n")?"selected":"";?>>No</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="sale_rent_flag" class="col-lg-4 control-label">Area<span class="mandatory"></span></label>
								<div class="col-lg-8">
                                <input type="text" class="form-control isRequired" id="area" name="area" placeholder="Area in SQRT" title="Area in SQRT" value="<?php if(isset($data['area'])){if($data['area']!=''){echo $data['area'];}}?>"  />
								</div>
							</div>
						</div>
					</div>
					</div>
					</div>
					<div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="col-lg-2 control-label">Property Type</label>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <?php
                                        $mychecklistquery=mysqli_query($con,"SELECT `id`,`name` FROM `property_type_master` ORDER BY `id` DESC ") or die(mysqli_error($con));
                                        $checkedvalue="";
                                        $datachecklist=array();
                                        
                                        while($checkResult=mysqli_fetch_assoc($mychecklistquery)){
                                            // echo '<pre>';print_r($checkResult);exit;
                                            
                                            $mycheckdlistquery=mysqli_query($con,"SELECT `type_id` FROM `property_type_checklist` where property_id = '".$id."' ORDER BY `type_id` ASC ") or die(mysqli_error($con));
                                            
                                            while($checklistrow = mysqli_fetch_assoc($mycheckdlistquery) ){
                                                $datachecklist[] = $checklistrow['type_id'];
                                            }
                                            
                                            // echo '<pre>';print_r($datachecklist);exit;
                                            
                                            if(in_array($checkResult['id'],$datachecklist)){
                                                $checkedvalue="checked";
                                            }
                                        
                                        ?>
                                        <div class="col-md-4">
                                        <!-- <div class="mmstatuscb">
                                                    <input type="checkbox" name="propertype_checklist[]" id="propertype_checklist<?php echo $checkResult['id'];?>" value="<?php echo $checkResult['id'];?>" class="icheckbox_flat-green" <?php echo $checkedvalue; ?> />
                                                    <label for="propertype_checklist<?php echo $checkResult['id'];?>"> &ensp;<?php echo $checkResult['name'];?> </label>
                                                </div>
                                                -->
                                            <div class="radio">
                                                <label>
                                                <input class="property_type_select" type="radio" name="propertype_checklist[]" id="propertype_checklist<?php echo $checkResult['id'];?>" value="<?php echo $checkResult['id'];?>" <?php echo $checkedvalue;?>>
                                                <?php echo $checkResult['name'];?>
                                                </label>
                                            </div>  
                                        </div>
                                        <?php  $checkedvalue="";} ?>
                    
                                    </div>
                    
                                 </div>
                     
                     
                            </div>
                        </div>
                  
                    </div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="brochure" class="col-lg-4 control-label">Brochure</label>
								<div class="col-lg-8">
									<input type="file" class="form-control" id="brochure" name="brochure"  accept = "application/pdf" />
								</div>
							</div>
						</div>
						<?php 
						
						if(!empty($data['brochure'])){
						?>
							<div class="col-md-6">
								<div class="form-group">
									<div class="col-lg-12">
										<a class="btn btn-primary" href="<?php echo $base_url.'/brochure-Img/'.$data['brochure'];?>" target="_blank"><i class="fa fa-download"></i>&nbsp;&nbsp;<?php echo $data['brochure'];?></a>
									</div>
								</div>
							</div>
						<?php
						}
						?>
						</div>
						<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="pricelist" class="col-lg-4 control-label">Price List</label>
								<div class="col-lg-8">
									<input type="file" class="form-control" id="pricelist" name="pricelist" accept = "application/pdf"/>
								</div>
							</div>
						</div>
						<?php 
						if(!empty($data['pricelist'])){
						?>
						<div class="col-md-6">
							<div class="form-group">
								<div class="col-lg-12">
									<a class="btn btn-primary" href="href="<?php echo $base_url.'/pricelist-Img/'.$data['pricelist'];?>"" target="_blank"><i class="fa fa-download"></i>&nbsp;&nbsp;<?php echo $data['pricelist'];?></a>
								</div>
							</div>
						</div>
						<?php
						}
						?>
					</div>
                    <!--
				  	<div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <label for="name" class="col-lg-2 control-label">Property Feature</label>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <?php
                                        /*$mychecklistquery=mysqli_query($con,"SELECT `id`,`name` FROM `property_features` ORDER BY `id` DESC ") or die(mysqli_error($con));
                                        $checkedvalue="";
                                        $datachecklist=array();
                                        
                                        while($checkResult=mysqli_fetch_array($mychecklistquery)){
                                            
                                            $mycheckdlistquery=mysqli_query($con,"SELECT `feature_id` FROM `property_feature_checklist` where property_id = '".$id."' ORDER BY `feature_id` ASC ") or die(mysqli_error($con));
                                            
                                            while($checklistrow = mysqli_fetch_assoc($mycheckdlistquery) ){
                                                $datachecklist[] = $checklistrow['feature_id'];
                                            }
                                            
                                            if(in_array($checkResult['id'],$datachecklist)){
                                                $checkedvalue="checked";
                                            }*/
                                        
                                        ?>
                                        <div class="col-md-4">
                                            <div class="mmstatuscb">
                                                <input type="checkbox" name="property_feature_checklist[]" id="property_feature_checklist<?php echo $checkResult['id'];?>" value="<?php echo $checkResult['id'];?>" class="icheckbox_flat-green" <?php echo $checkedvalue; ?> />
                                                <label for="property_feature_checklist<?php echo $checkResult['id'];?>"> &ensp;<?php echo $checkResult['name'];?> </label>
                                            </div>
                                        </div>
                                         <?php // $checkedvalue="";} ?>
                            
                                     </div>
                                </div>
                            </div>
                        </div>
                  </div>-->
					
					  <!--  -->
					<div class="row">
						<div class="col-md-6">
                         <div class="form-group"> 
                                	<label class="control-label col-lg-4" for="productName">Featured Image</label>
                                <div class="col-lg-8">

                                    <div class="fileinput fileinput-new fileinputCat3" data-provides="fileinput">
                                       <div><span>Maximum Image Upload Size is <code>1MB</code></span></div>
                                       <!--<div><span>Image Width : <code>748px</code> Height : <code> 380px</code></span></div>-->
                                        <div id="dvPreview" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                           <?php $blogImg="feature-Img";?>
                                           <?php if (isset($data['feature_image']) && $data['feature_image'] != '') { ?>
                                                <img src="../<?php echo $blogImg."/".$data['feature_image']; ?>"/>
                                            <?php } else { ?>
                                                <img src="http://www.placehold.it/200x150/3c8dbc/fff&text=Image"/>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div>
                                            <span class="btn btn-default btn-file"><span class="fileinput-new">Browse Image</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" id="imgUpload" name="featured_image" onclick="getImage3();" accept=".jpg, .jpeg, .png, .gif" /></span>
                                             <?php if (isset($data['feature_image']) && $data['feature_image'] != '')  { ?>
                                                <a href="javascript:void(0);" class="btn btn-default" data-dismiss="fileupload" id="oldImage3" onclick="clearImage3()">Clear</a>
                                            <?php } ?>
                                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
										<?php if (isset($data['feature_image']) && $data['feature_image'] != '') { ?>
                                            <input type="hidden" name="existImage3" id="existImage3" value="<?php echo $data['feature_image']; ?>"/>
                                            <input type="hidden" name="removedImage3" id="removedImage3" value="<?php echo $data['feature_image']; ?>"/>
                                        <?php } ?>
                                        
                                     </div>
                                 </div>
                        </div>
                      </div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="name" class="col-lg-2 control-label">Description</label>
								<div class="col-lg-8">
									<p> <strong>Please note </strong>: Do not copy and paste content from Microsoft Word or Google Docs, the formatting might come out badly. Paste content in a notepad and then paste here and then do formatting in the editor below</p>	
									<textarea class="form-control" id="mainDescription" name="mainDescription" rows="3" title="Please enter description"><?php if(isset($data['mainDescription'])){if($data['mainDescription']!=''){echo $data['mainDescription'];}}?></textarea>
								</div>
							</div>
						</div>
					</div>
                    <input type="hidden" name="id" id="id" value="<?php echo $id1; ?>"/>
                    <input type="hidden" name="property_id" id="property_id" value="<?php echo $id; ?>"/>

                    <div class="box-footer">
                        <input type="submit" name="submit" class="btn btn-info" value="Save Changes">
                        <input type="reset" name="reset" class="btn bg-primary" value="Reset">
                    </div>
                    
                </form>
                            </div><!-- /.box -->
        </div><!--/.col (left) -->
</section><!-- /.content -->
</aside>
<script type="text/javascript" src="dist/js/jquery.multiselect.js"></script>
<script type="text/javascript" src="dist/js/jquery.multiselect.filter.js"></script>
<script type="text/javascript" src="dist/js/jquery.fastconfirm.js"></script>
<script type="text/javascript" src="dist/js/slug.js"></script>
<script type="text/javascript" src="dist/js/jquery.blockUI.js"></script>
<script src="//cdn.ckeditor.com/4.5.9/full/ckeditor.js"></script>
<script>
$(document).ready(function () {
	$(".select2").select2();
	CKEDITOR.replace('mainDescription');
	$(".textarea").wysihtml5();
	
	$("#house_number_name,#street").on('keyup keydown blur',function(){
		var values = $("#house_number_name, #street").map(function(){
			return this.value;
		}).get().join(" ");
		$('#propertyAddress').val(values).trigger("keyup");
	}),
	$("#propertyAddress").stringToSlug({
		setEvents:"keyup keydown blur",
		getPut: "#propertySlug"
	});
	
	$("#date_available").datepicker( {dateFormat:"dd-mm-yy",});
	 
	
}) 
function clearImage1() {
        $('.fileinputCat1').fileinput('clear');
        $("#oldImage1").addClass("hide");
        $('#existImage1').val('');
    }
    
    function getImage1() {
        $('.fileinputCat1').fileinput('clear');
        $("#oldImage1").addClass("hide");
        $('#existImage1').val('');
    }
	
	function clearImage2() {
        $('.fileinputCat2').fileinput('clear');
        $("#oldImage2").addClass("hide");
        $('#existImage2').val('');
    }
    
    function getImage2() {
        $('.fileinputCat2').fileinput('clear');
        $("#oldImage2").addClass("hide");
        $('#existImage2').val('');
    }
	
	function clearImage3() {
        $('.fileinputCat3').fileinput('clear');
        $("#oldImage3").addClass("hide");
        $('#existImage3').val('');
    }
    
    function getImage3() {
        $('.fileinputCat3').fileinput('clear');
        $("#oldImage3").addClass("hide");
        $('#existImage3').val('');
    }
</script>

<?php
include "footer.php";
?>