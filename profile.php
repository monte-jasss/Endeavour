<?php
	
	session_start();
	if(isset($_SESSION['username1'])){
		if($_SESSION['acctype1'] == 0 || $_SESSION['acctype1'] == 2){
			$username = $_SESSION['username1'];
			$email = $_SESSION['email1'];
			
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
	</style>
</head><!--/head-->

<body>
	
	<header id="header" role="banner">		
		<?php include 'headerlogin.php'; ?>
    </header>
	<!--/#home-->

	<section id="subscribe" class="section-style" style="background-image:url(images/background/about-us2.jpg);background-attachment:fixed;">
		<div class="container">	
				<div class="form_div" >
					<center><h3>Profile</h3></center>

					  <ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#home">Change Password</a></li>
						<li><a data-toggle="tab" href="#menu1">Personal Info</a></li>
					  </ul>

					  <div class="tab-content">
						<div id="home" class="tab-pane fade in active">
						  <center><h3>Change Password</h3></center>
						  <form id="chpwd_form" method="POST">
							  <div class="form-group">
								<label style="color:white;" for="opwd">Old Password:</label>
								<input type="password" class="form-control" name="opwd" id="opwd" placeholder="Old Password" required>
							  </div>
							  <div class="form-group">
								<label style="color:white;" for="npwd">New Password:</label>
								<input type="password" class="form-control" name="npwd" id="npwd" placeholder="New Password" required>
							  </div>
							  <div class="form-group">
								<label style="color:white;" for="cpwd">Confirm Password:</label>
								<input type="password" class="form-control" name="cpwd" id="cpwd" placeholder="Confirm Password" required>
							  </div>
							  <center><h3 id="chpwdResult"></h3></center>
							  <button type="submit" class="btn btn-default" >Change</button>
							</form>
						</div>
						<div id="menu1" class="tab-pane fade">
						  <center><h3>Personal Info</h3></center>
						  <center><img src="images/underc.gif" alt="Under Construction" class="img-responsive" ></center>
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
	
	<script>
		$('#chpwd_form').submit(function(e){
			e.preventDefault();
			$('#chpwdResult').fadeOut('fast', function(){
			  $('#chpwdResult').fadeIn('fast').html("Processing");
			});
			
			var npwd = $('#npwd').val();
			var cpwd = $('#cpwd').val();
			
			if(npwd == cpwd){
				$.ajax({
					url: 'todb.php',
					type: 'POST',
					data: $(this).serialize(),
					dataType: 'html'
				})
				.done(function(data){
			
					if(data == true){
						
						window.location = "redirect.php";
						$('#chpwdResult').fadeOut('fast', function(){
						  $('#chpwdResult').fadeIn('fast').html("Access");
						});
					}else{
						$('#chpwd_form').find('input[type=password]').val('');
						$('#chpwdResult').fadeOut('fast', function(){
						  $('#chpwdResult').fadeIn('fast').html(data);
						});
					}
				})
				.fail(function(){
					alert('Ajax Submit Failed ...'); 
				});
			}else{
				$('#chpwdResult').fadeOut('fast', function(){
				  $('#chpwdResult').fadeIn('fast').html("Passwords do not match !!!");
				});
			}
		});
	</script>
</body>
</html>