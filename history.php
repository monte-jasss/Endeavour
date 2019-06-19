<?php
	session_start();
	if(isset($_SESSION['username1'])){
		if($_SESSION['acctype1'] == 0){
			$username = $_SESSION['username1'];
			$email = $_SESSION['email1'];
			$pidformat = $_SESSION['pidformat1'];
			
			include 'conn.php';
			if($con){
				$sql = "select * from idea where email = '$email'";
				$run = mysqli_query($con, $sql);
				
				$sql1 = "select * from synopsis where email = '$email'";
				$run1 = mysqli_query($con, $sql1);
			}
			
			if(isset($_GET['err'])){
				
				$err = $_GET['err'];
				if($err == 1){
					$msg = "Idea successfully Updated !!!";
				}else if($err == 2){
					$msg = "Submission Failed !!!";
				}else if($err == 3){
					$msg = "Sorry, there was an error uploading your file.";
				}else if($err == 4){
					$msg = "Sorry, only PDF, DOC & DOCX files are allowed.";
				}else if($err == 5){
					$msg = "Sorry, your file is too large.";
				}else if($err == 6){
					$msg = "Synopsis/Report successfully Updated !!!";
				}
			}
			
		}else if($_SESSION['acctype1'] == 1){
			header('location: admin.php');
		}else{
			header('location: index.php');
		}
	}else{
		
		
		header("location: index.php");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Project Endeavour</title>
	
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
	<link href="assets/css/main.css" rel="stylesheet">
	<link href="assets/css/animate.css" rel="stylesheet">
	<link href="assets/css/timepicki.css" rel="stylesheet">
	<link href="assets/css/responsive.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datepicker.css">
    <!--[if lt IE 9]>
	    <script src="js/html5shiv.js"></script>
	    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
	<style>
		.form_div{
			width:auto;
			background-color:rgba(2,8, 15, 0.8);
			padding:3% 6% 3% 6%;
			min-height: 400px;
			margin:5%;
			border-radius:5px;
		}
		@media only screen and (max-width: 500px) {
			.form_div{
				width:90%;
				min-height: 300px;
			}
		}
		.datepicker td, .datepicker th {
			color:black;
		}
	</style>
</head><!--/head-->

<body>
	
	<header id="header" role="banner">		
		<?php include 'headerlogin.php'; ?>
    </header>
	<!--/#home-->

	<section id="subscribe" class="section-style" style="background-image:url(images/background/about-us2.jpg);background-attachment:fixed;background-size:cover;">
		<div class="container">	
				<div class="form_div" >
					<ul class="nav nav-tabs">
					  <li class="active"><a data-toggle="pill" href="#home">Submitted Ideas</a></li>
					  <li><a data-toggle="pill" href="#menu1">Report</a></li>
					  <li><a data-toggle="pill" href="#menu2">View Attendance</a></li>
					</ul>

					<div class="tab-content">
					  <div id="home" class="tab-pane fade in active">
						<center><h3>submitted Ideas</h3></center>
						<table class="table table-bordered table-responsive">
							<thead>
							  <tr>
								<th>Sr. no.</th>
								<th>Project ID</th>
								<th>Name</th>
								<th>Email</th>
								<th>Project Title</th>
								<th>Project Idea</th>
								<th>Project Document</th>
								<th>Edit</th>
								<th>Remove</th>
							  </tr>
							</thead>
							<tbody>
							<?php
								$i = 1;
								while($row = mysqli_fetch_array($run)){
									$email = $row['email'];
									$s = mysqli_query($con, "select name from faculty where email = '$email'");
									$r = mysqli_fetch_array($s);
									$name = $r['name'];
									$pid = $row['pid'];
									if($row['pid']<10)
										$pid = '0'.$row['pid'];
									
							?>	
							  <tr id="<?php echo $pid.'10'; ?>">
								<td><?php echo $i; ?></td>
								<td><?php echo $pidformat.$pid; ?></td>
								<td><?php echo $name ?></td>
								<td><?php echo $row['email']; ?></td>
								<td><?php echo $row['projectTitle']; ?></td>
								<td><?php echo $row['projectIdea']; ?></td>
								<td><a href="uploads/<?php echo $row['fileName']; ?>" target="_blank" style="text-decoration:none;"><?php echo $row['fileName']; ?></a></td>
								<td><a href="edit.php?pid=<?php echo $pid; ?>&select=1" style="text-decoration:none;color:white;"><h3><span><i class="fa fa-pencil" aria-hidden="true"></i></span></h3></a></td>
								<td><a href="#" id="<?php echo $pid; ?>" class="remove" style="text-decoration:none;color:white;"><h3><span><i class="fa fa-trash" aria-hidden="true"></i></span></h3></a></td>
							  </tr>
							<?php
								$i++;
								}
							?> 
							</tbody>
						</table>
					  </div>
					  <div id="menu1" class="tab-pane fade">
						<h3>Synopsis and Project Report</h3>
						<table class="table table-bordered table-responsive">
							<thead>
							  <tr>
								<th>Sr. no.</th>
								<th>Project ID</th>
								<th>Project Title</th>
								<th>Subject</th>
								<th>Document</th>
								<th>Student</th>
								<th>Edit</th>
								<th>Remove</th>
							  </tr>
							</thead>
							<tbody>
							<?php
								$i = 1;
								while($row1 = mysqli_fetch_array($run1)){

									$pid = $row1['pid'];
									$s = mysqli_query($con, "select projectTitle from idea where pid = '$pid'");
									$r = mysqli_fetch_array($s);
									$project = $r[0];
									if($row1['subject'] == 'Synopsis1'){
										$subject = "Synopsis";
									}else if($row1['subject'] == 'Synopsis2'){
										$subject = "Progress Report";
									}else{
										$subject = "Final Report";
									}
									$filename = $row1['filename'];
									$enrollment = $row1['enrollment'];
									$pido = $row1['pid'];
									if($row1['pid']<10)
										$pid = '0'.$row1['pid'];
									
							?>	
							  <tr id="<?php echo $enrollment.'11'; ?>">
								<td><?php echo $i; ?></td>
								<td><?php echo $pidformat.$pid; ?></td>
								<td><?php echo $project ?></td>
								<td><?php echo $subject; ?></td>
								<td><a href="uploads/synopsis/<?php echo $row1['filename']; ?>" target="_blank" style="text-decoration:none;"><?php echo $row1['filename']; ?></a></td>
								<td><?php echo $enrollment; ?></td>
								<td><a href="edit.php?pid=<?php echo $pido; ?>&enrol=<?php echo $enrollment; ?>&select=2" style="text-decoration:none;color:white;"><h3><span><i class="fa fa-pencil" aria-hidden="true"></i></span></h3></a></td>
								<td><a href="#" id="<?php echo $enrollment.'$'.$row1['subject']; ?>" class="removeSyn" style="text-decoration:none;color:white;"><h3><span><i class="fa fa-trash" aria-hidden="true"></i></span></h3></a></td>
							  </tr>
							<?php
								$i++;
								}
							?> 
							</tbody>
						</table>
					  </div>
					  <div id="menu2" class="tab-pane fade">
						<h3>Attendance</h3>
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="pill" href="#datewise">Datewise</a></li>
							<li><a data-toggle="pill" href="#complete">Complete</a></li>
						</ul>

						<div class="tab-content">
							<div id="datewise" class="tab-pane fade in active">
								<div class="row" style="margin:1%;">
								  <div class="card card-mini" style="padding:3%;">
									<div class="card-body no-padding table-responsive">	
										<div class="form-group row">
											<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
												<label class="control-label" for="date">Select Date<span style="color:red;font-size:17px;">*</span>:</label>
												<input type="text" class="form-control" id="Adateid" placeholder="Select attendance Date" name="Adate" required>
												<input type="hidden" value="Hello"  name="mattdummy">
											</div>
										</div>
										<div id="result"></div>
									</div>
								  </div>	
								</div>
							</div>
							<div id="complete" class="tab-pane fade">
					<?php
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
					?>
							</div>
						</div>
					  </div>
					</div>
				</div>								
		</div>
	</section><!--/#explore-->

	
    <!--/#contact-->

    <footer id="footer">
        <div class="container">
            <div class="text-center">
                <p> Copyright  &copy; 2017. All Rights Reserved. <br> Designed by Vaibhav Pal & Monu Lakshkar</p>                
            </div>
        </div>
    </footer>
    <!--/#footer-->

    <script type="text/javascript" src="assets/js/jquery.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
  	<script type="text/javascript" src="assets/js/gmaps.js"></script>
	<script type="text/javascript" src="assets/js/smoothscroll.js"></script>
    <script type="text/javascript" src="assets/js/jquery.parallax.js"></script>
    <script type="text/javascript" src="assets/js/coundown-timer.js"></script>
    <script type="text/javascript" src="assets/js/jquery.scrollTo.js"></script>
    <script type="text/javascript" src="assets/js/jquery.nav.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script> 
	<script type="text/javascript" src="assets/js/timepicki.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap-datepicker.js"></script> 
	
	<div class="container">
  <!-- Modal -->
	  <div class="modal fade" id="errModal" role="dialog">
		<div class="modal-dialog modal-sm">
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h2 style="color:black;" class="modal-title">Message</h2>
			</div>
			<div class="modal-body">
				<center><h4 style="color:black;"><?php if(isset($_GET['err'])) echo $msg; ?></h4></center>
			</div>
			<div class="modal-footer">
			  <button type="button" onClick="refreshPage()" class="btn btn-default" id="refresh" data-dismiss="modal">Close</button>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	

	<?php if(isset($_GET['err'])) echo "<script>$('#errModal').modal('show');</script>"; ?>
	
	<script>
		function refreshPage(){
			window.location = "history.php";
		} 
	
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1; //January is 0!
		var yyyy = today.getFullYear();
		
		if(dd<10) {
			dd='0'+dd;
		}
		if(mm<10) {
			mm='0'+mm;
		}
		today = yyyy+'-'+mm+'-'+dd;
		
		var lastDate = new Date();
		var dd = lastDate.getDate()-2;
		var mm = lastDate.getMonth()+1; //January is 0!
		var yyyy = lastDate.getFullYear();
		
		if(dd<10) {
			dd='0'+dd;
		}
		if(mm<10) {
			mm='0'+mm;
		}
		lastDate = yyyy+'-'+mm+'-'+dd;
		
		
		$('#Adateid').datepicker({
			format: "yyyy-mm-dd",
			todayHighlight: true,
			autoclose: true,
			endDate: today,
			//startDate: lastDate
		});	
		$('#Adateid').on('changeDate', function(ev){
			$(this).datepicker('hide');
			date2 = Date.parse($(this).val());
			var d = $(this).val();
			$.ajax({
				url: 'todb.php',
				data: "viewAttDate="+d,
				type: 'POST',
				success: function(data){
					$('#result').html(data);
				}
			});	
		});
		$('.remove').click(function(){
			
			var id = $(this).attr('id');
			
			$.ajax({
				url: 'todb.php',
				type: 'POST',
				data: 'removePidH='+id,
				dataType: 'html'
			})
			.done(function(data){
				$('#'+id+'10').hide();
				alert(data);
			})
			.fail(function(){
				alert('Ajax Submit Failed ...'); 
			});
		});
		$('.removeSyn').click(function(){
			
			var data = $(this).attr('id').split("$");
			var id = data[0];
			var sub = data[1];
			
			$.ajax({
				url: 'todb.php',
				type: 'POST',
				data: 'removeEnSyn='+id+'&removeSubSyn='+sub,
				dataType: 'html'
			})
			.done(function(data){
				$('#'+id+'11').hide();
				alert(data);
			})
			.fail(function(){
				alert('Ajax Submit Failed ...'); 
			});
		});
	</script>
</body>
</html>