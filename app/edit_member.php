<?php 
include("auth.php");
include("header.php");
include("../config.php");
 include('function.php');
//include("mail.php");
$update_id=$_GET['ati_utf_id'];
date_default_timezone_set('Asia/Calcutta');
ini_set('max_execution_time', 100000);
$message="";
  
if(isset($_POST['submit'])){
	
	$name=encode($_POST['name'] ,'UDRENCODE');
	$email_id=encode($_POST['email_id'],'UDRENCODE');
	$mobile_no=encode($_POST['mobile_no'],'UDRENCODE');
	$gender=encode($_POST['gender'],'UDRENCODE');
	$address=encode($_POST['address'],'UDRENCODE');
	$other_info=encode($_POST['other_info'],'UDRENCODE');
	$emergency_contact_name=encode($_POST['emergency_contact_name'],'UDRENCODE');
	$emergency_contact_no=encode($_POST['emergency_contact_no'],'UDRENCODE');
  	$age=$_POST['age'];
	$landline_no=$_POST['landline_no'];
 	$dob=$_POST['dob'];
  	$landmark=$_POST['landmark'];
	$aadhar_card_no=$_POST['aadhar_card_no'];
	
	$pincode_no=$_POST['pincode_no'];
 	$hobbies=$_POST['hobbies'];
	$any_medical_treatment=$_POST['any_medical_treatment'];
	$area_of_specialization=$_POST['area_of_specialization'];
	$children=$_POST['children'];
 	$spouse_name=$_POST['spouse_name'];
	$spouse_dob1=$_POST['spouse_dob'];
	$spouse_dob=date('Y-m-d', strtotime($spouse_dob1));
	$date_of_anniversary1=$_POST['date_of_anniversary'];
	$date_of_anniversary=date('Y-m-d', strtotime($date_of_anniversary1));
 	$other_info=$_POST['other_info'];
	$update_id=$_POST['update_id'];
 
   $sql="update  `register` set  `name`='$name',`age`='$age',`landline_no`='$landline_no',`email_id`='$email_id',`dob`='$dob',`mobile_no`='$mobile_no',`gender`='$gender',`address`='$address',
`landmark`='$landmark',`pincode_no`='$pincode_no',`emergency_contact_name`='$emergency_contact_name',`emergency_contact_no`='$emergency_contact_no',`hobbies`='$hobbies',`any_medical_treatment`='$any_medical_treatment',
`area_of_specialization`='$area_of_specialization',`children`='$children',`spouse_name`='$spouse_name',`spouse_dob`='$spouse_dob',
`date_of_anniversary`='$date_of_anniversary',`other_info`='$other_info',`aadhar_card_no`='$aadhar_card_no'  where `id` = '$update_id'";
  $message = "Member update successfully.";
  $r=mysql_query($sql);
	$ids=mysql_insert_id();
	$photo="identity_proof".$update_id.".jpg";
	move_uploaded_file($_FILES["identity_proof"]["tmp_name"],"../identity_proof/".$photo);
	if($r)
	{
		$r=mysql_query("update register set identity_proof='$photo' where id='$update_id'");
 
	 }
	else
	{
		echo mysql_error();
		}
		
}
	
	
	

?>
<?php 
function createRandomPassword() { 

	$chars = "abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ023456789@#$^*?"; 
	srand((double)microtime()*1000000); 
	srand();
	$i = 0; 
	$pass = '' ;			
	while ($i <= 10) { 
		$num = rand() % 73; 
		$tmp = substr($chars, $num, 1); 
		$pass = $pass . $tmp; 
		$i++; 
	}			
	return $pass;			
}			

?>


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
     <!-- Content Header (Page header) -->
    <section class="content-header">
      	<h1>
		Edit Registration 
		</h1>
     </section>
<?php 
	$ftc=mysql_query("select * from `register` where `id` = '$update_id'"); 
		$ftc_data=mysql_fetch_array($ftc);
		$name=decode($ftc_data['name'] ,'UDRENCODE');
		$email_id=decode($ftc_data['email_id'],'UDRENCODE');
		$mobile_no=decode($ftc_data['mobile_no'],'UDRENCODE');
		$gender=decode($ftc_data['gender'],'UDRENCODE');
		$address=decode($ftc_data['address'],'UDRENCODE');
		$other_info=decode($ftc_data['other_info'],'UDRENCODE');
		$emergency_contact_name=decode($ftc_data['emergency_contact_name'],'UDRENCODE');
		$emergency_contact_no=decode($ftc_data['emergency_contact_no'],'UDRENCODE');
		$aadhar_card_no=$ftc_data['aadhar_card_no'];
		$SD=$ftc_data['spouse_dob'];
		$SD=$ftc_data['spouse_dob'];
		 if($SD=='0000-00-00' || $SD=='1970-01-01')
		{$spouse_dob='';}else {$spouse_dob=date('d-m-Y',strtotime($SD));}
		$DOA=$ftc_data['date_of_anniversary'];
		if($DOA=='0000-00-00' || $DOA=='1970-01-01')
		{$date_of_anniversary='';}else {$date_of_anniversary=date('d-m-Y',strtotime($DOA));}
		$dob=$ftc_data['dob'];
		if($dob=='')
		{	$dob='';}else {$dob=date('d-m-Y',strtotime($dob));}
