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
					<li class="active"><a href="index.php">Home</a></li>		
					<li><a href="registeredp.php">Resistered Projects</a></li>	
					<li><a target="_blank" href="documents/calendar.pdf">Endeavour Calendar</a></li>
					<li><a href="contact.php">Contact</a></li>	
					<?php if($_SESSION['acctype1'] == 2) echo '<li><a href="profile.php">Profile</a></li>'; ?>	
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $username; ?>
						<span class="caret"></span></a>
						<ul class="dropdown-menu">
						  <?php 
								if($_SESSION['acctype1'] != 1 && $_SESSION['acctype1'] != 2){
									echo "<li><a style=\"color:black;\" href=\"profile.php\">Profile</a></li>";
									echo "<li><a style=\"color:black;\" href=\"history.php\">History</a></li>";
								}
						  ?>
						  <li><a style="color:black;" href="logout.php">Logout</a></li>
						</ul>
					  </li>	
				  </ul>
				</div>
			  </div>
			</nav>