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
		$services_id=$_POST['services_id'];
		$sub_services_name=$_POST['sub_services_name'];
		$sub_services_discription=$_POST['sub_services_discription'];
		$icon=$_POST['icon'];
 
		 $sql="insert into `master_sub_services` set `services_id`='$services_id', `sub_services_name`='$sub_services_name',`sub_services_discription`='$ 	sub_services_discription',`icon`='$icon'";
		 $r=mysql_query($sql);
	}	
		 
	else if(isset($_POST['sub_update']))
{
$edit_model=$_POST['edit_model'];
		$service_name=$_POST['service_name'];
		$services_id=$_POST['services_id'];
		$sub_services_name=$_POST['sub_services_name'];
		$sub_services_discription=$_POST['sub_services_discription'];
		$icon=$_POST['icon'];
mysql_query("update `master_sub_services` SET `services_id`='$services_id', `sub_services_name`='$sub_services_name',`sub_services_discription`='$ 	sub_services_discription',`icon`='$icon' where `id`='$edit_model' ");
}


else if(isset($_POST['sub_del']))
{
  $delet_model=$_POST['delet_model'];
   mysql_query("update `master_sub_services` SET `flag`=1 where `id`='$delet_model'");
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
		   <div class="box-body" style="margin-left:40px;margin-right:40px;">
		  
		 <div class="row">
		 </br>
		 <div class="col-md-5" style="border:1px solid #3C8DBC;">
		 <form method="post"  id="contact-form" role="form" enctype="multipart/form-data">
			<h4>&nbsp; Add Service</h4>
			<hr> 
		  <div class="col-md-12">
		   
				<div class="form-group">
                  <label for="exampleInputFullName">Sub Service Name</label>
                  <div class="input-group">
                  	<select name='services_id' class="form-control" >
									<option value="#">----Select Service----</option>
									<?php 
									
									$query=mysql_query("select * from master_services order by id Asc");
										while($fetch=mysql_fetch_array($query))
										{
									 
										$id=$fetch['id'];
										$service_name=$fetch['service_name'];									
									?>
									<option value="<?php echo $id;?>"><?php echo $service_name;?></option>
										<?php } ?>
					</select>
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="exampleInputFullName">Sub Service Name</label>
                  <div class="input-group">
                  	<input type="text" name="sub_services_name" class="form-control" id="exampleInputFullName" placeholder="Enter Service Name" required>
                    <div class="input-group-addon">
                          <i class="fa fa-user"></i>
                      </div>
                  </div>
                </div>
		</div>
		<div class="col-md-12">
		    
				<div class="form-group">
                  <label for="exampleInputFullName">Icon Class</label>
                  <div class="input-group">
                  	<input type="text" name="icon" class="form-control" id="exampleInputFullName" placeholder="Enter Icon class Name" required>
                    <div class="input-group-addon">
                          <i class="fa fa-user"></i>
                      </div> 
                  </div>
                </div>
		</div>
		 <div class="col-md-12">		
			<div class="form-group">
				 <label for="exampleInputDob">Description</label>
				 <textarea name="sub_services_discription" class="form-control"></textarea>
			</div>
		</div>	
		  <div class="col-md-12" align="center">		
             <div class="box-footer">
                  <input name="submit" type="submit" class="btn btn-primary" id="submit" value="Register" >  
 
             </div>
		</div>  
		</form>
		 </div>
		 <div class="col-md-1">
		 <h4>&nbsp;  </h4>
		 
 
		</div>
		 
		<div class="col-md-6" style="border:1px solid #3C8DBC;">
		 <h4>&nbsp; View Service</h4>
		<hr>
		<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
					 <th>S/no.</th>
                   
                  <th>Service Name</th>
				  <th>Edit</th>
				  <th>Delete</th>
				 </tr>
                </thead>

					

                <tbody>
				<?php
			  $r1=mysql_query("select * from master_sub_services  where flag='0' order by id Desc ");							
					$i=0;
					while($row1=mysql_fetch_array($r1))
					{
						$i++;
					$id=$row1['id'];
					$sub_services_name=$row1['sub_services_name'];
					 
					$sub_services_discription=$row1['sub_services_discription'];
					$icon=$row1['icon'];
					 
				
					?>

                <tr>
				<td><?php echo $i;?></td>
                  <td><?php echo $sub_services_name;?></td>
                    <td><a class="btn btn-circle btn-xs editbtn" style="background-color:#0CF; color:#fff" data-toggle="modal" href="#popupcat<?php echo $id ;?>"><i class="fa fa-edit"></i></a>
                          <div class="modal fade" id="popupcat<?php echo $id ;?>" tabindex="-1" aria-hidden="true" style="padding-top:35px">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <span class="modal-title" align="left" style="font-weight:bold;">Update</span>
                                        </div>
                                        <div class="modal-body">
                                               <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                            <div class="form-body">
                                            <input type="hidden" name="edit_model" value="<?php echo $id; ?>" />
                                                 <div class="row">
												 <div class="col-md-12">		
             <div class="form-group">
              <label for="exampleInputAnyMedicalTreatment">Service Category</label>
              <div class="input-group">
              	<select name="admin_book_service" class="form-control suv_category">
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
			</br></br></br>
		<div class="col-md-12">		
             <div class="form-group">
              <label for="exampleInputAnyMedicalTreatment">Sub Service</label>
              <div class="input-group">
                     <select name="admin_book_sub_service" class="form-control" id="suv_category_result">
                		<option value="">Select...</option>
                    </select>
                     
                  </div>
             </div>
		</div>
												</br></br></br>
												  <div class="col-md-12">	
												   <div class="form-group">
												   <label for="exampleInputDob" style="margin-left: 10px;">Description</label>												
													 <textarea name="sub_services_discription" class="form-control" style="margin-left: 60px;width:450px;" required > <?php echo $sub_services_discription; ?></textarea>
													</div>
												</div>	
												  </div>
                                        <div class="row">
                                                    <div class="col-md-12" align="right">
													</br>
                                                        <button type="submit" class="btn editbtn" name="sub_update" style="background-color:#0CF;color:#FFF;margin-right: 70px;">Update</button>
														<button type="submit" class="btn btn-danger" name="sub_update" style= "color:#FFF;margin-right: 70px;">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
							 <td align="center" width="3%">

            <a class="btn default red-stripe btn-sm"  rel="tooltip" title="Delete"  data-toggle="modal" href="#delete<?php echo $id ;?>"><i class="fa fa-trash"></i></a>
            <div class="modal fade" id="delete<?php echo $id ;?>" tabindex="-1" aria-hidden="true" style="padding-top:35px">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <span class="modal-title" style="font-size:14px; font-weight:bold; color:red;text-align:left">Are you sure, you want to delete this Service?</span>
                        </div>
                        <div class="modal-footer">
                        <form method="post" name="delete<?php echo $id ;?>">
                            <input type="hidden" name="delet_model" value="<?php echo $id; ?>" />
                            
                            <button type="submit" name="sub_del" value="" class="btn btn-danger">Yes</button> 
							<button type="submit" name="sub_del" value="" class="btn btn-primary">No</button> 
                        </form>
                        </div>
                    </div>
                <!-- /.modal-content -->
                </div>
        <!-- /.modal-dialog -->
            </div>
            </td>  
                 
                </tr>
                
								<?php } ?>
                </tbody>
                 
              </table>
		</div>
	</div>	
</br>	
</div> 

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