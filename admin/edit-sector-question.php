<?php
include "header.php";
include "sidebar.php";
$id = check_input($con,base64_decode($_REQUEST['id']));
$id1 = check_input($con,$_REQUEST['id']);
$parentId = check_input($con,base64_decode($_REQUEST['parentId']));
$parentId1 = check_input($con,$_REQUEST['parentId']);
$query = mysqli_query($con, "SELECT * FROM `sectorQuestions` WHERE `id`='".$id."' ");
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
	$("#mainform").validate({
		rules: {
			question: {
				required: true,
			},
		},
		
		messages: {
			question: {
				required: "This field cannot be blank.",
			},
		}
	});
});
</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<aside class="right-side">
	<section class="content-header">
		<h1>Sector Question<!--<small>Preview</small>--></h1>
	</section>
<!-- Main content -->
	<section class="content">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit Sector Question</h3><div class="pull-right" style="font-size:15px;"><span class="mandatory">*</span> indicates required field &nbsp;</div> 
            </div><!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                <form role="form" class="form-horizontal" name="mainform" id="mainform"  method="post" action="sector-question-process.php" autocomplete="off" enctype="multipart/form-data">
                 
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="name" class="col-lg-2 control-label">Sector Question<span class="mandatory">*</span></label>
								<div class="col-lg-10">
									<input type="text" class="form-control isRequired" id="question" name="question" placeholder="Enter Question" value="<?php echo isset($data['question'])?$data['question']:"";?>" />
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="name" class="col-lg-2 control-label">Answer</label>
								<div class="col-lg-9">
									<p> <strong>Please note </strong>: Do not copy and paste content from Microsoft Word or Google Docs, the formatting might come out badly. Paste content in a notepad and then paste here and then do formatting in the editor below</p>	
									<textarea class="form-control" id="answer" name="answer" rows="3" title="Please enter description"><?php echo isset($data['answer'])?$data['answer']:"";?></textarea>
								</div>
							</div>
						</div>
					</div>
					<input type="hidden" name="parentId" id="parentId" value="<?php echo $parentId1;?>">
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
<script type="text/javascript" src="dist/js/jquery.blockUI.js"></script>
<script src="//cdn.ckeditor.com/4.5.9/full/ckeditor.js"></script>	
<script>
$(document).ready(function () {
	$("#service_title").stringToSlug({
		getPut: "#titleSlug"
	});
})
</script>
<script>
$(function () {
	// Replace the <textarea id="editor1"> with a CKEditor
	// instance, using default configuration.
	CKEDITOR.replace('answer', {
			on: {
				instanceReady: function() {
					this.document.appendStyleSheet( basr_url+'/assets/css/style.css' );
				}
			}
		});
	//bootstrap WYSIHTML5 - text editor
	$(".textarea").wysihtml5();
});
</script>	
<?php include "footer.php"; ?>