<?php 
include('auth.php'); 
include("../config.php");
include("header.php");
include('function.php');
date_default_timezone_set('Asia/Calcutta');
ini_set('max_execution_time', 100000);
@$status=$_GET['s'];
if(empty($status))
{
	$status=0;
}
@$SESSION_SUBSERVICE=$_SESSION['SESSION_SUBSERVICE']; 
@$SESSION_VENDORID=$_SESSION['SESSION_VENDORID']; 
@$SESSION_USERTYPE=$_SESSION['SESSION_USERTYPE']; 

if(isset($_POST['completed'])){
	$reason_for_complete=$_POST['reason_for_complete'];
	$update_id=$_POST['update_id'];
	
	if(@$SESSION_USERTYPE==1)
	{
		mysql_query("update `booking` set `reason_for_complete`='$reason_for_complete',`master_status`='3' where `id`='$update_id' ");
	}
	else
	{
		mysql_query("update `booking` set `reason_for_complete`='$reason_for_complete',`vendor_master_status`='3',`master_status`='3' where `id`='$update_id' ");
	}
	
}
if(isset($_POST['rejected'])){
	$reason_for_rejection=$_POST['reason_for_rejection'];
	$update_id=$_POST['update_id'];
	if(@$SESSION_USERTYPE==1)
	{
		mysql_query("update `booking` set `reason_for_rejection`='$reason_for_rejection',`master_status`='2' where `id`='$update_id' ");
	}
	else
	{
		mysql_query("update `booking` set `reason_for_rejection`='$reason_for_rejection',`vendor_master_status`='2',`master_status`='2' where `id`='$update_id' ");
	}	
}
if(isset($_POST['transfered'])){
	$reason_for_transfer=$_POST['reason_for_transfer'];
	$update_id=$_POST['update_id'];
	if(@$SESSION_USERTYPE==1)
	{
		mysql_query("update `booking` set `reason_for_transfer`='$reason_for_transfer',`master_status`='1' where `id`='$update_id' ");
	}
	else
	{
		mysql_query("update `booking` set `reason_for_transfer`='$reason_for_transfer',`vendor_master_status`='1',`master_status`='1' where `id`='$update_id' ");
	}
}
if(isset($_POST['assign'])){
	$assign_to_vendor=$_POST['assign_to_vendor'];
	$update_id=$_POST['update_id'];
 
	mysql_query("update `booking` set `assign_to_vendor`='$assign_to_vendor',`master_status`='4' where `id`='$update_id' ");
}
 
