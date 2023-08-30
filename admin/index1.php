<?php include 'header-top.php'; ?>
<title>Accounting Service | Bookkeeping | GoRings Accountants</title>
<meta name="description" content="We offer a wide range of accounting services in London, including Payroll, VAT, Accounts, and Tax Returns. We also offer a service where we take care of all your accounting needs.">
<?php include 'css.php'; ?>
<?php include 'header.php'; ?>
 <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<section class="home-slider">
	<div class="swiper mySwiper mySlider">
		<div class="swiper-wrapper">
			<?php 
			$sliderSql = "select * from banner where publish = 1 order by id desc";
			$sliderquery = mysqli_query($con,$sliderSql);
			if(mysqli_num_rows($sliderquery)>0)
			{
				while($banner = mysqli_fetch_assoc($sliderquery))
				{
			?>
			<div class="swiper-slide">
				<div class="slide-img">
					<img src="<?php echo $base_url.'/'.$bannerImg.'/'.$banner['image'];?>">
				</div>
				<div class="container">
					<div class="row slider-content">
						<div class="col-lg-6 mobile-none"></div>
						<div class="col-lg-6">
							<h3><?php echo isset($banner['text1'])?$banner['text1']:"";?> </h3>
							<h2><?php echo isset($banner['text2'])?$banner['text2']:"";?></h2>
							<p class="text"><?php echo isset($banner['text3'])?html_entity_decode($banner['text3']):"";?></p>
							<div class="btn-box">
								<button class="side-bar-btn"><a href="javascript:void(0)">Services</a></button>
								<button class="side-bar-btn light"><a href="<?php echo $base_url.'/contacts';?>">Contact Us</a></button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php	
				}
			}			
			?>
		</div>
		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
	</div>
</section>
<section class="home-about-section container section-margin">
	<div class="row">
		<div class="col-lg-6">
			<div class="images-block">
				<div class="img-one" data-aos="fade-right" data-aos-duration="2000">
					<div class="sub-img">
						<img src="<?php echo $base_url;?>/assets/images/other/office-interior.jpg">
					</div>
				</div>
				<div class="img-two" data-aos="fade-right" data-aos-duration="2000">
					<div class="sub-img">
						<img src="<?php echo $base_url;?>/assets/images/other/office-exterior.jpg">
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<?php 
			$SQL123 = "select * from home_page where id =1";
			$QUERY123 = mysqli_query($con,$SQL123);
			$home_page_details = mysqli_fetch_assoc($QUERY123);	
			echo '<pre>';print_r($home_page_details);exit;
			
			?>
		
			<div class="sec-title">
				<h1>Professional and <br> dedicated accounting services</h1>
				<div class="text-decoration">
					<span class="left"></span>
					<span class="right"></span>
				</div>
				<div class="text">Our services will give you peace of mind and trustworthy service as well as more complex accounting services which you thought you can only get by using a professional chartered accountant in London.</div>
				<div class="text two">Contact us if you need a professional accountant for bookkeeping, company accounts, self assessment, vat return, or business loan application accountant for your business.</div>
			</div>
			<div class="row">                        
				<div class="col-lg-6 col-sm-12">
					<div class="text-block">
						<span class="icon"><i class="fa-solid fa-magnifying-glass"></i></span>
						<div class="textin">
							<h5>Industries Covered</h5>
							<h4>Focused on Industries</h4>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-sm-12">
					<div class="text-block">
						<span class="icon"><i class="fa-solid fa-gears"></i></span>
						<div class="textin">
							<h5>our expertise</h5>
							<h4>High level of knowledge</h4>
						</div>
					</div>
				</div>                                            
			</div>
		</div>
	</div>
