<?php 
require_once("function.php");
require_once ("classes/databaseclasses/DataBaseConnect.php");
require_once("auth.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8" />
   <title>Comfort</title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
  <?php css(); ?>
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
      <div class="page-content">
         <div class="container-fluid">
     <?php menu(); ?>
     <form method="post" name="form_name">
<!--<div>                     
<a href="service_menu.php" class="btn blue"><i class="icon-ok"></i> Add</a>
<a href="service_menu_edit.php" class="btn red"><i class="icon-edit"></i> Edit</a>
<a href="service_menu_delete.php" class="btn blue"><i class="icon-trash"></i> Delete</a>
<a href="service_menu_serch.php" class="btn blue"><i class="icon-search"></i> Search</a>
</div> -->
<br />
                    <div class="portlet box yellow">
                    <div class="portlet-title">
                    <h4><i class="icon-cogs"></i>Service Edit</h4>
                    </div>
                    <div class="portlet-body form">
                    <br />
                       <table width="100%">
	              	<tr><td> Service:</td><td>
					<select name="service_service_id" class="chosen"  >	
					<option value="">Service</option>
					<?php 
							$mydatabase = new DataBaseConnect();
							$result= $mydatabase->execute_query_return("select * from service");
							while($row=mysql_fetch_array($result))
							{
								 echo '<option value="'.$row['service_id'].'">'.$row['name'].'</option>';
							}
					?>
					</select>
					</td></tr>
	              	<tr><td> Car:</td><td>
	              	<select name="carname_master_id"  class="chosen">
	              	<option value="">Car</option>	
					<?php 
							$result= $mydatabase->execute_query_return("select * from carname_master");
							while($row=mysql_fetch_array($result))
							{
								echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
							}
							$mydatabase->close_connection();
					?>
					</select> <button type="submit" style="margin-left:1%; margin-top:-3% !important"  class="btn green" name="tariff_rate_edit" />Go <i class="icon-circle-arrow-right"></i></button>
	              	</td></tr>
	                </table>
                    <br>

                  <?php
				if(isset($_POST['tariff_rate_edit']))
				{
					?> 
                     <div style="width:100%; overflow-x:scroll; overflow-y:hidden; margin:10px 0 !important">
					<table width="100%"  class="table table-bordered table-hover" id="sample_1" style="border-collapse:collapse;">
                    <thead>
                        <tr>
                        <th >Service Name</th>
                        <th >Car</th>
                        <th >Rate</th>
                        <th >Kilometers</th>
                        <th >Extra KM Rate</th>
                        <th >Miminum Charge Hourly</th>
                       	<th >Extra Hour Rate</th>
                        <th >Update</th>
                        </tr>
                    </thead>
                     <tbody>
                    <?php           
				$q1="";	$q2="";	
				if(!empty($_POST['service_service_id']))
				{
					$service_service_id=$_POST['service_service_id'];
					$q1="service_service_id='".$service_service_id."'";
				}
				if(!empty($_POST['carname_master_id']))
				{
					$carname_master_id=$_POST['carname_master_id'];
					if($q1=="")
						$q2=" carname_master_id='".$carname_master_id."'";
					else 
						$q2=" AND carname_master_id='".$carname_master_id."'";
				}
                        $qry="select * from tariff_rate where ";
                        if($q1=="" && $q2=="")
                        	$sql="select * from tariff_rate";
                        else
                        	$sql=$qry.$q1.$q2;
                     $data_base_object = new DataBaseConnect();
                        $result= $data_base_object->execute_query_return($sql);
                        if($result)
                        {
                        while($row=mysql_fetch_array($result))
                        {
                        	$idd=$row['tariff_id'];
							$service_service_id=$row['service_service_id'];
							$qry="select * from `service` where `service_id`='$service_service_id'";
							$data_base_object = new DataBaseConnect();
							$result_service = $data_base_object->execute_query_return($qry);
							$row_service=mysql_fetch_array($result_service);
							$service_name=$row_service['name'];
							$carname_master_id=$row['carname_master_id'];
							$qry_car="select * from `carname_master` where `id`='$carname_master_id'";
							$result_car = $data_base_object->execute_query_return($qry_car);
							$row_car=mysql_fetch_array($result_car);
							$car_name=$row_car['name'];
							$rate = $row['rate'];
							$minimum_chg_km = $row['minimum_chg_km'];
							$extra_km_rate = $row['extra_km_rate'];
							$minimum_chg_hourly = $row['minimum_chg_hourly'];
							$extra_hour_rate = $row['extra_hour_rate'];
                       ?>
                           
                            <tr>
                            <td><?php echo $service_name;?></td>
                            <td><?php echo $car_name;?></td>
                            <td><?php echo $rate;?></td>
                            <td><?php echo $minimum_chg_km;?></td>
                            <td><?php echo $extra_km_rate;?></td>
                            <td><?php echo $minimum_chg_hourly;?></td>
                            <td><?php echo $extra_hour_rate;?></td>
                             <td><a class="btn mini red"  role="button"  href="service_update_tariff_rate.php?id=<?php echo $idd;?>" target="_blank" style="text-decoration:none;">
    							<i class="icon-edit"></i></a>
                            </td>
                            	<?php 
								}
					    	?>
                            </tr>
                        <?php
						}
                        }
					?>
                     </tbody>
                    </table> 
                         
                     </div>   
                
                     
                     </div>
                     </div> 
 		
        </form>
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