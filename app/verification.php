 
<?php
session_start();
include("../config.php");
$unuse= @$_SESSION['UNUSES'];
$msg='';
if(isset($_POST['submit']))
{
	$in_code=$_POST['in_code'];
	//echo "select * from `login` where `id` = '$unuse'  &&  `code` = '$in_code' "; exit;
	$ftc_data=mysql_query("select * from `login` where `id` = '$unuse'  &&  `code` = '$in_code' ");
	$coiunt= mysql_num_rows($ftc_data);
 	
	if($coiunt>0)
	{
		$row= mysql_fetch_array($ftc_data);
		$id=$row['id'];
		$usertype=$row['user_type']; 
		$_SESSION['SESSION_ID']=$row['id'];
		$_SESSION['SESSION_USERNAME']=$row['username'];
		$_SESSION['SESSION_USERTYPE']=$row['user_type'];
		$_SESSION['SESSION_SUBSERVICE']=$row['master_sub_services'];
		$_SESSION['SESSION_REGISTERID']=$row['register_id'];
		unset($_SESSION['UNUSES']);
			ob_start();
			if($usertype==1){
				echo "<meta http-equiv='refresh' content='0;url=admin_dashboard.php'/>"; //
			}
			else if($usertype==2){
				echo "<meta http-equiv='refresh' content='0;url=vendor_dashboard.php'/>"; //
			}
			ob_flush();
	}
	else
	{
		$msg='Wrong OPT.';
 	}
 	
}

?>

             
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Verification</title>
</head>
<style>
span
{
	 color:#fb1818;	
}
</style>
<body>
<div align="center">
<form method="post">
<table width="40%" style="border:solid #333 1px; ">
<tr><td height="100px" align="center"><img src="../images/logos.png" height="80px" /></td></tr>
<tr><td height="30px"><strong>Please enter the random generated code that has been sent to your mobile no.</strong></td></tr>
<tr><td height="30px"><strong>Enter Code</strong> :<input type="text" style="height:30px" name="in_code" class="m-wrap medium" /> <span><?php echo $msg; ?></span></td></tr>
<tr><td height="30px" align="center"><input style=" width:90px; font-weight:bold; height:30px" type="submit" name="submit" value="Submit" /> </td></tr>
</table>
</form>
</div>
</body>
</html>        
            
            
            
            