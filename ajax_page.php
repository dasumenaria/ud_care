<?php

include("config.php");
include("app/function.php");
$function_name=$_GET['function_name'];
if($function_name=='mobileNo_check')
{
	$mobile_no=$_GET['mobile'];
	$mobile_no=encode($mobile_no,'UDRENCODE');
	$ftc_date=mysql_query("select `mobile_no` from `register` where `mobile_no`= '$mobile_no'");
	$count= mysql_num_rows($ftc_date); 
} 
if($function_name=='fetch_servicw_vendor_list')
{
	 $service_id=$_GET['id'];
	 $updateid=$_GET['updateid'];
	$ftc_date=mysql_query("select `id`,`vendor_id` from `service_management` where `sub_service_id`= '$service_id'");	
echo" <input type='hidden' name='update_id'value='".$updateid."'/>";		
echo"<select name='assign_to_vendor' class='form-control'>
<option value=''>Select...</option>";	
 	while($ftc=mysql_fetch_array($ftc_date)){
		$vendor_id=$ftc['vendor_id'];
		$ftc_vendor_id=mysql_query("select `id`,`full_name` from `vendor` where `id`= '$vendor_id'");	
		$fet=mysql_fetch_array($ftc_vendor_id);
		echo $fet['full_name'];



		echo "<option value=".$fet['id'].">".$fet['full_name']."</option>";
	
	}
	echo"</select>";	
}

if($function_name=='fetch_service_list')
{
	$service_id=$_GET['id'];
 	$ftc_date=mysql_query("select `id`,`sub_services_name` from `master_sub_services` where `services_id`= '$service_id' && `flag`='0'");	
		echo '<option value="">Select...</option>';
	while($ftc=mysql_fetch_array($ftc_date)){
		echo "<option value=".$ftc['id'].">".$ftc['sub_services_name']."</option>";
	}
}
if($function_name=='smsgenerate')
{
						$mobile_no=$_GET['mobileno'];
						
						 $usercheck=mysql_query("select `username` from `login` where `username`='$mobile_no'");
						$check=mysql_num_rows($usercheck);
						if($check>0)
						{
							$chars = "0123456789";//ABCDEFGHIJKLMNOPQRSTUVWXYZ
							$string = '';
							for ($i = 0; $i < 6; $i++) {
							 $string .= $chars[rand(0, strlen($chars) - 1)];
							} 
							
							$md4_password=md5($string);
							
							mysql_query("update `login` set `password`='$md4_password' where `username`='$mobile_no' ");
							 $working_key='A7a76ea72525fc05bbe9963267b48dd96';
							$sms_sender='UDCARE';
							$sms=str_replace(' ', '+', 'Welcome to Udaipur Care your one time password is '.$string);
							file_get_contents('http://alerts.sinfini.com/api/web2sms.php?workingkey='.$working_key.'&sender='.$sms_sender.'&to='.$mobile_no.'&message='.$sms.'');
							echo 1;
						}
						else
						{
							echo "Your mobile no not registered";
						}
						
}
if($function_name=='contact_us_submit')
{
	require_once("mail.php");	
	$name=$_GET['name'];
	$email=$_GET['email'];
  	$message=$_GET['message'];
	$mobile_no=$_GET['mobile_no'];
	//--- EMAIL
	 	$to = 'helpline@udaipurcare.com'; //helpline@udaipurcare.com
 		$msg='New enquiry is sumbitted. <br><br> 
			<strong>Name : </strong>'.$name.'<br>
			<strong>Email : </strong>'.$email.'<br>
			<strong>Mobile No. : </strong>'.$mobile_no.'<br>
			<strong>Mesage : </strong>'.$message.'<br><br>
			Thanks <br><strong> Udaipur Care.</strong>';
		$from="helpline.udaipurcare@gmail.com";
		$from_name="Udaipur Care";
		$subject="Contact us";
		smtpmailer($to, $from, $from_name, $subject,$msg, $is_gmail = true);
        mysql_query("insert into `contact_us` set `name`='$name',`message`='$message',`mobile_no`='$mobile_no',`email`='$email'");
		echo "success";
}

if($function_name=='partner_submit')
{
	require_once("mail.php");	
	$name=$_GET['name'];
	$email=$_GET['email'];
	$mobile_no=$_GET['mobile_no'];
	//--- EMAIL
	 	$to = 'helpline@udaipurcare.com'; //helpline@udaipurcare.com
 		$msg='New enquiry is sumbitted. <br><br> 
			<strong>Name : </strong>'.$name.'<br>
			<strong>Email : </strong>'.$email.'<br>
			<strong>Mobile No. : </strong>'.$mobile_no.'<br>
			Thanks <br><strong> Udaipur Care.</strong>';
		$from="helpline.udaipurcare@gmail.com";
		$from_name="Udaipur Care";
		$subject="Contact us";
		smtpmailer($to, $from, $from_name, $subject, $is_gmail = true);
        mysql_query("insert into `master_partner` set `name`='$name',`mobile_no`='$mobile_no',`email`='$email'");
		echo "success";
}


 ?>