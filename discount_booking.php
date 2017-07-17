<?php 
include("authForWeb.php");
include("config.php");
include("header.php");
$sub_serivice_id=$_GET['s_id'];
@$SESSION_ID=$_SESSION['SESSION_ID'];
@$SESSION_REGISTERID=$_SESSION['SESSION_REGISTERID'];  

$message="";
$image_path="";

if(isset($_POST['login'])){
	  $sub_serivice_id=$_POST['sub_serivice_id'];  
	$result=mysql_query("select `id`,`username`,`user_type`,`master_sub_services`,`register_id` from `login` where `username`='".$_POST['username']."' and `password`='".md5($_POST['password'])."'");
	if(mysql_num_rows($result)>0)
	{
		$row= mysql_fetch_array($result);
		$_SESSION['SESSION_ID']=$row['id'];
		$_SESSION['SESSION_USERNAME']=$row['username'];
		$_SESSION['SESSION_USERTYPE']=$row['user_type'];
		$_SESSION['SESSION_SUBSERVICE']=$row['master_sub_services'];
		$_SESSION['SESSION_REGISTERID']=$row['register_id'];
		$usertype=$row['user_type']; 
		ob_start();
 			header("location:service_booking.php?s_id=".$sub_serivice_id."");
		ob_flush();

	} 
	else 
	{
		$message = "Invalid Username or Password!";
	}
	
	
	
}

if(isset($_POST['submit']))
{
 	$udcare_no=$_POST['udcare_no'];
	$code=$_POST['code'];
	$name=$_POST['name'];
	$email=$_POST['email'];
  	$mobile_no=$_POST['mobile_no'];
	$address=$_POST['address'];
	$time=$_POST['time'];
	$date=$_POST['date'];
	$curnt_date=date('Y-m-d');
	$times=date('h:i:s A');
	$date_chne=date('Y-m-d', strtotime($date));
	$other_info=$_POST['other_info'];
	 
	 mysql_query("insert into `booking` set `udcare_no`='$udcare_no',`master_sub_service_id`='$sub_serivice_id',`code`='$code',`name`='$name',`mobile_no`='$mobile_no',`email`='$email',`address`='$address',`time`='$time',`date`='$date_chne',`other_info`='$other_info',`currnt_time`='$times',`currnt_date`='$curnt_date'");
	 
	// header('location:service_booking.php');
// file_get_contents('http://alerts.sinfini.com/api/web2sms.php?workingkey='.$working_key.'&sender='.$sms_sender.'&to='.$mobile_no.'&message='.$sms.'');
		$message = "Congratulations your booking successfully";
		$image_path='<img src="images/success.svg" width="60px">';
	}
	
 	
 if(!empty($SESSION_REGISTERID))
 {
	$ftc_data=mysql_query("select `udcare_no`,`unique_code` from `register` where `id`='$SESSION_REGISTERID'"); 
	$ftx_array=mysql_fetch_array($ftc_data);
	$udcare_no=$ftx_array['udcare_no'];
	$unique_code=$ftx_array['unique_code'];
 }
 else
 {
	$udcare_no='';$unique_code=''; 
 }
  ?>
