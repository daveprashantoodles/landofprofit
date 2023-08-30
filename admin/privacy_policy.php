<?php
include "header.php";
if(isset($_POST['submit'])&&$_POST['submit']=="submit"){
	
	$title = !empty($_POST['title'])?$_POST['title']:'';
	$metaKeyword = !empty($_POST['metaKeyword'])?$_POST['metaKeyword']:'';
	$metaDescription = !empty($_POST['metaDescription'])?$_POST['metaDescription']:'';
	$desc = !empty($_POST['desc'])?$_POST['desc']:'';
	$desc=check_input($con,$desc);
	$SQL = "Update privacy_policy set `title`='".$title."', `titleTag`='".$titleTag."',`description`='".$desc."',`metaKeyword`='".$metaKeyword."',`metaDescription`='".$metaDescription."' where `id`=1";
	$Update = mysqli_query($con,$SQL) or mysqli_error($con);
	if($Update){
		$_SESSION['msg'] = "data_updated";
	}
	else{
		$_SESSION['msg'] = "";
	}
}
$SQL = "select * from privacy_policy where id='1'";
$EXE = mysqli_query($con,$SQL);
$data = mysqli_fetch_assoc($EXE);
include "sidebar.php";
?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css"/>
<link href="dist/css/jquery.multiselect.css" rel="stylesheet" type="text/css" media="screen" />
<link href="dist/css/jquery.fastconfirm.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript">
$(document).ready(function() {
	$("#main_form").validate({
		rules: {
			title: {
				required: true,
			},desc: {
				required: true,
			},

		},
		messages: {
			title: {
				required: "This field cannot be blank.",
			},desc: {
				required: "This field cannot be blank.",
			},
		}
	});
});
</script>

<aside class="right-side">
	<section class="content-header">
		<h1>Privacy Policy <!--<small>Preview</small>--></h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- left column -->
		<div class="">
			<!-- general form elements -->
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Update page</h3><div class="pull-right" style="font-size:15px;"><span class="mandatory">*</span> indicates required field &nbsp;</div> 
				</div><!-- /.box-header -->
				<!-- form start -->
				<div class="box-body">
				
					<?php if(isset($_SESSION['msg']) && $_SESSION['msg']=='data_updated') { ?>
	                  	<div class="row">
			                <div class="col-sm-6">
				                <div class="alert alert-success alert-dismissible">
			                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                    Data Updated successfully!!.
			                   </div>
		                  	</div>
	                  	</div>
	                  	<?php 
	                  	$_SESSION['msg'] = '';
	                  	} 
	                ?>
					<form role="form" class="form-horizontal" name="main_form" id="main_form"  method="post" action="" autocomplete="off" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-12">                   
								<div class="form-group">
									<label for="title" class="col-sm-2 control-label">Title<span class="mandatory">*</span></label>
									<div class="col-sm-10">
									<input type="text" class="form-control isRequired" id="title" name="title" value="<?php echo isset($data['title'])?$data['title']:""; ?>" />
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
										<textarea class="form-control" id="desc" name="desc" rows="3" title="Please enter description"><?php if(isset($data['description'])){if($data['description'] !=''){echo $data['description'];}} ?></textarea>
									</div>
								</div>
							</div>
						</div>						 <br />                  <ul class="todo-list ui-sortable">                     <li style="font-size:20px;"><strong>SEO Description</strong></li>                  </ul>                  <br />                    	                     							<div class="form-group">   		                      <label class="col-sm-2 control-label">Title Tag</label>	                      <div class="col-sm-8">	                    		<textarea name="titleTag" id="titleTag" class="form-control" rows="3"><?php echo isset($data['titleTag'])?$data['titleTag']:"";?></textarea>	                    	 </div>	                  </div>	                  	                  <div class="form-group">   		                      <label class="col-sm-2 control-label">Meta Keywords</label>	                      <div class="col-sm-8">	                    		<textarea name="metaKeyword" id="metaKeyword" class="form-control" rows="3"><?php echo isset($data['metaKeyword'])?$data['metaKeyword']:"";?></textarea>	                    	 </div>	                  </div>	                  	                  <div class="form-group">   		                      <label class="col-sm-2 control-label">Meta Description</label>	                      <div class="col-sm-8">	                    		<textarea name="metaDescription" id="metaDescription" class="form-control" rows="3"><?php echo isset($data['metaDescription'])?$data['metaDescription']:"";?></textarea>	                    	 </div>	                  </div> 
						<div class="box-footer">
							<input type="submit" name="submit" class="btn btn-info" value="submit">
							<input type="reset" name="reset" class="btn bg-primary" value="Reset">
						</div>
					</form>		<!-- /.box -->
				</div><!--/.col (left) -->
			</div>
		</div>
	</section><!-- /.content -->
</aside>	
<script type="text/javascript" src="dist/js/jquery.multiselect.js"></script>
<script type="text/javascript" src="dist/js/jquery.multiselect.filter.js"></script>
<script type="text/javascript" src="dist/js/jquery.fastconfirm.js"></script>
<script type="text/javascript" src="dist/js/slug.js"></script>
<script type="text/javascript" src="dist/js/jquery.blockUI.js"></script>
<script src="//cdn.ckeditor.com/4.5.9/full/ckeditor.js"></script>
<script type="text/javascript" >
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('desc');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
      });

</script>

<?php
include "footer.php";
?>