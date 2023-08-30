<?php include_once'header-top.php'; 

$ID = 4;

if(isset($_GET['id'])&&$_GET['id']>0){
	$ID = $_GET['id'];
}
$SQL = "select * from `property` where id=".$ID;
$Query = mysqli_query($con,$SQL);
if(mysqli_num_rows($Query)>0){
	$DATA['property_detail'] = mysqli_fetch_assoc($Query);	
	$PropertyDetail = $DATA['property_detail'];	
	$Address = $PropertyDetail['house_number_name'].' ';
	$Address .= $PropertyDetail['street'].', ';
	$Address .= $PropertyDetail['town_city'].', ';
	$Address .= $PropertyDetail['county'].', ';
	$Address .= $PropertyDetail['postcode'];
	$DATA['property_detail']['Address'] = $Address;
	
	if($PropertyDetail['sale_rent_flag']==1){
		$DATA['property_detail']['SALEorRENT'] = "For Sale";
		$DATA['property_detail']['Price'] = $PropertyDetail['sale_price'];
	}
	else{
		$DATA['property_detail']['SALEorRENT'] = "To Let";
		$DATA['property_detail']['Price'] = $PropertyDetail['rent_price'];
	}
	
}

$SQL = "select name from `property_feature_checklist` as `checklist` LEFT JOIN `property_features` as feature  ON checklist.feature_id =feature.id where   `checklist`.`property_id`=".$ID;
$Query = mysqli_query($con,$SQL);
if(mysqli_num_rows($Query)>0){
	$I=0;
	while($row = mysqli_fetch_assoc($Query)){
		$DATA['property_features'][$I] = $row;
		$I++;		
	}
}

$SQL = "select name from `property_type_checklist` as `checklist` LEFT JOIN `property_type_master` as master ON checklist.type_id =master.id where `checklist`.`property_id`=".$ID;
$Query = mysqli_query($con,$SQL);
if(mysqli_num_rows($Query)>0){
	$I=0;
	while($row = mysqli_fetch_assoc($Query)){
		$DATA['property_type'][$I] = $row;
		$I++;		
	}
}

$SQL = "select image from `property_imgs` where status=1 and `property_id`=".$ID. ' Order by created_on desc' ;
$Query = mysqli_query($con,$SQL);
if(mysqli_num_rows($Query)>0){
	$I=0;
	while($row = mysqli_fetch_assoc($Query)){
		$DATA['property_img'][$I] = $row;
		$I++;		
	}
}

// echo '<pre>';print_r($DATA);exit;

?>

<title>Detail | Bajrang Property</title>
<meta name="description" content="">
<meta name="keyword" content="">

<?php include_once'header.php'; ?>

<section class="pager-sec bfr">
    <div class="container">
        <div class="pager-sec-details">
            <h3>Detail</h3>
            <ul>
                <li><a href="index.php" title="">Home</a></li>
                <li><span>Detail</span></li>
            </ul>
        </div>
    </div>
</section>

