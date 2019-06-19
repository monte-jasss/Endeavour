<?php
	
	session_start();
	if(isset($_SESSION['username1']) && isset($_GET['pid'])){
		if($_SESSION['acctype1'] == 0){
			
			include 'conn.php';
			
			$username = $_SESSION['username1'];
			$pid = $_GET['pid'];
			$select = $_GET['select'];
			
			$sql = "select * from idea where pid = '$pid'";
			$run = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($run);
			
			if(isset($_GET['enrol'])){
				$enrol = $_GET['enrol'];
				$sql1 = "select * from synopsis where pid = '$pid' and enrollment='$enrol'";
				$run1 = mysqli_query($con, $sql1);
				$row1 = mysqli_fetch_array($run1);
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
		<?php include 'headerlogin.php'; ?>
			
    </header>
	<!--/#home-->

	<section id="subscribe" class="section-style" style="background-image:url(images/background/about-us2.jpg);background-attachment:fixed;background-size:cover;">
		<div class="container">
			<div class="row">	
				<div class="mycontainer">
					<div class="form_div" >
						<?php
							if($select == 1){
						?>
								<center><h3>Edit Your Idea</h3></center>
								<form method="POST" action="todb.php" enctype="multipart/form-data">
									<div class="form-group">
									  <label for="usr">Project Title*:</label>
									  <input type="text" class="form-control" name = "editProjectTitle" id="usr" placeholder="Name" value="<?php echo $row[3]; ?>">
									</div>
									<div class="form-group">
									  <label for="comment">Project Idea*:</label>
									  <textarea class="form-control" rows="5" name="editProjectIdea" id="comment" placeholder="Project Idea"><?php echo $row[2]; ?></textarea>
									</div>
									<div class="form-group">
									  <label for="fileToUpload1">Upload Supporting Documents (Optional):</label>
									  <input type="file" class="form-control" name="fileToUpload" id="fileToUpload1" placeholder="(Optional)" >
									</div>
									<input type="hidden" name = "editProjectId" value = "<?php echo $pid; ?>">
								  <div id="showresult"></div>
								  <center><button type="submit" class="btn btn-default">Edit</button></center>
								</form>
						<?php
							}else if($select == 2){
								
						?>
								<h3>Update Synopsis</h3>
								<h3>Project : <?php echo $row['projectTitle']; ?></h3>
								<form method="POST" action="todb.php" enctype="multipart/form-data">

									<input type="hidden" name="updateSynPid" value="<?php echo $pid; ?>" />
									<input type="hidden" name="updateSynSub" value="<?php echo $row1['subject']; ?>" />
									<input type="hidden" name="updateSynEnr" value="<?php echo $enrol; ?>" />
									<div class="form-group">
									  <label>Upload :</label>
									  <input type="file" class="form-control" name="synopsisToUpdate" required>
									</div>
								  <div id="showresult"></div>
								  <center><button type="submit" class="btn btn-default">Submit</button></center>
								</form>
						<?php
							}
						?>
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
		
		$('#refresh').on("click",function(){
			window.location = "history.php";
		});
		
	</script>
</body>
</html>