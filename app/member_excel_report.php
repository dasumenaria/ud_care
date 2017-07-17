<?php
include('auth.php'); 
include('function.php');
include("../config.php");


 $id=$_GET['id'];
   $filename="view_member_excel";
	@header("Expires: 0");
    @header("Pragma: no-cache");
    @header("Content-type: application/vnd.ms-excel");
    @header("Content-Disposition: attachment; filename=".$filename.".xls");
    @header("Content-Description: Generated Report" );    
 ?>

				<table border="1">
				<thead>
                <tr>
					<th>S/No.</th>
					<th>Name</th>
					<th>DOB</th>
					<th>Age</th>
					<th>Identity proof</th>
					<th>Email Id</th>
					<th>Mobile No.</th>
					<th>Gender</th> 
					<th>Land Line</th> 
					<th>Other Mobile No</th> 
					<th>Emergency Contact Name</th> 
					<th>Emergency Contact No</th> 
					<th>Adhar Card No</th> 
					<th>Spouse Name</th> 
					<th>Spouse DOB</th> 
					<th>Area Of Specialization</th> 
					<th>Any Medical Treatment</th> 
					<th>Date Of Anniversary</th> 
					<th>Routine Problem</th> 
					<th>Hobbies</th> 
					<th>Preferance Of Service</th> 
					<th>Children</th> 
					<th>Landmark</th> 
					<th>Address</th> 
					<th>Pincode No</th> 
					<th>Remarks</th> 
					<th>Other Information</th> 
					<th>Reason Of Delete</th> 
					<th>Admin Id</th> 
					<th>Date</th> 
					<th>Time</th> 
					<th>Udcare No</th> 
					<th>Unique Code</th> 
					<th>Send</th> 
                </tr>
                </thead>
                <tbody>
				<?php
					$r1=mysql_query("select * from `register` where `flag`='0'");							
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
						$age=$row1['age'];
						$gender=$row1['gender'];
						$landline_no=$row1['landline_no'];
						$other_mobile_no=$row1['other_mobile_no'];
						$emergency_contact_name=$row1['emergency_contact_name'];
						$emergency_contact_no=$row1['emergency_contact_no'];
						$aadhar_card_no=$row1['aadhar_card_no'];
						$spouse_name=$row1['spouse_name'];
						$spouse_dob=$row1['spouse_dob'];
						$area_of_specialization=$row1['area_of_specialization'];
						$any_medical_treatment=$row1['any_medical_treatment'];
						$date_of_anniversary=$row1['date_of_anniversary'];
						$routine_problem=$row1['routine_problem'];
						$hobbies=$row1['hobbies'];
						$preferance_of_service=$row1['preferance_of_service'];
						$children=$row1['children'];
						$landmark=$row1['landmark'];
						$address=$row1['address'];
						$pincode_no=$row1['pincode_no'];
						$remark=$row1['remark'];
						$other_info=$row1['other_info'];
						$reason_for_delete=$row1['reason_for_delete'];
						$admin_id=$row1['admin_id'];
						$date=$row1['date'];
						$time=$row1['time'];
						$udcare_no=$row1['udcare_no'];
						$unique_code=$row1['unique_code'];
						$send=$row1['send'];
						
						
						
						$name=decode($name,'UDRENCODE');
						$email_id=decode($email_id,'UDRENCODE');
						$mobile_no=decode($mobile_no,'UDRENCODE'); 
						$gender=decode($gender,'UDRENCODE'); 
						$address=decode($address,'UDRENCODE'); 
						$other_info=decode($other_info,'UDRENCODE'); 
						$emergency_contact_name=decode($emergency_contact_name,'UDRENCODE'); 
						$emergency_contact_no=decode($emergency_contact_no,'UDRENCODE'); 
						 
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

						<td> <?php echo $age;?></td>
						<td><img src="../identity_proof/<?php echo $identity_proof; ?>" width="100px" height="100px"/> </td>						
						<td> <?php echo $email_id;?></td>
						<td> <?php echo $mobile_no;?></td>
						<td> <?php echo $gender;?></td>  
						<td> <?php echo $landline_no;?></td>  
						<td> <?php echo $other_mobile_no;?></td>  
						<td> <?php echo $emergency_contact_name;?></td>  
						<td> <?php echo $emergency_contact_no;?></td>  
						<td> <?php echo $aadhar_card_no;?></td>  
						<td> <?php echo $spouse_name;?></td>  
						<td> <?php echo $spouse_dob;?></td>  
						<td> <?php echo $area_of_specialization;?></td>  
						<td> <?php echo $any_medical_treatment;?></td>  
						<td> <?php echo $date_of_anniversary;?></td>  
						<td> <?php echo $routine_problem;?></td>  
						<td> <?php echo $hobbies;?></td>  
						<td> <?php echo $preferance_of_service;?></td>  
						<td> <?php echo $children;?></td>  
						<td> <?php echo $landmark;?></td>  
						<td> <?php echo $address;?></td>  
						<td> <?php echo $pincode_no;?></td>  
						<td> <?php echo $remark;?></td>  
						<td> <?php echo $other_info;?></td>  
						<td> <?php echo $reason_for_delete;?></td>  
						<td> <?php echo $admin_id;?></td>  
						<td> <?php echo $date;?></td>  
						<td> <?php echo $time;?></td>  
						<td> <?php echo $udcare_no;?></td>  
						<td> <?php echo $unique_code;?></td>  
						<td> <?php echo $send;?></td>  
					</tr>
              <?php } ?>
                </tbody>
                </table>
			