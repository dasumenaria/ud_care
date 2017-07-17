<?php 
include("auth.php");
include("header.php");
include("../config.php");
include('function.php');
date_default_timezone_set('Asia/Calcutta');
ini_set('max_execution_time', 100000); 
$message="";
$image_path="";
  
 
if(isset($_POST['submit']))
{ 
		$service_name=$_POST['service_name'];
		$discription=$_POST['discription'];
		$icon=$_POST['icon'];
 
		 $sql="insert into `master_services` set  `service_name`='$service_name',`discription`='$discription',`icon`='$icon'";
		 $r=mysql_query($sql);
	}	
		 
	else if(isset($_POST['sub_update']))
{
$edit_model=$_POST['edit_model'];
$service_name=$_POST['service_name'];
mysql_query("update `master_services` SET `service_name`='$service_name' where `id`='$edit_model' ");
}
else if(isset($_POST['sub_del']))
{
  $delet_model=$_POST['delet_model'];
   mysql_query("update `master_services` SET `flag`=1 where `id`='$delet_model'");
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
   
     <?php
			  $r1=mysql_query("select * from login  where id='".$SESSION_ID."'");							
					$row1=mysql_fetch_array($r1);
					$id=$row1['id'];
					$register_id=$row1['register_id'];
					$r2=mysql_query("select * from register  where id='".$register_id."'");
					$row2=mysql_fetch_array($r2);
					$name=$row2['name'];
					$name=decode($name,'UDRENCODE');
					$email_id=$row2['email_id']; 
					$email_id=decode($email_id,'UDRENCODE');
					$mobile_no=$row2['mobile_no'];
					$mobile_no=decode($mobile_no,'UDRENCODE');
					
				
					?>

    <!-- Main content -->
    <section class="content">
		<div class="box box-primary" >
		   <div class="box-body" style="margin-left:40px;margin-right:40px;">
		  </br> 
		 <div class="row">
		 </br>
		 <div class="col-md-12" style="border:1px solid #3C8DBC;">
		 

		 <form method="post"  id="contact-form" role="form" enctype="multipart/form-data">
			<h4>&nbsp; Profile</h4>
			<hr> 
		  <div class="col-md-6">
		   
				<div class="form-group">
                  <label for="exampleInputFullName">Your Name</label>
                  <div class="input-group">
                  	<input type="text" name="service_name" class="form-control" id="exampleInputFullName" placeholder="Enter Your Name" required  value="<?php echo $name;?>">
                    <div class="input-group-addon">
                          <i class="fa fa-user"></i>
                      </div>
                  </div>
                </div>
		</div>
		<div class="col-md-6">
		    
				<div class="form-group">
                  <label for="exampleInputFullName">Your Email </label>
                  <div class="input-group">
                  	<input type="text" name="icon" class="form-control" id="exampleInputFullName" placeholder="Enter Email" value="<?php echo $email_id;?>" required>
                    <div class="input-group-addon">
                          <i class="fa  fa-envelope-o"></i>
                      </div> 
                  </div>
                </div>
		</div>
		<div class="col-md-6">
		    
				<div class="form-group">
                  <label for="exampleInputFullName">Your Mobile No.</label>
                  <div class="input-group">
                  	<input type="text" name="icon" class="form-control" id="exampleInputFullName" placeholder="Enter Mobile No" value="<?php echo $mobile_no;?>" required>
                    <div class="input-group-addon">
                          <i class="fa fa-mobile"></i>
                      </div> 
                  </div>
                </div>
		</div>
		<div class="col-md-6">
		     <div class="form-group">
                  <label for="exampleInputFullName">Your Old Password</label>
                  <div class="input-group">
                  	<input type="text" name="icon" class="form-control" placeholder="Your Old Password" required>
                    <div class="input-group-addon">
                          <i class="fa fa-qrcode"></i>
                      </div> 
                  </div>
                </div>
		</div>
		<div class="col-md-6">
		     <div class="form-group">
                  <label for="exampleInputFullName">Your New Password</label>
                  <div class="input-group">
                  	<input type="text" name="icon" class="form-control"  placeholder="Your New Password" required>
                    <div class="input-group-addon">
                          <i class="fa fa-qrcode"></i>
                      </div> 
                  </div>
                </div>
		</div>
		<div class="col-md-6">
		     <div class="form-group">
                  <label for="exampleInputFullName">Your Confirm Password</label>
                  <div class="input-group">
                  	<input type="text" name="icon" class="form-control" placeholder="Your Confirm Password" required>
                    <div class="input-group-addon">
                          <i class="fa fa-qrcode"></i>
                      </div> 
                  </div>
                </div>
		</div>		
		  <div class="col-md-12" align="center">		
             <div class="box-footer">
                  <input name="submit" type="submit" class="btn btn-primary" id="submit" value="Register" >  
 
             </div>
		</div>  
		</form>
		 </div>
	 
</div>
		</br></br> 
</section>
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
	 
	 
</script>