?>

     <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                	<h3 class="box-title">Leads Status</h3>
                </div>
               <!------		Button 	----->
                <div class="col-md-12" align="right">
				<?php if(@$SESSION_USERTYPE==1){ ?>
						<a class="btn btn-warning" id="lead_button" href="partner_lead.php"> <i class="fa fa-book"> </i> Partner Leads</a>
				<?php } ?>
					<?php
                    
                    $sql='select `status`,`status_name` from `status_master` ';
                    $excute_sql=mysql_query($sql);
                    while($fetch_data=mysql_fetch_array($excute_sql))
                    {
                        $activeclass='';
                        if($status==$fetch_data['status'])
                        {
                            $activeclass='btn btn-danger margin';
                        }
                        else
                        {
                            
                            $activeclass='btn btn-primary margin';		
                        }
				if(@$fetch_data['status'] !=4)	{
				echo '<a class="'.$activeclass.'" href="lead_status.php?s='.$fetch_data['status'].'"><i class="fa fa-book"> </i> '.$fetch_data['status_name'].'</a>'; 
				} 
				else if(@$fetch_data['status'] == 4 && @$SESSION_USERTYPE==1)
				{echo '<a class="'.$activeclass.'" href="lead_status.php?s='.$fetch_data['status'].'"><i class="fa fa-book"> </i> '.$fetch_data['status_name'].'</a>';}
			
			}
			?>
                </div>
                <div class="box col-md-12">
                     
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table  class="table table-bordered table-striped">
                        <thead>
                        <tr>
						 <th>UdCare No</th>
                          <th>Name</th>
                          <th>Mobile No</th>
 						  <th>Service Type</th>
                          <th>Pickup date</th>
                          <th>Pickup Time</th>
						 <?php if($status == 0){ ?>
                          <th>Action</th>
						 <?php }
						 else if($SESSION_USERTYPE==1 && @$status == 4)   
						 {
							echo "<th>Status</th>";  
						 }
						 if($SESSION_USERTYPE == 1 && @$status != 3 ){?>
						 <th>Assign</th>
						<?php } ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
						//- Paginatoion
						$num_rec_per_page=10;
						if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
						$start_from = ($page-1) * $num_rec_per_page; 
						
						
						if($SESSION_USERTYPE==1){
							$leadNew="SELECT * from `booking` where `master_status` = '$status'  LIMIT $start_from, $num_rec_per_page";
						}
						else
						{
							$leadNew="SELECT * from `booking` where `vendor_master_status` = '$status' && `assign_to_vendor` = '$SESSION_VENDORID' LIMIT $start_from, $num_rec_per_page";
 						}
						$Newlead=mysql_query($leadNew);
						
						while($lead_new=mysql_fetch_array($Newlead)){
						$id=$lead_new['id'];	
						$date=$lead_new['date'];
						if($date=='0000-00-00' || $date=='1970-01-01'){ $dateforview='00-00-0000';}	
						else { $dateforview=date('d-m-Y',strtotime($date));} 
						$mobile_no=$lead_new['mobile_no'];  
						$assign_to_vendor=$lead_new['assign_to_vendor']; 
						$vendor_name=mysql_query("select `full_name` from vendor where `id`='$assign_to_vendor'");
						$fetch_name=mysql_fetch_array($vendor_name);
						$full_name=$fetch_name['full_name'];
						$sub_service=$lead_new['master_sub_service_id'];
						$sql=mysql_query("select `sub_services_name` from `master_sub_services` where `id`='$sub_service'");
						$ftc=mysql_fetch_array($sql);
						$vendor_master_status=$lead_new['vendor_master_status'];
						
						$sql1="select `status`,`status_name` from `status_master` where `status` = '".$vendor_master_status." '";
						
						$excute_sql1=mysql_query($sql1);
						$fetch_data1=mysql_fetch_array($excute_sql1);						
                        $status_name=$fetch_data1['status_name'];
						 
						
						?>
                        <tr>
                          <td><?php echo $lead_new['udcare_no'];?></td>
						 <td><?php echo ucwords($lead_new['name']); ?></td>
 						  <td><?php echo $mobile_no; ?></td>
						 <td><?php echo ucwords($ftc['sub_services_name']); ?></td>
                          <td><?php echo $dateforview; ?></td>
                          <td><?php echo $lead_new['time']; ?></td>
                          <?php if($SESSION_USERTYPE==1 && @$status == 4) { ?>
						 <td><strong><?php echo ucwords($status_name); ?></strong></td>
						 <?php } ?>
                          <?php if($status == 0){ ?>
                          <td>
                          
                          	 
                                <div class="btn-group action">
                                   
                                  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"> Action
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                  </button>
                                  <ul class="dropdown-menu" role="menu">
                                    <li><a data-toggle="modal" data-target="#reject<?php echo $lead_new['udcare_no']; ?>">Reject</a></li>
                                    <li class="divider"></li>
                                    <li><a data-toggle="modal" data-target="#transfer<?php echo $lead_new['udcare_no']; ?>">Transfer</a></li>
                                    <li class="divider"></li>
                                    <li><a data-toggle="modal" data-target="#complete<?php echo $lead_new['udcare_no']; ?>">Complete</a></li>
                                  </ul>
                                </div>
							 
                                <div class="modal fade complete" id="complete<?php echo $lead_new['udcare_no']; ?>" role="dialog">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                      <form method="post">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <h4 class="modal-title">Do you want to complete this lead </h4>
                                        </div>
                                        <div class="modal-body"  style="min-height:100px">
                                         	<div class="form-group col-md-12">
                                             <label class="">Remarks(any)</label>
                                             <input type="hidden" name="update_id" value="<?php echo $lead_new['id']; ?>" />
                                             <textarea name="reason_for_complete" class="form-control"style="width:100%" ></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                          <button type="submit" name="completed" class="btn btn-info">Complete</button>
                                        </div>
                                      </form>
                                      </div>
                                    </div>
                                  </div>
                                  
                                  <div class="modal fade" id="transfer<?php echo $lead_new['udcare_no']; ?>" role="dialog">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                      <form method="post">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <h4 class="modal-title"><strong>Do you want to transfer this lead </strong></h4>
                                        </div>
                                         <div class="modal-body"  style="min-height:100px">
                                         	<div class="form-group col-md-12">
                                             <label class="">Reason for Transfer</label>
                                             <input type="hidden" name="update_id" value="<?php echo $lead_new['id']; ?>" />
                                             <textarea name="reason_for_transfer" class="form-control"  style="width:100%" required></textarea>
                                            </div>
                                         </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                          <button type="submit" name="transfered" class="btn btn-info">Transfer</button>
                                        </div>
                                      </form>
                                      </div>
                                    </div>
                                  </div>
                                  
                                  <div class="modal fade" id="reject<?php echo $lead_new['udcare_no']; ?>" role="dialog">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                      <form method="post">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <h4 class="modal-title">Do you want to reject this lead </h4>
                                        </div>
                                        <div class="modal-body"  style="min-height:100px">
                                         	<div class="form-group col-md-12">
                                             <label class="">Reason for Rejection</label>
                                             <input type="hidden" name="update_id" value="<?php echo $lead_new['id']; ?>" />
                                             <textarea name="reason_for_rejection" class="form-control" style="width:100%"  required></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                          <button type="submit" name="rejected" class="btn btn-info">Reject</button>
                                        </div>
                                      </form>
                                      </div>
                                    </div>
                                  </div>
                              
                          </td>
                          <?php } ?>
						 <?php if($SESSION_USERTYPE==1 && @$status == 4) { ?>
						 <td><strong><?php echo ucwords($full_name); ?></strong></td>
						 <?php } ?>
						 <?php if($SESSION_USERTYPE==1 && (@$status !=3 && @$status !=4)) { ?>
						  <td>
                                <div class="btn-group assign">
                                  <button type="button" class="btn btn-warning assign_data"  service="<?php echo $lead_new['master_sub_service_id']; ?>" data-toggle="modal" data-target="#assign_dailog" updateid="<?php echo $lead_new['id']; ?>"><i class="fa fa-thumbs-up"></i> Assign To</button>
                                </div>
                           </td>
						<?php } ?>	  
                         </tr>
                       <?php } ?>
                        </tbody>
                      </table>
                      <?php 
					  
	$totalqry=mysql_query('select * from `booking` where `master_status` = '.$status.'');
	$total_records = mysql_num_rows($totalqry);  //count number of records
	$total_pages = ceil($total_records / $num_rec_per_page); 
	
	echo "<div align='right'><ul class='pagination'><li>
	<a href='lead_status.php?s=".$status."&page=1' > ".' < '."</a> "; // Goto 1st page  
	
	for ($i=1; $i<=$total_pages; $i++) { 
	?>
    	<a <?php if($i==$page){ echo 'style="background-color:#337ab7; color:#FFF"'; } ?> href='lead_status.php?s=<?php echo $status."&page=".$i; ?>'><?php echo $i; ?> </a>
	<?php 
	}; 
	echo "<a href='lead_status.php?s=".$status."&page=$total_pages'>".' > '."</a> </li></ul> </div>"; // Goto last page
						?>
                      
                      <div class="modal fade" id="assign_dailog" role="dialog">
                            <div class="modal-dialog">
                              <div class="modal-content">
                              <form method="post">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Assign Lead  </h4>
                                </div>
                                <div class="modal-body"  style="min-height:100px" >
									<div class="form-group" id="replace_data" >

									
										</div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <button type="submit" name="assign" class="btn btn-info">Assign</button>
                                </div>
                              </form>
                              </div>
                            </div>
                          </div>
                      
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
		var id = $(this).attr('updateid');	
		$.ajax({
			url: "../ajax_page.php?function_name=fetch_servicw_vendor_list&id="+service+"&updateid="+id,
			type: "POST",
			success: function(data)
			{   
			 
				 $('#replace_data').html(data);
				 $('.date-picker').datepicker();
				 $('.timepicker').timepicker();
			}
		});
	});
	
</script>


On Thu, Jul 13, 2017 at 11:44 AM, Lakshit Lohar <lakshit@phppoets.in> wrote:
 