</section>
<section class="couter-section" id="">
	<div class="container">
		<div class="fact-counter">
			<div class="row">
				<div class="column counter-column col-lg-4">
					<div class="inner">
						<div class="content">
							<div class="icon-box">
								<div class="counter-title">Accounting Tasks<br>with 100% satisfaction</div>
							</div>                                    
							<div class="count-outer count-box counted">
								<span class="count-text counter-value" data-count="2.5"></span><span>K</span>
							</div>
							<div class="text">More than 10+ accounting tasks at a time</div>
						</div>
					</div>
				</div>
				<div class="column counter-column col-lg-4">
					<div class="inner">
						<div class="content">
							<div class="icon-box">
								<div class="counter-title">Experienced & <br>Professional Team</div>
							</div>                                    
							<div class="count-outer count-box counted">
								<span class="count-text counter-value" data-count="38"></span><span>+</span>
							</div>
							<div class="text">One contact for all your accounting needs</div>
						</div>
					</div>
				</div>
				<div class="column counter-column col-lg-4">
					<div class="inner">
						<div class="content">
							<div class="icon-box">
								<div class="counter-title">Good accuracy for all accounting needs</div>
							</div>                                    
							<div class="count-outer count-box counted">
								<span class="count-text counter-value" data-count="99.9"></span><span>%</span>
							</div>
							<div class="text">100+ cases handled for loan applications and tax refund</div>
						</div>
					</div>
				</div>                                   
			</div>
		</div>
	</div>
