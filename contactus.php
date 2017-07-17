<?php
include('header.php');
include('config.php');
?>

<!-- start contact -->
		<div id="contact">
			<div class="container">
				<div class="row">
					
					<div class="col-md-4 col-sm-4 wow fadeIn" data-wow-delay="0.9s">
						<address>
							<h3>Visit Office</h3>
							<p><i class="fa fa-map-marker too-icon"></i>&nbsp; Rotary Udaipur Mewar Service Trust 11-12,Guru Ramdas Colony Opposite M.B. College Udaipur-313001(Raj.) </p>
							<p><i class="fa fa-phone too-icon"></i> &nbsp;0294-2490491, 2490492</p>
							<p><i class="fa fa-envelope-o too-icon"></i> &nbsp; helpline@udaipurcare.com</p>
						</address>
					</div>
					<form method="post" name="registration" class="col-md-8 col-sm-4" id="contact-form" role="form" >
					<h3>Contact Us</h3>
                    	<div class="col-md-12" style="padding-bottom:10px; " id="msg">
                           
                        </div>
							<div class="col-md-6 col-sm-12 wow fadeIn" data-wow-delay="0.3s">
								<input name="name" onkeyup="Validatename(this.value);" type="text" class="form-control" id="name"  placeholder="Name">
							</div>
							<div class="col-md-6 col-sm-12 wow fadeIn" data-wow-delay="0.3s">
								<input name="email" onblur="ValidateEmail(this.value);" type="email" class="form-control" id="email" placeholder="Email">
							</div>
                            <div class="col-md-12 col-sm-12 wow fadeIn" data-wow-delay="0.9s">
								<input name="mobileno" onchange="phonenumber(this.value);" type="text" maxlength="10" minlength="10" class="form-control" id="mobileno"  placeholder="Mobile No">
							</div>
							<div class="col-md-12 col-sm-12 wow fadeIn" data-wow-delay="0.9s">
								<textarea name="message" rows="5" class="form-control" id="message" placeholder="Message"></textarea>
							</div>
							<div class="col-md-offset-9 col-md-3 col-sm-6 wow fadeIn" data-wow-delay="0.3s">
								<input  type="button" class="form-control " id="submit_contact" value="Send">
							</div>
					</form>
				</div>
			</div>
		</div>
		<!-- end contact -->
		 

<script src="js/jquery.js"></script>
<script>
$( document ).ready(function() {
$('#submit_contact').on('click', function(){
	var name=$('#name').val();
	var email=$('#email').val();
	var mobile_no=$('#mobileno').val();
	var message=$('#message').val();
 	if(name.length>1){
		if(email.length>1){
			if(mobile_no.length>=9){
				if(message.length>1){
					
					$('#msg').html(' <img src="images/loading.gif" height="28px" />  Please wait...');
					
					$.ajax({
						url: "ajax_page.php?function_name=contact_us_submit&name="+name+"&email="+email+"&mobile_no="+mobile_no+"&message="+message,
						type: "POST",
						success: function(data)
						{  
							$('#name').val('');
							$('#email').val('');
							$('#mobile_no').val('');
							$('#message').val('');
							$('#msg').html('Thank you for contact with us.');
							
						}
					});
				}
				else
				{
					$('#msg').html('Please provide message');
				}
			}
			else
			{
				$('#msg').html('Please provide valid mobile no');
			}
		}
		else
		{
			$('#msg').html('Please provide email');
		}
	}
	else
	{
		$('#msg').html('Please provide name');
	}
	
});	
});

function Validatename(name)  
{   
	var name1 = /^[a-zA-Z\s-, ]+$/;  
	if(name.match(name1))  
	{  
	return true;  
	}  
	else  
	{  
	$('#msg').html('Name must have alphabet characters only');
	$('#name').val('');
	return false;  
	}  
}  


function ValidateEmail(email)  
{  
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
	if(email.match(mailformat))  
	{  
	return true;  
	}  
	else  
	{
	$('#msg').html('You have entered an invalid email address!');
	 $('#email').val('');
	return false;  
	}  
}  


function phonenumber(mobileno)  
{  
	var nofromat = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/; 
	if(mobileno.match(nofromat))  
	{  
	return true;  
	}  
	else  
	{ 
		$('#msg').html('You have entered an invalid mobile no! at least 10 digit');
	 $('#mobileno').val('');
	return false;  
	}  
}


</script>
<?php
include('footer.php');
?>