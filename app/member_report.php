<?php
include('auth.php'); 
include("../config.php");
include('function.php');
	echo @$member=$_GET['pon'];
	
 
//echo @$rows=$_GET['view_u'];
 
/* 
$from_date=$_GET['from'];
$to_date=$_GET['to'];

@$no_row=$_GET['no_row']; */
$p=$_SESSION['SESSION_ID'];
$session_id=$_SESSION['SESSION_ID'];
 
if(isset($_POST['deleted'])){
	$reason_for_delete=$_POST['reason_for_delete'];
	$update_id=$_POST['update_id'];
	mysql_query("update `register` set `reason_for_delete`='$reason_for_delete',`flag`='1' where `id`='$update_id' ");
}  
 ?>
<section class="content">
	<div class="row">
	<div class="col-md-12">
	<div class="box col-md-12" style="background:white;">
	<div class="box-header">
	 
	</br>
	</div>
	 <div class="box-body">
	<div align='right' colspan='7'><a class="btn btn-success" href="member_excel_report.php?id=<?php echo $p; ?>"><b>Download Excel</b>&nbsp; &nbsp;<i class="fa fa-cloud-download "></i></a></div><br>
	<table id="example1" class="table table-bordered table-striped">
		<thead>
		<tr>
			<th>S/No.</th>
			<th>Name</th>
			<th>DOB</th>
			<th>Age</th>
			<th>Mobile No.</th>
			<th>Identity proof</th>
			<th>Action</th> 
		</tr>
		</thead>
		<?php
		if(!empty($member) && empty($frm) && empty($to) ){
			  ?>
		<tbody>
		<?php 
			$r1=mysql_query("select * from register WHERE id='".$member."' && flag='0' ");							
			$i=0;
			while($row1=mysql_fetch_array($r1))
			{
				$i++;
				$id=$row1['id'];
				$name=$row1['name'];
				$dob=$row1['dob'];
				$identity_proof=$row1['identity_proof'];
				$email_id=$row1['email_id'];
				$mobile_no=$row1['mobile_no'];
				$name=decode($name,'UDRENCODE');
				$email_id=decode($email_id,'UDRENCODE');

				$mobile_no=decode($mobile_no,'UDRENCODE');
				if(!empty($dob))
				{
					$dateOfBirth = date('d-m-Y',strtotime($dob));
					$today = date("Y-m-d");
					$diff = date_diff(date_create($dateOfBirth), date_create($today));
					$age_year=$diff->format('%y');  
					$month_year=$diff->format('%m'); 
					$day_year=$diff->format('%d'); 
				}	

		?>

		<tr>
			<td><?php echo $i;?></td>
			<td><?php echo $name;?></td>
			<td><?php echo $dob;?></td>
			<td><?php if(!empty($dob)) {  echo $age_year.' Year and '.$month_year.' Month'; }?></td>
			<td> <?php echo $mobile_no;?></td>
			<td><img src="../identity_proof/<?php echo $identity_proof;?>" width="100px" height="100px"/> </td>
			<td>
				<a href="edit_member.php?ati_utf_id=<?php echo $row1['id']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> </a>
				<a data-toggle="modal" data-target="#delete<?php echo $row1['id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
				<div class="modal fade" id="delete<?php echo $row1['id']; ?>" role="dialog">
				<div class="modal-dialog">
				<div class="modal-content">
				<form method="post">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Do you want to delete this member </h4>
					</div>
					<div class="modal-body"  style="min-height:100px">
						<div class="form-group col-md-12">
							<label class="">Reason for delete</label>
							<input type="hidden" name="update_id" value="<?php echo $row1['id']; ?>" />
							<textarea name="reason_for_delete" class="form-control" cols="70" style="resize:none;" required></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" name="deleted" class="btn btn-danger">Delete</button>
					</div>
				</form>
				</div>
				</div>
				</div>
			</td> 
		</tr>
		<?php } ?>
		</tbody>
		<?php } ?>
		<!------------------------------------->
		<?php
		if(empty($member) && !empty($frm) && empty($to) ){
			  ?>
		<tbody>
		<?php 
			$r1=mysql_query("select * from register WHERE `id`='$frm' && flag='0' ");							
			$i=0;
			while($row1=mysql_fetch_array($r1))
			{
				$i++;
				$id=$row1['id'];
				$name=$row1['name'];
				$dob=$row1['dob'];
				$identity_proof=$row1['identity_proof'];
				$email_id=$row1['email_id'];
				$mobile_no=$row1['mobile_no'];
				$name=decode($name,'UDRENCODE');
				$email_id=decode($email_id,'UDRENCODE');

				$mobile_no=decode($mobile_no,'UDRENCODE');
				if(!empty($dob))
				{
					$dateOfBirth = date('d-m-Y',strtotime($dob));
					$today = date("Y-m-d");
					$diff = date_diff(date_create($dateOfBirth), date_create($today));
					$age_year=$diff->format('%y');  
					$month_year=$diff->format('%m'); 
					$day_year=$diff->format('%d'); 
				}	

		?>

		<tr>
			<td><?php echo $i;?></td>
			<td><?php echo $name;?></td>
			<td><?php echo $dob;?></td>
			<td><?php if(!empty($dob)) {  echo $age_year.' Year and '.$month_year.' Month'; }?></td>
			<td> <?php echo $mobile_no;?></td>
			<td><img src="../identity_proof/<?php echo $identity_proof;?>" width="100px" height="100px"/> </td>
			<td>
				<a href="edit_member.php?ati_utf_id=<?php echo $row1['id']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> </a>
				<a data-toggle="modal" data-target="#delete<?php echo $row1['id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
				<div class="modal fade" id="delete<?php echo $row1['id']; ?>" role="dialog">
				<div class="modal-dialog">
				<div class="modal-content">
				<form method="post">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Do you want to delete this member </h4>
					</div>
					<div class="modal-body"  style="min-height:100px">
						<div class="form-group col-md-12">
							<label class="">Reason for delete</label>
							<input type="hidden" name="update_id" value="<?php echo $row1['id']; ?>" />
							<textarea name="reason_for_delete" class="form-control" cols="70" style="resize:none;" required></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" name="deleted" class="btn btn-danger">Delete</button>
					</div>
				</form>
				</div>
				</div>
				</div>
			</td> 
		</tr>
		<?php } ?>
		</tbody>
		<?php } ?>
		<!------------------------------------->
		<?php
		if(empty($member) && !empty($frm) && !empty($to) ){
			 
			  ?>
		<tbody>
		<?php 
		echo "select * from register  where `id` BETWEEN '$frm' AND '$to'";
			$r1=mysql_query("select * from register WHERE `id` BETWEEN '$frm' AND '$to'");							
			$i=0;
			while($row1=mysql_fetch_array($r1))
			{
				$i++;
				$id=$row1['id'];
				$name=$row1['name'];
				$dob=$row1['dob'];
				$identity_proof=$row1['identity_proof'];
				$email_id=$row1['email_id'];
				$mobile_no=$row1['mobile_no'];
				$name=decode($name,'UDRENCODE');
				$email_id=decode($email_id,'UDRENCODE');

				$mobile_no=decode($mobile_no,'UDRENCODE');
				if(!empty($dob))
				{
					$dateOfBirth = date('d-m-Y',strtotime($dob));
					$today = date("Y-m-d");
					$diff = date_diff(date_create($dateOfBirth), date_create($today));
					$age_year=$diff->format('%y');  
					$month_year=$diff->format('%m'); 
					$day_year=$diff->format('%d'); 
				}	

		?>

		<tr>
			<td><?php echo $i;?></td>
			<td><?php echo $name;?></td>
			<td><?php echo $dob;?></td>
			<td><?php if(!empty($dob)) {  echo $age_year.' Year and '.$month_year.' Month'; }?></td>
			<td> <?php echo $mobile_no;?></td>
			<td><img src="../identity_proof/<?php echo $identity_proof;?>" width="100px" height="100px"/> </td>
			<td>
				<a href="edit_member.php?ati_utf_id=<?php echo $row1['id']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> </a>
				<a data-toggle="modal" data-target="#delete<?php echo $row1['id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
				<div class="modal fade" id="delete<?php echo $row1['id']; ?>" role="dialog">
				<div class="modal-dialog">
				<div class="modal-content">
				<form method="post">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Do you want to delete this member </h4>
					</div>
					<div class="modal-body"  style="min-height:100px">
						<div class="form-group col-md-12">
							<label class="">Reason for delete</label>
							<input type="hidden" name="update_id" value="<?php echo $row1['id']; ?>" />
							<textarea name="reason_for_delete" class="form-control" cols="70" style="resize:none;" required></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" name="deleted" class="btn btn-danger">Delete</button>
					</div>
				</form>
				</div>
				</div>
				</div>
			</td> 
		</tr>
		<?php } ?>
		</tbody>
		<?php } ?>
		
		
	</table>
	</div>
	</div>
	</div>
	</div> 
 
</section>
 