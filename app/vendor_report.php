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
				<h3 class="box-title">Vendor Report</h3>
			</div>
			<!------		Button 	----->
			<div id="sample_1_wrapper" class="dataTables_wrapper no-footer">
			<div class="row">
			<div class="col-md-12">
			
							 
			<div class="col-md-3" >
				 <h3>Vendor Report</h3>
					<div class="input-group">
						<select class="form-control select2me" id="suv_category">
							<option value="">Select...</option>
							<?php
								$service1=mysql_query("select full_name,id from `vendor` where `flag`='0'");
								while($ftc_data=mysql_fetch_array($service1))
								{
								$id=$ftc_data['id'];
									$name=$ftc_data['full_name'];	
							?>
								<option value="<?php echo $id;?>"><?php echo $name;?></option>
								<?php 	
								}
							?>
						</select>
					</div>
				</div>
				 
					 
				<div class="box-body" id="data">
					
				</div>
				 
			
			</div>
			</div>
			</div>
			<!-- /.box -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</div>
<script src="../assest/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script>
 /* 
$(document).ready(function(){
	
 $("#go").click(function(){
	 
var from = $("#from").val();
		var to = $("#to").val();
		
		$.ajax({
			url: "view_vendor_report.php?from="+from+"&to="+to+"",
				}).done(function(response) {
		   $("#data").html(""+response+"");
			});
		});

});
 
$(document).ready(function(){    
        $(".find_records").on("change",function(){
			
	    var view_u=$(".find_records option:selected").val();
		
	  	$.ajax({
			url: "view_vendor_report.php?view_u="+view_u,
			}).done(function(response) {
		   $("#data").html(""+response+"");
			});
});
}); 

  */
	$("#suv_category ").on("change",function(){
		var s=$("#suv_category option:selected").val();
	 
		$.ajax({
			url: "view_vendor_report.php?pon="+s,
			}).done(function(response) {
				$("#data").html(""+response+"");
		});
	});	
</script>
<?php 
include("footer.php");
?>

