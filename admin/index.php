<?php include_once("db_connect.php");?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Landofprofits- Admin Login</title>
    <link rel="shortcut icon" href="<?php echo $base_url.DS;?>assets/images/favicon.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>

    <script type="text/javascript" src="plugins/jQueryValidate/jquery.validate.min.js"></script>

<script type="text/javascript">
 $(document).ready(function() {
    $("#supportLoginInformation").validate({
      rules: {
        userName: {
          required: true,
        },
        passWord: {
          required: true,
        }
      },
      messages: {
        userName: {
          required: "Please enter your username.",
        },
        passWord: {
          required: "Please enter your password.",
        }
      }
    });
 }); 
</script>
<style type="text/css">
 label.error{
  color:#cc0000;
 } 
</style>
<style type="text/css">
        .form-signin {
        max-width: 490px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
	}
	.form-signin .form-signin-heading,
	.form-signin .checkbox {
	  margin-bottom: 10px;
	}
	.form-signin input[type="text"],
	.form-signin input[type="password"] {
	  font-size: 16px;
	  height: auto;
	  margin-bottom: 15px;
	  padding: 7px 9px;
	  border-radius: 5px;
	}
	hr{
		border-top: 1px solid #D8D8D8;
	}
</style>

  </head>
  <body class="">
    <div class="container" style="margin-top: 50px;">
    <div class="row" style="text-align: center;height:70px;">
		<img src="<?php echo $base_url.DS;?>assets/images/logo2.png" alt="Landofprofits" title="Landofprofits" style="border:2px solid #000; padding:20px;height: inherit;background-color: cadetblue;"/>
    </div>
      
      <form class="form-signin" method="post" name="supportLoginInformation" id="supportLoginInformation" action="login-process.php" >
        <h2 class="form-signin-heading" style="
    text-align: center;
    font: normal 25px Helvetica, Arial, sans-serif;
    margin-bottom: 20px;
">Please Login to Proceed</h2>
        <div>
                            <input type="text" class="form-control isRequired" placeholder="User Name" name="userName"  id="userName" title="Please enter User Name"/>
                        </div>
<div>
                            <input type="password" class="form-control isRequired" placeholder="Password" name="passWord"  id="passWord" title="Please enter Password"/>
                        </div>

      
        <div class="action" style="text-align: center;">
        <input type="submit" name="log-in" class="btn btn-primary" value="Log me in" />
        </div>
        <hr/>
      </form>
    </div>
    
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>