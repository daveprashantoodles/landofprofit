<?php
include "header.php";
include "sidebar.php";
 
?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css"/>
        
       
<script type="text/javascript">
$(document).ready(function() {
	$("#ChangePassword").validate({
		rules: {
		oldPassword: {
				required: true,
				remote: "checkOldpassword.php",
			},
			newPassword: {
				required: true,
				},
			confirmPassword: {
				required: true,
				equalTo: '#newPassword',
				}
		},
		messages: {
			oldPassword: {
				required: "This field cannot be blank.",
				remote: "Old Password Does Not Match.",
			},
			newPassword: {
				required: "This field cannot be blank.",
				
				
			},
			confirmPassword: {
				required: "This field cannot be blank.",
				equalTo: "Please enter same password again.",
				}	
		}
	});
});
</script>
<style type="text/css">
label.error{
	color: #cc0000;
}	
body {
	color: #73879C;
    background: #2A3F54;
    font-family: "Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif;
    font-size: 13px;
    font-weight: 400;
    line-height: 1.471;

}	
.mandatory {
	color:#cc0000; 
}
.row{
	margin-bottom: 10px;
}
.control-label {
	font-size:14px;
}
</style>

<aside class="right-side">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	    Change Password
	    <!--<small>...</small>-->
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	    <!--<li><a href="#">Forms</a></li>-->
	    <li class="active">Change Password</li>
	  </ol>
	</section>
	<!-- Main content -->
	<section class="content">
    <!-- left column -->
    <div class="">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Update Your Password
</h3><div class="pull-right" style="font-size:15px;"><span class="mandatory">*</span> indicates required field &nbsp;</div> 
            </div><!-- /.box-header -->
            <!-- form start -->
            <form role="form" class="form-horizontal" name="ChangePassword" id="ChangePassword" method="post" action="change_passwordexe.php" enctype="multipart/form-data" autocomplete="off">
                <div class="box-body">
                		<?php if(isset($_SESSION['msg']) && $_SESSION['msg']=='data_updated') { ?>
	                  	<div class="row">
			                <div class="col-sm-6">
				                <div class="alert alert-success alert-dismissible">
			                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                    		Password Change successfully!!.
			                  	</div>
		                  	</div>
	                  	</div>
	                  	<?php 
	                  	$_SESSION['msg'] = '';
	                  	} 
	                  	?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="categoryName" class="control-label col-sm-5 ">Old Password <span class="mandatory">*</span></label>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control isRequired" id="oldPassword" name="oldPassword" placeholder="Old Password" title="Please enter old Password" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="categorySlug" class="col-sm-5 control-label">New Password <span class="mandatory">*</span></label>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control isRequired" id="newPassword" name="newPassword" placeholder="New Password" title="Please enter new Password"  />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="status" class="col-sm-5 control-label">Confirm Password <span class="mandatory">*</span></label>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control isRequired" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" title="Please confirm your password"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        
                         <div class="box-footer">
                            <div class="col-sm-6">
                                <input type="submit" name="submit" class="btn btn-primary" value="Change Password">
                                <input type="reset" name="reset" class="btn bg-primary" value="Reset">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- /.box -->
    </div><!--/.col (left) -->
</section><!-- /.content -->
</aside>
	
<?php
include "footer.php";
?>