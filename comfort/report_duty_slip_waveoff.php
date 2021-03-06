<?php 
require_once("config.php");
require_once("function.php");
require_once("auth.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8" />
   <title><?php title(); ?></title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
	<?php logo(); ?>
    <?php css(); ?>
    <?php ajax(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
	<!-- BEGIN HEADER -->
	<?php navi_bar(); ?>
   <div class="page-container row-fluid">
      <!-- END SIDEBAR -->
      <?php  navi_menu(); ?>      
      <!-- BEGIN PAGE -->  
      <div class="page-content" id="zoom_div">
    <?php
	 if(isset($_GET['mode']))
	 {?>  
<form method="post" action="docburner.php">
<a class="btn blue diplaynone tooltips" role="button" href="report_duty_slip_waveoff.php"  title="Back" data-placement="bottom"><i class="icon-circle-arrow-left"></i></a>    
<button class="btn yellow diplaynone tooltips" role="button" title="Print" data-placement="bottom" id="zoom"  value="zoom_out" onClick="fun_zoom(this.value);javascript:window.print();"><i class="icon-print"></i></button> 
<button  type="submit" class="btn red diplaynone tooltips" title="Download in Excel"  data-placement="bottom"><i class="icon-download-alt"></i></button>
<input type="hidden" value="<?php echo $_POST['date_from']; ?>" name="date_from">
<input type="hidden" value="<?php echo $_POST['date_to']; ?>" name="date_to">
<input type="hidden" value="waveoffds" name="excel_for">
</form>
 <?php
	 }
	 ?>
         <div class="container-fluid">
     <?php menu(); ?>
     <?php
	 if(isset($_GET['mode']))
	 {
		 if($_GET['mode']=='view')
		 {
			$q1=""; $q2="";
			if(!empty($_POST['date_from'])&&!empty($_POST['date_to']))
			{
			$date_from=datefordb($_POST['date_from']);
			$date_to=datefordb($_POST['date_to']);
			$q1=" `date` between '".$date_from."' and  '".$date_to."' ";
			}
			if($q1=="")
			$qry ="select * from `duty_slip`  where `waveoff_status`='1'  ";
			else {
			$qry="select * from `duty_slip` where ";
			$q2=" and `waveoff_status`='1' "; }
			$sql=$qry.$q1.$q2;
			$result=mysql_query($sql);
			
	 		?>
            <div class="portlet box blue">
            <div class="portlet-title">
            <h4><i class="icon-trash"></i>Result for Waveoff DS</h4>
            </div>
            <div class="portlet-body form">
          	<div style="width:100%; overflow-x:scroll; overflow-y:hidden;">
            <table width="100%" class="table table-bordered table-hover table-condensed flip-content" id="sample_1">
            <thead>
            <th>DS No.</th>
            <th>Customer Name</th>
            <th>Guest Name</th>
            <th>Service</th>
            <th>Car</th>
            <th>Car No.</th>
            <th>Date</th>
            <th>Opening KM</th>
            <th>Closing KM</th>
            <th>Reason</th>
            </thead>
            <tbody>
            <?php
            while($row=mysql_fetch_array($result))
            {$i++;
				if(!empty($row['temp_car_no']))
				$car_no=$row['temp_car_no'];
				else
				$car_no=fetchcarno($row['car_id']);
				?>
                    <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo fetchcustomername($row['customer_id']);?></td>
                    <td><?php echo $row['guest_name'];?></td>
                    <td><?php echo fetchservicename($row['service_id']);?></td>
                    <td><?php echo fetchcarname($row['car_type_id']);?></td>
                    <td><?php echo $car_no; ?></td>
                    <td><?php echo dateforview($row['date']);?></td>
                    <td><?php echo $row['opening_km'];?></td>
                    <td><?php echo $row['closing_km'];?></td>
                    <td><?php echo $row['waveoff_reason'];?></td>
                    </tr>
                <?php
			 	}
			?>
          
            </tbody>
            </table>
            </div>
            </div>
            </div>
            <?php
		 }
	 }
	 else
	 {
		 ?>
        <form  name="form_name" action="report_duty_slip_waveoff.php?mode=view" class="form-horizontal"  method="post">
        <div class="portlet box blue">
        <div class="portlet-title">
        <h4><i class="icon-trash"></i>Waveoff DS</h4>
        </div>
        <div class="portlet-body form">
            
        <div class="control-group">
        <label class="control-label">Date From</label>
        <div class="controls">
        <input type="text" name="date_from" onClick="mydatepick();"  class="span6 m-wrap date-picker" />
        </div>
        </div>    
         
        <div class="control-group">
        <label class="control-label">Date To</label>
        <div class="controls">
        <input type="text" name="date_to" onClick="mydatepick();" class="span6 m-wrap date-picker" />
        </div>
        </div>    
     
        <div class="form-actions">
        <button type="submit"   class="btn green" name="done"/><i class="icon-signal"></i> Generate</button>
        <button type="reset"   class="btn yellow" name="done"/><i class="icon-retweet"></i> Reset</button>
        </div>
      	</div>
        </div>
 
 	   </form>
        <?php
	 }
	 ?>
        </div>
        </div>
        </div>
   <!-- BEGIN FOOTER -->
   
   <div class="footer">
     <?php footer();?>
   </div>
 <?php js(); ?> 
   <!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>