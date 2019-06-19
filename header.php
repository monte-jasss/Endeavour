<?php
	include 'conn.php';
	if($con){
		$sql = "select bit from bittable where action = 'studentregistration'";
		$run = mysqli_query($con, $sql);
		$bit = mysqli_fetch_array($run);
	}
?>
<nav class="navbar navbar-inverse">
			  <div class="container-fluid">
				<div class="navbar-header" style="padding:1%">
				  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span> 
				  </button>
				  
				  <img class="img-responsive" src="images/logo.png" width="100%;" alt="logo" >
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
				  <ul class="nav navbar-nav">
					
				  </ul>
				  <ul class="nav navbar-nav navbar-right">
					<li class=""><a href="index.php">Home</a></li>	
					<!--<li ><a href="register.php">Registration</a></li>-->
					<li><a href="registeredp.php">Registered Projects</a></li>	
					<li class="<?php if($bit[0] == 0) echo "hidden";?>"><a href="student.php">Student Registration</a></li>
					<li><a href="selected.php">Selected Students</a></li>
					<li><a target="_blank" href="documents/calendar.pdf">Endeavour Calendar</a></li>
					<li><a href="contact.php">Contact</a></li>		
					<li><a id="login" href="javascript:void(0)">Log In</a></li>	
				  </ul>
				</div>
			  </div>
			</nav>