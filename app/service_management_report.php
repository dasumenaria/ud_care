<?php
include('auth.php'); 
include("../config.php");
include("header.php");
  
  
    if(isset($_POST['sub_del']))
{
	$delet_model=$_POST['delet_model'];
   mysql_query("update `service_management` SET `flag`=1 where `id`='$delet_model'");
  }
  else
	{
		echo mysql_error();
		}
		
  
  
 ?>
   

 <section class="content">
      <div class="row">
         
        <!-- /.col -->
        <div class="col-md-12">
          
                 
               <!------		Button 	----->
                 
                <div class="box col-md-12" style="background:white;">
                     
                    <!-- /.box-header -->
                     
					 
            <div class="box-header">
              <h3 class="box-title"> User Report </h3>
			</br>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
					 <th>S/no.</th>
                  <th>Vendor Name</th>
                  <th>Service Type</th>
				  <th>Service Category</th>
                  <th>Sub Service</th>
				 </tr>
                </thead>

					

                <tbody>
				<?php
				
			  $r1=mysql_query("select * from  service_management where flag=0");							
					$i=0;
					while($row1=mysql_fetch_array($r1))
					{
						$i++;
					$id=$row1['id'];
					$vendor_id=$row1['vendor_id'];
					$r2=mysql_query("select * from  vendor where id='".$vendor_id."' ");
					$fet=mysql_fetch_array($r2);
					$full_name=$fet['full_name'];
					$service_id=$row1['service_id'];
					
					$r3=mysql_query("select * from  master_services where id='".$service_id."' ");
					$fet1=mysql_fetch_array($r3);
					$service_name=$fet1['service_name'];
					
					$sub_service_id=$row1['sub_service_id'];
					$r4=mysql_query("select * from  master_sub_services where id='".$sub_service_id."' ");
					$fet2=mysql_fetch_array($r4);
					$sub_services_name=$fet2['sub_services_name'];
					
					$categroy_type=$row1['categroy_type'];
					 
				
					?>

                <tr>
				<td><?php echo $i;?></td>
                  <td><?php echo $full_name;?></td>
                  <td><?php echo $service_name;?></td>
                  <td><?php echo $sub_services_name;?></td>
				  <td align="center" width="3%">
				<a class="btn default red-stripe btn-sm"  rel="tooltip" title="Delete"  data-toggle="modal" href="#delete<?php echo $id ;?>" style="background:#FF851B;"><i class="fa fa-trash" style="color:white;"></i></a>
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
							<button type="submit" name="del" value="" class="btn btn-primary">No</button> 
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
            <!-- /.box-body -->
          </div>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                 
        <!-- /.col -->
      
      <!-- /.row -->
    </section>
  
 <?php 
include("footer.php");
  ?>