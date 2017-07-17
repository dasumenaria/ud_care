<?php
include('header.php');
include('config.php');
?>
<style>
.a class{
	
    text-decoration: none;
    color: #fff;
    padding: 1px 1px;
    background-color: #1BBC9B;
}
.a class:hover {
	color: #fff !important;
}
</style>
<style>
.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: black;
	padding:1px 22px;
	border-radius: 3px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
	-webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;
}
 
.button4 {
    background-color: white;
    color: black;
    border: 2px solid #007787;
}

.button4:hover {background-color: #2191a1; color:white;}
 
</style>
		<!-- start service -->
		<div id="service">
			<div class="container">
            
            <?php
				$count=0;
				$sql="select `id`,`service_name`,`discription`,`icon` from master_services where flag=0";
				$fet=mysql_query($sql);
				while($result=mysql_fetch_array($fet))
				{ 
					$count++; 
                	$id=$result['id'];
					$service_name=$result['service_name'];
					$discription=$result['discription'];
					$icon=$result['icon'];
					   
				
				if($count==1 ){ echo '<div class="row">'; }?>
				
					<div class="col-md-4 col-sm-4">
						<div class="media">
							<div class="media-object media-left wow fadeIn" data-wow-delay="0.1s">
								<i class="<?php echo $icon; ?>"></i>
							</div>
							<div class="media-body wow fadeIn">
								<h3 class="media-heading"><?php echo $service_name; ?></h3>
								<p><?php echo $discription; ?></p>
							</div>
						</div>
                        <div align="center" class="col-md-12" data-wow-delay="0.1s">
                        	<div style="width:45%">
                            <a href="discount_user.php?id=<?php echo $id;?>" class="button button4" style="text-decoration:none; padding: 10px;">
							More Service
                            </a>
                            </div>
                        </div>
					</div>
				 
               <?php
 				 $count==3;
				  
					}
				?>
				
			</div>
		</div>
		</br>
		<!-- end service -->

<?php
include('footer.php');
?>
	