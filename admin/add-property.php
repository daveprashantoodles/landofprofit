<?php
include "header.php";
include "sidebar.php";
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
				// remote:{
				// 	 url: 'checkDuplicatePropertySlug.php',
				// 	data: { property_id: 0}
				// }
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
				// remote: "Slug is already exist.",
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
    <h1>Add Property<!--<small>Preview</small>--></h1>
</section>
<!-- Main content -->
<section class="content">

    <!-- left column -->
    <div class="">
        <!-- general form elements -->
        <div class="box">
           <!-- <div class="box-header">
                <h3 class="box-title">Add Property</h3><div class="pull-right" style="font-size:15px;"><span class="mandatory">*</span> indicates required field &nbsp;</div> 
            </div>
			-->
			<!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                <form role="form" class="form-horizontal" name="main_form" id="main_form"  method="post" action="./property-process.php" autocomplete="off" enctype="multipart/form-data">
				
				
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
									<input type="text" class="form-control PlaceAutoComplete pac-target-input" id="postcode" name="postcode" placeholder="Enter a Postcode	" autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="propertySlug" class="col-sm-4 control-label">Property Slug <span class="mandatory">*</span></label>
								<div class="col-sm-8">
									<input type="text" class="form-control isRequired" id="propertySlug" name="propertySlug" placeholder="Property slug" title="Please enter Property Slug" />
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="house_number_name" class="col-lg-4 control-label">House number/name<span class="mandatory">*</span></label>
								<div class="col-lg-8">
									<input type="text" class="form-control" id="house_number_name" name="house_number_name" placeholder="Enter House number/name" autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="street" class="col-sm-4 control-label">Street<span class="mandatory">*</span></label>
								<div class="col-sm-8">
									<input type="text" class="form-control isRequired" id="street" name="street" placeholder="Enter Street" title="Please enter Street" />
								</div>
							</div>
						</div>
					</div>
					
					<input type="hidden" name="propertyAddress" id="propertyAddress" value="">
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="town_city" class="col-lg-4 control-label">Town/city<span class="mandatory">*</span></label>
								<div class="col-lg-8">
									<input type="text" class="form-control" id="town_city" name="town_city" placeholder="Enter Town/city" title="Enter Town/city" autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="county" class="col-sm-4 control-label">County<span class="mandatory">*</span></label>
								<div class="col-sm-8">
									<input type="text" class="form-control isRequired" id="county" name="county" placeholder="Enter County" title="Please enter County" />
								</div>
							</div>
						</div>
					</div>
					</div>
					</div>
					<!--
					<div class="col-md-12" >
					<div class="box box-info">
					<div class="box-header">
						<h3 class="box-title">Geo Location</h3>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="latitude" class="col-sm-4 control-label">Latitude<span class="mandatory"></span></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="latitude" name="latitude" placeholder="Enter Latitude" title="Please enter Latitude" />
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="longitude" class="col-sm-4 control-label">Longitude<span class="mandatory"></span></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="longitude" name="longitude" placeholder="Enter Longitude" title="Please enter Longitude" />
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
								<label for="map_iframe" class="col-sm-2 control-label">Iframe<span class="mandatory"></span></label>
								<div class="col-sm-10">
									<textarea class="form-control" id="map_iframe" name="map_iframe" rows="3" title="Please enter iframe"></textarea>
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
									<input type="text" class="form-control" id="rent_price" name="rent_price" placeholder="Enter Rent Price(PCM) " title="Enter Rent Price(PCM) " autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="deposit_amount" class="col-lg-4 control-label">Deposit Amount<span class="mandatory"></span></label>
								<div class="col-lg-8">
									<input type="text" class="form-control" id="deposit_amount" name="deposit_amount" placeholder="Enter Deposit Amount " title="Enter Deposit Amount" autocomplete="off">
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
										<option value="1">Yes</option>
										<option value="0">No</option>
									
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
										<option value="1">Yes</option>
										<option value="0">No</option>
									
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
								<label for="sale_price" class="col-sm-4 control-label">List Price<span class="mandatory"></span></label>
								<div class="col-sm-8">
									<input type="text" class="form-control isRequired" id="sale_price" name="sale_price" placeholder="Enter Sale Price" title="Please enter Sale Price" />
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
								<label for="bedrooms" class="col-lg-4 control-label">No of Bedrooms<span class="mandatory">*</span></label>
								<div class="col-lg-8">
									<input type="number" class="form-control" id="bedrooms" name="bedrooms" placeholder="Enter the number of bedrooms in your property" title="Enter the number of bedrooms in your property" autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="bathrooms" class="col-sm-4 control-label">No of Bathrooms<span class="mandatory">*</span></label>
								<div class="col-sm-8">
									<input type="number" class="form-control isRequired" id="bathrooms" name="bathrooms" placeholder="Enter the number of bathrooms in your property " title="Enter the number of bathrooms in your property" />
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<!--<div class="col-md-6">
							<div class="form-group">
								<label for="reception_rooms" class="col-lg-4 control-label">No of Reception Rooms<span class="mandatory"></span></label>
								<div class="col-lg-8">
									<input type="number" class="form-control" id="reception_rooms" name="reception_rooms" placeholder="Enter the number of Reception Rooms in your property" title="Enter the number of Reception Rooms in your property" autocomplete="off">
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
										<option value="1">Yes</option>
										<option value="0">No</option>
									
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
										<option value="1">Yes</option>
										<option value="0">No</option>
									
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
										<option value="1">Sale</option>
										<option value="0">Rent</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						
						<div class="col-md-6">
							<div class="form-group">
								<label for="date_available" class="col-sm-4 control-label">Date Available<span class="mandatory"></span></label>
								<div class="col-sm-8">
									<input type="text" class="form-control isRequired" id="date_available" name="date_available" placeholder="Enter the date the property will become available" title="Enter the date the property will become available" value="<?php echo date("d-m-Y");?>" />
								</div>
							</div>
						</div>
                        <div class="col-md-6">
							<div class="form-group">
								<label for="built_in" class="col-lg-4 control-label">Built In<span class="mandatory"></span></label>
								<div class="col-lg-8">
                                <input type="text" class="form-control isRequired" id="built_in" name="built_in" placeholder="ex: 2023"/>
								
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="gross_yield" class="col-lg-4 control-label">Gross Yield(%)<span class="mandatory"></span></label>
								<div class="col-lg-8">
                                <input type="text" class="form-control isRequired" id="gross_yield" name="gross_yield" placeholder="ex: 8.3"/>
								
								</div>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label for="cap_rate" class="col-lg-4 control-label">Cap Rate(%)<span class="mandatory"></span></label>
								<div class="col-lg-8">
									<input type="text" class="form-control isRequired" id="cap_rate" name="cap_rate" placeholder="ex: 8.3"/>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="hoa" class="col-lg-4 control-label">HOA<span class="mandatory"></span></label>
								<div class="col-lg-8">
									<select name="hoa" id="hoa" class="select2" style="width:100%;">
										<option value="y">Yes</option>
										<option value="n" selected>No</option>
									</select>
								</div>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label for="sale_rent_flag" class="col-lg-4 control-label">Area<span class="mandatory"></span></label>
								<div class="col-lg-8">
                                <input type="text" class="form-control isRequired" id="area" name="area" placeholder="Area in SQRT" title="Area in SQRT"  />
								</div>
							</div>
						</div>
					</div>
				
					
					<div class="row">
						<div class="col-md-6">
                         <div class="form-group"> 
                                	<label class="control-label col-lg-4" for="productName">Featured Image</label>
                                <div class="col-lg-8">

                                    <div class="fileinput fileinput-new fileinputCat3" data-provides="fileinput">
                                       <div><span>Maximum Image Upload Size is <code>1MB</code></span></div>
                                      <!-- <div><span>Image Width : <code>748px</code> Height : <code> 380px</code></span></div>-->
                                        <div id="dvPreview" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                           <img src="http://www.placehold.it/200x150/3c8dbc/fff&text=Image"/>
                                        </div>
                                        <div>
                                            <span class="btn btn-default btn-file"><span class="fileinput-new">Browse Image</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" id="imgUpload" name="featured_image" onclick="getImage3();" accept=".jpg, .jpeg, .png, .gif" /></span>
                                            
                                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                        
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
						<div class="col-md-6">
							<div class="form-group">
								<label for="pricelist" class="col-lg-4 control-label">Price List</label>
								<div class="col-lg-8">
									<input type="file" class="form-control" id="pricelist" name="pricelist" accept = "application/pdf"/>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="mainDescription" class="col-lg-2 control-label">Description</label>
								<div class="col-lg-8">
									<p> <strong>Please note </strong>: Do not copy and paste content from Microsoft Word or Google Docs, the formatting might come out badly. Paste content in a notepad and then paste here and then do formatting in the editor below</p>	
									<textarea class="form-control" id="mainDescription" name="mainDescription" rows="3" title="Please enter description"></textarea>
								</div>
							</div>
						</div>
					</div>
                    <div class="box-footer">
                        <input type="submit" name="submit" class="btn btn-info" value="Submit">
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
	$("#date_available").datepicker( {
		dateFormat:"dd-mm-yy",
	});
	

}) 

function getImage1() {
	$('.fileinputCat1').fileinput('clear');
}
function getImage2() {
	$('.fileinputCat2').fileinput('clear');
}
function getImage3() {
	$('.fileinputCat3').fileinput('clear');
}

</script>

<?php
include "footer.php";
?>