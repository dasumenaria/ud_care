<?php 
include('auth.php'); 
include("../config.php");
include("header.php");
date_default_timezone_set('Asia/Calcutta');
ini_set('max_execution_time', 100000);
@$status=$_GET['s'];
if(empty($status))
{
	$status=0;
}
@$SESSION_SUBSERVICE=$_SESSION['SESSION_SUBSERVICE'];
@$SESSION_USERTYPE=$_SESSION['SESSION_USERTYPE']; 
 
?>

     <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                	<h3 class="box-title">Leads Status</h3>
                </div>
               <!------		Button 	----->
                <div class="col-md-12" align="right">
					 &nbsp;
                </div>
                <div class="box col-md-12">
                     
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
						  <th>UdCare No</th>
                          <th>Name</th>
                          <th>Mobile No</th>
 						  <th>Service Type</th>
                          <th>Pickup date</th>
                          <th>Pickup Time</th>
                          <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
						@$SESSION_REGISTERID=$_SESSION['SESSION_REGISTERID'];  
						if(!empty($SESSION_REGISTERID))
						 {
							$ftc_data=mysql_query("select `udcare_no`,`unique_code` from `register` where `id`='$SESSION_REGISTERID'"); 
							$ftx_array=mysql_fetch_array($ftc_data);
							$udcare_no=$ftx_array['udcare_no'];
							$unique_code=$ftx_array['unique_code'];
						 }
						 else
						 {
							$udcare_no='';$unique_code=''; 
						 }
 						
						$leadNew="SELECT * from `booking` where `udcare_no` = '$udcare_no'";
						 
						$Newlead=mysql_query($leadNew);
						while($lead_new=mysql_fetch_array($Newlead)){
						$date=$lead_new['date'];
						if($date=='0000-00-00' || $date=='1970-01-01'){ $dateforview='00-00-0000';}	
						else { $dateforview=date('d-m-Y',strtotime($date));}
						$master_status=$lead_new['master_status'];
						if($master_status==0){
							$recod='<span class="label label-sm label-warning">In-Process</span>';
						}
						if($master_status==1){
							$recod='<span class="label label-sm label-success">In-Process</span>';
						 }
						else if($master_status==2){
							$recod='<span class="label label-sm btn red btn-sm">Rejected</span>';
						 }
						else if($master_status==3){
							$recod='<span class="label label-danger label-sm btn blue btn-sm">Completed</span>';
						 }
							
						  $sub_service=$lead_new['master_sub_service_id'];
						$sql=mysql_query("select `sub_services_name` from `master_sub_services` where `id`='$sub_service'");
						$ftc=mysql_fetch_array($sql);
						?>
                        <tr>
                          <td><?php echo $lead_new['udcare_no']; ?></td>
						  <td><?php echo $lead_new['name']; ?></td>
 						  <td><?php echo $lead_new['mobile_no']; ?></td>
						  <td><?php echo $ftc['sub_services_name']; ?></td>
                          <td><?php echo $dateforview; ?></td>
                          <td><?php echo $lead_new['time']; ?></td>
                          <td><?php echo $recod; ?></td>
                          </tr>
                          <?php }?>
                        </tbody>
                      </table>
                      
                      
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </section>
            <!-- /.content -->
          </div>
                
                </div>
            </div>
        </div>
    </div>
  
 
<?php 
include("footer.php");
?>
<script>
	$(".assign_data").on('click',function(){
		var service = $(this).attr('service');	
		$.ajax({
			url: "../ajax_page.php?function_name=fetch_servicw_vendor_list&id="+service,
			type: "POST",
			success: function(data)
			{   
				  $('.replace_data').html(data);
				  $('.date-picker').datepicker();
				  $('.timepicker').timepicker();
			}
		});
	});
</script>
