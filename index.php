<?php
	
	session_start();
	if(isset($_SESSION['username1'])){
		if($_SESSION['acctype1'] == 0){
			header('location: idea.php');
		}else if($_SESSION['acctype1'] == 1){
			header('location: admin.php');
		}else if($_SESSION['acctype1'] == 2){
			header('location: admin.php');
		}else{
			header('location: index.php');
		}
	}else{
		include 'conn.php';
		if($con){
			$sql = "select bit from bittable where action = 'studentregistration'";
			$run = mysqli_query($con, $sql);
			$bit = mysqli_fetch_array($run);
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Project Endeavour</title>
	<meta name="description" content="Kite Coming Soon HTML Template by Jewel Theme" >
	<meta name="author" content="Jewel Theme">

	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

	<!-- Bootstrap  -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">

	<!-- icon fonts font Awesome -->
	<link href="assets/css/font-awesome.min.css" rel="stylesheet">

	<!-- Custom Styles -->
	<link href="assets/css/style.css" rel="stylesheet">

	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.js"></script>
	<![endif]-->
	<style>
		.mycontainer{
	width:80%;
	margin:0 auto;
	padding:5%;
	background-color:rgba(0, 0, 0, 0.3);
	border-radius:5px;
}
	p{
		text-align:justify;
	}
	@media only screen and (max-width: 500px) {
		.mobile{
			font-size:12px !important;
		}
		.mycontainer{
			width:100%;
		}
		.pattern{
			width:100%;
		}
	}
	.modalClass{
		width:50%;
		margin: 0 auto;
	}
	.btn-default:hover, .btn-default:focus, .btn-default:active, .btn-default.active, .open>.dropdown-toggle.btn-default {
		background-color: #fff;
	}
	.btn-default{
		background-color: #fff;
	}
	.nav-tabs > li.active > a, .nav-tabs > li.active > a:focus{
          background-color: #428bca;
		  color:#fff;
        } 
		.nav-tabs > li > a{
		  color:#fff;
        } 
		.nav-tabs > li > a:hover{
			color:black;
		}
	</style>

</head>
<body>


	<!-- Preloader -->
	<div id="preloader">
		<div id="loader">
			<div class="dot"></div>
			<div class="dot"></div>
			<div class="dot"></div>
			<div class="dot"></div>
			<div class="dot"></div>
			<div class="dot"></div>
			<div class="dot"></div>
			<div class="dot"></div>
			<div class="lading"></div>
		</div>
	</div><!-- /#preloader -->
	<!-- Preloader End-->


	<!-- Main Menu -->
	<div id="main-menu" class="navbar navbar-default navbar-fixed-top" role="navigation">

		<div class="navbar-header">
			<!-- responsive navigation -->
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<i class="fa fa-bars"></i>
			</button> <!-- /.navbar-toggle -->

		</div> <!-- /.navbar-header -->

		<nav class="collapse navbar-collapse">
			<!-- Main navigation -->
			<ul id="headernavigation" class="nav navbar-nav">
				<li class="active"><a href="#">Home</a></li>	
				<!--<li><a id="register" href="#">Registration</a></li>	-->
				<li><a id="registeredp" href="#">Registered Projects</a></li>
				<li class="<?php if($bit[0] == 0) echo "hidden"; ?>"><a id="student" href="#">Student Registration</a></li>
				<li><a id="sstudent" href="#">Selected Students</a></li>
				<li><a id="calendar" href="#">Endeavour Calendar</a></li>
				<li><a id="contact" href="#">Contact</a></li>		
				<li><a id="login" href="javascript:void(0)">Log In</a></li>		
			</ul> <!-- /.nav .navbar-nav -->
		</nav> <!-- /.navbar-collapse  -->
	</div><!-- /#main-menu -->
	<!-- Main Menu End -->
	

	<!-- Page Top Section -->
	<section id="page-top" class="section-style" style="background-image:url(images/background/page-top.jpg);background-attachment:fixed;">
		<div class="pattern height-resize">
			<div class="container">
				<h1 class="site-title">
					Sir Padampat Singhania University
				</h1><!-- /.site-title -->
				<center><img src="images/logo1.png" class="img-responsive" alt="SPSU LOGO" width="15%" /></center>
				<h2 class="section-title">
					<span>
						Project Endeavour
					</span>
				</h2><!-- /.section-name -->
				<h3 class="section-name">
					The Intelligence that does not innovate ages and declines.In a period of rapid change such as the present the decline will be fast.
				</h3><!-- /.Section-title  -->
				<!-- /.time-count-container -->

				<div class="next-section">
					<a href="#about"><span></span></a>
				</div><!-- /.next-section -->
				
			</div><!-- /.container -->
		</div><!-- /.pattern -->		
	</section><!-- /#page-top -->
	<!-- Page Top Section  End -->


	<!-- About Us Section -->
	<section id="about" class="section-style" style="background-image:url(images/background/about-us.jpg);background-attachment:fixed;">
		<div class="pattern height-resize"> 
			<div class="mycontainer">
				<h3 class="section-name">
					<span>
						Project Endeavour 2017
					</span>
				</h3><!-- /.section-name -->
				<br>
				<p style="font-size:20px;" class="mobile">
					
					If you have ever taken care to read the vision statement of SPSU, it says:
To be a leader among educational institutions by building a tradition of innovation, problem solving and interdisciplinary collaboration to meet the changing needs of the society.
Let us understand it as :
Innovation: When we talk about business, industry or even jobs today, innovation comes across as the buzz-word that everybody talks about but no one has any clue of what it is actually about. Wikipedia puts it like that:
The goal of innovation is positive change, to make someone or something better.
At SPSU, we are trying to understand and initiate a process that might establish a culture of innovation in our University. We believe that innovation can come, if we are allowed to make a lot of mistakes while having an eye to see our own mistakes, move on and build something better. As you read on, you will understand how we plan to create such an environment for you.
Problem Solving: Problem solving is something that we are faced with on a daily basis, and more so as we get close to becoming real engineers. But the real essence of problem solving is understanding the problem really well. Problem solving is an attitude. An attitude that takes careful thinking, alternate perspectives and suitable actions. We hope to build that attitude.
Interdisciplinary Collaboration: If you have seen the latest smartphone, you know that besides just a phone, it is a computer, music provider, temperature reader and much more. Therefore, technology is converging. It is not enough to know just one subject and get on with it. The scope of knowledge and application is different now. Therefore, an interdisciplinary approach is a must. And we at SPSU have figured out a way to inject that spirit in our culture.
Project Endeavour is a ground-breaking idea at the center of which lies initiatives. Initiatives that are taken by you. Initiatives that can be in the form of projects or researches. Initiatives that interest you. Initiatives that you believe are important to you.
Everybody know that projects are good for practical knowledge, building team spirit and knowing beyond the scope of course. And since, it is obvious that students gave more importance to theoretical subjects because they carry marks, we came up with the idea of giving marks for practical work also. We thought of merging the two processes and coming up with a solution so that both the needs can be fulfilled i.e. Making projects and crediting students by giving them marks for their projects. So now, the credit for making a worthwhile project goes straight to your mark sheet. Most exciting part is that it is not just for final year students. It is for everyone who wants to do something.
We look forward for an overwhelming response from your part towards Project Endeavour 2016-17.
				</p><!-- /.section-description -->
				
				
<!-- /.container -->
			</div>
		</div><!-- /.pattern -->
		
		
	</section><!-- /#about -->
	<!-- About Us Section End -->

	
	<section id="page-top" class="section-style" style="background-image:url(images/background/pic2.jpg);">
		<div class="pattern" style="height:800px;">
			
		</div><!-- /.pattern -->		
	</section><!-- /#page-top -->


	<!-- Subscribe Section -->
	<section id="subscribe" class="section-style" style="background-image:url(images/background/newsletter.jpg);background-attachment:fixed;">
		<div class="pattern height-resize">
			<div class="mycontainer">
				<h3 class="section-name">
					<span>
						Know about us
					</span>
				</h3><!-- /.section-name -->
				<br>
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#home">PROJECT ENDEAVOUR CONCEPT PAPER REPORT</a></li>
					<li><a data-toggle="tab" href="#menu1">STEPS TO FOLLOW</a></li>
					<li><a data-toggle="tab" href="#menu2">EVALUATION CRITERIA</a></li>
				  </ul>

				  <div class="tab-content">
					<div id="home" class="tab-pane fade in active">
						<br>
<p>We at SPSU are continuously looking at innovative ways to deliver knowledge to our students. Make learning and delivery mechanism innovative, interesting, easy and truly “out of box” teaching-learning process.
We have 10 working Saturdays (JULY- NOVEMBER) and 8 working Saturdays (DECEMBER-MAY). We have planned these Saturdays in a way that will help both the teacher and the taught to develop a concept which will require an in depth attempt to learn, articulate, bond together, initiate discussion, foster research, analyze, and above all, motivate ourselves to express our ideas openly.</p>
					</div>
					<div id="menu1" class="tab-pane fade">
						<br>
					  <p>Faculty will select a contemporary topic, which is preferably industry relevant.<br>
To associate a company or professional who can provide application-oriented perspective.<br>
Select a group of students (HOD will divide the students in groups taking the total number of students in the department)<br>
The topic will be thoroughly discussed, debated and developed into<br>
<ul>
<li>Project Endeavour format (project Endeavor deadlines mentioned in the academic calendar)</li>
<li>DST</li>
<li>GOI incubation project (If the project can be incubated)</li>
 </ul>
The best concept/paper (the selection criteria and the Jury members will be announced soon) will be selected to hold a Seminar on the subject. The seminar will invite relevant companies to participate.<br>
The concept paper, presentations and external evaluation will be concluded during the uneven semester (December 21-24, 2015)<br>
The seminars will be held on second Saturdays of the even semester.<br>
Finally, well-written and good concept papers will be collected and a department magazine will be published annually.<br>
<ul>
<li>ALL THE PAPERS WILL BE WRITTEN IN THE PROVIDED FORMAT.</li>
<li>ALL DEADLINES TO BE FOLLOWED.</li>
<li>THE FACULTY AND THE GROUP OF STUDENTS WILL MEET REGULARLY ON THE SCHEDULED TIME AND VENUE.</li>
<li>ALL STAGES OF CONCEPT DEVELOPMENT IN A DESIGNATED TIME FRAME MAY BE TABLED BEFORE THE HOD ON THE FIRST WORKING SATURDAY.</li>
</ul></p>
					</div>
					<div id="menu2" class="tab-pane fade">
						<br>
					  <p>The project shall be evaluated for 3 credits. The criteria for evaluation shall be as follows:<br>
					  <ol type="a">
<li>)     Originality of the concept                     :   20%</li>
<li>)     Procedure followed                              :   20%</li>
<li>)     Team work and deadlines achieved    :   20%</li>
<li>)     Documentation                                    :   20%</li>
<li>)     Presentation and display                     :   20%</li>
</ol>
The credit earned by the group shall be reflected in their grade sheet in the even semester i.e. II, IV, VI and VIII semesters.</p>
					</div>
				  </div>

				<div class="social-btn-container">
					<span class="social-btn-box">
						<a href="#" class="facebook-btn">
							<i class="fa fa-facebook"></i></a>
						</span><!-- /.social-btn-box -->

						<span class="social-btn-box">
							<a href="#" class="twitter-btn"><i class="fa fa-twitter"></i></a>
						</span><!-- /.social-btn-box -->

						<span class="social-btn-box">
							<a href="#" class="linkedin-btn"><i class="fa fa-linkedin"></i></a>
						</span><!-- /.social-btn-box -->

						<span class="social-btn-box">
							<a href="#" class="google-plus-btn"><i class="fa fa-google-plus"></i></a>
						</span><!-- /.social-btn-box -->


						<span class="social-btn-box">
							<a href="#" class="youtube-btn"><i class="fa fa-youtube"></i></a>
						</span><!-- /.social-btn-box -->



					</div><!-- /.social-btn-container -->

				</div><!-- /.container -->
			</div><!-- /.pattern -->

		</section><!-- /#subscribe -->
		<!-- Subscribe Section End -->

		<!-- Contact Section End -->

		<?php include 'login.php'; ?>
		
		<div class="container">
  <!-- Modal -->
	  <div class="modal fade" id="notiModal" role="dialog">
		<div class="modal-dialog modal-lg">
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h2 style="color:black;" class="modal-title">Notification</h2>
			</div>
			<div class="modal-body">
				<center><h4 style="color:black;">Faculty Members Need To Register Their Projects In The Registration Section</h4></center>
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		  </div>
		</div>
	  </div>
	</div>

		<!-- Footer Section -->
		<footer id="footer-section">
			<p class="copyright">
				&copy;SPSU 2017, All Rights Reserved. Designed & Developed by Vaibhav Pal & Monu Lakshkar
			</p>
		</footer>

		<!-- jQuery Library -->
		<script type="text/javascript" src="assets/js/jquery-2.1.0.min.js"></script>
		<!-- Modernizr js -->
		<script type="text/javascript" src="assets/js/modernizr-2.8.0.min.js"></script>
		<!-- Plugins -->
		<script type="text/javascript" src="assets/js/plugins.js"></script>
		<!-- Custom JavaScript Functions -->
		<script type="text/javascript" src="assets/js/functions.js"></script>
		<!-- Custom JavaScript Functions -->
		<script type="text/javascript" src="assets/js/jquery.ajaxchimp.min.js"></script>

		<script>
			//$('#notiModal').modal('show');
			$("#contact").click(function(){
				location.href = "contact.php";
			});
			$("#registeredp").click(function(){
				location.href = "registeredp.php";
			});
			$("#student").click(function(){
				location.href = "student.php";
			});
			$('#login').on("click",function(){
				$('#loginModal').modal('show');
			});
			$("#sstudent").click(function(){
				location.href = "selected.php";
			});
			$("#calendar").click(function(){
				window.open('documents/calendar.pdf','_blank');
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
