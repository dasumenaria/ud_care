 <?php 
 include("auth.php");
include("header.php");
include("../config.php");
//include("mail.php");
date_default_timezone_set('Asia/Calcutta');
ini_set('max_execution_time', 100000);
  $message="";
 if(isset($_POST['add_service']))
 {
	$service_name=$_POST['service_name'];
	$discription=$_POST['discription'];
	 
	 $sql="insert into `master_services` set `service_name`='$service_name', `discription`='$discription',flag=0";
 	mysql_query($sql);
 }
 
 if(isset($_POST['add_sub_service']))
 {
	$services_id=$_POST['company_service'];
	$sub_services_name=$_POST['sub_service_name'];
	$discription=$_POST['discription'];
	$sql="insert into `master_sub_services` set `sub_services_name`='$sub_services_name' , `services_id`='$services_id' , `discription`='$discription'";
	mysql_query($sql);
} 
  
if(isset($_POST['submit'])){
	 
	$full_name=$_POST['full_name'];
	$mobile_no=$_POST['mobile_no'];
	$landline_no=$_POST['landline_no'];
	$email_id=$_POST['email_id'];
	$aadhar_card_no=$_POST['aadhar_card_no'];
	$company_name=$_POST['company_name'];
	$company_reg_no=$_POST['company_reg_no'];
	$company_address=$_POST['company_address'];
	$company_service=$_POST['company_service'];
	$company_service_discription=$_POST['company_service_discription'];
	$company_sub_service=$_POST['company_sub_service'];
	$company_sub_service_discription=$_POST['company_sub_service_discription'];
	$discount=$_POST['discount'];
	$current_date=date('Y-m-d ');
	$offer=$_POST['offer'];
	$service_price=$_POST['service_price'];
   $sql="insert into `vendor` set `full_name`='$full_name', `mobile_no`='$mobile_no',`landline_no`='$landline_no',`email_id`='$email_id',`aadhar_card_no`='$aadhar_card_no',`company_name`='$company_name',`company_reg_no`='$company_reg_no',`company_address`='$company_address',`company_service`='$company_service',`company_service_discription`='$company_service_discription',`company_sub_service`='$company_sub_service',`company_sub_service_discription`='$company_sub_service_discription',`discount`='$discount',`offer`='$offer',`vendor_reg_date_get`='$current_date',`service_price`='$service_price'";
 
  $r=mysql_query($sql);
 
 	$ids=mysql_insert_id();

	$photo="company_logo".$ids.".jpg";
	$photo1="company_mou_certificate".$ids.".jpg";


// move photo in  floder//
	 

	move_uploaded_file($_FILES["company_logo"]["tmp_name"],"vendor/".$photo);
	move_uploaded_file($_FILES["company_mou_certificate"]["tmp_name"],"mou/".$photo1);

	if($r)
	{
		$r=mysql_query("update vendor set `company_logo`='$photo',`company_mou_certificate`='$photo1' where id='$ids'");
 
	 }

	else
	{
		echo mysql_error();
		}
		
}
	
	
	

