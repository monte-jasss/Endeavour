<?php
	
	session_start();
	include 'conn.php';
	if(isset($_SESSION['username1'])){
		if($_SESSION['acctype1'] == 0){
			$username = $_SESSION['username1'];
			$email = $_SESSION['email1'];
			
			if(isset($_GET['err'])){
				
				$err = $_GET['err'];
				if($err == 1){
					$msg = "Idea successfully submitted !!!";
				}else if($err == 2){
					$msg = "Submission Failed !!!";
				}else if($err == 3){
					$msg = "Sorry, there was an error uploading your file.";
				}else if($err == 4){
					$msg = "Sorry, only Pdf, doc & docx files are allowed.";
				}else if($err == 5){
					$msg = "Sorry, your file is too large.";
				}else if($err == 6){
					$msg = "Synopsis successfully submitted !!!";
				}else if($err == 7){
					$msg = "Synopsis for this phase already submitted. You can edit it in History !!!";
				}
			}
			
			
			$sql = "select pid, projectTitle from idea where email = '$email'";
			$run = mysqli_query($con, $sql);
			
			$sql2 = "select * from selected where email = '$email'";
			$run2 = mysqli_query($con, $sql2);
			
			$sqlbit = "select * from bittable";
			$runbit = mysqli_query($con, $sqlbit);
			$ideabit = mysqli_fetch_array($runbit);
			mysqli_fetch_array($runbit);
			$uploadbit = mysqli_fetch_array($runbit);
			$twodaybit = mysqli_fetch_array($runbit);
			$requestbit = mysqli_fetch_array($runbit);
			$attbit = mysqli_fetch_array($runbit);
			mysqli_fetch_array($runbit);
			$marksbit = mysqli_fetch_array($runbit);
			
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
	<link href="assets/css/responsive.css" rel="stylesheet">
	<link href="assets/css/timepicki.css" rel="stylesheet">
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
		.mycontainer{
			width:90%;
			margin:0 auto;
			padding:5%;
			min-height:500px;
			background-color:rgba(0, 0, 0, 0.3);
			border-radius:5px;
		}
		.form_div{
			width:60%;
			margin:0 auto;
			background-color:rgba(2,8, 15, 0.8);
			padding:3% 10% 3% 10%;
			
			border-radius:5px;
		}
		.form_div2{
			background-color:rgba(2,8, 15, 0.8);
			padding:3% 5% 3% 5%;
			border-radius:5px;
		}
		@media only screen and (max-width: 500px) {
			.form_div{
				width:90%;
			}
		}
		.dropdown-menu{
			z-index:5;
		}
		.material-switch > input[type="checkbox"] {
			display: none;   
		}

		.material-switch > label {
			cursor: pointer;
			height: 0px;
			position: relative; 
			width: 40px;  
		}

		.material-switch > label::before {
			background: rgb(13, 180, 241);
			box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
			border-radius: 8px;
			content: '';
			height: 16px;
			margin-top: -8px;
			position:absolute;
			opacity: 0.3;
			transition: all 0.4s ease-in-out;
			width: 40px;
		}
		.material-switch > label::after {
			background: rgb(255, 255, 255);
			border-radius: 16px;
			box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
			content: '';
			height: 24px;
			left: -4px;
			margin-top: -8px;
			position: absolute;
			top: -4px;
			transition: all 0.3s ease-in-out;
			width: 24px;
		}
		.material-switch > input[type="checkbox"]:checked + label::before {
			background: rgb(255, 255, 255);
			opacity: 0.5;
		}
		.material-switch > input[type="checkbox"]:checked + label::after {
			background: rgb(255, 255, 255);
			left: 20px;
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

	<section id="subscribe" class="section-style" style="background-image:url(images/background/about-us2.jpg);background-attachment:fixed;background-size:cover;" 

>
		<div class="container">
			<div class="row">	
				<div class="mycontainer" style="z-index:-5;">
					<ul class="nav nav-tabs">
					  <li class="<?php if($ideabit[2] == 0) echo "hidden";?>" ><a data-toggle="tab" href="#home">Post Idea</a></li>
					  <li class="<?php if($requestbit[2] == 0) echo "hidden"; ?> "><a data-toggle="tab" href="#menu1">Requests</a></li>
					  <li><a data-toggle="tab" href="#selected">Selected Students</a></li>
					  <li class="<?php if($uploadbit[2] == 0) echo "hidden"; ?>"><a data-toggle="tab" href="#upload">Upload</a></li>
					  <li class="<?php if($attbit[2] == 0) echo "hidden"; ?>"><a data-toggle="tab" href="#attendance">Attendance</a></li>
					  <li class="<?php if($marksbit[2] == 0) echo "hidden"; ?>"><a data-toggle="tab" href="#marks">Marks</a></li>
					</ul>

					<div class="tab-content">
						
					  <div id="home" class="tab-pane fade in active">
						<br>
						<div class="form_div" >
							<center><h3>Post Your Ideas</h3></center>
							<form method="POST" action="todb.php" enctype="multipart/form-data">
								<div class="form-group">
								  <label for="usr">Project Title*:</label>
								  <input type="text" class="form-control" name = "projectTitle" id="usr" placeholder="Name" required>
								</div>
								<div class="form-group">
								  <label for="comment">Project Idea*:</label>
								  <textarea class="form-control" rows="5" name="projectIdea" id="comment" placeholder="Project Idea" 

required></textarea>
								</div>
								<div class="form-group">
								  <label for="fileToUpload1">Upload Supporting Documents(Optional):</label>
								  <input type="file" class="form-control" name="fileToUpload" id="fileToUpload1" 

placeholder="(Optional)">
								</div>
							  <div id="showresult"></div>
							  <center><button type="submit" class="btn btn-default">Submit</button></center>
							</form>
						</div>
					  </div>
					  <div id="menu1" class="tab-pane fade">
						<div class="form_div2">
						<h3>Requests</h3>
						<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
							  <tr>
								<th>Sr no.</th>
								<th>Name</th>
								<th>Enrollment</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Project Title</th>
								<th>Select</th>
							  </tr>
							</thead>
							<tbody>
						<?php
							$i = 1;
							while($row = mysqli_fetch_array($run)){
								$pid = $row[0];
								$projectTitle = $row[1];
								$sql1 = "SELECT * FROM student WHERE selectedp = '$pid'";
								$run1 = mysqli_query($con, $sql1);
								while($row1 = mysqli_fetch_array($run1)){
						?>
								  <tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $row1['name']; ?></td>
									<td><?php echo $row1['enrollment']; ?></td>
									<td><?php echo $row1['email']; ?></td>
									<td><?php echo $row1['phone']; ?></td>
									<td><?php echo $projectTitle; ?></td>
									<td>
										<a href="javascript:void(0)" class="select" id="<?php echo $pid.'$'.$row1['enrollment']; ?>" 

style="text-decoration:none;color:white;"><i class="fa fa-check" aria-hidden="true"></i></a>
									</td>
								  </tr>
						<?php
								  $i++;
								}
							}
							mysqli_data_seek($run, 0);
						?>
							</tbody>
						</table>
						</div>
					  </div>
					  </div>
					  <div id="selected" class="tab-pane fade">
						<div class="form_div2">
						<h3>Selected Students</h3>
						<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
							  <tr>
								<th>Sr no.</th>
								<th>Name</th>
								<th>Enrollment</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Project Title</th>
								<th>Remove</th>
							  </tr>
							</thead>
							<tbody>
						<?php
							$i = 1;
							while($row2 = mysqli_fetch_array($run2)){
								$enrollment = $row2[1];
								$pid = $row2[2];
								
								$sql1 = "SELECT * FROM student WHERE enrollment = '$enrollment'";
								$run1 = mysqli_query($con, $sql1);
								$row1 = mysqli_fetch_array($run1);
								
								$sql3 = "SELECT projectTitle FROM idea WHERE pid = '$pid'";
								$run3 = mysqli_query($con, $sql3);
								$row3 = mysqli_fetch_array($run3);

						?>
								  <tr id="<?php echo $row1['enrollment']; ?>">
									<td><?php echo $i; ?></td>
									<td><?php echo $row1['name']; ?></td>
									<td><?php echo $row1['enrollment']; ?></td>
									<td><?php echo $row1['email']; ?></td>
									<td><?php echo $row1['phone']; ?></td>
									<td><?php echo $row3[0]; ?></td>
									<td>
										<div><a href="javascript:void(0)" class="remove" id="<?php echo $pid.'$'.$row1['enrollment']; ?>" 

style="text-decoration:none;color:white;"><i class="fa fa-trash" aria-hidden="true"></i></a></div>
									</td>
								  </tr>
						<?php
								  $i++;
								
							}
							mysqli_data_seek($run2, 0);
						?>
							</tbody>
						</table>
						</div>
					  </div>
					  </div>
					  <div id="upload" class="tab-pane fade">
						<div class="form_div">
						<h3>Upload</h3>
						<form method="POST" action="todb.php" enctype="multipart/form-data">
							<div class="form-group">
							  <label>Subject:</label>
							  <select class="form-control" name="synSub">
								<option>Select</option>
								<option value="Synopsis1">Synopsis</option>
								<option value="Synopsis2">Progress Report</option>
								<option value="Synopsis3">Final Report</option>
							  </select>
							</div>
							<div class="form-group">
							  <label>Select Project:</label>
							  <select class="form-control" name="synPro">
								<option>Select</option>
								<?php
									while($ro = mysqli_fetch_array($run)){
								?>
										<option><?php echo $ro['projectTitle']; ?></option>
								<?php
									}
								?>
							  </select>
							</div>
							<div class="form-group">
							  <label>Select Student:</label>
							  <select class="form-control" name="synstu">
								<option>Select</option>
								<?php
									while($ro = mysqli_fetch_array($run2)){
								?>
										<option><?php echo $ro[1]; ?></option>
								<?php
									}
									mysqli_data_seek($run2, 0);
								?>
							  </select>
							</div>
							<div class="form-group">
							  <label for="fileToUpload1">Upload :</label>
							  <input type="file" class="form-control" name="synopsisToUpload" required>
							</div>
						  <div id="showresult"></div>
						  <center><button type="submit" class="btn btn-default">Submit</button></center>
						</form>
						<h3 style="color:red">Note: Edit option available in history section.</h3>
					  </div>
					  </div>
					  <div id="attendance" class="tab-pane fade">
							<div class="form_div2">
								<form id="attendance_form">
									<div class="form-group row">
										<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
											<label class="control-label" for="date">Select Date<span style="color:red;font-size:17px;">*</span>:</label>
											<input type="text" class="form-control" id="Adateid" placeholder="Select attendance Date" name="Adate" required>
											<input type="hidden" value="Hello"  name="mattdummy">
										</div>
									</div>
									 <br>
									 <div class="tableDisplay">
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
											$i++;
											$enrollment = $col[1];
											$pid = $col[2];
											
											$sql1 = "SELECT * FROM student WHERE enrollment = '$enrollment'";
											$run1 = mysqli_query($con, $sql1);
											$row1 = mysqli_fetch_array($run1);
									?>
									  <tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $row1['name']; ?></td>
										<td><?php echo $enrollment; ?></td>
										<td><?php echo $row1['phone']; ?></td>
										
										<td>
											<div class="material-switch">
												<input class="check" id="someSwitchOptionSuccess<?php echo $i; ?>" name="present[]" type="checkbox" value="<?php echo $col[1]; ?>"/>
												<label for="someSwitchOptionSuccess<?php echo $i; ?>" class="label-success"></label>
											</div>
										</td>
									  </tr>
									<?php
										}
									?>
									</tbody>
								  </table>
								  </div>
								  <div id="Result"></div>
								  <center><button class="btn btn-primary" name="submit">Submit</button></center>
								</form>  
							</div>				
					  </div>	

					  <div id="marks" class="tab-pane fade">
							<div class="form_div2">
								<form id="marks_form">
								  <div class="tableDisplay">
								  <table class="table" >
									<thead>
									  <tr>
										<th>#</th>
										<th>Name</th>
										<th>Enrollment</th>
										<th>Mobile</th>
										<th>Marks</th>
									  </tr>
									</thead>
									<tbody>
									<?php
										mysqli_data_seek($run2, 0);
										$i=0;
										while($col = mysqli_fetch_array($run2)){
											$i++;
											$enrollment = $col[1];
											$pid = $col[2];
											
											$sql1 = "SELECT * FROM student WHERE enrollment = '$enrollment'";
											$run1 = mysqli_query($con, $sql1);
											$row1 = mysqli_fetch_array($run1);
									?>
									  <tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $row1['name']; ?></td>
										<td>
											<div class="form-group">
											  <input style="width:60%;" type="text" class="form-control" name="enrollment[]" value="<?php echo $enrollment; ?>" required readonly>
											</div>
										</td>
										<td><?php echo $row1['phone']; ?></td>
										
										<td>
											<div class="form-group">
											  <input style="width:50%;" type="number" class="form-control" name="marks[]" title="<?php echo $col[1]; ?>" required>
											</div>
										</td>
									  </tr>
									<?php
										}
									?>
									</tbody>
								  </table>
								  </div>
								  <div id="Result2"></div>
								  <center><button class="btn btn-primary" name="submit">Submit</button></center>
								</form>  
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
	<?php include 'login.php'; ?>
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
			  <button type="button" class="btn btn-default" id="refresh" data-dismiss="modal">Close</button>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	

	<?php if(isset($_GET['err'])) echo "<script>$('#errModal').modal('show');</script>"; ?>
	<script>
		
		var tabid = $('.nav-tabs').find('li:visible:first').children().first().attr('href');
		$('.nav-tabs a[href="'+tabid+'"]').tab('show');
			
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
			
			var twoday = '<?php echo $twodaybit[2]; ?>';
			if(twoday == 1){
				$('#Adateid').datepicker({
					format: "yyyy-mm-dd",
					todayHighlight: true,
					autoclose: true,
					endDate: today,
					startDate: lastDate
				});
			}else{
				$('#Adateid').datepicker({
					format: "yyyy-mm-dd",
					todayHighlight: true,
					autoclose: true,
					endDate: today,
					//startDate: lastDate
				});
			}
			
			
			$('#Adateid').on('changeDate', function(ev){
				$(this).datepicker('hide');
				date2 = Date.parse($(this).val());
				
				var d = $(this).val();
				$.ajax({
					url: 'todb.php',
					data: "upAttDate="+d,
					type: 'POST',
					success: function(data){
						$('.tableDisplay').html(data);
					}
				});	
			});
			
			$('#refresh').on("click",function(){
				window.location = "idea.php";
			});
			
			
			
			$('.select').click(function() { 
				var id = $(this).attr('id').split("$");
				var pid = id[0];
				var enrollment = id[1];
				
				$.ajax({
					url: 'todb.php',
					type: 'POST',
					data: "selectedPid="+pid+"&selectedEnrol="+enrollment,
					dataType: 'html'
				})
				.done(function(data){
					if(data == true){
						alert("Successfull..");
						window.location = "idea.php";
					}else{
						alert(data);
					}
					
				})
				.fail(function(){
					alert('Ajax Submit Failed ...'); 
				});
			});
			
			$('.remove').click(function() {
				var id = $(this).attr('id').split("$");
				var pid = id[0];
				var enrollment = id[1];
				
				$.ajax({
					url: 'todb.php',
					type: 'POST',
					data: "removePid="+pid+"&removeEnrol="+enrollment,
					dataType: 'html'
				})
				.done(function(data){
					if(data == true){
						$("#"+enrollment).hide();
						alert("Successfull..");
					}else{
						alert(data);
					}
				})
				.fail(function(){
					alert('Ajax Submit Failed ...'); 
				});
			});
		
			
			$("#attendance_form").on('submit',function(e){
				e.preventDefault();
				
				$.ajax({
					url: 'todb.php',
					data: $(this).serialize(),
					type: 'POST',
					success: function(data){
						$("#Result").html(data).fadeIn(100).delay(3000).fadeOut(100);
					}
				});
			});
			
			$("#marks_form").on('submit',function(e){
				e.preventDefault();
				
				$.ajax({
					url: 'todb.php',
					data: $(this).serialize(),
					type: 'POST',
					success: function(data){
						if(data=="true"){
							$("marks_form")[0].reset();
							alert("Marks successfully Submitted !!");
						} else if(data=="false") {
							alert("Marks Submission Failed or Already Submitted !!");
						} else {
							alert("Something went wrong, please try again later..."+data);
						}
					}
				});
			});
	
	</script>
</body>
</html>