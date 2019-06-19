<?php
	session_start();
	include 'conn.php';
	if(isset($_SESSION['username1'])){
		if($_SESSION['acctype1'] == 1 || $_SESSION['acctype1'] == 2){
			$username = $_SESSION['username1'];
			$pidformat = $_SESSION['pidformat1'];
			include 'conn.php';
			if($con){
				$sql = "select * from idea";
				$run = mysqli_query($con, $sql);
				
				$projects = mysqli_num_rows($run);
				
				$sql6 = "SELECT distinct pid FROM selected";
				$run6 = mysqli_query($con, $sql6);
				$adopted = mysqli_num_rows($run6);
				
				$pnot = $projects - $adopted;
				
				$sql9 = "SELECT distinct enrollment FROM selected";
				$run9 = mysqli_query($con, $sql9);
				$selected = mysqli_num_rows($run9);
				
				$sql7 = "SELECT distinct enrollment FROM studentmaster";
				$run7 = mysqli_query($con, $sql7);
				$students = mysqli_num_rows($run7);
				
				$snot = $students - $selected;
				
				$sql8 = "SELECT distinct enrollment FROM student";
				$run8 = mysqli_query($con, $sql8);
				$studentsReg = mysqli_num_rows($run8);
				
				$sql10 = "select name, email from faculty";
				$run10 = mysqli_query($con, $sql10);
				$mentors = mysqli_num_rows($run10);
				
				$main = "SELECT pid, email, enrollment FROM selected";
				$exec = mysqli_query($con, $main);
				
				$sqlbit = "select * from bittable";
				$runbit = mysqli_query($con, $sqlbit);
				$rowbit = mysqli_fetch_array($runbit);
			}
			
			if(isset($_GET['err'])){
				
				$err = $_GET['err'];
				if($err == 1){
					$msg = "Calendar Successfully Uploaded !!!";
				}else if($err == 2){
					$msg = "Sorry, there was an error uploading your file.";
				}else if($err == 3){
					$msg = "Sorry, only PDF, DOC & DOCX files are allowed.";
				}else if($err == 4){
					$msg = "Sorry, your file is too large.";
				}
				
				
			}
		}else if($_SESSION['acctype1'] == 0){
			header('location: idea.php');
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
		.form_div2{
			width:60%;
			margin:0 auto;
		}
		.infoDivOut{
			min-height:100px;
			background-color:#006064;
			width:22%;
			margin-left:3%;
			box-shadow: 5px 5px 5px white;
			border: 1px solid white;
		}
		h1{
			text-shadow: -1px 0 black, 0 2px black, 2px 0 black, 0 -1px black;
		}
		.infoDivFa{
			float:right;
			font-size:35px;
			line-height:100px;
		}
		@media only screen and (max-width: 500px) {
			.form_div{
				width:100%;
				min-height: 300px;
				padding-left:0px;
			}
			.infoDivOut{
				width:100%;
				margin-bottom:2%;
			}
		}
		.datepicker td, .datepicker th {
			color:black;
		}
		.nav-tabs>li>a {
			background-color: #fff;
			color: black !important;
		}
		.nav-tabs > li.active > a, .nav-tabs > li.active > a:focus {
			background-color: #428bca;
			color: #fff !important;
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
			<br>
				<center><h1 style="font-size:80px;">ENDEAVOUR ADMIN PANEL</h1></center>
				<div class="row">
					<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 infoDivOut">
						<h3 style="display:inline-flex;">Total Projects <br><?php echo $projects; ?></h3>
						<i class="infoDivFa fa fa-free-code-camp" style="color:#B2FF59;"></i>
					</div>
					<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 infoDivOut">
						<h3 style="display:inline-flex;">Adopted Projects <br><?php echo $adopted; ?></h3>
						<i class="infoDivFa fa fa-free-code-camp" style="color:#B2FF59;"></i>
					</div>
					<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 infoDivOut">
						<h3 style="display:inline-flex;">Unadopted Projects <br><?php echo $pnot; ?></h3>
						<i class="infoDivFa fa fa fa-free-code-camp" style="color:#B2FF59;"></i>
					</div>
					<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 infoDivOut">
						<h3 style="display:inline-flex;">Mentor Registered <br><?php echo $mentors; ?></h3>
						<i class="infoDivFa fa fa-user-o" style="color:#B2FF59;" aria-hidden="true"></i>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 infoDivOut">
						<h3 style="display:inline-flex;">Total Students <br><?php echo $students; ?></h3>
						<i class="infoDivFa fa fa-user-circle-o" style="color:#B2FF59;"></i>
					</div>
					<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 infoDivOut">
						<h3 style="display:inline-flex;">Students Registered <br> <?php echo $studentsReg; ?></h3>
						<i class="infoDivFa fa fa-user-circle-o" style="color:#B2FF59;"></i>
					</div>
					<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 infoDivOut">
						<h3 style="display:inline-flex;">Students Selected <br> <?php echo $selected; ?></h3>
						<i class="infoDivFa fa fa-graduation-cap" style="color:#B2FF59;"></i>
					</div>
					<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 infoDivOut">
						<h3 style="display:inline-flex;">Unselected Students <br><?php echo $snot; ?></h3>
						<i class="infoDivFa fa fa-free-code-camp" style="color:#B2FF59;"></i>
					</div>
				</div>
				<br><br>
				<?php
					$acc_type = $_SESSION['acctype1'];
				?>
				<ul class="nav nav-tabs">
				  <li class="<?php if($acc_type==1) echo "active"; ?>" style="<?php if($acc_type==2) echo "display: none"; ?>"><a data-toggle="tab" href="#tweaks">Tweaks</a></li>
				  <li style="<?php if($acc_type==2) echo "display: none"; ?>"><a data-toggle="tab" href="#home">Ideas</a></li>
				  <li style="<?php if($acc_type==2) echo "display: none"; ?>"><a data-toggle="tab" href="#menu2">Requests</a></li>
				  <li style="<?php if($acc_type==2) echo "display: none"; ?>"><a data-toggle="tab" href="#menu3">Selected Students</a></li>
				  <li class="<?php if($acc_type==2) echo "active"; ?>"><a data-toggle="tab" href="#menu4">Report</a></li>
				  <li style="<?php if($acc_type==2) echo "display: none"; ?>"><a data-toggle="tab" href="#menu5">Attendance</a></li>
				  <li style="<?php if($acc_type==2) echo "display: none"; ?>"><a data-toggle="tab" href="#menu1">Password Reset</a></li>
				  <li style="<?php if($acc_type==2) echo "display: none"; ?>"><a data-toggle="tab" href="#menu6">Marks</a></li>
				  <li style="<?php if($acc_type==2) echo "display: none"; ?>"><a data-toggle="tab" href="#menu7">Final Selection</a></li>
				</ul>

				<div class="tab-content">
				  <div id="tweaks" class="tab-pane <?php if($acc_type==1) echo "fade in active"; ?>">
						<div class="form_div">
							<center><h3>Tweaks</h3></center>
							<div class="table-responsive">          
							  <table class="table table-bordered">
								<thead>
								  <tr>
									<th>Action</th>
									<th>Toggle</th>
									<th></th>
								  </tr>
								</thead>
								<tbody>
								  <tr>
									<td>Submit Idea</td>
									<td>
										<button class="btn btn-success tweakbtn" id="<?php echo $rowbit['id'].'Hen'; ?>" style="<?php if($rowbit['bit'] == 1) echo "visibility: hidden" ?>" >Enable</button>
										<button class="btn btn-danger tweakbtn" id="<?php echo $rowbit['id'].'Hdis'; ?>" style="<?php if($rowbit['bit'] == 0) echo "visibility: hidden" ?>" >Disable</button>
									</td>
									<td></td>
								  </tr>
								  <tr>
									<td>Student Registration</td>
									<td>
										<?php $rowbit = mysqli_fetch_array($runbit);?>
										<button class="btn btn-success tweakbtn" id="<?php echo $rowbit['id'].'Hen'; ?>" style="<?php if($rowbit['bit'] == 1) echo "visibility: hidden" ?>" >Enable</button>
										<button class="btn btn-danger tweakbtn" id="<?php echo $rowbit['id'].'Hdis'; ?>" style="<?php if($rowbit['bit'] == 0) echo "visibility: hidden" ?>" >Disable</button>
									</td>
									<td></td>
								  </tr>
								  <tr>
									<td>Report Upload</td>
									<td>
										<?php $rowbit = mysqli_fetch_array($runbit);?>
										<button class="btn btn-success tweakbtn" id="<?php echo $rowbit['id'].'Hen'; ?>" style="<?php if($rowbit['bit'] == 1) echo "visibility: hidden" ?>" >Enable</button>
										<button class="btn btn-danger tweakbtn" id="<?php echo $rowbit['id'].'Hdis'; ?>" style="<?php if($rowbit['bit'] == 0) echo "visibility: hidden" ?>" >Disable</button>
									</td>
									<td></td>
								  </tr>
								  <tr>
									<td>2 days attendance lock</td>
									<td>
										<?php $rowbit = mysqli_fetch_array($runbit);?>
										<button class="btn btn-success tweakbtn" id="<?php echo $rowbit['id'].'Hen'; ?>" style="<?php if($rowbit['bit'] == 1) echo "visibility: hidden" ?>" >Enable</button>
										<button class="btn btn-danger tweakbtn" id="<?php echo $rowbit['id'].'Hdis'; ?>" style="<?php if($rowbit['bit'] == 0) echo "visibility: hidden" ?>" >Disable</button>
									</td>
									<td></td>
								  </tr>
								  <tr>
									<td>Mentee Request accept</td>
									<td>
										<?php $rowbit = mysqli_fetch_array($runbit);?>
										<button class="btn btn-success tweakbtn" id="<?php echo $rowbit['id'].'Hen'; ?>" style="<?php if($rowbit['bit'] == 1) echo "visibility: hidden" ?>" >Enable</button>
										<button class="btn btn-danger tweakbtn" id="<?php echo $rowbit['id'].'Hdis'; ?>" style="<?php if($rowbit['bit'] == 0) echo "visibility: hidden" ?>" >Disable</button>
									</td>
									<td></td>
								  </tr>
								  <tr>
									<td>Freeze Attendance</td>
									<td>
										<?php $rowbit = mysqli_fetch_array($runbit);?>
										<button class="btn btn-success tweakbtn" id="<?php echo $rowbit['id'].'Hen'; ?>" style="<?php if($rowbit['bit'] == 1) echo "visibility: hidden" ?>" >Enable</button>
										<button class="btn btn-danger tweakbtn" id="<?php echo $rowbit['id'].'Hdis'; ?>" style="<?php if($rowbit['bit'] == 0) echo "visibility: hidden" ?>" >Disable</button>
									</td>
									<td></td>
								  </tr>
								  <tr>
									<form action="todb.php" method="post" enctype="multipart/form-data">
										<td>Upload Calendar</td>
										<td>
											<input type="file" style="float:left;" name="calendarUpload" id="calendarUploadid" required>
										</td>
										<td>
											<button class="btn btn-default">Upload</button>
										</td>
									</form>
								  </tr>
								  <tr>
									<td>Project id Format</td>
									<form id="pidformatform">
										<td>
											<?php $rowbit = mysqli_fetch_array($runbit);?>
											<input style="color:black;" type="text" style="float:left;" value="<?php echo $rowbit[1];?>" name="pidformatname" maxlength="7" required>
										</td>
										<td>
											<button class="btn btn-default">Update</button>
										</td>
									</form>
								  </tr>
								  <tr>
									<td>Marks Upload</td>
									<td>
										<?php $rowbit = mysqli_fetch_array($runbit);?>
										<button class="btn btn-success tweakbtn" id="<?php echo $rowbit['id'].'Hen'; ?>" style="<?php if($rowbit['bit'] == 1) echo "visibility: hidden" ?>" >Enable</button>
										<button class="btn btn-danger tweakbtn" id="<?php echo $rowbit['id'].'Hdis'; ?>" style="<?php if($rowbit['bit'] == 0) echo "visibility: hidden" ?>" >Disable</button>
									</td>
									<td></td>
								  </tr>
								</tbody>
							  </table>
							</div>
						</div>
				  </div>
				  <div id="home" class="tab-pane fade">
					<div class="form_div" >
					<button class="btn btn-default" id="btnPrint2" >Print</button>
					<center><h3>submitted Ideas</h3></center>
					<div class="table-responsive">
				<table class="table table-bordered" id="form_div_print2">
					<thead>
					  <tr>
						<th>Sr. no.</th>
						<th>Project ID</th>
						<th>Name</th>
						<th>Email</th>
						<th>Project Title</th>
						<th>Project Idea</th>
						<th>File</th>
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
							if($pid<10)
								$pid = '00'.$pid;
							elseif($pid<100)
								$pid = '0'.$pid;
							
					?>	
					  <tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $pidformat.$pid; ?></td>
						<td><?php echo $name ?></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo $row['projectTitle']; ?></td>
						<td><?php echo $row['projectIdea']; ?></td>
						<td><a href="uploads/<?php echo $row['fileName']; ?>" target="_blank" style="text-decoration:none;"><?php echo $row['fileName']; ?></a></td>
					  </tr>
					<?php
						$i++;
						}
					?> 
					</tbody>
				</table>
				</div>
				</div>
				  </div>
				  <div id="menu1" class="tab-pane fade">
					<div class="form_div" >
						<div class="form_div2">
							<center><h3>Password Reset</h3></center>
							<form id="ad_chpwd">
							  <div class="form-group">
								<label for="email">Email address:</label>
								<input type="email" class="form-control" name="ad_email" id="email" placeholder="Email" required>
							  </div>
							  <div class="form-group">
								<label for="pwd">Password:</label>
								<input type="text" class="form-control" name="ad_pwd" id="pwd" placeholder="Password" value="spsu@123" required>
							  </div>
							  <center><h3 id="result"></h3></center>
							  <button type="submit" class="btn btn-default">Submit</button>
							</form>
						</div>
					</div>
				  </div>
				  <div id="menu2" class="tab-pane fade">
					<div class="form_div" >
						<button class="btn btn-default" id="btnPrint" >Print</button>
						<center><h3>Requests</h3></center>
						<div class="table-responsive">
						<table class="table table-bordered" id="form_div_print">
							<thead>
							  <tr>
								<th>Sr no.</th>
								<th>Student Name</th>
								<th>Enrollment</th>
								<th>Mentor</th>
								<th>Project Title</th>
							  </tr>
							</thead>
							<tbody>
						<?php
							mysqli_data_seek($run, 0);
							$i = 1;
							while($row2 = mysqli_fetch_array($run)){
								$pid = $row2['pid'];
								$projectTitle = $row2['projectTitle'];
								$email = $row2['email'];
								
								$sql1 = "SELECT student.name, student.enrollment, faculty.name FROM student, faculty WHERE student.selectedp = '$pid' and faculty.email = '$email'";
								$run1 = mysqli_query($con, $sql1);
								while($row1 = mysqli_fetch_array($run1)){
						?>
								  <tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $row1[0]; ?></td>
									<td><?php echo $row1[1]; ?></td>
									<td><?php echo $row1[2]; ?></td>
									<td><?php echo $projectTitle; ?></td>
								  </tr>
						<?php
								  $i++;
								}
							}
						?>
							</tbody>
						</table>
						</div>
					</div>
				  </div>
				  <div id="menu3" class="tab-pane fade">
					<div class="form_div" >
							<button class="btn btn-default" id="btnPrint5" >Print</button>
							<center><h3>Selected Students</h3></center>
							<div class="table-responsive">
							<table class="table table-bordered" id="form_div_print5">
								<thead>
								  <tr>
									<th>Sr. no.</th>
									<th>Student name</th>
									<th>Enrollment</th>
									<th>Mentor</th>
									<th>Project ID</th>
									<th>Project Title</th>
								  </tr>
								</thead>
								<tbody>

							<?php
								include 'conn.php';
								if($con){
									$sql = "select * from selected";
									$run = mysqli_query($con, $sql);
									$i=1;
									while($row = mysqli_fetch_array($run)){
										
										$email = $row[0];
										$enrollment = $row[1];
										$pid = $row[2];
										
										$sql1 = "select name from faculty where email = '$email'";
										$run1 = mysqli_query($con, $sql1);
										$row1 = mysqli_fetch_array($run1);
										$mentor = $row1[0];
										
										$sql2 = "select distinct name from student where enrollment = '$enrollment'";
										$run2 = mysqli_query($con, $sql2);
										$row2 = mysqli_fetch_array($run2);
										$stname = $row2[0];
										
										$sql3 = "select projectTitle from idea where pid = '$pid'";
										$run3 = mysqli_query($con, $sql3);
										$row3 = mysqli_fetch_array($run3);
										$ptitle = $row3[0];
										
										if($pid<10)
											$pid = '00'.$pid;
										elseif($pid<100)
											$pid = '0'.$pid;
							?>
											  <tr>
												<td><?php echo $i; ?></td>
												<td><?php echo $stname ?></td>
												<td><?php echo $enrollment; ?></td>
												<td><?php echo $mentor; ?></td>
												<td><?php echo $pidformat.$pid; ?></td>
												<td><?php echo $ptitle; ?></td>
											  </tr>
							<?php			
										$i++;
									}
								}
							?>
								</tbody>
							</table>
							</div>
					</div>
				  </div>
				  <div id="menu4" class="tab-pane fade<?php if($acc_type==2) echo " in active"; ?>">
					<div class="form_div">
						<ul class="nav nav-tabs">
						  <li class="active"><a data-toggle="tab" href="#submitted">Submitted</a></li>
						  <li><a data-toggle="tab" href="#notsubmitted">Not submitted</a></li>
						</ul>
						<div class="tab-content">
							<div id="submitted" class="tab-pane fade in active">
								<b><h3>Students who have Submitted Synopsis and Report...</h3></b>
								<ul class="nav nav-tabs">
								  <li class="active"><a data-toggle="tab" href="#chhome">Synopsis</a></li>
								  <li><a data-toggle="tab" href="#chmenu1">Progress Report</a></li>
								  <li><a data-toggle="tab" href="#chmenu2">Final Report</a></li>
								</ul>
								<div class="tab-content">
									<div id="chhome" class="tab-pane fade in active">
										<button class="btn btn-default" id="print1">Print</button>
										<div class="table-responsive">
											<table class="table table-bordered" id="div_print1">
												<thead>
												  <tr>
													<th>#</th>
													<th>Project ID</th>
													<th>Mentor</th>
													<th>Enrollment</th>
													<th>Document</th>
												  </tr>
												</thead>
												<tbody>

											<?php
												include 'conn.php';
												if($con){
													$sql = "SELECT faculty.name, synopsis.enrollment, synopsis.pid, synopsis.filename FROM synopsis INNER JOIN faculty ON faculty.email=synopsis.email and synopsis.subject='Synopsis1'";
													$run = mysqli_query($con, $sql);
													$i=1;
													while($row = mysqli_fetch_array($run)){
														$name = $row[0];
														$enrollment = $row[1];
														$pid = $row[2];
														$file = $row[3];

														if($pid<10)
															$pid = '00'.$pid;
														elseif($pid<100)
															$pid = '0'.$pid;
											?>
															  <tr>
																<td><?php echo $i; ?></td>
																<td><?php echo $pidformat.$pid; ?></td>
																<td><?php echo $name; ?></td>
																<td><?php echo $enrollment; ?></td>
																<td><a href="uploads/synopsis/<?php echo $file; ?>"><?php echo $file; ?></td>
															  </tr>
											<?php			
														$i++;
													}
												}
											?>
												</tbody>
											</table>
										</div>
									</div>
									<div id="chmenu1" class="tab-pane fade">
										<button class="btn btn-default" id="print2">Print</button>
										<div class="table-responsive">
											<table class="table table-bordered" id="div_print2">
												<thead>
												  <tr>
													<th>#</th>
													<th>Project ID</th>
													<th>Mentor</th>
													<th>Enrollment</th>
													<th>Document</th>
												  </tr>
												</thead>
												<tbody>

											<?php
												if($con){
													$sql = "SELECT faculty.name, synopsis.enrollment, synopsis.pid, synopsis.filename FROM synopsis INNER JOIN faculty ON faculty.email=synopsis.email and synopsis.subject='Synopsis2'";
													$run = mysqli_query($con, $sql);
													$i=1;
													while($row = mysqli_fetch_array($run)){
														$name = $row[0];
														$enrollment = $row[1];
														$pid = $row[2];
														$file = $row[3];
														
														if($pid<10)
															$pid = '00'.$pid;
														elseif($pid<100)
															$pid = '0'.$pid;
											?>
															  <tr>
																<td><?php echo $i; ?></td>
																<td><?php echo $pidformat.$pid; ?></td>
																<td><?php echo $name; ?></td>
																<td><?php echo $enrollment; ?></td>
																<td><a href="uploads/synopsis/<?php echo $file; ?>"><?php echo $file; ?></td>
															  </tr>
											<?php			
														$i++;
													}
												}
											?>
												</tbody>
											</table>
										</div>
									</div>
									<div id="chmenu2" class="tab-pane fade">
										<button class="btn btn-default" id="print3">Print</button>
										<div class="table-responsive">
											<table class="table table-bordered" id="div_print3">
												<thead>
												  <tr>
													<th>#</th>
													<th>Project ID</th>
													<th>Mentor</th>
													<th>Enrollment</th>
													<th>Document</th>
												  </tr>
												</thead>
												<tbody>

											<?php
												if($con){
													$sql = "SELECT faculty.name, synopsis.enrollment, synopsis.pid, synopsis.filename FROM synopsis INNER JOIN faculty ON faculty.email=synopsis.email and synopsis.subject='Synopsis3'";
													$run = mysqli_query($con, $sql);
													$i=1;
													while($row = mysqli_fetch_array($run)){
														$name = $row[0];
														$enrollment = $row[1];
														$pid = $row[2];
														$file = $row[3];
														
														if($pid<10)
															$pid = '00'.$pid;
														elseif($pid<100)
															$pid = '0'.$pid;
											?>
															  <tr>
																<td><?php echo $i; ?></td>
																<td><?php echo $pidformat.$pid; ?></td>
																<td><?php echo $name; ?></td>
																<td><?php echo $enrollment; ?></td>
																<td><a href="uploads/synopsis/<?php echo $file; ?>"><?php echo $file; ?></td>
															  </tr>
											<?php			
														$i++;
													}
												}
											?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div id="notsubmitted" class="tab-pane fade">
								<b><h3>Students who have not submitted Synopsis and Report...</h3></b>
								<ul class="nav nav-tabs">
								  <li class="active"><a data-toggle="tab" href="#chhoment">Synopsis</a></li>
								  <li><a data-toggle="tab" href="#chhoment1">Progress Report</a></li>
								  <li><a data-toggle="tab" href="#chhoment2">Final Report</a></li>
								</ul>
								<div class="tab-content">
									<div id="chhoment" class="tab-pane fade in active">
										<button class="btn btn-default" id="print4">Print</button>
										<div class="table-responsive">
											<table class="table table-bordered" id="div_print4">
												<thead>
												  <tr>
													<th>#</th>
													<th>Project ID</th>
													<th>Mentor</th>
													<th>Enrollment</th>
												  </tr>
												</thead>
												<tbody>

											<?php
												
													$i=1;
													while($res = mysqli_fetch_array($exec)){
														$sql = "select pid from synopsis where enrollment = '$res[2]' and subject = 'Synopsis1'";
														$run = mysqli_query($con, $sql);
														if(mysqli_num_rows($run)==0){
															$fetch = "SELECT name FROM faculty WHERE email='$res[1]'";
															$exc = mysqli_query($con, $fetch);
															$rst = mysqli_fetch_array($exc);
															
															$pid = $res[0];
															if($pid<10)
																$pid = '00'.$pid;
															elseif($pid<100)
																$pid = '0'.$pid;
															
															?>
															  <tr>
																<td><?php echo $i++; ?></td>
																<td><?php echo $pidformat.$pid; ?></td>
																<td><?php echo $rst[0]; ?></td>
																<td><?php echo $res[2]; ?></td>
															  </tr>
															<?php
														}
													}
											?>
												</tbody>
											</table>
										</div>
									</div>
									<div id="chhoment1" class="tab-pane fade">
										<button class="btn btn-default" id="print5">Print</button>
										<div class="table-responsive">
											<table class="table table-bordered" id="div_print5">
												<thead>
												  <tr>
													<th>#</th>
													<th>Project ID</th>
													<th>Mentor</th>
													<th>Enrollment</th>
												  </tr>
												</thead>
												<tbody>

											<?php
												
													mysqli_data_seek($exec, 0);
													$i=1;
													while($res = mysqli_fetch_array($exec)){
														$sql = "select pid from synopsis where enrollment = '$res[2]' and subject = 'Synopsis2'";
														$run = mysqli_query($con, $sql);
														if(mysqli_num_rows($run)==0){
															$fetch = "SELECT name FROM faculty WHERE email='$res[1]'";
															$exc = mysqli_query($con, $fetch);
															$rst = mysqli_fetch_array($exc);
															
															$pid = $res[0];
															if($pid<10)
																$pid = '00'.$pid;
															elseif($pid<100)
																$pid = '0'.$pid;
															?>
															  <tr>
																<td><?php echo $i++; ?></td>
																<td><?php echo '17PE002'.$pid; ?></td>
																<td><?php echo $rst[0]; ?></td>
																<td><?php echo $res[2]; ?></td>
															  </tr>
															<?php
														}
													}
											?>
												</tbody>
											</table>
										</div>
									</div>
									<div id="chhoment2" class="tab-pane fade">
										<button class="btn btn-default" id="print6">Print</button>
										<div class="table-responsive">
											<table class="table table-bordered" id="div_print6">
												<thead>
												  <tr>
													<th>#</th>
													<th>Project ID</th>
													<th>Mentor</th>
													<th>Enrollment</th>
												  </tr>
												</thead>
												<tbody>

											<?php
												
													mysqli_data_seek($exec, 0);
													$i=1;
													while($res = mysqli_fetch_array($exec)){
														$sql = "select pid from synopsis where enrollment = '$res[2]' and subject = 'Synopsis3'";
														$run = mysqli_query($con, $sql);
														if(mysqli_num_rows($run)==0){
															$fetch = "SELECT name FROM faculty WHERE email='$res[1]'";
															$exc = mysqli_query($con, $fetch);
															$rst = mysqli_fetch_array($exc);
															
															$pid = $res[0];
															if($pid<10)
																$pid = '00'.$pid;
															elseif($pid<100)
																$pid = '0'.$pid;
															
															?>
															  <tr>
																<td><?php echo $i++; ?></td>
																<td><?php echo $pidformat.$pid; ?></td>
																<td><?php echo $rst[0]; ?></td>
																<td><?php echo $res[2]; ?></td>
															  </tr>
															<?php
														}
													}
											?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				  </div>
				  <div id="menu5" class="tab-pane fade">
					<div class="form_div">
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
												<label class="control-label" for="Adateid">Select Date<span style="color:red;font-size:17px;">*</span>:</label>
												<input type="text" class="form-control" id="Adateid" placeholder="Select attendance Date" name="Adate" required>
												<input type="hidden" value="Hello"  name="mattdummy">
											</div>
											<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
												<label class="control-label" for="attmentor">Mentor<span style="color:red;font-size:17px;">*</span>:</label>
												<input type="text" class="form-control" list="mentorList" id="attmentor" placeholder="Select mentor" name="attmentor">
												<datalist id="mentorList">
													<?php while($row10 = mysqli_fetch_array($run10)){ ?>
														<option value="<?php echo $row10[0]; ?>">
													<?php } 
														  mysqli_data_seek($run10, 0);
													?>
												</datalist>
											</div>
										</div>
										<div id="resultAtt"></div>
									</div>
								  </div>	
								</div>
							</div>
							<div id="complete" class="tab-pane fade">
								<div class="row" style="margin:1%;">
								  <div class="card card-mini" style="padding:3%;">
									<div class="card-body no-padding table-responsive">
										<div class="form-group row">
											<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
												<label class="control-label" for="attmentorComp">Mentor<span style="color:red;font-size:17px;">*</span>:</label>
												<input type="text" class="form-control" list="mentorListComp" id="attmentorComp" placeholder="Select mentor" name="attmentorComp">
												<datalist id="mentorListComp">
													<?php while($row10 = mysqli_fetch_array($run10)){ ?>
														<option value="<?php echo $row10[0]; ?>">
													<?php } ?>
												</datalist>
											</div>
										</div>
										<div id="resultAttComp"></div>
									</div>
								</div>
							  </div>
							</div>
						</div>
					</div>								
				  </div>	
					<div id="menu6" class="tab-pane fade">
					<div class="form_div">
						<div class="tab-content">
							<div class="tab-pane fade in active">
								<div class="row" style="margin:1%;">
								  <div class="card card-mini" style="padding:3%;">
									<div class="card-body no-padding table-responsive">	
										<div class="form-group row">
											<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
												<label class="control-label" for="markmentor">Mentor<span style="color:red;font-size:17px;">*</span>:</label>
												<input type="text" class="form-control" list="mentorlst" id="mark_st" placeholder="Select mentor" name="markmentor">
												<datalist id="mentorlst">
													<?php 
														mysqli_data_seek($run10,0);
														while($row10 = mysqli_fetch_array($run10)){ ?>
														<option value="<?php echo $row10[1]; ?>"><?php echo $row10[0]; ?></option>
													<?php }
													?>
												</datalist>
											</div>
										</div>
										<div id="resultMark"></div>
									</div>
								  </div>	
								</div>
							</div>
						</div>
					</div>								
				  </div>
				  
				  <div id="menu7" class="tab-pane fade">
					<div class="form_div" >
						<div class="form_div2">
							<center><h3>Select Student for Presentation</h3></center>
							<button class="btn btn-success" id="show_final">Show Final Selection</button>
							<br/>
							<br/>
							<div class="table-responsive">
								<table class="table table-bordered" id="">
									<thead>
									  <tr>
										<th>Sr. no.</th>
										<th>Name</th>
										<th>Enrollment</th>
										<th>Project ID</th>
										<th>Project Title</th>
										<th>Action</th>
									  </tr>
									</thead>
									<tbody>
									<?php
										$sql = "select distinct email from selected";
										$run_f = mysqli_query($con, $sql);
										$i = 1;
										while($row = mysqli_fetch_array($run_f)){
											$j = 'a';
											$email = $row['email'];
											$s = mysqli_query($con, "select idea.projectTitle, selected.pid, selected.final_select, selected.enrollment, studentmaster.name from idea inner join selected on selected.email='$email' and idea.pid=selected.pid inner join studentmaster on selected.enrollment=studentmaster.enrollment");
									?>		
										<tr style="background:#fff;color:#000;">
										  <td><b><?php echo $i; ?></b></td>
										  <td colspan="5"><?php echo $email; ?></td>
										</tr>
									<?php
											while($r = mysqli_fetch_array($s)){
												$title = $r['projectTitle'];
												$pid = $r['pid'];
												$enrollment = $r['enrollment'];
												$name = $r['name'];
												if($pid<10)
													$pid = '00'.$pid;
												elseif($pid<100)
													$pid = '0'.$pid;
									?>	
									  <tr>
										<td><?php echo $j; ?></td>
										<td><?php echo $name; ?></td>
										<td><?php echo $enrollment; ?></td>
										<td><?php echo $pidformat.$pid; ?></td>
										<td><?php echo $title; ?></td>
										<td><button class="btn btn-success select-btn" title="<?php echo $enrollment; ?>" style="<?php if($r['final_select']==1) echo "display:none;" ?>">Select</button><button class="btn btn-danger remove-btn" title="<?php echo $enrollment; ?>" style="<?php if($r['final_select']==0) echo "display:none;" ?>">Remove</button></td>
									  </tr>
									<?php
												$j++;
											}
											$i++;
										}
									?> 
									</tbody>
								</table>
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
	
	
	<script type="text/javascript">
		function refreshPage(){
			window.location = "admin.php";
		} 

		$("#show_final").click(function(){
			window.location = "show-final-list.php";
		});

		$(".select-btn").click(function(){
			var enrl = $(this).attr('title');
			
			$.ajax({
				url: 'todb.php',
				data: "s_pid="+enrl,
				type: 'POST',
				success: function(data){
					if(data == "true"){
						$("button.select-btn[title="+enrl+"]").hide();
						$("button.remove-btn[title="+enrl+"]").show();
					}else{
						alert("Something went wrong");
					}
				}
			});
		});

		$(".remove-btn").click(function(){
			var enrl = $(this).attr('title');
			
			$.ajax({
				url: 'todb.php',
				data: "r_pid="+enrl,
				type: 'POST',
				success: function(data){
					if(data == "true"){
						$("button.remove-btn[title="+enrl+"]").hide();
						$("button.select-btn[title="+enrl+"]").show();
					}else{
						alert("Something went wrong");
					}
				}
			});
		});
	
		$(".tweakbtn").on("click", function () {
			var raw = $(this).attr('id');
			var data = raw.split("H");
			var id = data[0];
			var action = data[1];
			
			$.ajax({
				url: 'todb.php',
				data: "tweakid="+id+"&tweakaction="+action,
				type: 'POST',
				success: function(data){
					if(data == true){
						if(action == "en")
							$('#'+id+'Hdis').css('visibility','');
						else
							$('#'+id+'Hen').css('visibility','');
						$('#'+raw).css('visibility','hidden');
					}else{
						alert("Something went wrong");
					}
				}
			});
		});
	
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
		
		$('#mark_st').change(function(){
			var mentor = $('#mark_st').val();
			if(mentor != ""){
				$.ajax({
					url: 'todb.php',
					data: "viewMarks="+mentor,
					type: 'POST',
					success: function(data){
						$('#resultMark').html(data);
					}
				});
			}
		});
		
		$('#attmentorComp').change(function(){
			
			var mentor = $('#attmentorComp').val();
			
			if(mentor != ""){
				$.ajax({
					url: 'todb.php',
					data: "viewAttMentorComp="+mentor,
					type: 'POST',
					success: function(data){
						$('#resultAttComp').html(data);
					}
				});
			}
		});
	
        $("#btnPrint").on("click", function () {
            var divContents = $("#form_div_print").html();
            var printWindow = window.open('', '', 'height=800,width=1200');
            printWindow.document.write('<html><head><title>Request Report</title>');
            printWindow.document.write('<center><h2>Report</h2></center>');
            printWindow.document.write('</head><body >');
			printWindow.document.write("<table border=\"1\" cellpadding=\"3\" style=\"border-collapse:collapse;\"");
            printWindow.document.write(divContents);
			printWindow.document.write("</table>");
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
      
        });
		$("#btnPrint2").on("click", function () {
            var divContents = $("#form_div_print2").html();
            var printWindow = window.open('', '', 'height=800,width=1200');
            printWindow.document.write('<html><head><title>Request Report</title>');
			printWindow.document.write('<center><h2>Report</h2></center>');
            printWindow.document.write('</head><body >');
			printWindow.document.write("<table border=\"1\" cellpadding=\"3\" style=\"border-collapse:collapse;\"");
            printWindow.document.write(divContents);
			printWindow.document.write("</table>");
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
      
        });
		
		$("#btnPrint5").on("click", function () {
            var divContents = $("#form_div_print5").html();
            var printWindow = window.open('', '', 'height=800,width=1200');
            printWindow.document.write('<html><head><title>Request Report</title>');
			printWindow.document.write('<center><h2>Report</h2></center>');
            printWindow.document.write('</head><body >');
			printWindow.document.write("<table border=\"1\" cellpadding=\"3\" style=\"border-collapse:collapse;\"");
            printWindow.document.write(divContents);
			printWindow.document.write("</table>");
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
      
        });
		
		$("#print1").on("click", function () {
            var divContents = $("#div_print1").html();
            var printWindow = window.open('', '', 'height=800,width=1200');
            printWindow.document.write('<html><head><title>Synopsis Report</title>');
			printWindow.document.write('<center><h2>Report Submitted Students</h2></center>');
            printWindow.document.write('</head><body >');
			printWindow.document.write("<table border=\"1\" cellpadding=\"3\" style=\"width:100%;border-collapse:collapse;\"");
            printWindow.document.write(divContents);
			printWindow.document.write("</table>");
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
		$("#print2").on("click", function () {
            var divContents = $("#div_print2").html();
            var printWindow = window.open('', '', 'height=800,width=1200');
            printWindow.document.write('<html><head><title>Synopsis Report</title>');
			printWindow.document.write('<center><h2>Report Submitted Students</h2></center>');
            printWindow.document.write('</head><body >');
			printWindow.document.write("<table border=\"1\" cellpadding=\"3\" style=\"width:100%;border-collapse:collapse;\"");
            printWindow.document.write(divContents);
			printWindow.document.write("</table>");
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
		$("#print3").on("click", function () {
            var divContents = $("#div_print3").html();
            var printWindow = window.open('', '', 'height=800,width=1200');
            printWindow.document.write('<html><head><title>Synopsis Report</title>');
			printWindow.document.write('<center><h2>Report Submitted Students</h2></center>');
            printWindow.document.write('</head><body >');
			printWindow.document.write("<table border=\"1\" cellpadding=\"3\" style=\"width:100%;border-collapse:collapse;\"");
            printWindow.document.write(divContents);
			printWindow.document.write("</table>");
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
		$("#print4").on("click", function () {
            var divContents = $("#div_print4").html();
            var printWindow = window.open('', '', 'height=800,width=1200');
            printWindow.document.write('<html><head><title>Synopsis Report</title>');
			printWindow.document.write('<center><h2>Report not Submitted Students</h2></center>');
            printWindow.document.write('</head><body >');
			printWindow.document.write("<table border=\"1\" cellpadding=\"3\" style=\"width:100%;border-collapse:collapse;\"");
            printWindow.document.write(divContents);
			printWindow.document.write("</table>");
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
		$("#print5").on("click", function () {
            var divContents = $("#div_print5").html();
            var printWindow = window.open('', '', 'height=800,width=1200');
            printWindow.document.write('<html><head><title>Synopsis Report</title>');
			printWindow.document.write('<center><h2>Report not Submitted Students</h2></center>');
            printWindow.document.write('</head><body >');
			printWindow.document.write("<table border=\"1\" cellpadding=\"3\" style=\"width:100%;border-collapse:collapse;\"");
            printWindow.document.write(divContents);
			printWindow.document.write("</table>");
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
		$("#print6").on("click", function () {
            var divContents = $("#div_print6").html();
            var printWindow = window.open('', '', 'height=800,width=1200');
            printWindow.document.write('<html><head><title>Synopsis Report</title>');
			printWindow.document.write('<center><h2>Report not Submitted Students</h2></center>');
            printWindow.document.write('</head><body >');
			printWindow.document.write("<table border=\"1\" cellpadding=\"3\" style=\"width:100%;border-collapse:collapse;\"");
            printWindow.document.write(divContents);
			printWindow.document.write("</table>");
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });

		$('#ad_chpwd').submit(function(e){
				e.preventDefault();
				  
				$.ajax({
					url: 'todb.php',
					type: 'POST',
					data: $(this).serialize(),
					dataType: 'html'
				})
				.done(function(data){
					$('#ad_chpwd').find('input[type=email]').val(''); 
					$('#ad_chpwd').find('input[type=text]').val('');
					$('#result').fadeOut('fast', function(){
					  $('#result').fadeIn('fast').html(data);
					});
				})
				.fail(function(){
					alert('Ajax Submit Failed ...'); 
				});
			});
			$('#pidformatform').submit(function(e){
				e.preventDefault();
				  
				$.ajax({
					url: 'todb.php',
					type: 'POST',
					data: $(this).serialize(),
					dataType: 'html'
				})
				.done(function(data){
					alert(data);
				})
				.fail(function(){
					alert('Ajax Submit Failed ...'); 
				});
			});
	</script>
</body>
</html>