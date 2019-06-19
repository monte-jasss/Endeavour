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
	<link href="assets/css/animate.css" rel="stylesheet">	
	<link href="assets/css/responsive.css" rel="stylesheet">
	<link href="assets/css/main.css" rel="stylesheet">

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
		@media only screen and (max-width: 500px) {
			.form_div{
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
			<div class="row">	
				<div class="mycontainer">
					<div class="form_div">
						<center><h3>Project Endeavour Mentor<br>Registration Form</h3></center>
						<form id="register_form" method="POST">
							<div class="form-group">
							  <label for="usr">Name:</label>
							  <input type="text" class="form-control" name = "facultyname" id="usr" placeholder="Name" required>
							</div>
						  <div class="form-group">
							<label for="email">Email address:</label>
							<input type="email" class="form-control" name="email" id="email" placeholder="Email (SPSU)" required>
						  </div>
						  <div class="form-group">
							<label for="pwd">Password:</label>
							<input type="password" class="form-control" name="password" id="pwd" placeholder="Password" required>
						  </div>
						  <div class="form-group">
							<label for="cpwd">Password:</label>
							<input type="password" class="form-control" name="cpassword" id="cpwd" placeholder="Confirm Password" required>
						  </div>
						  <div><center><h3 id="showresult" style="color:red;"></h3></center></div>
						  <center><button type="submit" class="btn btn-default">Submit</button></center>
						</form>
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
	<script>
		
		$('#login').on("click",function(){
			$('#loginModal').modal('show');
		});
		
		$('#register_form').submit(function(e){
			e.preventDefault();
			var domain = "spsu.ac.in";
			var edomain = $('#email').val().split("@");
	
			if(domain == edomain[1]){
				if($('#pwd').val() == $('#cpwd').val()){
			  
					$.ajax({
						url: 'todb.php',
						type: 'POST',
						data: $(this).serialize(),
						dataType: 'html'
					})
					.done(function(data){
						$('#showresult').fadeOut('fast', function(){
						  $('#showresult').fadeIn('fast').html(data);
						});
						$('#register_form').find('input[type=text]').val(''); 
						$('#register_form').find('input[type=email]').val(''); 
						$('#register_form').find('input[type=password]').val(''); 
					})
					.fail(function(){
						alert('Ajax Submit Failed ...'); 
					});
				}else{
					$('#showresult').fadeOut('fast', function(){
					  $('#showresult').fadeIn('fast').html("Passwords do not match !!!");
					});
				}
			}else{
				$('#showresult').fadeOut('fast', function(){
				  $('#showresult').fadeIn('fast').html("Register with SPSU email ID !!!");
				});
			}
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