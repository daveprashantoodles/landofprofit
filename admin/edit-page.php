<?php
include "header.php";
include "sidebar.php";
$id = check_input($con,base64_decode($_REQUEST['id']));
$id1 = check_input($con,$_REQUEST['id']);
$query = mysqli_query($con, "SELECT * FROM `page` WHERE `id`='".$id."' ");
$data =mysqli_fetch_array($query);
if(!$data) {  
	die("".mysqli_error()); 
}
?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css"/>
<link href="dist/css/jquery.multiselect.css" rel="stylesheet" type="text/css" media="screen" />
<link href="dist/css/jquery.fastconfirm.css" rel="stylesheet" type="text/css" media="screen" />   
<script>
$(document).ready(function() {
	$("#pageform").validate({
		rules: {
			title: {
				required: true,
			},
			titleTag: {
				required: true,
			},
			slug: {
				required: true,
			},
		},
		messages: {
			title: {
				required: "This field cannot be blank.",
			},
			titleTag: {
				required: "This field cannot be blank.",
			},
			slug: {
				required: "This field cannot be blank.",
			},
		}
	});
});
 
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<aside class="right-side">
	<section class="content-header">
		<h1>Page<!--<small>Preview</small>--></h1>
	</section>
<!-- Main content -->
	<section class="content">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit Page</h3><div class="pull-right" style="font-size:15px;"><span class="mandatory">*</span> indicates required field &nbsp;</div> 
            </div><!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                <form role="form" class="form-horizontal" name="loanform" id="loanform"  method="post" action="page-process.php" autocomplete="off" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="title" class="col-sm-4 control-label">
									Page Title <span class="mandatory">*</span>
								</label>
								<div class="col-sm-8">
									<input type="text" class="form-control isRequired" id="title" name="title" placeholder="Page Title" title="Please Title" value="<?php echo isset($data['title'])?$data['title']:"";?>"/>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="slug" class="col-sm-4 control-label">
									Slug <span class="mandatory">*</span>
								</label>
								<div class="col-sm-8">
									<input type="text" class="form-control isRequired" id="slug" name="slug" placeholder="Loan slug" title="Please Slug" value="<?php echo isset($data['slug'])?$data['slug']:"";?>"/>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="name" class="col-lg-2 control-label">Description</label>
								<div class="col-lg-9">
									<p> <strong>Please note </strong>: Do not copy and paste content from Microsoft Word or Google Docs, the formatting might come out badly. Paste content in a notepad and then paste here and then do formatting in the editor below</p>	
									<textarea class="form-control" id="mainDescription" name="mainDescription" rows="3" title="Please enter description"><?php echo $data['mainDescription']; ?></textarea>
								</div>
							</div>
						</div>
					</div>
					<br />
					<ul class="todo-list ui-sortable">
						<li style="font-size:20px;"><strong>SEO Description</strong></li>
					</ul>
					<br />
					<div class="form-group">   	
						<label class="col-sm-2 control-label">Title Tag</label>
						<div class="col-sm-8">
							<textarea name="titleTag" id="titleTag" class="form-control" rows="3"><?php echo $data['titleTag']; ?></textarea>
						</div>
					</div>
					<div class="form-group">   	
						<label class="col-sm-2 control-label">Meta Keywords</label>
						<div class="col-sm-8">
							<textarea name="metaKeyword" id="metaKeyword" class="form-control" rows="3"><?php echo $data['metaKeyword']; ?></textarea>
						</div>
					</div>
					<div class="form-group">   	
						<label class="col-sm-2 control-label">Meta Description</label>
						<div class="col-sm-8">
							<textarea name="metaDescription" id="metaDescription" class="form-control" rows="3"><?php echo $data['metaDescription']; ?></textarea>
						</div>
					</div> 
					<input type="hidden" name="id" id="id" value="<?php echo $id1; ?>" />
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
<script src="//cdn.ckeditor.com/4.5.9/full/ckeditor.js"></script>	
<script>
$(document).ready(function () {
	CKEDITOR.replace('mainDescription');
	$(".textarea").wysihtml5();
});
function clearImage() {
	$('.fileinputCat').fileinput('clear');
	$("#oldImage").addClass("hide");
	$('#existImage').val('');
}
function getImage() {
	$('.fileinputCat').fileinput('clear');
	$("#oldImage").addClass("hide");
	$('#existImage').val('');
}
</script>	
<?php include "footer.php"; ?>