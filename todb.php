<?php
	
	include 'conn.php';
	
	if($con){
		if(isset($_POST['facultyname'])){
			
			$name = mysqli_real_escape_string($con, trim($_POST['facultyname']));
			$email = mysqli_real_escape_string($con, trim($_POST['email']));
			$password = md5(mysqli_real_escape_string($con, trim($_POST['password'])));
			
			$insert = "insert into faculty (name, email, password) values('$name', '$email', '$password')";
			if(mysqli_query($con, $insert)){
				echo "Registration Successful !!!";
				
				$email_msg = "Dear Sir/Mam,

Thank you registration as mentor of Project Endeavour.
For any query write to Team
Endeavour (projecte@spsu.ac.in)";
					
				$email_msg = stripslashes(html_entity_decode($email_msg));

				$email_subject = "Endeavour Faculty Registration";
					
				$headers = "From: projecte@spsu.ac.in\r\nReply-To: saturdayproject@spsu.ac.in\r\n";
					
				$mail_sent = @mail( $email, $email_subject, $email_msg, $headers );
					
				
				$message = '
Dear Admin,

New faculty joined as mentor, please find the detail.
Name: '.$name.'
E-mail: '.$email;
				$to = 'projecte@spsu.ac.in';

				$subject = 'SPSU Enquiry'; 
				$mail_sent = @mail( $to, $subject, $message, $headers );	

			}
			else{
				echo "Already registered with same Email !!!";
			}
		}
		else if(isset($_POST['s_pid'])){
			$spid = mysqli_real_escape_string($con, trim($_POST['s_pid']));
			
			$update = "UPDATE `selected` SET final_select=1 WHERE enrollment='$spid'";
			$run = mysqli_query($con, $update);
			if(mysqli_affected_rows($con))
				echo "true";
			else
				echo "false";
		}
		else if(isset($_POST['r_pid'])){
			$rpid = mysqli_real_escape_string($con, trim($_POST['r_pid']));
			
			$update = "UPDATE `selected` SET final_select=0 WHERE enrollment='$rpid'";
			$run = mysqli_query($con, $update);
			if(mysqli_affected_rows($con))
				echo "true";
			else
				echo "false";
		}
		else if(isset($_POST['save_en'])){
			$int_evl = array();
			$ext_evl = array();
			$int_evl = $_POST['int_evl'];
			$ext_evl = $_POST['ext_evl'];
			$date = mysqli_real_escape_string($con, validate($_POST['date']));
			$venue = mysqli_real_escape_string($con, validate($_POST['venue']));
			$save_en = mysqli_real_escape_string($con, validate($_POST['save_en']));
			for($i=0;$i<sizeof($int_evl);$i++){
				$int_evl[$i] = mysqli_real_escape_string($con, validate($int_evl[$i]));
			}
			for($i=0;$i<sizeof($ext_evl);$i++){
				$ext_evl[$i] = mysqli_real_escape_string($con, validate($ext_evl[$i]));
			}
			
			$int = implode(", ",$int_evl);
			$ext = implode(", ",$ext_evl);
			
			$update = "UPDATE `selected` SET int_evl='$int', ext_evl='$ext', date_time='$date', venue='$venue' WHERE enrollment like '$save_en' and final_select=1";
			$run = mysqli_query($con, $update);
			if(mysqli_affected_rows($con))
				echo "true";
			else
				echo "false";
		}
		else if(isset($_POST['loginEmail'])){
			
			$email = mysqli_real_escape_string($con, trim($_POST['loginEmail']));
			$password = md5(mysqli_real_escape_string($con, trim($_POST['loginPassword'])));
			//$password = mysqli_real_escape_string($con, trim($_POST['loginPassword']));
			
			$select = "select name, acctype from faculty where email like '$email' and password like '$password'";
			$run = mysqli_query($con, $select);
			if(mysqli_num_rows($run) > 0){
				$row = mysqli_fetch_array($run);
				$pidselect = "select action from bittable where id = 7";
				$pidrun = mysqli_query($con, $pidselect);
				$pidrow = mysqli_fetch_array($pidrun);
				session_start();
				
				$_SESSION['username1'] = $row['name'];
				$_SESSION['email1'] = $email;
				$_SESSION['acctype1'] = $row['acctype'];
				$_SESSION['pidformat1'] = $pidrow[0];
				echo true;
			}else{
				echo "Either Username Or Password Incorrect !!!";
			}
		}
		else if(isset($_POST['viewMarks']))
		{
			$mentor = $_POST['viewMarks'];
			$sql0 = "select * from marks where mentor = '$mentor'";
			$run0 = mysqli_query($con, $sql0);
			
			$i = 1;
			if(mysqli_num_rows($run0) > 0){
?>
				<div class="table-responsive">  		
					<table class="table">
						<thead>
						  <tr>
							<th>#</th>
							<th>Name</th>
							<th>Enrollment</th>
							<th>Marks (given by mentor)</th>
						  </tr>
						</thead>
						<tbody>
<?php
				while($row0 = mysqli_fetch_array($run0))
				{
					$run = mysqli_query($con, "select distinct name from studentmaster where enrollment like '$row0[1]'");
					$row = mysqli_fetch_array($run);
?>
						  <tr><center>
							<td><?php echo $i++; ?></td>
							<td><?php echo $row[0]; ?></td>
							<td><?php echo strtoupper($row0[1]); ?></td>
							<td><?php echo $row0[2]; ?></td></center>
						  </tr>
<?php
				}
?>
						</tbody>
					 </table>
				</div>
<?php
			}
			else
				echo "<center><div class=\"alert alert-warning\"><strong>Warning!</strong> No record Found !!!</div></center>";
		}
		else if(isset($_POST['viewAttMentorComp'])){
			
			$mentor = $_POST['viewAttMentorComp'];
			
			$sql1 = "select email from faculty where name = '$mentor'";
			$run1 = mysqli_query($con, $sql1);
			$row1 = mysqli_fetch_array($run1);
			$email = $row1[0];
			
			$comp = "select distinct date from endv_attendance where email = '$email'";
			$run_comp = mysqli_query($con, $comp);
			$total = mysqli_num_rows($run_comp);
			
			$sql = "SELECT distinct student.name, selected.enrollment FROM selected, student WHERE selected.enrollment = student.enrollment and selected.email = '$email'";
			$run = mysqli_query($con, $sql);
			$i = 1;
			if(mysqli_num_rows($run) > 0){
?>
				<div class="table-responsive">  		
					<table class="table">
						<thead>
						  <tr>
							<th>#</th>
							<th>Name</th>
							<th>Enrollment</th>
							<th>Attendance Total : <?php echo $total; ?></th>
						  </tr>
						</thead>
						<tbody>
<?php
				while($row = mysqli_fetch_array($run))
				{
					$sql2 = "SELECT count(attendance) FROM `endv_attendance` WHERE enrollment like '$row[1]' and attendance = 1";
					$run2 = mysqli_query($con, $sql2);
					$row2 = mysqli_fetch_array($run2)
?>
						  <tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $row[0]; ?></td>
							<td><?php echo $row[1]; ?></td>
							<td><?php echo $row2[0]; ?></td>
						  </tr>
<?php
				}
?>
						</tbody>
					 </table>
				</div>
<?php
			}
		}
		else if(isset($_POST['projectIdea'])){
			
			session_start();
			$projectTitle = mysqli_real_escape_string($con, trim($_POST['projectTitle']));
			$projectIdea = mysqli_real_escape_string($con, trim($_POST['projectIdea']));
			$email = $_SESSION['email1'];
			
			if(!file_exists($_FILES['fileToUpload']['tmp_name']) || !is_uploaded_file($_FILES['fileToUpload']['tmp_name'])){
				
				$insert = "insert into idea (email, projectIdea, projectTitle) values('$email', '$projectIdea', '$projectTitle')";
				if(mysqli_query($con, $insert)){
					header('location: idea.php?err=1');
				}else{
					header('location: idea.php?err=2');
				}
			}else{
				
				$target_dir = "uploads/";
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

				if ($_FILES["fileToUpload"]["size"] < 5000000) {
					
					if($imageFileType == "pdf" || $imageFileType == "doc" || $imageFileType == "docx" ) {
						
						$username = explode(" ",$_SESSION['username1']);
						$rn = mt_rand(10,1000);
						$file_name = $username[0].$rn.'.'.$imageFileType;
						if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], 'uploads/'.$file_name)) {
							
							$insert = "insert into idea (email, projectIdea, projectTitle, fileName) values('$email', '$projectIdea', '$projectTitle', '$file_name')";
							if(mysqli_query($con, $insert)){
								header('location: idea.php?err=1');
							}else{
								header('location: idea.php?err=2');
							}
						} else {
							header('location: idea.php?err=3');
						}
					}else{
						header('location: idea.php?err=4');
					}
				}else{
					header('location: idea.php?err=5');
				}
			}
		}
		else if(isset($_POST['editProjectTitle'])){
			
			session_start();
			$projectTitle = mysqli_real_escape_string($con, trim($_POST['editProjectTitle']));
			$projectIdea = mysqli_real_escape_string($con, trim($_POST['editProjectIdea']));
			$projectId = mysqli_real_escape_string($con, trim($_POST['editProjectId']));
			$email = $_SESSION['email1'];
			
			if(!file_exists($_FILES['fileToUpload']['tmp_name']) || !is_uploaded_file($_FILES['fileToUpload']['tmp_name'])){
				
				$update = "update idea set projectIdea  = '$projectIdea', projectTitle = '$projectTitle' where email = '$email' and pid = '$projectId'";
				if(mysqli_query($con, $update)){
					header('location: history.php?err=1');
				}else{
					header('location: history.php?err=2');
				}
			}else{
				
				$target_dir = "uploads/";
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

				if ($_FILES["fileToUpload"]["size"] < 500000) {
					
					if($imageFileType == "pdf" || $imageFileType == "doc" || $imageFileType == "docx" ) {
						
						$username = explode(" ",$_SESSION['username1']);
						$rn = mt_rand(10,1000);
						$file_name = $username[0].$rn.'.'.$imageFileType;
						if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], 'uploads/'.$file_name)) {
							
							$update = "update idea set projectIdea  = '$projectIdea', projectTitle = '$projectTitle', fileName = '$file_name' where email = '$email' and pid = '$projectId'";
							if(mysqli_query($con, $update)){
								header('location: history.php?err=1');
							}else{
								header('location: history.php?err=2');
							}
						} else {
							header('location: history.php?err=3');
						}
					}else{
						header('location: history.php?err=4');
					}
				}else{
					header('location: history.php?err=5');
				}
			}
		}
		else if(isset($_POST['opwd'])){
			
			$opwd = md5(mysqli_real_escape_string($con, trim($_POST['opwd'])));
			$npwd = md5(mysqli_real_escape_string($con, trim($_POST['npwd'])));
			
			session_start();
			$email = $_SESSION['email1'];
			
			$select = "select password from faculty where email = '$email'";
			$run = mysqli_query($con, $select);
			$row = mysqli_fetch_array($run);
			$password = $row[0];
			
			if($password == $opwd){
			
				$update = "update faculty set password  = '$npwd' where email = '$email'";
				if(mysqli_query($con, $update)){
					echo "Password Changed Successfully";
				}else{
					echo "Failed";
				}
			}else{
				echo "Incorrect Old Password";
			}
		}
		else if(isset($_POST['studentname'])){
			$name = mysqli_real_escape_string($con, trim($_POST['studentname']));
			$enrollment = mysqli_real_escape_string($con, trim($_POST['enrollment']));
			$email = mysqli_real_escape_string($con, trim($_POST['email']));
			$phone = mysqli_real_escape_string($con, trim($_POST['phone']));
			$run = mysqli_query($con, "select * from studentmaster where enrollment like '$enrollment'");
			if(mysqli_num_rows($run)>0){
				if(count(@$_POST['check_list'])>0){
					
					foreach($_POST['check_list'] as $selected) {
						$insert = "insert into student (name, enrollment, email, phone, selectedp) values('$name', '$enrollment', '$email', '$phone', '$selected')";
						mysqli_query($con, $insert);
					}
					
					$insert1 = "insert into st_selected (enrollment) values('$enrollment')";
					mysqli_query($con, $insert1);
					
					echo "Request Successfull";
				}else{
					echo "Select atleast one project !!!";
				}
			}
			else{
				echo "Enrollment does not exist !!";
			}
		}
		else if(isset($_POST['ad_email'])){
			
			$ad_email = mysqli_real_escape_string($con, trim($_POST['ad_email']));
			$ad_pwd = md5(mysqli_real_escape_string($con, trim($_POST['ad_pwd'])));
			
			$update = "update faculty set password  = '$ad_pwd' where email = '$ad_email'";
			mysqli_query($con, $update);
			if(mysqli_affected_rows($con)>0){
				echo "Password Changed Successfully";
			}else{
				echo "Failed";
			}
		}
		else if(isset($_POST['selectedPid'])){
			
			$selectedPid = mysqli_real_escape_string($con, trim($_POST['selectedPid']));
			$selectedEnrol = mysqli_real_escape_string($con, trim($_POST['selectedEnrol']));
			
			$select = "select status from st_selected where enrollment = '$selectedEnrol' and status = 1";
			$run = mysqli_query($con, $select);
			if(mysqli_num_rows($run)>0){
				echo "Student has already been selected in a project...";
			}else{
				session_start();
				$email = $_SESSION['email1'];
				
				$update = "update st_selected set status  = 1 where enrollment = '$selectedEnrol'";
				mysqli_query($con, $update);
				if(mysqli_affected_rows($con)>0){
					$insert = "insert into selected (email, enrollment, pid) values('$email', '$selectedEnrol', '$selectedPid')";
					if(mysqli_query($con, $insert)){
						echo true;
					}else{
						echo "You have already selected a student for this project...";
					}
				}else{
					echo "Failed";
				}
			}
		}
		else if(isset($_POST['removePid'])){
			
			$removePid = mysqli_real_escape_string($con, trim($_POST['removePid']));
			$removeEnrol = mysqli_real_escape_string($con, trim($_POST['removeEnrol']));
			
			session_start();
			$email = $_SESSION['email1'];
			
			$update = "update st_selected set status  = 0 where enrollment = '$removeEnrol'";
			mysqli_query($con, $update);
			if(mysqli_affected_rows($con)>0){
				$delete = "delete from selected where enrollment = '$removeEnrol' and pid = '$removePid' and email = '$email'";
				if(mysqli_query($con, $delete)){
					echo true;
				}else{
					echo "Failed";
				}
			}else{
				echo "Failed";
			}
		}
		else if(isset($_POST['removePidH'])){
			
			$removePid = mysqli_real_escape_string($con, trim($_POST['removePidH']));
			
			$delete1 = "delete from idea where pid = '$removePid'";
			$delete2 = "delete from selected where pid = '$removePid'";
			$delete3 = "delete from student where selectedp = '$removePid'";
			if(mysqli_query($con, $delete1) && mysqli_query($con, $delete2) && mysqli_query($con, $delete3)){
				echo "Successful";
			}else{
				echo "Failed";
			}
		}
		else if(isset($_POST['removeEnSyn'])){
			
			$removeEnSyn = mysqli_real_escape_string($con, trim($_POST['removeEnSyn']));
			$removeSubSyn = mysqli_real_escape_string($con, trim($_POST['removeSubSyn']));
			
			$select = "select filename from synopsis where enrollment = '$removeEnSyn' and subject = '$removeSubSyn'";
			$run = mysqli_query($con, $select);
			$row = mysqli_fetch_array($run);
			$path = "uploads/synopsis/".$row[0];
			unlink($path);
			
			$delete1 = "delete from synopsis where enrollment = '$removeEnSyn' and subject = '$removeSubSyn'";
			mysqli_query($con, $delete1);
			if(mysqli_affected_rows($con) > 0){
				echo "Successful";
			}else{
				echo "Failed";
			}
		}
		else if(file_exists(@$_FILES['synopsisToUpload']['tmp_name']) || is_uploaded_file(@$_FILES['synopsisToUpload']['tmp_name'])){
			
			$synSub = $_POST['synSub'];
			$synPro = $_POST['synPro'];
			$synStu = $_POST['synstu'];
			session_start();
			$username = $_SESSION['email1'];
			$sql = "select pid from idea where projectTitle like '$synPro'";
			$run = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($run);
			$pid = $row[0];
			if($row[0]<10)
				$synPid = '0'.$row[0];
			else
				$synPid = $row[0];
		
			$target_dir = "uploads/synopsis/";
			$target_file = $target_dir . basename($_FILES["synopsisToUpload"]["name"]);
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

			if ($_FILES["synopsisToUpload"]["size"] < 5000000) {
				
				if($imageFileType == "pdf" || $imageFileType == "doc" || $imageFileType == "docx" ) {
					$rn = mt_rand(100, 999);
					$file_name = $synSub.'_'.$pid.'_'.$synStu.'_'.$rn.'.'.$imageFileType;
					if (move_uploaded_file($_FILES["synopsisToUpload"]["tmp_name"], $target_dir.$file_name)) {
						
						$insert = "insert into synopsis (pid, email, subject, filename, enrollment) values('$pid', '$username', '$synSub', '$file_name', '$synStu')";
						if(mysqli_query($con, $insert)){
							header('location: idea.php?err=6');
						}else{
							header('location: idea.php?err=7');
						}
					} else {
						header('location: idea.php?err=3');
					}
				}else{
					header('location: idea.php?err=4');
				}
			}else{
				header('location: idea.php?err=5');
			}
		}
		else if(isset($_POST['updateSynPid'])){
			
			$updateSynPid = mysqli_real_escape_string($con, trim($_POST['updateSynPid']));
			$updateSynSub = mysqli_real_escape_string($con, trim($_POST['updateSynSub']));
			$updateSynEnr = mysqli_real_escape_string($con, trim($_POST['updateSynEnr']));
			
			$select = "select filename from synopsis where enrollment = '$updateSynEnr' and subject = '$updateSynSub'";
			$run = mysqli_query($con, $select);
			$row = mysqli_fetch_array($run);
			$path = "uploads/synopsis/".$row[0];
			unlink($path);
		
			$target_dir = "uploads/synopsis/";
			$target_file = $target_dir . basename($_FILES["synopsisToUpdate"]["name"]);
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

			if ($_FILES["synopsisToUpdate"]["size"] < 5000000) {
				
				if($imageFileType == "pdf" || $imageFileType == "doc" || $imageFileType == "docx" ) {
					$rn = mt_rand(100, 999);
					$file_name = $updateSynSub.'_'.$updateSynPid.'_'.$updateSynEnr.'_'.$rn.'.'.$imageFileType;
					if (move_uploaded_file($_FILES["synopsisToUpdate"]["tmp_name"], $target_dir.$file_name)) {
						
						$update = "update synopsis set filename  = '$file_name' where pid = $updateSynPid and subject = '$updateSynSub' and enrollment like '$updateSynEnr'";
						if(mysqli_query($con, $update)){
							header('location: history.php?err=6');
						}else{
							header('location: history.php?err=2');
						}
					} else {
						header('location: history.php?err=3');
					}
				}else{
					header('location: history.php?err=4');
				}
			}else{
				header('location: history.php?err=5');
			}
		}
		else if(isset($_POST['marks'])){
			extract($_POST);
			session_start();
			$email = $_SESSION['email1'];
			$count=0;
			for($i=0;$i<sizeof($enrollment);$i++){
				$insert = "INSERT INTO `marks`(`mentor`, `enrollment`, `marks`) VALUES ('$email','$enrollment[$i]','$marks[$i]')";
				$run = mysqli_query($con, $insert);
				if(mysqli_affected_rows($con)>0)
					$count++;
			}
			if($count==sizeof($enrollment))
				echo "true";
			else
				echo "false";
		}
		else if(isset($_POST['upAttDate']))
		{
			session_start();
			$date = $_POST['upAttDate'];
			$email = $_SESSION['email1'];
			
			$sql2 = "select * from selected where email = '$email'";
			$run2 = mysqli_query($con, $sql2);
			
?>
			<table class="table" >
				<thead>
				  <tr>
					<th>#</th>
					<th>Name</th>
					<th>Enrollment</th>
					<th>Mobile</th>
					<th>Attendance</th>
				  </tr>
				</thead>
				<tbody>
				<?php
					$i=0;
					while($col = mysqli_fetch_array($run2)){
						
						$enrollment = $col[1];
						$pid = $col[2];
						
						$sql1 = "SELECT * FROM student WHERE enrollment = '$enrollment'";
						$run1 = mysqli_query($con, $sql1);
						$row1 = mysqli_fetch_array($run1);
						
						$sql = "select attendance from endv_attendance where enrollment = '$enrollment' and date = '$date'";
						$run = mysqli_query($con, $sql);
						$row = mysqli_fetch_array($run);
						$i++;
				?>
				  <tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $row1['name']; ?></td>
					<td><?php echo $enrollment; ?></td>
					<td><?php echo $row1['phone']; ?></td>
					
					<td>
						<div class="material-switch">
							<input class="check" id="someSwitchOptionSuccess<?php echo $i; ?>" name="present[]" type="checkbox" value="<?php echo $col[1]; ?>" <?php if($row[0] == 1) echo "checked"; ?>/>
							<label for="someSwitchOptionSuccess<?php echo $i; ?>" class="label-success"></label>
						</div>
					</td>
				  </tr>
				<?php
					}
				?>
				</tbody>
			</table>
<?php

		}
		else if(isset($_POST['mattdummy'])){
			$date = $_POST['Adate'];
			session_start();
			$email = $_SESSION['email1'];
			
			$sql = "select enrollment from endv_attendance where date='$date' and email='$email'";
			$run = mysqli_query($con, $sql);
			if(mysqli_num_rows($run)==0){		
				$sql2 = "select * from selected where email = '$email'";
				$do = mysqli_query($con, $sql2);
				
				while($row = mysqli_fetch_array($do)){
					$sql1 = "insert into endv_attendance (enrollment, email, date) values('$row[1]', '$email', '$date')";
					mysqli_query($con, $sql1);
				}
			}else{
				$update1 = "update endv_attendance set attendance=0 where email = '$email' and date = '$date'"; 
				mysqli_query($con, $update1);
			}
			if(isset($_POST['present'])){
				foreach($_POST['present'] as $present) {
					$update = "update endv_attendance set attendance=1 where enrollment = '$present' and date = '$date'";
					mysqli_query($con, $update);
				}
			}/*else{
				$delete = "delete from endv_attendance where email = '$email' and date = '$date'";
				mysqli_query($con, $delete);
			}*/
			
			echo "<center><div class=\"alert alert-success\"><strong>Success!</strong> Attendance Updated Successfully.</div></center>";
		}
		else if(isset($_POST['tweakid'])){
			$tweakid = mysqli_real_escape_string($con, validate($_POST['tweakid']));
			$tweakaction = mysqli_real_escape_string($con, validate($_POST['tweakaction']));
			$bit = 0;
			if($tweakaction == "en")
				$bit = 1;
			
			$update = "update bittable set bit=$bit where id = '$tweakid'";
			mysqli_query($con, $update);
			
			if(mysqli_affected_rows($con) > 0){
				echo true;
			}else{
				echo false;
			}
		}
		else if(file_exists(@$_FILES['calendarUpload']['tmp_name']) || is_uploaded_file(@$_FILES['calendarUpload']['tmp_name'])){

			$path = "documents/Calendar.pdf";
			unlink($path);
		
			$target_dir = "documents/";
			$target_file = $target_dir . basename($_FILES["calendarUpload"]["name"]);
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

			if ($_FILES["calendarUpload"]["size"] < 5000000) {
				
				if($imageFileType == "pdf" || $imageFileType == "doc" || $imageFileType == "docx" ) {
					$file_name = "Calendar.pdf";
					if (move_uploaded_file($_FILES["calendarUpload"]["tmp_name"], $target_dir.$file_name)) {
						
						header('location: admin.php?err=1');
					} else {
						header('location: admin.php?err=2');
					}
				}else{
					header('location: admin.php?err=3');
				}
			}else{
				header('location: admin.php?err=4');
			}
		}
		else if(isset($_POST['pidformatname'])){
			
			$pidformatedit = mysqli_real_escape_string($con, validate($_POST['pidformatname']));

			$update = "update bittable set action='$pidformatedit' where id = 7";
			mysqli_query($con, $update);
			
			if(mysqli_affected_rows($con) > 0){
				echo "Successful";
			}else{
				echo "Something went wrong !!!";
			}
		}
		else if(isset($_POST['enrolstureg'])){
			
			$enrol = mysqli_real_escape_string($con, validate($_POST['enrolstureg']));

			$select = "select * from studentmaster where enrollment = '$enrol'";
			$run = mysqli_query($con, $select);
			$row = mysqli_fetch_array($run);
			
			$result[0] = $row[1];
			$result[1] = $row[5];
			
			echo json_encode($result);
		}
	}
	
	function validate($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>