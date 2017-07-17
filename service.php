
<?php
include('header.php');
include('config.php');
echo $service_name_id=$_GET['id'];
	
?>
<?php 
 
				$sql="select * from master_services where id='".$service_name_id."' && flag='0'";
				$fet=mysql_query($sql);
				$ft=mysql_fetch_array($fet);
				 
				$service_name=$ft['service_name'];
				$discription=$ft['discription']; 
				$icon=$ft['icon'];
			?>
 <style>


.title{ color:white; font-size:40px; }
.wrimagecard{	
	margin-top: 0;
    margin-bottom: 1.5rem;
    text-align: left;
    position: relative;
    background: #fff;
    box-shadow: 13px 14px 10px -9px rgba(101, 105, 108, 0.8);
	
    border-radius: 4px;
    transition: all 0.3s ease;
}
.wrimagecard .fa{
	position: relative;
    font-size: 70px;
}
.wrimagecard-topimage_header{
padding: 8px;
}
a.wrimagecard:hover, .wrimagecard-topimage:hover {
    box-shadow: 2px 4px 8px 0px rgba(46,61,73,0.2);
}
.wrimagecard-topimage a {
    width: 100%;
   
    display: block;
}
.wrimagecard-topimage_title {
  height: 50px;  
}
.wrimagecard-topimage a {
    border-bottom: none;
    text-decoration: none;
    color: #525c65;
    transition: color 0.3s ease;
}

    
 </style>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
<section style="background-image:url(images/12.jpg);background-repeat:cover;">
<div class="row">
<?php 
$rr=mysql_query("select * from `master_services` where `service_name`='$service_name' and flag=0 ");
$ff=mysql_fetch_array($rr);
$id=$ff['id'];
$service_name=$ff['service_name'];

 ?>
 
	
			<div class = "col-md-12">
				<br/><br/>
					<center><h2 style="font-size:40px;"><i class="<?php echo $icon;?>"></i>&nbsp;<?php echo $service_name; ?></h2></center>
				 
			</div>
			<div class="col-md-6">
			 
			 <h3 style="font-size:30px;margin-left:22px;">Our All Services</h3> 
			 </br>
			 </div>
		
			<div class="col-md-12">
					 <?php
				$count=0;
				$query=mysql_query("select * from `master_sub_services` where `services_id`='$service_name_id' and flag=0 ");
					while($fetch=mysql_fetch_array($query))
					{
						$count++;	
						$id=$fetch['id'];
						$service_id=$fetch['services_id'];
						$sub_services_name=$fetch['sub_services_name'];
						
						$service_images=$fetch['service_images'];
						$sub_services_discription=$fetch['sub_services_discription'];
					
				if($count==1 ) 
				?> 

					<div class="col-md-2">
						<a class="open-code"  href="service_booking.php?id=<?php echo $id;?>" style="text-decoration;"> 
							<div class="wrimagecard wrimagecard-topimage" style="border-radius:25px;">
								<div class="wrimagecard-topimage_header" style="background-color:#fff;border-radius:25px;">
									<center><img src="images/service_images/<?php echo $service_images;?>" width="170px" height="140px"  style="border-radius:25px;"></center>
								</div>
								<div class="wrimagecard-topimage_title" >
									<center><span style="font-size:14px;font-weight:bold;"><?php echo $sub_services_name;?><span></center></br>
								</div>
							</div>
						</a> 	
					</div>
					  <?php  
		 if($count==6){ echo '</br></br>';  $count=0;}	
		 } ?>
					</div>
	 	
	  
</div>
</section>
	 

<?php
include('footer.php');
?>
	