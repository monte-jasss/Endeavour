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
			margin:5%;
			border-radius:5px;
		}
		.con-image img{
			border-radius: 50%;
			height: 180px;
			width: 180px;
			border: 2px solid grey;
		}
		@media only screen and (max-width: 500px) {
			.form_div{
				width:90%;
				height: 360px;
			}
		}
	</style>
</head><!--/head-->

<body>
	
	<header id="header" role="banner">		
		<?php 
			session_start();
			if(isset($_SESSION['username1'])){
				$username = $_SESSION['username1'];
				include 'headerlogin.php'; 
			}else{
				
				
				include 'header.php';
			}
		?>
    </header>
	<!--/#home-->

	<section id="subscribe" class="section-style" style="background-image:url(images/background/about-us2.jpg);background-attachment:fixed;">
		<div class="container">	
			<div class="form_div">
				<h2><center>Co-Ordinators</center></h2>
				<div class="row" style="width:60%;margin:0 auto;">
					<div class="col-sm-12 col-md-6 con-image" style="margin:0 auto;">
						<center><img src="images/neogi.jpg" alt="Subhrendu Guha Neogi"><p>Faculty Co-Ordinator</p><p>Subhrendu Guha Neogi</p><p>mob: 9887712216</p><p>subhrendu.neogi@spsu.ac.in</p></center>
					</div>
					<div class="col-sm-12 col-md-6 con-image" style="margin:0 auto;">
						<center><img src="images/vaibhav.jpg" alt="Vaibhav Pal"><p>Student Co-Ordinator</p><p>Vaibhav Pal</p><p>mob: 8769328304</p><p>vaibhav.pal@spsu.ac.in</p></center>
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