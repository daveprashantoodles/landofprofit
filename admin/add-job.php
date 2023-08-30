<?php
include "header.php";
include "sidebar.php";
?>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css"/>
<link href="dist/css/jquery.multiselect.css" rel="stylesheet" type="text/css" media="screen" />
<link href="dist/css/jquery.fastconfirm.css" rel="stylesheet" type="text/css" media="screen" />
 
<script>
$(document).ready(function() {
	$("#jobform").validate({
		rules: {
			title: {
				required: true,
			},
			duration: {
				required: true,
			},
			location: {
				required: true,
			},
			positions: {
				required: true,
			},
			last_date: {
				required: true,
			},
			packages: {
				required: true,
			},
			
		},
		
		messages: {
			title: {
				required: "This field is required.",
			},
			duration: {
				required: "This field is required.",
			},
			location: {
				required: "This field is required.",
			},
			positions: {
				required: "This field is required.",
			},
			last_date: {
				required: "This field is required.",
			},
			packages: {
				required: "This field is required.",
			},
			
		}
	});
});   
</script>
<aside class="right-side">
	<section class="content-header">
		<h1>Job<!--<small>Preview</small>--></h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- general form elements -->
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Add Job</h3><div class="pull-right" style="font-size:15px;"><span class="mandatory">*</span> indicates required field &nbsp;</div> 
			</div><!-- /.box-header -->
			<!-- form start -->
			<div class="box-body">
				<form role="form" class="form-horizontal" name="jobform" id="jobform"  method="post" action="job-process.php" autocomplete="off" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="name" class="col-lg-2 control-label">Title</label>
								<div class="col-lg-9">
									<p> <strong>Please note </strong>: Do not copy and paste content from Microsoft Word or Google Docs, the formatting might come out badly. Paste content in a notepad and then paste here and then do formatting in the editor below</p>	
									<textarea class="form-control" id="title" name="title" rows="3" title="Please enter title"></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="duration" class="col-lg-4 control-label">
									Duration
									<span class="mandatory">*</span>
								</label>
								<div class="col-lg-8">
									<input type="text" class="form-control isRequired" id="duration" name="duration" placeholder="Enter Duration Label" title="Please enter Duration Label" />
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="location" class="col-lg-4 control-label">
									Location
									<span class="mandatory">*</span>
								</label>
								<div class="col-lg-8">
									<input type="text" class="form-control isRequired" id="location" name="location" placeholder="Enter Location" title="Please enter Location" />
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="duration" class="col-lg-4 control-label">
									Positions
									<span class="mandatory">*</span>
								</label>
								<div class="col-lg-8">
									<input type="number" class="form-control isRequired" id="positions" name="positions" />
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="location" class="col-lg-4 control-label">
									Application Last Date
									<span class="mandatory">*</span>
								</label>
								<div class="col-lg-8">
									<input type="text" class="form-control isRequired" id="last_date" name="last_date"/>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="packages" class="col-lg-4 control-label">
									Package
									<span class="mandatory">*</span>
								</label>
								<div class="col-lg-8">
									<input type="text" class="form-control isRequired" id="packages" name="packages" />
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
<script src="//cdn.ckeditor.com/4.5.9/full/ckeditor.js"></script>
<script>
$("#last_date").datepicker( {
	dateFormat:"dd-mm-yy",
});
 $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('title');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
        
      });
</script>
<?php
include "footer.php";
?>