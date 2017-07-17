<?php 
include("authForWeb.php");
include("config.php");
include("header.php");
  $ids=$_GET['id'];

$qi=mysql_query("select `id`,`services_id` from `master_sub_services` where `id`='$ids'");
$fi=mysql_fetch_array($qi);
  $sub_id=$fi['id'];
   $services_id=$fi['services_id'];
	$id_q=mysql_query("select `id` from `master_services` where `id`='$services_id'");
	$f_id=mysql_fetch_array($id_q);
	$servic_id=$f_id['id'];
 

 
@$SESSION_ID=$_SESSION['SESSION_ID'];
@$SESSION_REGISTERID=$_SESSION['SESSION_REGISTERID'];  

$message="";
$image_path="";

if(isset($_POST['login'])){
	  $sub_serivice_id=$_POST['ids'];  
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
	
	
	
	$chars = "0123456789";//ABCDEFGHIJKLMNOPQRSTUVWXYZ
		$string = '';
		for ($i = 0; $i < 6; $i++) {
			$string .= $chars[rand(0, strlen($chars) - 1)];
		}  
		$charss = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$udcare = '';
		for ($i = 0; $i < 8; $i++) {
			$udcare .= $charss[rand(0, strlen($charss) - 1)];
		} 
	/*   echo "insert into `booking` set `udcare_no`='$udcare_no',`master_service_id`='$servic_id',`master_sub_service_id`='$sub_id',`code`='$code',`name`='$name',`mobile_no`='$mobile_no',`email`='$email',`address`='$address',`time`='$time',`date`='$date_chne',`other_info`='$other_info',`currnt_time`='$times',`currnt_date`='$curnt_date'";
	exit;   */
	 mysql_query("insert into `booking` set `udcare_no`='$udcare_no',`master_service_id`='$servic_id',`master_sub_service_id`='$sub_id',`code`='$code',`name`='$name',`mobile_no`='$mobile_no',`email`='$email',`address`='$address',`time`='$time',`date`='$date_chne',`other_info`='$other_info',`currnt_time`='$times',`currnt_date`='$curnt_date'");
	 
	// header('location:service_booking.php');
		$working_key='A7a76ea72525fc05bbe9963267b48dd96';
		$sms_sender='UDCARE';
		
		
		
		$sms=str_replace('', '+','Welcome to Udaipur Care your one time password is '.$string);
		 file_get_contents('http://alerts.sinfini.com/api/web2sms.php?workingkey='.$working_key.'&sender='.$sms_sender.'&to='.$mobile_no.'&message='.$sms.'');
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




.alizarin {
    background: #e74c3c;
}



.emerald {
    background: #2ecc71;
}

.midnight-blue {
    background: #2c3e50;
}

.peter-river {
    background: #3498db;
}

.dl {
    background: #F8F8F8;
    padding: 30px 0;
    border-radius: 20px;
    position: relative;
	margin-left:60px;
}

.dl:before {
    content: " ";
    height: 20px;
    width: 20px;
    background: #ddd;
    border-radius: 20px;
    position: absolute;
    left: 50%;
    top: 20px;
    margin-left: -10px;
}
    
.dl .brand {
    text-transform: uppercase;
    letter-spacing: 3px;
    padding: 10px 15px;
    margin-top: 10px;
    text-align: center;
    min-height: 100px; 
}

.dl .discount {
    min-height: 30px;
    position: relative;
    font-size: 30px;
    line-height: 50px;
    text-align: center;
    font-weight: bold;

    padding: 20px 15px 0;
    color: #f1c40f;
}

.dl .discount:after {
    content: " ";
    
    border-right: 20px solid transparent;
    border-left: 20px solid transparent;
    position: absolute;
    bottom: -20px;
    left: 20%;
}

.dl .discount.alizarin:after {
    border-top: 20px solid #e74c3c;
}

.dl .discount.peter-river:after {
    border-top: 20px solid #3498db;
}

.dl .discount.emerald:after {
    border-top: 20px solid #2ecc71;
}

.dl .discount.amethyst:after {
    border-top: 20px solid #9b59b6;
}

.dl .discount .type {
    font-size: 20px;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-top: -30px;
}

.dl .descr {
    color: #999;
    margin-top: 10px;
    padding: 20px 15px; 
}
 
.dl .ends {
    padding: 0 15px;
    color: #f1c40f;
   
}

.dl .coupon {
    min-height: 50px;
    text-align: center;
    
    text-transform: uppercase;
    font-weight: bold;
    font-size: 18px;
    padding: 20px 15px;
}

.dl .coupon a.open-code {
    color: #16a085;
}

.dl .coupon .code {
    letter-spacing: 1px;
    border-radius: 4px;
    margin-top: 10px;
    padding: 10px 15px;
    color: #f1c40f;
    background: #f0f0f0;
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
        <div class="col-md-4" style="align:center">
            <div class="box box-primary" >
                <div class="box-header with-border">
                    <?php
                       
if(!empty($ids))		
	{ 
						
						
						
						
                        $query=mysql_query("select `sub_services_name`,`services_id`, `sub_services_discription` from `master_sub_services` where `id`='$ids'");
                        $fetch=mysql_fetch_array($query);
                        {
							 
												$services_id=$fetch['services_id'];
												$sub_services_name=$fetch['sub_services_name'];										
										
												$sub_services_discription=$fetch['sub_services_discription'];
												$string = strip_tags($sub_services_discription);
												if (strlen($string) > 350) {
												$stringCut = substr($string, 0, 350);
												$string = substr($stringCut, 0, strrpos($stringCut, ' ')).'. . . . . . . . etc.'; 
					 }
                    ?>
					<div class="col-md-3" style="align:center">
						 </br></br></br>
							  <div class="dl" style="box-shadow:1px 4px 12px #ffffff; width:350px; height:450px">
								<div class="brand">
									<h2>
									  <i class="<?php echo $icon;?>"></i><?php echo $sub_services_name;?>
									</h2>
								</div>
								
									<?php 
									$query1=mysql_query("select discount from `vendor` where `company_sub_service`='$ids'");
									 $fetch1=mysql_fetch_array($query1);
									 {
										  $discount=$fetch1['discount'];
										  if(!empty($discount)){
									?>
								<div class="discount alizarin">
									<?php echo $discount;?> 
									<div class="type">
										</div>
								</div>
								<?php }
								else
								{
									?>
									<div class="discount alizarin">
									<div class="type">
									offer - NA   
									</div>
									</div>
								<?php }
								}?> 
								<div class="descr">
								
									<strong>
									<?php echo $string;  ?>
									</strong> 
								 </div>
								<div class="ends">
									 
								</div>
								
							  </div>
						</div>
						<?php } }  ?>
                    
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
                 <a href="index.php"> <img src="images/logos.png"   width="180px;"> </a>
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
 

