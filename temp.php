<?php  
include("config.php");
include('app/function.php');
 $r1=mysql_query("select * from register where `send`='0'  order by id ASC limit 100 ");							
 	while($row1=mysql_fetch_array($r1))
	{
 		$id=$row1['id'];
 		$name=$row1['name'];
		$email_id=$row1['email_id'];
 		$mobile_no=$row1['mobile_no'];
		$other_mobile_no=$row1['other_mobile_no'];
		$unique_code=$row1['unique_code'];
 		
		$mobile_no=decode($mobile_no,'UDRENCODE'); 
		$working_key='A7a76ea72525fc05bbe9963267b48dd96';
		$sms_sender='UDCARE';
		$sms=str_replace(' ', '+', 'Welcome to Udaipur Care your one time password is '.$unique_code);
 		file_get_contents('http://alerts.sinfini.com/api/web2sms.php?workingkey='.$working_key.'&sender='.$sms_sender.'&to='.$mobile_no.'&message='.$sms.'');
 		
		$pass=md5($unique_code);
 		$date=date('Y-m-d');
		$time=date('h:i:s A');
		
		$ccheck=mysql_query("select `register_id` from `login` where `register_id`='$id'");
		$count=mysql_num_rows($ccheck);
 		if($count>0){
			$sql1="update `login` set `password`='$pass' where `register_id`='$id'";
			mysql_query($sql1);
		}
		else
		{	$email=decode($email_id,'UDRENCODE'); 
			mysql_query("insert into `login` set `username`='$mobile_no' , `password`='$pass' , `email_id`='$email',  `register_id`='$id' , `date`='$date', `time`='$time' ");
 		}
	}
/*
include("config.php");
include('app/function.php');
 $r1=mysql_query("select * from reg_n where flag = 0");							
 	while($row1=mysql_fetch_array($r1))
	{
 		$up_id=$row1['id'];
		$name=$row1['name'];
		$address=$row1['address'];
		$mobile_no=$row1['mobile_no'];
		$landline_no=$row1['landline_no'];
		
		$name=encode($name,'UDRENCODE');
		$mobile_no=encode($mobile_no,'UDRENCODE');
		$address=encode($address,'UDRENCODE');
		
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
		
		$sql="insert into `register` set  `name`='$name',`mobile_no`='$mobile_no',`address`='$address', `date`='$date', `udcare_no`='$udcare', `unique_code`='$string', `time`='$time'";
		mysql_query($sql);
		$ids=mysql_insert_id();
		$md4_password=md5($string);
		$mobile_no=decode($mobile_no,'UDRENCODE');
		$email_id=decode($email_id,'UDRENCODE');
		mysql_query("insert into `login` set `username`='$mobile_no' , `password`='$md4_password' , `register_id`='$ids' , `date`='$date', `time`='$time' ");
mysql_query("update `reg_n` set `flag`='1' where `id`='$up_id'");
		
 }
 */
?>