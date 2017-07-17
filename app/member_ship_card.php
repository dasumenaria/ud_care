<?php 
include('auth.php'); 
include("../config.php");
include("header.php");

include('function.php');
@$status=$_GET['s'];
$p=$_SESSION['SESSION_ID'];
$session_id=$_SESSION['SESSION_ID'];

@$SESSION_SUBSERVIDE=$_SESSION['SESSION_SUBSERVICE'];
@$SESSION_USERTYPE=$_SESSION['SESSION_USERTYPE']; 
?>
<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border" style="background-color:#3c8dbc; color:#FFF">
				<h3 class="box-title">Member report</h3>
			</div>
			<!------		Button 	----->
 					
					<div class="input-group">
						<div class="row">
							<div class="col-md-12">
							 <div class="col-md-6">
								<h3 style=" ">From</h3>
								<select class="form-control select2me search_hw"  id="frm" style="width:150px; ">
									<option value="">Select...</option>
									<?php
										$service1=mysql_query("select name,id from `register` where `flag`='0'");
										while($ftc_data=mysql_fetch_array($service1))
										{
										$id=$ftc_data['id'];
									 ?>
										<option value="<?php echo $id;?>"><?php echo $id;?></option>
										<?php 	
										}
									?>
								</select>
							</div>
							<div class="col-md-6">
								<h3>To </h3>
								<select class="form-control select2me search_hw" id="to" style="width:150px;">
									<option value="">Select...</option>
									<?php
										$service1=mysql_query("select name,id from `register` where `flag`='0'");
										while($ftc_data=mysql_fetch_array($service1))
										{
										$id=$ftc_data['id'];
									 ?>
										<option value="<?php echo $id;?>"><?php echo $id;?></option>
										<?php 	
										}
									?>
								</select>
							</div>
						  </div>
						</div>
				</div>
					<!-- /.box-header -->
				<div class="box-body" id="vhw">
					
				</div>
				<!-- /.box-body -->
			
			<!-- /.box -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</div>
<script src="../assest/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script> 
	$(document).ready(function()
		{ 
		 
		$(".search_hw").on("change",function()
				{		
				 	var frm_id=$("#frm").val();
 	 
				var to_id=$("#to").val();
   
				  $.ajax({
					url: "mem_ship_card.php?from="+frm_id+"&to="+to_id,
					}).done(function(response) {
					$("#vhw").html(""+response+"");
					 						 
					});

				});			

		});

</script> 
<?php 
include("footer.php");
?>

