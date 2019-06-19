<?php
	include 'conn.php';
	if($con){
		
		$pidselect = "select action from bittable where id = 7";
		$pidrun = mysqli_query($con, $pidselect);
		$pidrow = mysqli_fetch_array($pidrun);
		$pidformat = $pidrow[0];
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
				width:100%;
				min-height: 300px;
				padding:3% 2% 3% 0%;
			}
			.container{
				padding-left:0px;
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
				<div class="form_div" >
					<center><h3>submitted Ideas</h3></center>
				<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
					  <tr>
						<th>Sr. no.</th>
						<th>Project ID</th>
						<th>Name</th>
						<th>Email</th>
						<th>Project Title</th>
						<th>Project Idea</th>
						<th>Project document</th>
					  </tr>
					</thead>
					<tbody>
					<?php
						$sql = "select * from idea";
						$run = mysqli_query($con, $sql);
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