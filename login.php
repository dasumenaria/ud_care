<?php
session_start();
include("config.php");
date_default_timezone_set('Asia/Calcutta');
ini_set('max_execution_time', 100000);
$message="";

unset($_SESSION['SESSION_ID']);
unset($_SESSION['SESSION_USERTYPE']);
unset($_SESSION['SESSION_USERNAME']);
unset($_SESSION['SESSION_SUBSERVICE']);
unset($_SESSION['SESSION_REGISTERID']);

 if(isset($_POST['submit'])) {
	
	$result=mysql_query("select `id`,`username`,`user_type`,`master_sub_services`,`register_id` from `login` where `username`='".$_POST['username']."' and `password`='".md5($_POST['password'])."'");
	if(mysql_num_rows($result)>0)
	{
		$row= mysql_fetch_array($result);
		$id=$row['id'];
		
		$usertype=$row['user_type']; 
		$_SESSION['SESSION_ID']=$row['id'];
			$_SESSION['SESSION_USERNAME']=$row['username'];
			$_SESSION['SESSION_USERTYPE']=$row['user_type'];
			$_SESSION['SESSION_SUBSERVICE']=$row['master_sub_services'];
			$_SESSION['SESSION_REGISTERID']=$row['register_id'];
		//--- SMS
		if($usertype != 0)
		{
			$charss = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			$udcare = '';
			for ($i = 0; $i < 8; $i++) {
				$udcare .= $charss[rand(0, strlen($charss) - 1)];
			}   
			$_SESSION['SESSION_ID']=$row['id'];
			$working_key='A7a76ea72525fc05bbe9963267b48dd96';
			$sms_sender='UDCARE';
			$sms=str_replace(' ', '+', 'Welcome to Udaipur Care your one time password is '.$udcare);
			$mobile_no=$row['username'];
			//file_get_contents('http://alerts.sinfini.com/api/web2sms.php?workingkey='.$working_key.'&sender='.$sms_sender.'&to='.$mobile_no.'&message='.$sms.'');
				mysql_query("update `login` set `code`='$udcare' where `id`='$id'");
			ob_start();
		}
 		$_SESSION['UNUSES']=$id;
		if($usertype==0){
			$_SESSION['SESSION_ID']=$row['id'];
			$_SESSION['SESSION_USERNAME']=$row['username'];
			$_SESSION['SESSION_USERTYPE']=$row['user_type'];
			$_SESSION['SESSION_SUBSERVICE']=$row['master_sub_services'];
			$_SESSION['SESSION_REGISTERID']=$row['register_id'];
			
			echo "<meta http-equiv='refresh' content='0;url=services.php'/>";
		}
		else if($usertype==1){
			 
			echo "<meta http-equiv='refresh' content='0;url=app/admin_dashboard.php'/>"; //admin_dashboard
		}
		else if($usertype==2){
			echo "<meta http-equiv='refresh' content='0;url=app/vendor_dashboard.php'/>"; //vendor_dashboard
		}
	
		ob_flush();
	} 
	else 
	{
		$message = "Invalid Username or Password!";
	}
}
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UDAIPUR CARE</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="assest/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assest/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assest/plugins/iCheck/square/blue.css">
 
  <style>
  .login-page, .register-page {
    background:url('images/login.png');
	 background-repeat: no-repeat;

	.login-box-body, .register-box-body {
    background: #fffafa4d !important;
    padding: 20px;
    border-top: 0;
    color: #666;
    box-shadow: 19px 39px 101px 28px #040504b3 !important;
} 
	 
}
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box"  >
  <div class="login-logo">
		 
  </div>
       
  <!-- /.login-logo -->
  <div class="login-box-body">
<center><a href="index.php"><img src="images/logos.png"width="180px;"></a></center>

</br>
    <form method="post">
      <div class="form-group has-feedback">
         <input type="text" name="username" class="form-control" placeholder="Mobile No " required="required">
         <span class="fa fa-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password" required="required">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
	  <div class="form-group">
		<?php if(!empty($message)){ ?>
		<code><?php echo $message; ?></code>
		<?php }?>
	  </div>
      <div class="row">
		<div class="col-xs-8">
			<a href="#">Forgot Password</a>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
	  <div class="form-group">
	  <span>Don't have an account? <a href="registration.php" class="text-center"> Register now</a></span>
	  </div>
    </form>

     
    <!-- /.social-auth-links -->


  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="assest/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="assest/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="assest/plugins/iCheck/icheck.min.js"></script>
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
