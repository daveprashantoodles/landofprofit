<?php
include "header.php";
include "sidebar.php";
?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css"/>
<script>
$(document).ready(function() {
	$("#Categoryform").validate({
		rules: {
			categoryTitle: {
				required: true,
			},
		},
		messages: {
			categoryTitle: {
				required: "This field is required.",
			},
		}
	});
});
</script>
<aside class="right-side">
	<section class="content-header">
		<h1>Category<!--<small>Preview</small>--></h1>
	</section>
	<!-- Main content -->
	<section class="content">

		<!-- left column -->
		<!-- general form elements -->
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Add Category</h3><div class="pull-right" style="font-size:15px;"><span class="mandatory">*</span> indicates required field &nbsp;</div> 
			</div><!-- /.box-header -->
			<!-- form start -->
			<div class="box-body">
				<form role="form" class="form-horizontal" name="Categoryform" id="Categoryform"  method="post" action="category-process.php" autocomplete="off" enctype="multipart/form-data">

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="name" class="col-lg-2 control-label">Category Title<span class="mandatory">*</span></label>
								<div class="col-lg-8">
									<input type="text" class="form-control isRequired" id="categoryTitle" name="categoryTitle" placeholder="Enter Category Title" required />
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="titleSlug" class="col-lg-2 control-label">Category Slug<span class="mandatory">*</span></label>
								<div class="col-lg-8">
									<input type="text" class="form-control isRequired" id="titleSlug" name="titleSlug" placeholder="Enter Category slug" required />
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
	<script type="text/javascript" src="dist/js/slug.js"></script>
	<script>
	$(document).ready(function () {
        $("#categoryTitle").stringToSlug({
            getPut: "#titleSlug"
        });
    })
	</script>
<?php
include "footer.php";
?>