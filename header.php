<style>
.footer_fix {
  min-height:580px;
}

</style>

<?php
include('authForWeb.php');
 @$SESSION_ID=$_SESSION['SESSION_ID'];
if($SESSION_ID){
	$log_path='<a href="logout.php" >LOGOUT</a>';
}
else
{
	$log_path='<a href="login.php" >LOGIN</a>';
}
 @$SESSION_USERTYPE=$_SESSION['SESSION_USERTYPE']; //$seccion_usertype = $_SESSION['SESSION_USERTYPE']; exit;
  @$user_name=$_SESSION['SESSION_USERNAME'];
  if($SESSION_USERTYPE==0){
	  $dashboard='app/user_dashboard.php';
  }
  if($SESSION_USERTYPE==1){
	  $dashboard='app/admin_dashboard.php';
  }
  if($SESSION_USERTYPE==2){
	  $dashboard='app/vendor_dashboard.php';
  }
 
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Udaipur Care</title>
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="keywords" content="">
		<meta name="description" content="">
 		<!-- animate -->
		<link rel="stylesheet" href="css/animate.min.css">
		<!-- bootstrap -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- font-awesome -->
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- google font -->
		<link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700,800' rel='stylesheet' type='text/css'>
		<!-- custom -->
		<link rel="stylesheet" href="css/style.css">
        <!-- Date picker -->
        <link rel="stylesheet" href="assest/plugins/datepicker/datepicker3.css">
		<link rel="stylesheet" href="assest/plugins/timepicker/bootstrap-timepicker.min.css">

 	</head>
	<body data-spy="scroll" data-offset="50" data-target=".navbar-collapse" style="overflow-x:hidden;">
		<!-- start navigation -->
		<div class="navbar navbar-fixed-top navbar-default" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon icon-bar"></span>
						<span class="icon icon-bar"></span>
						<span class="icon icon-bar"></span>
					</button>
					<a href="index.php" class="navbar-brand smoothScroll"><img src="images/logos.png" style="height:62px !important" class="img-responsive" alt="logo"></a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
                    	 
						<li><a href="<?php echo $dashboard;?>" class="smoothScroll">DASHBOARD</a></li>
                       <li><a href="index.php#about" class="smoothScroll">ABOUT US</a></li> 
 					  <!--<li class="dropdown">
						<a href="" class="smoothScroll" data-toggle="dropdown">SERVICES<span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
							 <li><a href="services.php" style="line-height: 21px !important;" > Door To Door</a></li>
							<li class="divider"></li>
							<li><a href="discount.php" style="line-height: 21px !important;" >Discount</a></li>
							</ul>
						</li> -->

 
						<li><a href="services.php" class="smoothScroll">SERVICES</a></li>
						<li><a href="discount.php" class="smoothScroll">DISCOUNT</a></li>
 						<li><a href="partners.php" class="smoothScroll">PARTNERS</a></li>
						<li class="dropdown">
						<a href="" class="smoothScroll" data-toggle="dropdown">REGISTER<span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
							 <li><a href="registration.php" style="line-height: 21px !important;" >Member Registration</a></li>
							<li class="divider"></li>
							<li><a href="partner_add.php" style="line-height: 21px !important;" >Partner Registration</a></li>
							</ul>
						
						</li>
						<li><a href="contactus.php" class="smoothScroll">CONTACT</a></li>
						<li><?php echo $log_path; ?></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- end navigation -->