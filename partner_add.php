<?php 
include("header.php");
include("config.php");
 
$message="";

 
if(isset($_POST['submit']))
{ 
	  $full_name=$_POST['full_name'];  
	$mobile_no=$_POST['mobile_no'];
    $email=$_POST['email'];  
	$aadhar_card_no=$_POST['aadhar_card_no'];
    $company_name=$_POST['company_name'];  
    $company_reg_no=$_POST['company_reg_no'];  
 	$company_address=$_POST['company_address'];
 	$company_serivces=$_POST['company_serivces'];
 	$service_price=$_POST['service_price'];
 	$discount=$_POST['discount'];
 	$offer=$_POST['offer'];
 	$current_date=date('Y-m-d ');
	 
	 
 	$s=mysql_query("select `aadhar_card_no`,`company_reg_no` from `temp_patner` where `aadhar_card_no`='$aadhar_card_no'&&`company_reg_no`='$company_reg_no'");
	$count=mysql_num_rows($s);
	if($count>0)
	{
		$message="Member Already Exist";
	}else
	{
		 
	$sql="insert into `temp_patner` set `full_name`='$full_name',`email`='$email',`mobile_no`='$mobile_no',`company_name`='$company_name',`company_reg_no`='$company_reg_no',`company_address`='$company_address',`company_serivces`='$company_serivces',`service_price`='$service_price',`discount`='$discount',`offer`='$offer',`aadhar_card_no`='$aadhar_card_no',`curent_date`='$current_date'";
	$r=mysql_query($sql);

			$message="Request Added  sucessfully ";
	
	}
	header('Location: partner_add.php');	
	
 		
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
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
		Partner Registration
		</h1>
     </section>

    <!-- Main content -->
    <section class="content">
		<div class="box box-primary" >
		<center>
		<h4>Registration Form</h4>
		<hr>
		 </center>
		<div>
		<?php 
			echo $message;
		?>
		</div>
           <form method="post"  id="contact-form" role="form" enctype="multipart/form-data">
         <div class="box-body" style="margin-left:40px;margin-right:40px;">
		 </br>
		 <div class="row">
		 
		 <div class="col-md-6">
				<div class="form-group">
                  <label >Full Name</label>
                  <div class="input-group">
                  	<input type="text" name="full_name" class="form-control" id="exampleInputFullName" placeholder="Enter Your Full Name" required>
                    <div class="input-group-addon">
                          <i class="fa fa-user"></i>
                      </div>
                  </div>
                </div>
		</div>
		<div class="col-md-6">		
                <div class="form-group">
                  <label >Mobile No.</label>
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
                  <label >Email address</label>
                  <div class="input-group">
                  	<input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter Email Address" >
                    <div class="input-group-addon">
                          <i class="fa fa-envelope"></i>
                      </div>
                  </div>
                </div>
		</div>
		<div class="col-md-6">		
             <div class="form-group">
              <label>Aadhar Card No.</label>
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
                  <label >Company Name</label>
                  <div class="input-group">
                  	<input type="text" name="company_name" class="form-control" placeholder="Enter Your Company Name" required>
                    <div class="input-group-addon">
                          <i class="fa fa-user"></i>
                      </div>
                  </div>
                </div>
		</div>		
		
		 <div class="col-md-6">		
             <div class="form-group">
              <label >Company Registration No.</label>
              <div class="input-group">
              		<input name="company_reg_no" type="text" class="form-control" placeholder="Enter Your Company Registration No.">
                    <div class="input-group-addon">
                          <i class="fa fa-barcode"></i>
                      </div>
                  </div>
             </div>
		</div>	
		<div class="col-md-6">		
			<div class="form-group">
				<label >Company Service</label>
				<div class="input-group">
					<input type="text" name="company_serivces" class="form-control" placeholder="Enter Your Company Service" required>
					<div class="input-group-addon">
						<i class="fa fa-pencil"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">		
			<div class="form-group">
				<label >Service Price</label>
				 <div class="input-group">
				<input type="text" name="service_price" class="form-control" placeholder="Enter Your Service Price" required>
					<div class="input-group-addon">
						<i class="fa fa-pencil"></i>
					</div>
				</div>	
			</div>
		</div>
		<div class="col-md-6">		
			<div class="form-group">
				<label >Service Discount</label>
				<div class="input-group">
					<input type="text" name="discount" class="form-control" placeholder="Enter Your Discount" required>
                    <div class="input-group-addon">
						<i class="fa fa-percent"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">		
			<div class="form-group">
				 <label >Service Offer</label>
				 <input name="offer" type="text" class="form-control" placeholder="Enter Offer"></input>
			</div>
		</div>
		<div class="col-md-6">		
			<div class="form-group">
				<label >Company Address</label>
				
					<textarea name="company_address" class="form-control" placeholder="Enter Company Address"></textarea>
				
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
  </div>

		 

<?php include("footer.php"); ?>
