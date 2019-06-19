<?php
	include 'conn.php';
	if($con){
		
		
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
		#form_div2{
			width:50%;
			margin:0 auto;
		}
		@media only screen and (max-width: 500px) {
			.form_div{
				width:90%;
				min-height: 300px;
			}
			#form_div2{
				width:90%;
			}
		}
	</style>
</head><!--/head-->

<body>
	
	<header id="header" role="banner">		
		<?php include 'header.php'; ?>
    </header>
	<!--/#home-->

	<section id="subscribe" class="section-style" style="background-image:url(images/background/about-us2.jpg);background-attachment:fixed;">
		<div class="container">	
				<div class="form_div" >
					<center><h3>Choose Your Projects</h3></center>
					<br>
					<form id="student_form" method="POST">
					<div id="form_div2">
						<div><center><h3 class="studentResult"></h3></center></div>
					  <div class="form-group">
						<label for="enrollment">Enrollment:</label>
						<input type="text" class="form-control" list="enrlist" name="enrollment" id="enrollment" placeholder="Enrollment" required>
						<datalist id="enrlist">
						<?php
							$sql1 = "select * from studentmaster";
							$run1 = mysqli_query($con, $sql1);
							
							while($row1 = mysqli_fetch_array($run1)){
						?>
								<option value="<?php echo $row1[0]; ?>">
						<?php
							}
						?>
						</datalist>
					  </div>
					  <div class="form-group">
						<label for="name">Name:</label>
						<input type="text" class="form-control" name="studentname" id="name" placeholder="Name" required>
					  </div>
					  <div class="form-group">
						<label for="email">Email:</label>
						<input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
					  </div>
					  <div class="form-group">
						<label for="phone">Phone no.:</label>
						<input type="number" class="form-control" name="phone" id="phone" placeholder="Phone Number" required>
					  </div>
					</div>
					<br>
				<table class="table table-bordered table-responsive">
					<thead>
					  <tr>
						<th>Sr. no.</th>
						<th>Selected</th>
						<th>Mentor</th>
						<th>Project Title</th>
						<th>Project Idea</th>
						<th>Project document</th>
					  </tr>
					</thead>
					<tbody>
					<?php
						$i = 1;
						$sql = "select * from idea";
						$run = mysqli_query($con, $sql);
						while($row = mysqli_fetch_array($run)){
							$email = $row['email'];
							$s = mysqli_query($con, "select name from faculty where email = '$email'");
							$r = mysqli_fetch_array($s);
							$name = $r['name'];
							
					?>	
					  <tr>
						<td><?php echo $i; ?></td>
						<td>
							<div class="checkbox">
							  <center><input type="checkbox" name="check_list[]" value="<?php echo $row['pid']; ?>"></center>
							</div>
						</td>
						<td><?php echo $name ?></td>
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
						<div><center><h3 class="studentResult"></h3></center></div>
					  <button type="submit" class="btn btn-default">Submit</button>
				</form>
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
	
	<script>
		$('#login').on("click",function(){
			$('#loginModal').modal('show');
		});
		
		$("#enrollment").change(function(){
			var enrol = $('#enrollment').val();
			
			$.ajax({
				url: 'todb.php',
				type: 'POST',
				data: "enrolstureg="+enrol,
				dataType: 'html'
			})
			.done(function(data){
				var arr = JSON.parse(data);
				$('#name').val(arr[0]);
				$('#email').val(arr[1]);
			});
		});
		
		$('#student_form').submit(function(e){
				e.preventDefault();
				
				$('.studentResult').fadeOut('fast', function(){
					 $('.studentResult').fadeIn('fast').html("Processing");
				});
				  
				$.ajax({
					url: 'todb.php',
					type: 'POST',
					data: $(this).serialize(),
					dataType: 'html'
				})
				.done(function(data){
			
					if(data == true){
						
						
						$('.studentResult').fadeOut('fast', function(){
						  $('.studentResult').fadeIn('fast').html("Access");
						});
					}else{
						$('#student_form').find('input[type=email]').val(''); 
						$('#student_form').find('input[type=text]').val(''); 
						$('#student_form').find('input[type=number]').val('');
						
						$('.studentResult').fadeOut('fast', function(){
						  $('.studentResult').fadeIn('fast').html(data);
						});
					}
				})
				.fail(function(){
					alert('Ajax Submit Failed ...'); 
				});
			});
			
		$('#login_form').submit(function(e){
				e.preventDefault();
				  
				$.ajax({
					url: 'todb.php',
					type: 'POST',
					data: $(this).serialize(),
					dataType: 'html'
				})
				.done(function(data){
			
					if(data == true){
						
						window.location = "redirect.php";
						$('#loginResult').fadeOut('fast', function(){
						  $('#loginResult').fadeIn('fast').html("Access");
						});
					}else{
						$('#login_form').find('input[type=email]').val(''); 
						$('#login_form').find('input[type=password]').val('');
						$('#loginResult').fadeOut('fast', function(){
						  $('#loginResult').fadeIn('fast').html(data);
						});
					}
				})
				.fail(function(){
					alert('Ajax Submit Failed ...'); 
				});
			});
	</script>
</body>
</html>