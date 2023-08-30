<?php
include "header.php";
include "sidebar.php";
$id = isset($_GET['parentId'])?base64_decode($_GET['parentId']):"";
$parentId = isset($_GET['parentId'])?$_GET['parentId']:"";
if($id)
{
	header("Location:view-loan.php");
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
<aside class="right-side">
<section class="content-header">
    <h1>Loan Question<!--<small>Preview</small>--></h1>
</section>
<!-- Main content -->
<section class="content">

    <!-- left column -->
    <div class="">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Add Loan Question</h3><div class="pull-right" style="font-size:15px;"><span class="mandatory">*</span> indicates required field &nbsp;</div> 
            </div><!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                <form role="form" class="form-horizontal" name="mainform" id="mainform"  method="post" action="loan-question-process.php" autocomplete="off" enctype="multipart/form-data">
                 <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                    <label for="name" class="col-lg-2 control-label">Loan Question<span class="mandatory">*</span></label>
                     <div class="col-lg-10">
                      <input type="text" class="form-control isRequired" id="question" name="question" placeholder="Enter Question" />
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
                            <textarea class="form-control" id="answer" name="answer" rows="3" title="Please enter description"></textarea>
                     </div>
                    </div>
                  </div>
                 </div>
					<input type="hidden" name="parentId" id="parentId" value="<?php echo $parentId;?>">
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

      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('answer');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
        
      });
</script>
<?php
include "footer.php";
?>