?>

    <!-- Main content -->
    <section class="content">
		<div class="box box-primary" >
        <form method="post"  id="contact-form" role="form" enctype="multipart/form-data">
         <div class="box-body" style="margin-left:12px;">
		 </br>
		 <div class="row">
		 <div class="form-group col-md-6">
                  <label for="exampleInputUdCare_no">Full Name</label>
                  <div class="input-group">
                      <input type="text" name="name" class="form-control" id="exampleInputFullName" value="<?php echo $name; ?>" placeholder="Enter Your Full Name">
                      <div class="input-group-addon">
                      <i class="fa fa-user"></i>
                      </div>
                  </div>
                </div>
 			<div class="form-group col-md-6">
                 <label for="exampleInputage">Age</label>
                  <div class="input-group">
                         <input type="text" name="age" class="form-control" id="exampleInputAge" value="<?php echo $ftc_data['age'];?>" placeholder="Enter Your Age">
                      <div class="input-group-addon">
                      <i class="fa fa-birthday-cake"></i>
                      </div>
                  </div>
                </div>
				<div class="form-group col-md-6">
                  <label for="exampleInputLandlineNo">Landline No.</label>
                  <div class="input-group">
                         <input type="landline_no"name="landline_no" class="form-control" id="exampleInputEmail1" value="<?php echo $ftc_data['landline_no'] ;?>" placeholder="Enter Your Landline No">
                      <div class="input-group-addon">
                      <i class="fa fa-phone"></i>
                      </div>
                  </div>
                </div>
                <input type="hidden" value="<?php echo $update_id;?>" name="update_id">
				<div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Email address</label>
                  <div class="input-group">
                         <input type="email" name="email_id" class="form-control" id="exampleInputEmail1" value="<?php echo $email_id;?>" placeholder="Enter email Address">
                      <div class="input-group-addon">
                      <i class="fa  fa-envelope-o"></i>
                      </div>
                  </div>
                </div>
				<div class="form-group col-md-6">
                  <label for="exampleInputDob">Date Of Birth</label>
                  <div class="input-group">
                         <input type="text" name="dob" class="form-control datepickera" value="<?php echo $dob;?>" placeholder="Enter Your Date Of Birth">
                      <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                      </div>
                  </div>
                </div>
				<div class="form-group col-md-6">
                  <label for="exampleInputmobile_no">Mobile No.</label>
                  <div class="input-group">
                         <input type="text" name="mobile_no" class="form-control allLetter"  value="<?php echo $mobile_no;?>" placeholder="Enter Your Mobile No.">
                      <div class="input-group-addon">
                      <i class="fa  fa-mobile-phone "></i>
                      </div>
                  </div>
                </div>
			 <div class="col-md-6">		
				<div class="form-group">
				</br></br> 
					  <label for="exampleInputDob">Gender &nbsp;</label>
						<input type="radio" value="male" name="gender" <?php if($gender=='male' || empty($gender)){echo "checked";}?> class="minimal" > &nbsp; Male 
						<input type="radio" name="gender" value="female" <?php if($gender=='female'){echo "checked";}?> class="minimal"> &nbsp; Female
				</div>
			</div>
			<div class="col-md-6">		
				<div class="form-group">
                   <label for="exampleInputDob">Address</label>
                    <textarea name="address" class="form-control" ><?php echo $address; ?></textarea>
				</div>
			</div>
		
			<div class="form-group col-md-6">
                  <label for="exampleInputmobile_no">LandMark</label>
                  <div class="input-group">
                         <input type="text" name="landmark" class="form-control" id="exampleInputmobile_no" value="<?php echo $ftc_data['landmark'];?>" placeholder="Enter Your Landmark.">
                      <div class="input-group-addon">
                      <i class="fa  fa-map-marker"></i>
                      </div>
                  </div>
			 </div>
			 <div class="form-group col-md-6">
                  <label for="exampleInputPinCodeNo">Pin code No.</label>
                  <div class="input-group">
                         <input type="text" name="pincode_no" maxlength="6" minlenght="6" class="form-control" value="<?php echo $ftc_data['pincode_no'];?>"  placeholder="Enter Your Pin Code No">
                      <div class="input-group-addon">
                      <i class="fa fa-codepen"></i>
                      </div>
                  </div>
			 </div>
			 <div class="form-group col-md-6">
					  <label for="exampleInputemergency_contact_no">Emergency Contact No</label>
					  <div class="input-group">
							 <input type="text" name="emergency_contact_no" value="<?php echo $emergency_contact_no;?>" class="form-control"  placeholder="Enter Your Emergency Contact No">
						  <div class="input-group-addon">
						  <i class="fa fa-phone"></i>
						  </div>
					  </div>
			 </div>
			 <div class="form-group col-md-6">
					  <label for="exampleInputemergency_contact_name">Emergency Contact Name</label>
					  <div class="input-group">
							 <input type="text" name="emergency_contact_name" value="<?php echo $emergency_contact_name;?>" class="form-control" placeholder="Enter Your Emergency Contact Name">
						  <div class="input-group-addon">
						  <i class="fa fa-user"></i>
						  </div>
					  </div>
			 </div>
			 <div class="form-group col-md-6">
					  <label for="exampleInputHobbies">Hobbies</label>
					  <div class="input-group">
							 <input name="hobbies" type="text" class="form-control" value="<?php echo $ftc_data['hobbies'];?>" placeholder="Hobbies">
						  <div class="input-group-addon">
						  <i class="fa fa-star-half-o"></i>
						  </div>
					  </div>
			 </div>
			 <div class="form-group col-md-6">
					  <label for="exampleInputAnyMedicalTreatment">Any Medical Treatment</label>
					  <div class="input-group">
							 <input name="any_medical_treatment" type="text" class="form-control" id="name" value="<?php echo $ftc_data['any_medical_treatment'];?>" placeholder="Any Medical Treatment">
						  <div class="input-group-addon">
						  <i class="fa fa-stethoscope"></i>
						  </div>
					  </div>
			 </div>
			 <div class="form-group col-md-6">
					  <label for="exampleInputAnyMedicalTreatment">Area of Specialization</label>
					  <div class="input-group">
							 <input name="area_of_specialization" type="text" class="form-control" id="name" value="<?php echo $ftc_data['area_of_specialization'];?>" placeholder="Area of Specialization">
						  <div class="input-group-addon">
						  <i class="fa fa-briefcase"></i>
						  </div>
					  </div>
			 </div>
			 <div class="form-group col-md-6">
					  <label for="exampleInputAnyMedicalTreatment">How many children do you have ?</label>
					  <div class="input-group">
							 <input name="children" type="text" class="form-control" id="name" value="<?php echo $ftc_data['children'];?>" placeholder="How many children do you have ?">
						  <div class="input-group-addon">
						  <i class="fa fa-group "></i>
						  </div>
					  </div>
			 </div>
			 
		 <div class="col-md-6">
			<div class="form-group">
                  <label for="exampleInputFile">Identity proof like : Aadhar card / Pan card /Driving Licence. etc</label>
                  <input type="file" id="exampleInputFile" name="identity_proof">
			</div>
		</div>
		<div class="col-md-6">		
             <div class="form-group">
              <label for="exampleInputAnyMedicalTreatment">Aadhar Card No.</label>
              <div class="input-group">
              		<input name="aadhar_card_no" type="text" class="form-control" placeholder="Enter Your Aadhar Card No" maxlength="12" minlength="12" value="<?php echo $aadhar_card_no;?>" required="required">
                    <div class="input-group-addon">
                          <i class="fa fa-barcode"></i>
                      </div>
                  </div>
             </div>
		</div>
		 <div class="form-group col-md-6">
					  <label for="exampleInputAnyMedicalTreatment">Spouse Name</label>
					  <div class="input-group">
							 <input name="spouse_name" type="text" class="form-control" id="name" value="<?php echo $ftc_data['spouse_name'];?>" placeholder="Spouse Name">
						  <div class="input-group-addon">
						  <i class="fa fa-transgender-alt"></i>
						  </div>
					  </div>
			 </div>	
		<div class="form-group col-md-6">
					  <label for="exampleInputAnyMedicalTreatment">Spouse Date of Birth</label>
					  <div class="input-group">
							 <input class="form-control input-small datepickera"  placeholder="Spouse Date of Birth" type="text" data-date-format="dd-mm-yyyy" value="<?php echo $spouse_dob;?>" name="spouse_dob"> 
						  <div class="input-group-addon">
						  <i class="fa fa-calendar"></i>
						  </div>
					  </div>
			 </div>
			<div class="form-group col-md-6">
					  <label for="exampleInputAnyMedicalTreatment">Date of Anniversary</label>
					  <div class="input-group">
							 <input class="form-control input-small datepickera"  value="<?php echo $date_of_anniversary;?>" placeholder="Date of Anniversary" 
                                            data-date-format="dd-mm-yyyy" type="text" name="date_of_anniversary">
						  <div class="input-group-addon">
						  <i class="fa fa-calendar"></i>
						  </div>
					  </div>
			 </div>
			<div class="form-group col-md-6">
                  <label for="exampleInputAnyMedicalTreatment">Other Details (if any):</label>
                  <div class="input-group">
                          <input name="other_info" type="text" class="form-control" id="name" value="<?php echo $ftc_data['other_info'];?>" placeholder="Daily Routine problem you face">
                      <div class="input-group-addon">
                      <i class="fa fa-question"></i>
                      </div>
                  </div>
			 </div> 
             
 		</div>	
         <div class="box-footer" align="center">
          	<input name="submit" type="submit" class="btn btn-primary" id="submit" value="Register" >
          </div>	
     </div> 
		</div>	  
               </div>
            </form>
      </section>
    <!-- /.content -->
 
<?php include("footer.php"); ?>
<script>
	$('.datepickera').datepicker({
		  autoclose: true,
		  endDate: '+0d'
	});
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
</script>