</section>
<section class="why-choose-section">
	<div class="pattern"></div>
	<div class="side-image"><img src="<?php echo $base_url;?>/assets/images/other/video-bg-2.jpg" alt="Awesome Image"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-6 order-lg-2">
				<div class="sec-title light">
					<h2>Why GoRings Accountants ?</h2>
					<div class="text-decoration">
						<span class="left"></span>
						<span class="right"></span>
					</div>
				</div>
				<ul class="features-list">
					<li class="single-feature-item">
						<i class="fa-solid fa-check-double"></i>
						<h5>Competitive</h5>
						<span class="text">Cost effective and low accountancy service fees</span>
					</li>
					<li class="single-feature-item">
						<i class="fa-solid fa-check-double"></i>
						<h5>Professional</h5>
						<span class="text">Only experienced and professional accountants</span>
					</li>
					<li class="single-feature-item">
						<i class="fa-solid fa-check-double"></i>
						<h5>Covenient</h5>
						<span class="text">Available on-site or off-site​ chartered accountants</span>
					</li>
				</ul>
			</div>
			<div class="col-lg-6">
				<div class="consult-form">
					<div class="contact-form">
						<form id="contactus_form" class="needs-validation" method="post" action="contact-exe.php" novalidate>
							<h2>Request for Our <br>Free Consultation</h2>
							<div class="row">
								<div class="col-md-6 form-group">
									<input type="text" name="fname" id="fname" class="form-control" placeholder="Your First Name*" required>
									<div class="invalid-feedback">
										This field is required.
									</div>
								</div>
								<div class="col-md-6 form-group">
									<input type="text" name="lname" id="lname" class="form-control" placeholder="Your Last Name*" required>
									<div class="invalid-feedback">
										This field is required.
									</div>
								</div>
								<div class="col-md-6 form-group">
									<input type="email" name="email" id="email" class="form-control" placeholder="example@example.com*" required>
									<div class="invalid-feedback">
										This field is required.
									</div>
								</div>
								<div class="col-md-6 form-group">
									<input type="text" name="phone" id="phone"class="form-control" placeholder="Phone*" required >
							        <div class="invalid-feedback">
										This field is required.
									</div>
								</div>
								<div class="col-md-6 form-group">
									<select name="service" id="service" class="form-control" required>
										<option value="">Choose Service</option>
										<option value="Business Loans">Business Loans</option>
										<option value="Payroll">Payroll</option>
										<option value="Self-Assessment">Self-Assessment</option>
										<option value="VAT Returns">VAT Returns</option>
										<option value="Company Accounts">Company Accounts</option>
										<option value="Bookkeeping">Bookkeeping</option>
									</select>
									<div class="invalid-feedback">
										This field is required.
									</div>
								</div>
								<div class="col-sm-12 form-group">
									<div class="g-recaptcha" data-sitekey="6LcP-EMfAAAAAJurjhXfhoXfnG2d1yHEgFrgOgV3"></div>
									
								</div>
								<div class="col-sm-12 form-group">
									<button name="submit" type="submit" value="contact-form-submt-btn" class="side-bar-btn">Send Request</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="process-section section-padding">
	<div class="pattern"></div>
	<div class="container">
		<div class="sec-top row">
			<div class="sec-title col-md-6">
				<h2>Our Basic Work Process</h2>
			</div>
			<p class="text col-md-6">Contact us today to get a competitive quote for <br>accountancy services or <b> business loan application </b>accounting tasks</p>
		</div>
		<div class="row">
			<div class="col-lg-4 process-block-one">
				<div class="inner-box">
					<div class="icon">
						<i class="fa-solid fa-plus"></i>
					</div>
					<h5><span class="count">Step : 01.</span></h5>
					<h4>Plan for work</h4>
					<p class="text">Through plans, you break down a process into small and identify the things you accomplish..</p>
				</div>
			</div>
			<div class="col-lg-4 process-block-one">
				<div class="inner-box">
					<div class="icon">
						<i class="fa-solid fa-magnifying-glass"></i>
					</div>
					<h5><span class="count">Step : 02.</span></h5>
					<h4>Implementation</h4>
					<p class="text">To carry out activities put into action perform to implement a plan to execute the tasks. </p>
				</div>
			</div>
			<div class="col-lg-4 process-block-one">
				<div class="inner-box">
					<div class="icon">
						<i class="fa-solid fa-gem"></i>
					</div>
					<h5><span class="count">Step : 03.</span></h5>
					<h4>Final Submissions</h4>
					<p class="text">It involves handing over to customer, submitting to hmrc and passing the documentations to client.</p>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="feature-section-two">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 feature-block-two style-two">
				<div class="shape-box">
					<div class="inner-box">
						<div class="icon"><i class="fa-solid fa-user-check"></i></div>
						<h4>Accounting Services</h4>
						<p class="text">Professional accountants in London to help you with bookkeeping, payroll paye, tax filing, vat returns and company accounts.</p>
					</div>
				</div>
			</div>
			<div class="col-lg-6 feature-block-two style-two">
				<div class="shape-box">
					<div class="inner-box">
						<div class="icon"><i class="fa-solid fa-handshake"></i></div>
						<h4>Trusted &amp; Reliable Services</h4>
						<p class="text">We follow professionalized approach to provide reliable most trusted accounting services in London, UK.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="modal" id="inquiry_modal" tabindex="-1" aria-modal="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="contact-form-box">
			<div class="contact-form p-3">
				<form id="contactus_form" class="needs-validation" method="post" action="contact-exe.php" novalidate="">
					<h3>Inquiry Now</h3>
					<div class="row">
						<div class="col-md-6 form-group">
							<input type="text" name="fname" id="fname" class="form-control" placeholder="Your First Name*" required="">
							<div class="invalid-feedback">
								This field is required.
							</div>
						</div>
						<div class="col-md-6 form-group">
							<input type="text" name="lname" id="lname" class="form-control" placeholder="Your Last Name*" required="">
							<div class="invalid-feedback">
								This field is required.
							</div>
						</div>
						<div class="col-md-6 form-group">
							<input type="email" name="email" id="email" class="form-control" placeholder="example@example.com*" required="">
							<div class="invalid-feedback">
								This field is required.
							</div>
						</div>
						<div class="col-md-6 form-group">
							<input type="text" name="phone" id="phone" class="form-control" placeholder="Phone*" required >
							<div class="invalid-feedback">
								This field is required.
							</div>
						</div>
						<div class="col-md-12 form-group">
							<textarea name="message" id="message" class="form-control" rows="5" placeholder="Type here...*" required=""></textarea>
							<div class="invalid-feedback">
								This field is required.
							</div>
						</div>
						<div class="col-sm-12 form-group">
							<!--<div class="g-recaptcha" data-sitekey="6Lel4Z4UAAAAAOa8LO1Q9mqKRUiMYl_00o5mXJrR"></div>-->
							<div class="g-recaptcha" data-sitekey="6LcP-EMfAAAAAJurjhXfhoXfnG2d1yHEgFrgOgV3"></div>
						</div>
						<div class="col-sm-12 form-group">
							<button name="submit" type="submit" value="contact-form-submt-btn" class="side-bar-btn">Send Request</button>
						</div>
					</div>
				</form>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.1.0/js.cookie.js">-->
<script>
var myModal = document.getElementById('inquiry_modal')
var myInput = document.getElementById('fname')
myModal.addEventListener('shown.bs.modal', function () {
  myInput.focus()
})
document.addEventListener("DOMContentLoaded", function(event) { 
	setTimeout(function () {
		console.log(Cookies.get('isModal'))
		if(!Cookies.get('isModal')) {
			$('#inquiry_modal').modal('show');
			Cookies.set('isModal', true);
		}
	}, 5000);
});
</script>
<?php include 'footer.php'; ?>
<?php include 'footer-script.php'; ?>
<script>

// $(document).ready(function(){
	// setInterval(function () {$('#inquiry_modal').modal('show');}, 3000);
// });
</script>