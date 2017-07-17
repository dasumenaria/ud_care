<?php
include('header.php');
include('config.php');

?> 
<style>
 
.title{ color:white; font-size:40px; }
.wrimagecard{	
	margin-top: 0;
    margin-bottom: 1.5rem;
    text-align: left;
    position: relative;
    background: #fff;
    box-shadow: 12px 15px 20px 0px rgba(46,61,73,0.15);
    border-radius: 4px;
    transition: all 0.3s ease;
}
.wrimagecard .fa{
	position: relative;
    font-size: 70px;
}
.wrimagecard-topimage_header{
padding: 20px;
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

/* */  

.contact .fa:before {
  display: inline-block;
  opacity: 0.7;
}

.contact li {
  display: inline-block;
  list-style-type: none;
  margin: 0 1em;
  text-align: center;
}

.contact p {
  text-align: center;
}

.contact {
  display: inline-block;
  margin: 0 auto;
  padding-left: 0;
}

.cont {
  text-align: center;
}

 

section {
    padding-top: 100px;
    
}

.quote {
    color: rgba(0,0,0,.1);
    text-align: center;
    margin-bottom: 30px;
}
 ---------------------------*/
 
#fade-quote-carousel.carousel .carousel-inner .item {
  opacity: 0;
  -webkit-transition-property: opacity;
      -ms-transition-property: opacity;
          transition-property: opacity;
}
#fade-quote-carousel.carousel .carousel-inner .active {
  opacity: 1;
  -webkit-transition-property: opacity;
      -ms-transition-property: opacity;
          transition-property: opacity;
} 
#fade-quote-carousel.carousel .carousel-indicators > li {
  background-color: #e84a64;
  border: none;
}
#fade-quote-carousel blockquote {
    text-align: center;
 
}
#fade-quote-carousel .profile-circle {
   
    margin: 0 auto;
    border-radius: 100px;
}

</style>  
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
<div id="service" style="margin-top:10px;">
	<div class="row">
	<div class="container">
     <p class="title" style="color:black;font-weight:bold;margin-top:10px;" >Our Services</p>
	 	<h4>Choose from our wide range of services</h4>
		</br>
	 
	  
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
					   
				 	if($count==1 ){ echo '<div class="row form-group">'; }
				
				?>
	<div class="col-md-3">
      <div class="wrimagecard wrimagecard-topimage">
          <a href="#">
          <div class="wrimagecard-topimage_header" style="background-color:#fff">
            <center><i class="<?php echo $icon; ?>" style="color:#5a454599;"> </i></center>
			<hr></hr>
          </div>
          <div class="wrimagecard-topimage_title" >
				<center><h4><a href="service.php?id=<?php echo $id;?>" style="font-size:18px;"><?php echo $service_name; ?></a></h4></center>
          </div>
          
        </a>
      </div>
	</div>
	 <?php  
			if($count==4){ echo '</div>';  $count=0;}
		 } ?>
	</div>
	</div>
</div> 
 
 
 
 
		</div>
 

 		<!-- end service -->

<?php
include('footer.php');
?>

	<script>
    $('#myCarousel').carousel({
        pause: 'none'
	})
</script>
