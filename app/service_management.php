 <?php 
 include("auth.php");
include("header.php");
include("../config.php");
//include("mail.php");
date_default_timezone_set('Asia/Calcutta');
ini_set('max_execution_time', 100000);
 
if(isset($_POST['submit'])){
	 
	$vendor_id=$_POST['vendor_id'];
	$service_id=$_POST['service_id'];
	$sub_service_id=$_POST['sub_service_id'];
	$categroy_type=$_POST['categroy_type'];
	
   $sql="insert into `service_management` set `vendor_id`='$vendor_id',`service_id`='$service_id',`sub_service_id`='$sub_service_id',`categroy_type`='$categroy_type'";
 
  $r=mysql_query($sql);
}
   
	else
	{
		echo mysql_error();
		}
		

	
 ?>
  <section class="content">
      <div class="row">
 
        <div class="col-md-12">
         <div class="box box-primary">
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
 				<h3>&nbsp; Service Management </h3><hr>
           <form method="post"  id="contact-form" role="form" enctype="multipart/form-data">
         <div class="box-body" style="margin-left:40px;margin-right:40px;">
 		 <div class="row">
 		 <div class="col-md-6">		
             <div class="form-group">
              <label for="exampleInputAnyMedicalTreatment">Vendor Name</label>
              <div  >
              	<select name="vendor_id" class="form-control suv_category">
                <option value="">Select...</option>
                <?php
					$vendor_name=mysql_query("select * from vendor order by id Asc");
					while($ftc_name=mysql_fetch_array($vendor_name))
					{
						echo "<option value=".$ftc_name['id'].">".$ftc_name['full_name']."</option>";
					}
                ?>
                </select>
                </div>
             </div>
		</div>
		<div class="col-md-6">		
             <div class="form-group">
              <label for="exampleInputAnyMedicalTreatment">Service Type</label>
              <div class="">
              	<select name="categroy_type" class="form-control suv_category">
				<option value="">Select...</option>
                <option value="1">Discount</option>
				<option value="2">Door To Door</option>
			   
                </select>
                </div>
             </div>
		</div>
		 <div class="col-md-6">		
             <div class="form-group">
              <label for="exampleInputAnyMedicalTreatment">Service Category</label>
              <div class="">
              	<select name="service_id" class="form-control suv_category">
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
		<div class="col-md-6">		
             <div class="form-group">
              <label for="exampleInputAnyMedicalTreatment">Sub Service</label>
              <div class="">
                     <select name="sub_service_id" class="form-control" id="suv_category_result">
                		<option value="">Select...</option>
                    </select>
 
                  </div>
             </div>
		</div>
		
		<div class="col-md-12" align="center">		
             <div class="box-footer">
                  <input name="submit" type="submit" class="btn btn-primary" id="submit" value="Submit" >  
              </div>
		</div>
	</div>		
</div> 
</form>
  
	 	
      	 

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