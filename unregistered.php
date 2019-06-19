<table style="width:100%;" border="1">
					  <tr>
						<th>Sr no.</th>
						<th>Enrollment</th>
						<th>Name</th> 
					  </tr>
<?php
	include 'conn.php';
	
	if($con){
		$i = 1;
		$check = 0;
		$sql = "select distinct enrollment from student";
		$run = mysqli_query($con, $sql);
		
		$sql1 = "select distinct enrollment, name from studentmaster";
		$run1 = mysqli_query($con, $sql1);
		
		while($row1 = mysqli_fetch_array($run1)){// ALL Student
			$check = 0;

			while($row = mysqli_fetch_array($run)){// Selected
				
				if(strtoupper($row[0]) == strtoupper($row1[0])){
					$check = 1;
					break;
				}
			}
			if($check == 0){
?>
				<tr>
					<td><?php echo $i++; ?></td>
					<td><?php echo $row1[0]; ?></td>
					<td><?php echo $row1[1]; ?></td> 
				</tr>	
<?php
			}
			mysqli_data_seek($run, 0);
		}
	}
?>
</table>