?>
 
  

 
 <section class="content">
      <div class="row">
 
        <div class="col-md-12">
         <div class="box box-primary">
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
 				<h3>Vendor Registration </h3><hr>
           <form method="post"  id="contact-form" role="form" enctype="multipart/form-data">
         <div class="box-body" style="margin-left:40px;margin-right:40px;">
 		 <div class="row">
 		 <div class="col-md-6">
            <div class="form-group">
              <label for="exampleInputFullName">Full Name</label>
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
              <label for="exampleInputmobile_no">Landline No.</label>
              <div class="input-group">
                <input type="text" name="landline_no" class="form-control "  maxlength="12"  placeholder="Enter Your Landline No.">
                <div class="input-group-addon">
                      <i class="fa fa-mobile"></i>
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
            <div class="form-group">
              <label for="exampleInputmobile_no">Aadhar Card No</label>
              <div class="input-group">
                <input type="text" name="aadhar_card_no" class="form-control "  maxlength="12"  placeholder="Enter Your Aadhar Card No." required>
                <div class="input-group-addon">
                      <i class="fa fa-mobile"></i>
                  </div>
              </div>
            </div>
		</div>
		<div class="col-md-6">	
				<div class="form-group">
                  <label for="exampleInputEmail1">Company Name</label>
                  <div class="input-group">
                  	<input type="text" name="company_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Company Name" >
                    <div class="input-group-addon">
                          <i class="fa fa-envelope"></i>
                      </div>
                  </div>
                </div>
		</div>
		<div class="col-md-6">	
				<div class="form-group">
                  <label for="exampleInputEmail1">Company Registration No.</label>
                  <div class="input-group">
                  	<input type="text" name="company_reg_no" class="form-control" id="exampleInputEmail1" placeholder="Enter Company Registration No." >
                    <div class="input-group-addon">
                          <i class="fa fa-envelope"></i>
                      </div>
                  </div>
                </div>
		</div>
		 		
		  
		 	
		<div class="col-md-6">
			<div class="form-group">
                  <label for="exampleInputFile">Company Logo</label>
                  <div class="input-group">
                  	<input type="file" class="form-control" id="exampleInputFile" name="company_logo">
                    <div class="input-group-addon">
                          <i class="fa fa-upload"></i>
                      </div>
                  </div>
 		     </div>
		</div>		
		<div class="col-md-6">		
             <div class="form-group">
              <label for="exampleInputAnyMedicalTreatment">Service Category</label>
              <div class="input-group">
              	<select name="company_service" class="form-control suv_category">
                <option value="">Select...</option>
                <?php
					$ftx_servide=mysql_query("select `id`,`service_name` from `master_services` where `flag`='0'");
					while($ftc_data=mysql_fetch_array($ftx_servide))
					{
						echo "<option value=".$ftc_data['id'].">".$ftc_data['service_name']."</option>";
					}
                ?>
                </select>
              
              		
                    <div class="input-group-addon" style="background-color:#c7c6c6; cursor:pointer" data-toggle="modal" data-target="#service_dailog">
                          <i class="fa fa-plus"></i>
                      </div>
                  </div>
             </div>
		</div>
		<div class="col-md-6">		
             <div class="form-group">
              <label for="exampleInputAnyMedicalTreatment">Sub Service</label>
              <div class="input-group">
                     <select name="company_sub_service" class="form-control" id="suv_category_result">
                		<option value="">Select...</option>
                    </select>
                    <div class="input-group-addon" style="background-color:#c7c6c6; cursor:pointer" data-toggle="modal" data-target="#sub_service_dailog">
                          <i class="fa fa-plus"></i>
                      </div>
                  </div>
             </div>
		</div>
		<div class="col-md-6">		
			<div class="form-group">
				 <label for="exampleInputDob">Service Description</label>
				 <textarea name="company_service_discription" class="form-control"></textarea>
			</div>
		</div>
		<div class="col-md-6">		
			<div class="form-group">
				 <label for="exampleInputDob">Service Sub Description</label>
				 <textarea name="company_sub_service_discription" class="form-control"></textarea>
			</div>
		</div>
		<div class="col-md-6">		
			<div class="form-group">
				 <label for="exampleInputDob">Company Address</label>
				 <textarea name="company_address" class="form-control"></textarea>
			</div>
		</div>
		 
		
		<div class="col-md-6">
			<div class="form-group">
                  <label for="exampleInputFile">Company MOU Certificate</label>
                  <div class="input-group">
                  	<input type="file" class="form-control" id="exampleInputFile" name="company_mou_certificate">
                    <div class="input-group-addon">
                          <i class="fa fa-upload"></i>
                      </div>
                  </div>
 		     </div>
		</div>	
					
		
		 <div class="col-md-6">		
             <div class="form-group">
              <label for="exampleInputAnyMedicalTreatment">Service Price</label>
              <div class="input-group">
              		<input name="service_price" type="text" class="form-control" id="name" placeholder="Enter Service Price">
                    <div class="input-group-addon">
                          <i class="fa fa-book"></i>
                      </div>
                  </div>
             </div>
		</div>
		<div class="col-md-6">		
             <div class="form-group">
              <label for="exampleInputAnyMedicalTreatment">Discount On Service</label>
              <div class="input-group">
              		<input name="discount" type="text" class="form-control" id="name" placeholder="Enter How many Discount On Service">
                    <div class="input-group-addon">
                          <i class="fa fa-book"></i>
                      </div>
                  </div>
             </div>
		</div>
		<div class="col-md-6">		
             <div class="form-group">
              <label for="exampleInputAnyMedicalTreatment">Offer</label>
              <div class="input-group">
              		<input name="offer" type="text" class="form-control" id="name" placeholder="Enter Offer">
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
 <div class="modal fade" id="service_dailog" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
              <form method="post">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add New Service Category  </h4>
                </div>
                <div class="modal-body"  style="min-height:180px">
                    <div class="col-md-12">		
                         <div class="form-group">
                          <label for="exampleInputAnyMedicalTreatment">Service Category</label>
                          <div class=" ">
                            <input type="text" name="service_name" class="form-control" placeholder="Provide Service Category" />                                
                          </div>
                        </div>
                    </div>
                    <div class="col-md-12">		
                         <div class="form-group">
                          <label for="exampleInputAnyMedicalTreatment">Discription</label>
                          <div class="">
                          	<input type="text" name="discription" class="form-control" placeholder="Discription" />       
                          </div>
                        </div>
                    </div> 
                </div>
                
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" name="add_service" class="btn btn-info">Submit</button>
                </div>
              </form>
              </div>
    	</div>
      </div>	
	<div class="modal fade" id="sub_service_dailog" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
              <form method="post">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add New Sub Service </h4>
                </div>
                <div class="modal-body"  style="min-height:230px">
                     
                  <div class="col-md-12">		
                         <div class="form-group">
                          <label for="exampleInputAnyMedicalTreatment">Service Category</label>
                          <div class="">
                            <select name="company_service" class="form-control suv_category">
                            <option value="">Select...</option>
                            <?php
                                $ftx_servide=mysql_query("select `id`,`service_name` from `master_services` where `flag`='0'");
                                while($ftc_data=mysql_fetch_array($ftx_servide))
                                {
                                    echo "<option value=".$ftc_data['id'].">".$ftc_data['service_name']."</option>";
                                }
                            ?>
                            </select>
                             </div>
                        </div>
                    </div>  
                    <div class="col-md-12">		
                         <div class="form-group">
                          <label for="exampleInputAnyMedicalTreatment">Sub Service Name</label>
                          <div class="">
                          	<input type="text" name="sub_service_name" class="form-control" placeholder="Provide Sub Service Name" />       
                          </div>
                        </div>
                    </div> 
                    <div class="col-md-12">		
                         <div class="form-group">
                          <label for="exampleInputAnyMedicalTreatment">Discription</label>
                          <div class="">
                          	<input type="text" name="discription" class="form-control" placeholder="Discription" />       
                          </div>
                        </div>
                    </div> 
                      
                     
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" name="add_sub_service" class="btn btn-info">Submit</button>
                </div>
              </form>
              </div>
    	</div>
      </div>	
      	 

              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
  
 <?php 
include("footer.php");
  ?>
  <script>
  $('.suv_category').on('change', function(){
	var service = $(this).val();  
	$.ajax({
			url: "../ajax_page.php?function_name=fetch_service_list&id="+service,
			type: "POST",
			success: function(data)
			{   
				  $('#suv_category_result').html(data);
			}
		});
   });
  </script>