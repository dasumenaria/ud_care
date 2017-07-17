<?php 
include("auth.php");
include("header.php");
include("../config.php");
date_default_timezone_set('Asia/Calcutta');
ini_set('max_execution_time', 100000); 
$message="";
$image_path="";
 
if(isset($_POST['submit']))
{ 
	include('function.php');
	$name=$_POST['name'];
	$mobile_no=$_POST['mobile_no'];
        $mobile_no=encode($mobile_no,'UDRENCODE');
 	$check=mysql_query("select `id` from `register` where `mobile_no`='$mobile_no'");
	$count=mysql_num_rows($check);
	if($count==0)
	{
		$dob1=$_POST['dob'];
		if(!empty($dob1)) { $dob=date('Y-m-d', strtotime($dob1));}
		else { $dob='0000-00-00'; }
 		$email_id=$_POST['email_id'];
		$gender=$_POST['gender'];
		$address=$_POST['address'];
		$other_info=$_POST['other_info'];
		$aadhar_card_no=$_POST['aadhar_card_no'];
		$to=$_POST['email_id'];
		$date=date('Y-m-d');
		$time=date('h:i:s A');
		
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
		 
		 $name=encode($name,'UDRENCODE');
		 $email_id=encode($email_id,'UDRENCODE');
		 
		 $gender=encode($gender,'UDRENCODE');
		 $address=encode($address,'UDRENCODE');
		 $other_info=encode($other_info,'UDRENCODE');
		  
 		$sql="insert into `register` set  `name`='$name',`email_id`='$email_id',`dob`='$dob',`mobile_no`='$mobile_no',`gender`='$gender',`address`='$address',`other_info`='$other_info', `date`='$date', `udcare_no`='$udcare', `unique_code`='$string', `time`='$time',`aadhar_card_no`='$aadhar_card_no'";
		 
		$r=mysql_query($sql);
		
		$ids=mysql_insert_id();
		$md4_password=md5($string);
		$mobile_no=decode($mobile_no,'UDRENCODE');
		mysql_query("insert into `login` set `username`='$mobile_no' , `password`='$md4_password' , `register_id`='$ids' , `date`='$date', `time`='$time' ");
		
		$photo="identity_proof".$ids.".jpg";
		// move photo in  floder//
		move_uploaded_file($_FILES["identity_proof"]["tmp_name"],"../identity_proof/".$photo);
	
		$r=mysql_query("update register set identity_proof='$photo' where id='$ids'");
		
		$working_key='A7a76ea72525fc05bbe9963267b48dd96';
		$sms_sender='UDCARE';
		$sms=str_replace(' ', '+', 'Welcome to Udaipur Care your one time password is '.$string);
		 
		file_get_contents('http://alerts.sinfini.com/api/web2sms.php?workingkey='.$working_key.'&sender='.$sms_sender.'&to='.$mobile_no.'&message='.$sms.'');
		$message = "Congratulations you are successfully registr in udaipur care portal";
		$image_path='<img src="../images/success.svg" width="60px">';
	}
	else
	{
		$message = "Mobile no already registered.";
		$image_path='<img src="../images/error.png" width="85px">';
	}
 		
}
?>
<!-- bootstrap datepicker -->
<style>
.box.box-primary {
    border-top-color: #3c8dbc;
}
.box {
position: relative;
border-radius: 3px;
background: #ffffff;
border-top: 3px solid #d2d6de;
margin-bottom: 20px;
width: 100%;
box-shadow: 0 1px 1px rgba(0,0,0,0.1);
}
</style>
   
     

    <!-- Main content -->
    <section class="content">
		<div class="box box-primary" >
		 
		<h3>&nbsp; Registration Form</h3>
		<hr>
		  
		
           <form method="post"  id="contact-form" role="form" enctype="multipart/form-data">
         <div class="box-body" style="margin-left:40px;margin-right:40px;">
		 </br>
		 <div class="row">
		 
		 <div class="col-md-6">
				<div class="form-group">
                  <label for="exampleInputFullName">Full Name</label>
                  <div class="input-group">
                  	<input type="text" name="name" class="form-control" id="exampleInputFullName" placeholder="Enter Your Full Name" required>
                    <div class="input-group-addon">
                          <i class="fa fa-user"></i>
                      </div>
                  </div>
                </div>
		</div>
		<div class="col-md-6">		
                <div class="form-group">
                  <label for="exampleInputmobile_no">Mobile No.</label>
                  <div class="input-group">
                  	<input type="text" name="mobile_no" class="form-control allLetter checkMobile"  maxlength="10" minlength="10" placeholder="Enter Your Mobile No." required>
                    <div class="input-group-addon">
                          <i class="fa fa-mobile"></i>
                      </div>
                  </div>
                </div>
		</div>		
		<div class="col-md-6">		
                <div class="form-group">
                  <label for="exampleInputDob">Date Of Birth</label>
                  <div class="input-group">
                  	<input type="text" name="dob" class="form-control datepickera" placeholder="Enter Your Date Of Birth">
                    <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                      </div>
                  </div>
                </div>
		</div>
		 
		 
		<div class="col-md-6">	
				<div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <div class="input-group">
                  	<input type="email" name="email_id" class="form-control" id="exampleInputEmail1" placeholder="Enter email Address" >
                    <div class="input-group-addon">
                          <i class="fa fa-envelope"></i>
                      </div>
                  </div>
                </div>
		</div>	
		 <div class="col-md-6">	
         <label for="exampleInputDob">Gender &nbsp;</label>	
			<div class="form-group">
                 <input type="radio"  name="gender" class="minimal" value="male" checked> &nbsp; Male 
                <input type="radio"   name="gender" class="minimal" value="female"> &nbsp; Female
            </div>
		</div>
		<div class="col-md-6">		
			<div class="form-group">
				 <label for="exampleInputDob">Address</label>
				 <textarea name="address" class="form-control"></textarea>
			</div>
		</div>	
		<div class="col-md-6">
			<div class="form-group">
                  <label for="exampleInputFile">Identity proof like : Aadhar card / Pan card /Driving Licence. etc</label>
                  <div class="input-group">
                  	<input type="file" class="form-control" id="exampleInputFile" name="identity_proof">
                    <div class="input-group-addon">
                          <i class="fa fa-upload"></i>
                      </div>
                  </div>
 		     </div>
		</div>
		<div class="col-md-6">		
             <div class="form-group">
              <label for="exampleInputAnyMedicalTreatment">Aadhar Card No.</label>
              <div class="input-group">
              		<input name="aadhar_card_no" type="text" class="form-control" placeholder="Enter Your Aadhar Card No" maxlength="12" minlength="12" >
                    <div class="input-group-addon">
                          <i class="fa fa-barcode"></i>
                      </div>
                  </div>
             </div>
		</div>	
		
		 <div class="col-md-6">		
             <div class="form-group">
              <label for="exampleInputAnyMedicalTreatment">Other Details (if any):</label>
              <div class="input-group">
              		<input name="other_info" type="text" class="form-control" id="name" placeholder="Daily Routine problem you face">
                    <div class="input-group-addon">
                          <i class="fa fa-book"></i>
                      </div>
                  </div>
             </div>
		</div>
 
		<div class="col-md-12" align="center">		
             <div class="box-footer">
                  <input name="submit" type="submit" class="btn btn-primary" id="submit" value="Register" >  
             </div>
		</div>
	</div>		
