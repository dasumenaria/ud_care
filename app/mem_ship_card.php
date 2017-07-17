<?php
include('auth.php'); 
include("../config.php");
include('function.php');
  
  echo @$from=$_GET['from'];
  echo @$to=$_GET['to'];
 
 ?>
<section class="content">
	<div class="row">
	<div class="col-md-12">
	<div class="box col-md-12" style="background:white;">
	<div class="box-header">
	 
	</br>
	</div>
	 <div class="box-body">
	 	 <div align='right' colspan='7'><a class="btn btn-success" href="member_card.php?frm=<?php echo $from; ?>&to=<?php echo $to;?>"><b>Print Card</b>&nbsp; &nbsp;<i class="fa fa-cloud-download "></i></a></div>
	<br>
	<table id="example1" class="table table-bordered table-striped">
		<thead>
		<tr>
			<th>S/No.</th>
			<th>Name</th>
			<th>DOB</th>
			<th>Age</th>
			<th>Mobile No.</th>
			<th>Identity proof</th>
			<th>print card</th> 
		</tr>
		</thead>
		 <tbody>
	 <?php 
			$r1=mysql_query("select * from register where `id` BETWEEN '$from' AND '$to' && flag='0'" );							
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
				<a class="btn btn-warning" href="member_card.php?id=<?php echo $id; ?>"><b>Print Card</b>&nbsp; &nbsp;<i class="fa fa-cloud-download "></i></a>
			</td> 
		</tr>
		<?php } ?>
		</tbody>	
	</table>
	</div>
	</div>
	</div>
	</div> 
 
</section>
 