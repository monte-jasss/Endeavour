<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<div class="container" style="margin-top:50px;">
<center style="margin-bottom:50px;"><h2>Endeavour Attendance</h2></center>
<?php
			include 'conn.php';
			
			$email_q = "select distinct email, name from faculty";
			$email_r = mysqli_query($con, $email_q);
			
			while($em_row = mysqli_fetch_array($email_r)){
				
				$email = $em_row[0];
				
				$comp = "select distinct date from endv_attendance where email = '$email'";
				$run_comp = mysqli_query($con, $comp);
				$total = mysqli_num_rows($run_comp);
				
				$sql = "select distinct enrollment from selected where email = '$email'";
				$run = mysqli_query($con, $sql);
				$i = 1;
				if(mysqli_num_rows($run) > 0){
	?>
				
					 		
						<table class="table table-bordered">
							<thead>
							  <tr><th colspan="4"><h4 style="color:red;"><?php echo $em_row[1]; ?></h4></th></tr>
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
						$name = "select name from student where enrollment = '$row[0]'";
						$name1 = mysqli_query($con, $name);
						$n_row = mysqli_fetch_array($name1);
						
						$sql2 = "SELECT count(attendance) FROM `endv_attendance` WHERE enrollment like '$row[0]' and attendance = 1";
						$run2 = mysqli_query($con, $sql2);
						$row2 = mysqli_fetch_array($run2)
	?>
							  <tr>
								<td><?php echo $i++; ?></td>
								<td><?php echo $n_row[0]; ?></td>
								<td><?php echo $row[0]; ?></td>
								<td><?php echo $row2[0]; ?></td>
							  </tr>
	<?php
					}
	?>
							</tbody>
						 </table>
	<?php
				}
			}
?>
</div>