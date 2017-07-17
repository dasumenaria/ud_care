<?php 
include("header.php");
include("config.php");
include('app/function.php');
date_default_timezone_set('Asia/Calcutta');
ini_set('max_execution_time', 100000);
$message="";
  
if(isset($_POST['submit'])){
	
	$name=encode($ftc_data['name'] ,'UDRENCODE');
	$email_id=encode($ftc_data['email_id'],'UDRENCODE');
	$mobile_no=encode($ftc_data['mobile_no'],'UDRENCODE');
	$gender=encode($ftc_data['gender'],'UDRENCODE');
	$address=encode($ftc_data['address'],'UDRENCODE');
	$other_info=encode($ftc_data['other_info'],'UDRENCODE');
	$emergency_contact_name=encode($ftc_data['emergency_contact_name'],'UDRENCODE');
	$emergency_contact_no=encode($ftc_data['emergency_contact_no'],'UDRENCODE');
	 
 	$age=$_POST['age'];
	$landline_no=$_POST['landline_no'];
 	$dob1=$_POST['dob'];
	$dob=date('Y-m-d', strtotime($dob1));
 	$landmark=$_POST['landmark'];
	$pincode_no=$_POST['pincode_no'];
 	$hobbies=$_POST['hobbies'];
	$any_medical_treatment=$_POST['any_medical_treatment'];
	$area_of_specialization=$_POST['area_of_specialization'];
	$children=$_POST['children'];
	$remark=$_POST['remark'];
	$spouse_name=$_POST['spouse_name'];
	$spouse_dob1=$_POST['spouse_dob'];
	$spouse_dob=date('Y-m-d', strtotime($spouse_dob1));
	$date_of_anniversary1=$_POST['date_of_anniversary'];
	$date_of_anniversary=date('Y-m-d', strtotime($date_of_anniversary1));
 	$other_info=$_POST['other_info'];
 
   $sql="insert into `register` set  `name`='$name',`age`='$age',`landline_no`='$landline_no',`email_id`='$email_id',`dob`='$dob',`mobile_no`='$mobile_no',`gender`='$gender',`address`='$address',
`landmark`='$landmark',`pincode_no`='$pincode_no',`emergency_contact_name`='$emergency_contact_name',`emergency_contact_no`='$emergency_contact_no',`hobbies`='$hobbies',`any_medical_treatment`='$any_medical_treatment',
`area_of_specialization`='$area_of_specialization',`children`='$children',`remark`='$remark',`spouse_name`='$spouse_name',`spouse_dob`='$spouse_dob',
`date_of_anniversary`='$date_of_anniversary',`other_info`='$other_info',`admin_id`='$session_id'";
  $message = "Registration Add Successfully.";
	$r=mysql_query($sql);
	$ids=mysql_insert_id();
	$photo="identity_proof".$ids.".jpg";
 	 

	move_uploaded_file($_FILES["identity_proof"]["tmp_name"],"identity/".$photo);

	if($r)
	{
		$r=mysql_query("update register set identity_proof='$photo' where id='$ids'");
 
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
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
		Registration 
		</h1>
     </section>

    <!-- Main content -->
    <section class="content">
	
		<div class="box box-primary" >
           <form method="post"  id="contact-form" role="form">
         <div class="box-body" style="margin-left:12px;">
		 </br>
		 <div class="row">
		 <div class="form-group col-md-6">
                  <label for="exampleInputUdCare_no">Full Name</label>
                  <div class="input-group">
                      <input type="text" name="name" class="form-control" id="exampleInputFullName" placeholder="Enter Your Full Name">
                      <div class="input-group-addon">
                      <i class="fa fa-user"></i>
                      </div>
                  </div>
                </div>
 			<div class="form-group col-md-6">
                 <label for="exampleInputage">Age</label>
                  <div class="input-group">
                         <input type="text" name="age" class="form-control" id="exampleInputAge" placeholder="Enter Your Age">
                      <div class="input-group-addon">
                      <i class="fa fa-birthday-cake"></i>
                      </div>
                  </div>
                </div>
				<div class="form-group col-md-6">
                  <label for="exampleInputLandlineNo">Landline No.</label>
                  <div class="input-group">
                         <input type="landline_no"name="landline_no" class="form-control" id="exampleInputEmail1" placeholder="Enter Your Landline No">
                      <div class="input-group-addon">
                      <i class="fa fa-phone"></i>
                      </div>
                  </div>
                </div>
				<div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Email address</label>
                  <div class="input-group">
                         <input type="email" name="email_id" class="form-control" id="exampleInputEmail1" placeholder="Enter email Address">
                      <div class="input-group-addon">
                      <i class="fa  fa-envelope-o"></i>
                      </div>
                  </div>
                </div>
				<div class="form-group col-md-6">
                  <label for="exampleInputDob">Date Of Birth</label>
                  <div class="input-group">
                         <input type="date" name="dob" class="form-control" id="exampleInputPassword1" placeholder="Enter Your Date Of Birth">
                      <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                      </div>
                  </div>
                </div>
				<div class="form-group col-md-6">
                  <label for="exampleInputmobile_no">Mobile No.</label>
                  <div class="input-group">
                         <input type="text" name="mobile_no" class="form-control" id="exampleInputmobile_no" placeholder="Enter Your Mobile No.">
                      <div class="input-group-addon">
                      <i class="fa  fa-mobile-phone "></i>
                      </div>
                  </div>
                </div>
			 <div class="col-md-6">		
				<div class="form-group">
				</br></br> 
					  <label for="exampleInputDob">Gender &nbsp;</label>
						<input type="radio" name="gender" class="minimal" checked> &nbsp; Male 
						<input type="radio" name="gender" class="minimal"> &nbsp; Female
				</div>
			</div>
			<div class="col-md-6">		
				<div class="form-group">
				
					  <label for="exampleInputDob">Address</label>
						<textarea name="address" class="form-control" ></textarea>
				</div>
			</div>
		
			<div class="form-group col-md-6">
					  <label for="exampleInputmobile_no">LandMark</label>
					  <div class="input-group">
							 <input type="text" name="landmark" class="form-control" id="exampleInputmobile_no" placeholder="Enter Your Mobile No.">
						  <div class="input-group-addon">
						  <i class="fa  fa-map-marker"></i>
						  </div>
					  </div>
			 </div>
			 <div class="form-group col-md-6">
					  <label for="exampleInputPinCodeNo">Pin code No.</label>
					  <div class="input-group">
							 <input type="text" name="pincode_no" class="form-control" id="exampleInputpincode_no" placeholder="Enter Your Pin Code No">
						  <div class="input-group-addon">
						  <i class="fa fa-codepen"></i>
						  </div>
					  </div>
			 </div>
			 <div class="form-group col-md-6">
					  <label for="exampleInputemergency_contact_no">Emergency Contact No</label>
					  <div class="input-group">
							 <input type="text" name="emergency_contact_no" class="form-control" id="exampleInputemergencycontactno" placeholder="Enter Your Emergency Contact No">
						  <div class="input-group-addon">
						  <i class="fa fa-phone"></i>
						  </div>
					  </div>
			 </div>
			 <div class="form-group col-md-6">
					  <label for="exampleInputemergency_contact_name">Emergency Contact Name</label>
					  <div class="input-group">
							 <input type="text" name="emergency_contact_name" class="form-control" id="exampleInputemergency_contact_name" placeholder="Enter Your Emergency Contact Name">
						  <div class="input-group-addon">
						  <i class="fa fa-user"></i>
						  </div>
					  </div>
			 </div>
			 <div class="form-group col-md-6">
					  <label for="exampleInputHobbies">Hobbies</label>
					  <div class="input-group">
							 <input name="hobbies" type="text" class="form-control" placeholder="Hobbies">
						  <div class="input-group-addon">
						  <i class="fa fa-star-half-o"></i>
						  </div>
					  </div>
			 </div>
			 <div class="form-group col-md-6">
					  <label for="exampleInputAnyMedicalTreatment">Any Medical Treatment</label>
					  <div class="input-group">
							 <input name="any_medical_treatment" type="text" class="form-control" id="name" required="required" placeholder="Any Medical Treatment">
						  <div class="input-group-addon">
						  <i class="fa fa-stethoscope"></i>
						  </div>
					  </div>
			 </div>
			 <div class="form-group col-md-6">
					  <label for="exampleInputAnyMedicalTreatment">Area of Specialization</label>
					  <div class="input-group">
							 <input name="area_of_specialization" type="text" class="form-control" id="name" required="required" placeholder="Area of Specialization">
						  <div class="input-group-addon">
						  <i class="fa fa-briefcase"></i>
						  </div>
					  </div>
			 </div>
			 <div class="form-group col-md-6">
					  <label for="exampleInputAnyMedicalTreatment">How many children do you have ?</label>
					  <div class="input-group">
							 <input name="children" type="text" class="form-control" id="name" required="required" placeholder="How many children do you have ?">
						  <div class="input-group-addon">
						  <i class="fa fa-group "></i>
						  </div>
					  </div>
			 </div>
			 
		 <div class="col-md-6">
			<div class="form-group">
                  <label for="exampleInputFile">Identity proof like : Aadhar card / Pan card /Driving Licence. etc</label>
                  <input type="file" id="exampleInputFile" name="">
			</div>
		</div>
		 <div class="form-group col-md-6">
					  <label for="exampleInputAnyMedicalTreatment">Spouse Name</label>
					  <div class="input-group">
							 <input name="spouse_name" type="text" class="form-control" id="name" required="required" placeholder="Spouse Name">
						  <div class="input-group-addon">
						  <i class="fa fa-transgender-alt"></i>
						  </div>
					  </div>
			 </div>	
		<div class="form-group col-md-6">
					  <label for="exampleInputAnyMedicalTreatment">Spouse Date of Birth</label>
					  <div class="input-group">
							 <input class="form-control input-small date-picker"   value="" placeholder="Date of Birth" type="text" data-date-format="dd-mm-yyyy" type="text" name="spouse_dob"> 
						  <div class="input-group-addon">
						  <i class="fa fa-calendar"></i>
						  </div>
					  </div>
			 </div>
			<div class="form-group col-md-6">
					  <label for="exampleInputAnyMedicalTreatment">Date of Anniversary</label>
					  <div class="input-group">
							 <input class="form-control input-small date-picker"   value="" placeholder="Date of Anniversary" type="text" 
                                            data-date-format="dd-mm-yyyy" type="text" name="date_of_anniversary">
						  <div class="input-group-addon">
						  <i class="fa fa-calendar"></i>
						  </div>
					  </div>
			 </div>
			<div class="form-group col-md-6">
					  <label for="exampleInputAnyMedicalTreatment">Other Details (if any):</label>
					  <div class="input-group">
							  <input name="other_info" type="text" class="form-control" id="name" required="required" placeholder="Daily Routine problem you face">
						  <div class="input-group-addon">
						  <i class="fa fa-question"></i>
						  </div>
					  </div>
			 </div> 
		 
		 
		 
		 
		<div class="col-md-6">		
                <div class="form-group">
                  <label for="exampleInputAnyMedicalTreatment">Other Details (if any):</label>
				  <textarea name="remark" rows="2" class="form-control" id="" placeholder="Any other information would you like to share with us
"></textarea>
                </div>
		</div>
		
		  
		  
		</div>		
                
                
              </div> 
		</div>	  
              <!-- /.box-body -->

              <div class="box-footer">
			  <input name="submit" type="submit" class="btn btn-primary" id="submit" value="Register" >
                
              </div>
            </form>
          </div>
           
 
 
    </section>
    <!-- /.content -->
  </div>		 

<?php include("footer.php"); ?>