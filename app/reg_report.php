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
							<h3>Member</h3>
							<select class="form-control select2me" id="suv_category" style="width:225px;">
								<option value="">Select...</option>
								<?php
									$service1=mysql_query("select name,id from `register` where `flag`='0'");
									while($ftc_data=mysql_fetch_array($service1))
									{
									$id=$ftc_data['id'];
										$name=$ftc_data['name'];
										$name=decode($name,'UDRENCODE');	
								?>
									<option value="<?php echo $id;?>"><?php echo $name;?></option>
									<?php 	
									}
								?>
							</select>
						</div>
						 </div>
						</div>
				</div>
					<!-- /.box-header -->
				<div class="box-body" id="data">
					
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
 /* $(document).ready(function(){
	
 $("#go").click(function(){
	 
var from = $("#frm").val();
		var to = $("#to").val();
		
		$.ajax({
			url: "member_report.php?from="+frm+"&to="+to+"",
				}).done(function(response) {
		   $("#data").html(""+response+"");
			});
		});

});

$(document).ready(function(){    
        $(".find_records").on("change",function(){
			
	    var view_u=$(".find_records option:selected").val();
		 
	  	$.ajax({
			url: "member_report.php?view_u="+view_u,
			}).done(function(response) {
		   $("#data").html(""+response+"");
			});
});
});*/
  
	$("#suv_category ").on("change",function(){
		var s=$("#suv_category option:selected").val();
		
		$.ajax({
			url: "member_report.php?pon="+s,
			}).done(function(response) {
				$("#data").html(""+response+"");
		});
	});	
</script>
<?php 
include("footer.php");
?>

