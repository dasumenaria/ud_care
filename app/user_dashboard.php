<?php
 
include('auth.php'); 
include("../config.php");
include("header.php");
  
  @$SESSION_SUBSERVICE=$_SESSION['SESSION_SUBSERVICE'];
//--	LEAD OPEN
$leadNew="SELECT `id` from `booking` where `master_status` = '0' && `master_sub_service_id`='$SESSION_SUBSERVICE'";
$Newlead=mysql_query($leadNew);
$lead_new=mysql_num_rows($Newlead);
//--	LEAD OPEN
$leadtransfer="SELECT `id` from `booking` where  `master_status` = '1' && `master_sub_service_id`='$SESSION_SUBSERVICE'";
$teanlead=mysql_query($leadtransfer);
$lead_transfer=mysql_num_rows($teanlead);
//--	LEAD OPEN
$leadreject="SELECT `id` from `booking` where  `master_status` = '2' && `master_sub_service_id`='$SESSION_SUBSERVICE'";
$Openreject=mysql_query($leadreject);
$lead_reject=mysql_num_rows($Openreject);

//--	LEAD OPEN
$leadconmpleted="SELECT `id` from `booking` where  `master_status` = '3' && `master_sub_service_id`='$SESSION_SUBSERVICE'";
$donelead=mysql_query($leadconmpleted);
$lead_complete=mysql_num_rows($donelead); 


 ?>
 
  
 <section class="content">
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-footer no-padding">
              <div class="mailbox-controls" style="min-height: 470px;">
			   
				<!---		TABS	---->
				<div class="col-lg-3 col-xs-6">
				  <div class="small-box bg-aqua">
					<div class="inner">
					  <h3> <?php echo $lead_new; ?> </h3>
					  <p> my Leads</p>
					</div>
					<div class="icon">
					  <i class="ion ion-stats-bars"></i>
					</div>
					<a href="user_lead.php" class="small-box-footer">
					  More info <i class="fa fa-arrow-circle-right"></i>
					</a>
				  </div>
				</div>
				<!---		TABS	---->
				<div class="col-lg-3 col-xs-6">
				  <div class="small-box bg-red">
					<div class="inner">
					  <h3><?php echo $lead_reject; ?></h3>
					  <p>Rejected Leads</p>
					</div>
					<div class="icon">
					  <i class="ion ion-person-add"></i>
					</div>
					<a href="user_lead.php" class="small-box-footer">
					  More info <i class="fa fa-arrow-circle-right"></i>
					</a>
				  </div>
				</div>
				
				<!---		TABS	---->
                 <!---		TABS	---->
				 </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  
 <?php 
include("footer.php");
  ?>