<style>
.box.box-primary {
    border-top-color: #3c8dbc;
}
.box {
 
border-radius: 3px;
background: #ffffff;
border-top: 3px solid #d2d6de;
margin-bottom: 20px;
width: 100%;
box-shadow: 0 1px 1px rgba(0,0,0,0.1);
}
</style>



  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Servicing
   </h1>
     </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-4">
            <div class="box box-primary" style="margin-left:12px; margin-right:12px;">
                <div class="box-header with-border">
                    <?php
                        $s_id=$_GET['s_id']; 
                        $query=mysql_query("select * from `master_sub_services` where `services_id`='$s_id'");
                        $fetch=mysql_fetch_array($query);
                        {
                            $sub_services_name=$fetch['sub_services_name'];
                            $sub_services_discription=$fetch['sub_services_discription'];
                        }		 
                    ?>
                    <center><h4 class="box-title"><?php echo $sub_services_name; ?></h4></center>
                    <hr>
                </div>
                <div class="box-body" style="margin-left:12px;margin-right:12px;">
                    <p><?php echo $sub_services_discription; ?></p>
                </div>
             </div>
        </div>
        <div class="col-md-8">
            <div class="box box-primary" style="margin-left:12px; margin-right:12px;">
            <div class="box-header with-border">
            <center><h4 class="box-title">Book Now </h4></center>
			<hr>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
             <form role="form" method="post">
              <div class="box-body" style="margin-left:12px;margin-right:12px;">
				<div class="form-group col-md-6">
                  <label for="exampleInputUdCare_no">Udaipur Care No.</label>
                  <div class="input-group">
                      <input  type="text" name="udcare_no" class="form-control" value="<?php echo $udcare_no; ?>" placeholder="Enter Udaipur Care No." required>
                      <div class="input-group-addon">
                          <i class="fa fa-book"></i>
                      </div>
                  </div>
                </div>
				<div class="form-group col-md-6">
                  <label for="exampleInputCode">6 Digit Code </label>
                  <div class="input-group">
                      <input type="text" name="code" class="form-control" value="<?php echo $unique_code; ?>" placeholder="Enter 6 Digit Code" required>
                      <div class="input-group-addon">
                          <i class="fa fa-book"></i>
                      </div>
                  </div>
                </div>
				<div class="form-group col-md-6">
                  <label for="exampleInputName">Name</label>
                  <div class="input-group">
                  	  <input type="text" name="name" class="form-control" placeholder="Enter Your Name" required>
                  	  <div class="input-group-addon">
                          <i class="fa fa-user"></i>
                      </div>
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputEmailAddress">Email address</label>
                  <div class="input-group">
                  	  <input type="email" name="email" class="form-control" placeholder="Enter Your email Address" >
                  	  <div class="input-group-addon">
                          <i class="fa fa-envelope"></i>
                      </div>
                  </div>
                </div>
				 <div class="form-group col-md-6">
                  <label for="exampleInputEmailAddress">Mobile No.</label>
                  <div class="input-group">
                      <input type="text" name="mobile_no" class="form-control allLetter" maxlength="10" minlength="10"  placeholder="Enter Your Your Mobile No" required>
                      <div class="input-group-addon">
                          <i class="fa fa-mobile"></i>
                      </div>
                  </div>
                </div>
				<div class="form-group col-md-6">
                  <label for="exampleInputEmailAddress">Address</label>
				  <textarea name="address" class="form-control" style="resize:none;" required></textarea>
                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputPicUpTime">Pick Up Date</label>
                  <div class="input-group">
                      <input type="text"  name="date" class="form-control datepickera" required id="">
                      <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                      </div>
                  </div>
                </div>
                <div class="form-group col-md-6 ">
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                          <label>Pick Up Time </label>
                            <div class="input-group">
                                <input type="text" name="time" class="form-control timepicker">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                         </div>
                   </div>
                </div>
                
				<div class="form-group col-md-12">
                  <label for="exampleInputFile">Other Information</label>
                   <textarea name="other_info" class="form-control"></textarea>
              </div>
              <!-- /.box-body -->
              <div class="col-md-12" align="center">
                  <div style="width:15%">
                    <input name="submit" type="submit" class="btn btn-primary form-control" id="submit" value="Book Now">
                  </div>
              </div>
			  <!------->
			   
             
			 
            </form>
          </div>
        </div>
      </div>
   </div>
    </section>
    <!-- /.content -->
 
<div style="display:none;margin-top:20px" id="new_app_login" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="false">
<div  class="modal-backdrop fade in" style="z-index:0 !important"></div>
    <div class="modal-dialog" style="width:400px">
        <div class="modal-content">
           
            <div class="modal-body" style="min-height:300px">
            	<div class="brand" align="center">
                  <img src="images/logos.png"   width="180px;">  
                </div><br />

            <form method="post">
                  <div class="form-group has-feedback">
                     <input type="text" name="username" class="form-control" placeholder="Mobile No" required="required">
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
                  </div><br />

                  <div class="row">
                    <div class="col-xs-8">
                        <a href="#">Forgot Password</a>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                      <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                  </div>
                  <div class="form-group">
                  <span>Don't have an account? <a href="registration.php" class="text-center"> Register now</a></span>
                  <input type="hidden" name="sub_serivice_id" value="<?php echo $sub_serivice_id; ?>" />
                  </div>
            </form>
                </div>
            </div>
        </div>
    </div>

	<!--------pop up------->
<div style="display:none;margin-top:20px" id="success_messge" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="false">
    <div  class="modal-backdrop fade in" style="z-index:0 !important"></div>
        <div class="modal-dialog" style="width:400px">
            <div class="modal-content" align="center">
               
                <div class="modal-body" style="min-height:250px">
                    
                    <div  style="width:100%; padding-top:20px; font-size:25px" id="congrates"><?php echo $image_path; ?></div>
                    <div class="modal-body" id="success_mag" style="padding:20px"><strong><?php echo $message; ?></strong> </div>
                    <div  style="padding-top: 0px !important; padding-bottom:10px">
                    
                         <a style="background-color:#195683; color:#FFF; margin-right:0px !important" href="index.php" class="btn blue">Okay </a>
                     
                    </div>
                     
                    
                </div>
            </div>
        </div>
    </div>
    
<?php include("footer.php"); ?>



<script>
<?php if(empty($SESSION_ID)){?>
 		$('#new_app_login').show();
		<?php }

if(!empty ($message))
{?>
	$('#success_messge').show();
<?php }
		?>
 
$('.allLetter').keyup(function(){
		var inputtxt=  $(this).val();
		var numbers =  /^[0-9]*\.?[0-9]*$/;
		if(inputtxt.match(numbers))  
		{} 
		else  
		{  
			$(this).val('');
			return false;  
		}
	});
	var date = new Date();
	date.setDate(date.getDate()+1);//-1
	  $('.datepickera').datepicker({
			  autoclose: true,
			  startDate: date
	});
</script>
 

