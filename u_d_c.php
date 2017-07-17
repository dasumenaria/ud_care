<?php
include('header.php');
include('config.php');
?>

<style>
 
 
.content {
    padding: 30px 0;
}

/***
Pricing table
***/
.pricing {
  position: relative;
  margin-bottom: 15px;
  border: 2px solid #33bacc;
}

.pricing-active {
  border: 2px solid #36d7ac;
  margin-top: -10px;
  box-shadow: 7px 7px rgba(54, 215, 172, 0.2);
}

.pricing:hover {
  border: 2px solid #007787;
}

.pricing:hover h4 {
  color: #36d7ac;
} 

.pricing-head {
  text-align: center;
}

.pricing-head h3,
.pricing-head h4 {
  margin: 0;
  line-height: normal;
}

.pricing-head h3 span,
.pricing-head h4 span {
  display: block;
  margin-top: 5px;
  font-size: 14px;
  font-style: italic;
}

.pricing-head h3 {
  font-weight: 300;
  color: #fafafa; 
  font-size: 27px;
  
 /* border-bottom: solid 2px #e7e0e0;*/
  
}

.pricing-head h4 {
  color: #000;
  padding: 5px 0;
  font-size: 32px;
  font-weight: 300;
  background: #f3f3f3;
  border-bottom: solid 2px #eee ;
}

.pricing-head-active h4 {
  color: #36d7ac;
}

.pricing-head h4 i {
  top: -6px;
  font-size: 18px;
  font-style: normal;
  position: relative;
}

.pricing-head h4 span {
  top: -10px;
  font-size: 14px;
  font-style: normal;
  position: relative;
}

/*Pricing Content*/
.pricing-content li {
  color: #888;
  font-size: 12px;
  padding: 7px 15px;
  border-bottom: solid 1px #f5f9e7;
}  

/*Pricing Footer*/
.pricing-footer {
  color: #777;
  font-size: 11px;
 
  text-align: center;
  padding: 0 20px 19px;
}

/*Priceing Active*/
.price-active,
.pricing:hover {
  z-index: 9;
}

.price-active h4 {
  color: #36d7ac;
}

.no-space-pricing .pricing:hover {
  transition: box-shadow 0.2s ease-in-out;
}

.no-space-pricing .price-active .pricing-head h4,
.no-space-pricing .pricing:hover .pricing-head h4 {
  color: #36d7ac;
  padding: 15px 0;
  font-size: 80px;
  transition: color 0.5s ease-in-out;
}

.yellow-crusta.btn {
  color: #FFFFFF;
  background-color:  #007787; 
}
.yellow-crusta.btn:hover,
.yellow-crusta.btn:focus,
.yellow-crusta.btn:active,
.yellow-crusta.btn.active {
    color: #FFFFFF;
    background-color: #2191a1;
}
  
   
</style> 
  <style>
#team img {
    border:none !important;
    display: inline-block;
    padding: 5px !important; 
    transition: all 0.4s ease-in;
	background-size: cover;

}
  
#background-carousel{
	position:absolute;
	width:100%;
	height:400px;
	z-index:-1;
}
.carousel,
.carousel-inner {
	width:100%;
	height:100%;
	z-index:0;
	overflow:hidden;
}
.item {
	width:100%;
	height:100%;
	background-position:center center;
	background-size:cover;
	z-index:0;
}
 
#content-wrapper {
	position:absolute;
	z-index:1 !important;
	min-width:100%;
}
.well {
    opacity:0.90

}

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
    padding: 20px 24px;
    height: 80px;
    padding-bottom: 0.75rem;
    position: relative;
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
 
<section class="content-header">
       <center>
      	<h2 class="wow bounce" style=" color:#707568"> <strong> 
		DISCOUNT 
       </strong></h2>
       </center>
	   </section>
 
  <div id="service" style="padding: 22px 61px; " class="footer_fix">
		 
		 
   <div class="container content">
	<div class="row"> 
		<!-- Pricing -->
		 <div class="col-md-3">
			<div class="pricing hover-effect">
				<div class="pricing-head">
					<h3><img src="images/partner/discount/7.jpg" width="100%" height="150px"></h3>
					  
				</div>
				 <div class="pricing-footer">
					<p style="font-size:12px">For Discount Click here <span class="label label-sm label-warning"  ><a href="service_booking.php" style="font-size:12px;color:white;text-decoration:none;">
						Get Coupan
					</a><i class="fa fa-share " style="height:10px"></i></span>
					</p>
					
				</div>
			</div>
		</div>
		</div>
	 	  
	 </div>
</div> 
  
</div>
     
		 
		<!-- end service -->

<?php
include('footer.php');
?>
	