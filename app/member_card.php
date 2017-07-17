<?php 
include('auth.php'); 
include("../config.php");
// include("header.php");

include('function.php');
@$from=$_GET['frm'];
@$to=$_GET['to'];
@$member_id=$_GET['id'];
  
$p=$_SESSION['SESSION_ID'];
$session_id=$_SESSION['SESSION_ID'];

?>
    <link rel="stylesheet" href="../assest/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assest/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../assest/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="../assest/plugins/datatables/dataTables.bootstrap.css"> 
    <link rel="stylesheet" href="../assest/plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="../assest/plugins/timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/plugins/select2/select2.css"/>
<style>
.col-md-4 {
	background-image:url(../images/member_card.png) !important;
	background-repeat: no-repeat;
	background-position: center;
	background-size: cover !important;
	height:240px;
	width:31%;
	border-right:1px solid #000;
	
}
.col-md-1 {
	width:1%;
}
.col-md-6
{
	top:30px;
	font-size:12px;
	color:#6BB0B9 !important;
	
	word-wrap: break-word; 
	width: 54.66666667%;
	position: relative;
	min-height: 1px; 
}
.col-md-3 {
    width: 25%;
	position: relative;
    min-height: 1px;
 }
 table {
	font-size:12px;
	color:#6BB0B9 !important; 
 }
</style>
<style>
@media print{
    .row{
        width:130% !important;
       
    }
	.clr{
		color:#fff !important;
	}
	
    .hidden-print{
        display:none;
    }
}
p{
margin-bottom: 0;
}
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot >
tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table >
tfoot > tr > td {
    padding: 1px !important;
    font-family:Lato !important;
	color:#fff;
}
</style>
<?php  
if (!empty($from) && !empty($to) && empty($member_id) )
{
?>
            <div class="row" align="center">
				<?php
					$r1=mysql_query("select * from register where id between '$from' and '$to' AND flag='0' order by id Desc");							
					$i=0;
					while($row1=mysql_fetch_array($r1))
				{ 
					$id=$row1['id'];
					$name=$row1['name'];
					$aadhar_card_no=$row1['aadhar_card_no'];
					$udcare_no=$row1['udcare_no'];
					$address=$row1['address']; 
					$name=decode($name,'UDRENCODE');
					?>
			
                <div class="col-md-4">
                 	<div class="col-md-6 clr" style="float:right">
                    	<table width="100%" class="clr">
                        <tr>
                        	<td width="40%"><strong class="clr" >Care No. </strong></td>
                            <td width="60%" class="clr" ><?php echo $udcare_no;?></td>
                        </tr>
						<tr><td>&nbsp;</td></tr>
                        <tr>
                        	<td><strong class="clr">Name </strong></td>
                            <td class="clr" ><?php echo $name;?></td>
                        </tr>
						<tr><td>&nbsp;</td></tr>
                        <tr>
                        	<td  ><strong class="clr">Adhar No.</strong></td>
                            <td class="clr" ><?php echo $aadhar_card_no;?></td>
                        </tr>
						<tr><td>&nbsp;</td></tr>
                        <tr>
                        	<td  ><strong class="clr">Address </strong></td>
                            <td class="clr"><?php echo $address;  ?></td>
                        </tr>
                    	</table>     
                    </div>
                </div> 
					<?php }  ?>   
			</div>
<?php } ?>	

<!----------------------------------->
<?php  
if (empty($from) && empty($to) && !empty($member_id) )
{
?>
            <div class="row" align="center">
				<?php
					$r1=mysql_query("select * from register where id ='".$member_id."'order by id Desc");							
					$i=0;
					while($row1=mysql_fetch_array($r1))
				{  
					$id=$row1['id'];
					$name=$row1['name'];
					$aadhar_card_no=$row1['aadhar_card_no'];
					$udcare_no=$row1['udcare_no'];
					$address=$row1['address']; 
					$name=decode($name,'UDRENCODE'); 

			
			?>
			 <div class="col-md-4">
                 	<div class="col-md-6 clr" style="float:right">
                    	<table width="100%" class="clr">
                        <tr>
                        	<td width="40%"><strong class="clr" >Care No. </strong></td>
                            <td width="60%"  ><?php echo $udcare_no;?></td>
                        </tr>
						<tr><td>&nbsp;</td></tr>
                        <tr>
                        	<td><strong>Name </strong></td>
                            <td  ><?php echo $name;?></td>
                        </tr>
						<tr><td>&nbsp;</td></tr>
                        <tr>
                        	<td  ><strong>Adhar No.</strong></td>
                            <td  ><?php echo $aadhar_card_no;?></td>
                        </tr>
						<tr><td>&nbsp;</td></tr>
                        <tr>
                        	<td  ><strong>Address </strong></td>
                            <td ><?php echo $address;  ?></td>
                        </tr>
                    	</table>     
                    </div>
                </div> 
                 
					<?php }  ?>   
			</div>
<?php } ?>	
		
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</div>
 
 

