<?php
  @$SESSION_USERTYPE=$_SESSION['SESSION_USERTYPE']; //$seccion_usertype = $_SESSION['SESSION_USERTYPE']; exit;
  @$user_name=$_SESSION['SESSION_USERNAME'];
  if($SESSION_USERTYPE==0){
	  $dashboard='user_dashboard.php';
  }
  if($SESSION_USERTYPE==1){
	  $dashboard='admin_dashboard.php';
  }
  if($SESSION_USERTYPE==2){
	  $dashboard='vendor_dashboard.php';
  }
 
include("../config.php"); 
$user_type=@$_SESSION['SESSION_USERTYPE']; 

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Udaipur Care</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../assest/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assest/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../assest/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../assest/plugins/datatables/dataTables.bootstrap.css"> 
   <link rel="stylesheet" href="../assest/plugins/datepicker/datepicker3.css">
	<link rel="stylesheet" href="../assest/plugins/timepicker/bootstrap-timepicker.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/plugins/select2/select2.css"/>
 <style>
 .active_color
 {
	background-color:#e02222 !important;
	color:#FFF !important; 
 }
 .sidebar-menu >li > a
 {
	 color:#FFF !important;
 }
 .sidebar-menu >li >ul >li > a
 {
	 color:#FFF !important;
 }
 </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper" >

  <header class="main-header" style="background-color:#FFF !important">
    <!-- Logo -->
    <a href="../index.php" class="logo">
       <img src="../images/logos.png" width="180px;" height="49px"    alt="logo">
       
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"  style='size:auto'>
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
       
       <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
           <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#000 !important">
               <span class="hidden-xs"><?php echo $user_name; ?></span>
            </a>
            <ul class="dropdown-menu">
               <li class="user-footer">
                <div class="pull-left">
                  <a href="my_profile.php" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="../logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
         </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar" style="background-color:#3d3d3d !important; color:fff; margin-top:1px" >
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
       <ul class="sidebar-menu">
       
       
      <!--  <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../assest/index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="../assest/index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul>
        </li>
        <li><a href="../assest/documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
       -->  
         
       <?php  $page_name_from_url=basename($_SERVER['PHP_SELF']);
			 
			 
							//@$fac_id=$_SESSION['id'];
							$user_type=$user_type;
							
			$selecto7=mysql_query("select * from `user_management` where `user_type`='$user_type'");
			while($reco7=mysql_fetch_array($selecto7))
			   {
				   $mng_mdul_id[]=$reco7['module_id'];
			   }
				    
				 $sel_module2=mysql_query("select `main_menu` from `modules` where `page_name_url`='".$page_name_from_url."'");
				$arr_module2=mysql_fetch_array($sel_module2);
				 $main_menu_active=$arr_module2['main_menu'];			
				
					$selecto3=mysql_query("select * FROM `modules` ORDER BY order_by Asc");
                      while($data=mysql_fetch_array($selecto3))
					  {
                      $main_menu_arr[]='';
                     if(in_array($data['id'],$mng_mdul_id))
					 {
                        if(empty($data['main_menu']) && empty($data['sub_menu']))
                        {
                             ?>
                            <li class="<?php if($page_name_from_url==$data['page_name_url']){ echo 'active_color'; } ?>">
  <a href="<?php echo $data['page_name_url']; ?>"><i class="<?php echo $data['icon_class_name']; ?>"></i><?php echo $data['name']; if($page_name_from_url==$data['page_name_url']){ echo '<span class="selected"></span>'; } ?></a>
                            </li>
                            <?php
                        }
                      
                        if(!empty($data['main_menu']) && empty($data['sub_menu']))
                        {
                            if(in_array($data['main_menu'], $main_menu_arr))
                            {
                               
                            }
                            else
                            {
                                $main_menu_arr[]=$data['main_menu'];
                                  ?>
                                <li class="treeview <?php if($main_menu_active==$data['main_menu']){ echo 'active'; } ?>">
                                    <a href="javascript:;"<?php if($main_menu_active==$data['main_menu']){ echo 'class="active_color"'; } ?> >
                                    <i class="<?php echo $data['main_menu_icon']; ?>"></i>
                                    <?php echo $data['main_menu']; ?>  
                                    <span class="pull-right-container">
                                      <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                     </a>
                                    <ul  class="treeview-menu">
                                    <?php
									$selecto4=mysql_query("select * FROM `modules` where `main_menu`='".$data['main_menu']."'");
									while($data_value=mysql_fetch_array($selecto4))
									{
										if(in_array($data_value['id'],$mng_mdul_id))
										{			
                                         ?>
											<li class="<?php if($page_name_from_url==$data_value['page_name_url']){ echo 'active'; } ?>">
												<a href="<?php echo $data_value['page_name_url']; ?>"> <i class="<?php echo $data_value['icon_class_name']; ?>"></i><?php echo $data_value['name']; ?></a>
											</li>
										<?php
										}
                                    }
                                    ?>
                                    </ul>
                                </li>
                                <?php
                            }
                        }
					 }
					  }
					  
					  ?>   
         </ul>
    </section>
  </aside>
<script type="text/javascript" src="../assets/plugins/select2/select2.min.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content -->
   