<section class="property-single-pg">
    <div class="container">
        <div class="property-hd-sec">
            <div class="card">
                <div class="card-body">
                   <a href="#">
                   <!--     <h3>Traditional Apartments</h3> -->
                        <p><i class="la la-map-marker"></i><?php echo isset($DATA['property_detail']['Address'])?($DATA['property_detail']['Address']!=''?$DATA['property_detail']['Address']:''):'';?></p>
                    </a>
                    <ul>
                        <li><?php echo isset($DATA['property_detail']['bathrooms'])?($DATA['property_detail']['bathrooms']!=''?$DATA['property_detail']['bathrooms']:'N/A'):'N/A';?> Bathrooms</li>
                        <li><?php echo isset($DATA['property_detail']['bedrooms'])?($DATA['property_detail']['bedrooms']!=''?$DATA['property_detail']['bedrooms']:'N/A'):'N/A';?> Beds</li>
							<!--<li>Area 555 Sq Ft</li>-->
                    </ul>
                </div>
                <!--card-body end-->
                <div class="rate-info">
                    <h5><?php echo isset($DATA['property_detail']['Price'])?'$'.number_format($DATA['property_detail']['Price'],2,'.',','):'';?></h5>
                    <span><?php echo isset($DATA['property_detail']['SALEorRENT'])?$DATA['property_detail']['SALEorRENT']:'';?></span>
                    <a data-toggle="modal" data-target="#exampleModalCenter" href="#" title="" class="btn2 btn3">
                        <span>Ask a Question</span>
                    </a>

                </div>
                <!--rate-info end-->
            </div>
            <!--card end-->
        </div>
        <!---property-hd-sec end-->
        <div class="property-single-page-content">
            <div class="row">
                <div class="col-lg-8 pl-0 pr-0">
                    <div class="property-pg-left">
                        <div class="property-imgs">
                            <div class="property-main-img">
							
							<?php 
								if(isset($DATA['property_img'])){
									if(count($DATA['property_img'])>0){
										foreach($DATA['property_img'] as $img){
							?>
								<div class="property-img">
                                    <img src="<?php echo "property-photo-gallery/".$img;?>" alt="">
                                </div>
									
								
							<?php
										}
									}
								}
							?>
							
							<!--
							
                                <div class="property-img">
                                    <img src="assets/images/resources/blog-img.jpg" alt="">
                                </div>
                               
                                <div class="property-img">
                                    <img src="assets/images/resources/blog-img2.jpg" alt="">
                                </div>
                               
                                <div class="property-img">
                                    <img src="assets/images/resources/blog-img3.jpg" alt="">
                                </div>
                              
                                <div class="property-img">
                                    <img src="assets/images/resources/blog-img4.jpg" alt="">
                                </div>
                               
                                <div class="property-img">
                                    <img src="assets/images/resources/blog-img5.jpg" alt="">
                                </div>
								
							-->	
                               
                            </div>
                            <!--property-main-img end-->
                            <div class="property-thumb-imgs">
                                <div class="row thumb-carous">
								
								<?php 
								if(isset($DATA['property_img'])){
									if(count($DATA['property_img'])>0){
										foreach($DATA['property_img'] as $img){
							?>
								<div class="col-lg-4 col-md-4 col-sm-4 col-4 thumb-img">
                                    <div class="property-img">
										<img src="<?php echo "property-photo-gallery/".$img;?>" alt="">
									</div>
                                </div>
									
								
							<?php
										}
									}
								}
							?>
							
								
								
								
								
								
								
								<!--
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-4 thumb-img">
                                        <div class="property-img">
                                            <img src="assets/images/resources/blog-img.jpg" alt="">
                                        </div>
                                       
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-4 thumb-img">
                                        <div class="property-img">
                                            <img src="assets/images/resources/blog-img2.jpg" alt="">
                                        </div>
                                        
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-4 thumb-img">
                                        <div class="property-img">
                                            <img src="assets/images/resources/blog-img3.jpg" alt="">
                                        </div> 
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-4 thumb-img">
                                        <div class="property-img">
                                            <img src="assets/images/resources/blog-img4.jpg" alt="">
                                        </div>
                                        
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-4 thumb-img">
                                        <div class="property-img">
                                            <img src="assets/images/resources/blog-img5.jpg" alt="">
                                        </div>
                                      
                                    </div>
									-->
                                </div>
                            </div>
                            <!--property-thumb-imgs end-->
                        </div>
                        <!--property-imgs end-->
                        <div class="descp-text">
                            <h3>Description</h3>
                            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequa ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat cons equat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himen aeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue.</p>
                        </div>
                        <!--descp-text end-->
                        <div class="details-info">
                            <h3>Detail</h3>
                            <ul>
                                <li>
                                    <h4>Construction Tyoe:</h4>
                                    <span>Condo</span>
                                </li>
                                <li>
                                    <h4>Year Built:</h4>
                                    <span>2012</span>
                                </li>
                                <li>
                                    <h4>Units in Building: </h4>
                                    <span>87</span>
                                </li>
                                <li>
                                    <h4>Bathrooms:</h4>
                                    <span>5</span>
                                </li>
                                <li>
                                    <h4>Badrooms:</h4>
                                    <span>7</span>
                                </li>
                                <li>
                                    <h4>Flooring:</h4>
                                    <span>555 Sq Ft</span>
                                </li>
                                <li>
                                    <h4>Amenities:</h4>
                                    <span>Elevator</span>
                                </li>
                                <li>
                                    <h4>Cooling:</h4>
                                    <span>Central Cooling</span>
                                </li>
                                <li>
                                    <h4>Other Features:</h4>
                                    <span>Fireplace</span>
                                </li>
                            </ul>
                        </div>
                        <!--details-info end-->
                        <div class="features-dv">
                            <h3>Features</h3>
                            <form class="form_field">
                                <ul>
                                    <li class="input-field">
                                        <input type="checkbox" name="cc" id="c1">
                                        <label for="c1">
                                            <span></span>
                                            <small>Parking</small>
                                        </label>
                                    </li>
                                    <li class="input-field">
                                        <input type="checkbox" name="cc" id="c2" checked>
                                        <label for="c2">
                                            <span></span>
                                            <small>Gym</small>
                                        </label>
                                    </li>
                                    <li class="input-field">
                                        <input type="checkbox" name="cc" id="c3">
                                        <label for="c3">
                                            <span></span>
                                            <small>Heating</small>
                                        </label>
                                    </li>
                                    <li class="input-field">
                                        <input type="checkbox" name="cc" id="c4" checked>
                                        <label for="c4">
                                            <span></span>
                                            <small>Air Conditioner</small>
                                        </label>
                                    </li>
                                    <li class="input-field">
                                        <input type="checkbox" name="cc" id="c5" checked>
                                        <label for="c5">
                                            <span></span>
                                            <small>Wireless Internet</small>
                                        </label>
                                    </li>
                                    <li class="input-field">
                                        <input type="checkbox" name="cc" id="c6">
                                        <label for="c6">
                                            <span></span>
                                            <small>Swimming Pool</small>
                                        </label>
                                    </li>
                                </ul>
                            </form>
                        </div>
                        <!--features-dv end-->
                        <div class="floorplan">
                            <h3>floorplan</h3>
                            <img src="assets/images/resources/prop-map.png" alt="">
                        </div>

                    </div>
                    <!--property-pg-left end-->
                </div>
                <div class="col-lg-4 pr-0">
                    <div class="sidebar layout2">

                        <div class="widget widget-posts">
                            <h3 class="widget-title">Popular Listings</h3>
                            <ul>
                                <li>
                                    <div class="wd-posts">
                                        <div class="ps-img">
                                            <a href="14_Blog_Open.html" title="">
                                                <img src="assets/images/resources/p-img1.png" alt="">
                                            </a>
                                        </div>
                                        <!--ps-img end-->
                                        <div class="ps-info">
                                            <h3><a href="14_Blog_Open.html" title="">Traditional Apartments</a></h3>
                                            <strong>$125.700</strong>
                                            <span><i class="la la-map-marker"></i>212 5th Ave, New York</span>
                                        </div>
                                        <!--ps-info end-->
                                    </div>
                                    <!--wd-posts end-->
                                </li>
                                <li>
                                    <div class="wd-posts">
                                        <div class="ps-img">
                                            <a href="14_Blog_Open.html" title="">
                                                <img src="assets/images/resources/p-img2.png" alt="">
                                            </a>
                                        </div>
                                        <!--ps-img end-->
                                        <div class="ps-info">
                                            <h3><a href="14_Blog_Open.html" title="">Traditional Apartments</a></h3>
                                            <strong>$125.700</strong>
                                            <span><i class="la la-map-marker"></i>212 5th Ave, New York</span>
                                        </div>
                                        <!--ps-info end-->
                                    </div>
                                    <!--wd-posts end-->
                                </li>
                                <li>
                                    <div class="wd-posts">
                                        <div class="ps-img">
                                            <a href="14_Blog_Open.html" title="">
                                                <img src="assets/images/resources/p-img3.png" alt="">
                                            </a>
                                        </div>
                                        <!--ps-img end-->
                                        <div class="ps-info">
                                            <h3><a href="14_Blog_Open.html" title="">Traditional Apartments</a></h3>
                                            <strong>$125.700</strong>
                                            <span><i class="la la-map-marker"></i>212 5th Ave, New York</span>
                                        </div>
                                        <!--ps-info end-->
                                    </div>
                                    <!--wd-posts end-->
                                </li>
                            </ul>
                        </div>
                        
                        <div class="widget widget-posts mbp-dv">
                            <h3 class="widget-title">Location</h3>                                                    
                            <div id="">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2540.959963607442!2d-104.61053638414235!3d50.44184639586561!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x531c1e395d6dc747%3A0xc5fd1fe59853d293!2s4540%20Rose%20St%2C%20Regina%2C%20SK%20S4P%202B1%2C%20Canada!5e0!3m2!1sen!2sin!4v1617964764086!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>                                
                            </div>
                        </div>
                    </div>
                    <!--sidebar end-->
                </div>
            </div>
        </div>
        <!--property-single-page-content end-->
    </div>
</section>

<?php include_once'footer.php'; ?>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Ask a Question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-field">
                                <input type="text" name="" placeholder="First Name">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-field">
                                <input type="text" name="" placeholder="Last Name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-field">
                                <input type="text" name="" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-field">
                                <input type="text" name="" placeholder="Phone">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-field">
                                <input type="text" name="password" placeholder="Password">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn2">Submit</button>
            </div>
        </div>
    </div>
</div>