</div> 
</form>
</div>
</section>
    <!-- /.content -->
   
<div style="display:none;margin-top:20px" id="new_app_login" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="false">
    <div  class="modal-backdrop fade in" style="z-index:0 !important"></div>
        <div class="modal-dialog" style="width:400px">
            <div class="modal-content" align="center">
               
                <div class="modal-body" style="min-height:250px">
                    
                    <div  style="width:100%; padding-top:20px; font-size:25px" id="congrates"><?php echo $image_path; ?></div>
                    <div class="modal-body" id="success_mag" style="padding:20px"><strong><?php echo $message; ?></strong> </div>
                    <div  style="padding-top: 0px !important; padding-bottom:10px">
                    
                         <a style="background-color:#195683; color:#FFF; margin-right:0px !important" href="admin_member_registration.php" class="btn blue"> Okay </a>
                     
                    </div>
                     
                    
                </div>
            </div>
        </div>
    </div>
		 

<?php include("footer.php"); ?>
<script>
<?php if(!empty($message)){?>
	$('#new_app_login').show();
<?php } ?>

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
	$('.checkMobile').on('keyup', function(){
		var mobile = $(this).val();
		if(mobile.length > 0 ){
			$.ajax({
				url: "../ajax_page.php?function_name=mobileNo_check&mobile="+mobile,
				type: "POST",
				success: function(data)
				{  
					 if(data>0){
						 $('.checkMobile').val('');
						 alert('Mobile no already registered');
					 }
				}
			});
		}
	});
	$('.datepickera').datepicker({
		  autoclose: true,
		  endDate: '+0d'
	});
</script>