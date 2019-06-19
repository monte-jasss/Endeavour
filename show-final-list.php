<?php
	session_start();
	include 'conn.php';
	if(isset($_SESSION['username1'])){
		if($_SESSION['acctype1'] == 1 || $_SESSION['acctype1'] == 2){
			$username = $_SESSION['username1'];
			$pidformat = $_SESSION['pidformat1'];
			include 'conn.php';
			if($con){
				$sql = "select idea.projectTitle, selected.pid, selected.enrollment from idea inner join selected on idea.pid=selected.pid and selected.final_select=1";
				$run = mysqli_query($con, $sql);
				$sql3 = "select * from presentation_timing";
				$run3 = mysqli_query($con, $sql3);
			}
			
			if(isset($_GET['err'])){
				
				$err = $_GET['err'];
				if($err == 1){
					$msg = "Calendar Successfully Uploaded !!!";
				}else if($err == 2){
					$msg = "Sorry, there was an error uploading your file.";
				}else if($err == 3){
					$msg = "Sorry, only PDF, DOC & DOCX files are allowed.";
				}else if($err == 4){
					$msg = "Sorry, your file is too large.";
				}
				
				
			}
		}else if($_SESSION['acctype1'] == 0){
			header('location: idea.php');
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
	<link href="assets/css/timepicki.css" rel="stylesheet">
	<link href="assets/css/responsive.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datepicker.css">
	<link rel="stylesheet" type="text/css" href="assets/css/accordion.css">

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
		.form_div2{
			width:60%;
			margin:0 auto;
		}
		.infoDivOut{
			min-height:100px;
			background-color:#006064;
			width:22%;
			margin-left:3%;
			box-shadow: 5px 5px 5px white;
			border: 1px solid white;
		}
		h1{
			text-shadow: -1px 0 black, 0 2px black, 2px 0 black, 0 -1px black;
		}
		.infoDivFa{
			float:right;
			font-size:35px;
			line-height:100px;
		}
		@media only screen and (max-width: 500px) {
			.form_div{
				width:100%;
				min-height: 300px;
				padding-left:0px;
			}
			.infoDivOut{
				width:100%;
				margin-bottom:2%;
			}
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
		body {
			font-family: Arial, Helvetica, sans-serif;
		}

		table {
			font-size: 1em;
		}

		.ui-draggable, .ui-droppable {
			background-position: top;
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
			<div class="">
				<center><h3>Selected Project for Presentation</h3></center>
				<div id="accordion" style="width:85%;margin:0 auto;">
				<?php
					$i=1;
					while($row = mysqli_fetch_array($run)){
						$title = $row['projectTitle'];
						$pid = $row['pid'];
						$enrollment = $row['enrollment'];
						if($pid<10)
							$pid = '00'.$pid;
						elseif($pid<100)
							$pid = '0'.$pid;
				?>
				  <h3 style="font-size:20px;font-family:;"><?php echo $i++."."."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$title; ?></h3>
				  <div>
					<p>
					<?php echo "<b>Project ID &nbsp;: ".$pidformat.$pid."</b><br/>"; ?>
					<?php echo "Enrollment : ".strtoupper($enrollment); ?>
					<br>
					<form class="row save-form" id="<?php echo $enrollment; ?>">
						<div class="col-md-3 col-lg-3">
							<div class="form-group int-<?php echo $enrollment; ?>">
							  <label for="int_evl">Internal Evaluator * </label>
							  <input name="int_evl[]" list="int_evl" id = "add_int_evl" class="form-control" type="text" placeholder="Internal Evaluator" required >
							  <datalist id="int_evl">
							  <?php
								$runq3 = mysqli_query($con, "select email, name from faculty");
								while($resq3 = mysqli_fetch_array($runq3)){
							  ?>
									<option value="<?php echo $resq3[1]; ?>"><?php echo $resq3[0]; ?></option>
							  <?php
								}
							  ?>	
							  </datalist>  
							</div>
							<center><i title="<?php echo $enrollment; ?>" class="add_evl fa fa-plus" style="font-size:25px;cursor:pointer;" aria-hidden="true"></i></center>
						</div>
					
						<div class="col-md-3 col-lg-3">
							<div class="form-group ext-<?php echo $enrollment; ?>">
							  <label for="ext_evl">External Evaluator * </label>
							  <input name="ext_evl[]" list="ext_evl" id = "add_ext_evl" class="form-control" type="text" placeholder="External Evaluator" required >
							  <datalist id="ext_evl">
							  <?php
								$runq3 = mysqli_query($con, "select email, name from faculty");
								while($resq3 = mysqli_fetch_array($runq3)){
							  ?>
									<option value="<?php echo $resq3[1]; ?>"><?php echo $resq3[0]; ?></option>
							  <?php
								}
							  ?>	
							  </datalist>  
							</div>
							<center><i title="<?php echo $enrollment; ?>" class="add_evl2 fa fa-plus" style="font-size:25px;cursor:pointer;" aria-hidden="true"></i></center>
						</div>
						<div class="col-md-3 col-lg-3">
							<div class="form-group date">
							  <label for="date">Date - Time * </label>
							  <input name="date" list="date" id = "add_date" class="form-control" type="text" placeholder="Date - Time" required >
							  <datalist id="date">
							  <?php
								while($res3 = mysqli_fetch_array($run3)){
							  ?>
									<option><?php echo $res3[0]." at ".$res3[1]; ?></option>
							  <?php
								}
							  ?>	
							  </datalist>  
							</div>
						</div>
						<div class="col-md-3 col-lg-3">
							<div class="form-group venue">
							  <label for="venue">Venue * </label>
							  <input name="venue" list="venue" id = "add_venue" class="form-control" type="text" placeholder="Venue" required >
							  <datalist id="venue">
							  <?php
								$run4 = mysqli_query($con, "select * from presentation_venue");
								while($res4 = mysqli_fetch_array($run4)){
							  ?>
									<option><?php echo $res4[0]; ?></option>
							  <?php
								}
							  ?>	
							  </datalist>  
							</div>
						</div>
						<center class="col-md-12 col-lg-12"><button type="submit" id="<?php echo $pid; ?>" class="btn btn-primary save">Save</button></center>
					</form>	
					</p>
				  </div>
				<?php } ?>
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
	<script type="text/javascript" src="assets/js/jquery-ui.min/jquery-ui.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
		$(function() {
			$("#accordion").accordion();
		});
	</script>
	
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
			  <button type="button" onClick="refreshPage()" class="btn btn-default" id="refresh" data-dismiss="modal">Close</button>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	

	<?php if(isset($_GET['err'])) echo "<script>$('#errModal').modal('show');</script>"; ?>
	
	
	<script type="text/javascript">
		function refreshPage(){
			window.location = "admin.php";
		}

		$(".add_evl").click(function(){
			var id = $(this).attr('title');
			$(this).parent().parent().find(".int-"+id).children('input:first').clone().val('').appendTo(".int-"+id);
		});

		$(".add_evl2").click(function(){
			var id = $(this).attr('title');
			$(this).parent().parent().find(".ext-"+id).children('input:first').clone().val('').appendTo(".ext-"+id);
		});

		$("#show_final").click(function(){
			window.location = "show-final-list.php";
		});
		
		$(".save-form").submit(function(e){
			e.preventDefault();
			var pid = $(this).attr('id');
			
			$.ajax({
				url: 'todb.php',
				data: $("#"+pid).serialize()+"&save_en="+pid,
				type: 'POST',
				success: function(data){
					if(data == "true"){
						$("#"+pid)[0].reset();
						alert("Saved Successfully !");
					}else{
						alert("Something went wrong");
					}
				}
			});
		});
	
		$(".tweakbtn").on("click", function () {
			var raw = $(this).attr('id');
			var data = raw.split("H");
			var id = data[0];
			var action = data[1];
			
			$.ajax({
				url: 'todb.php',
				data: "tweakid="+id+"&tweakaction="+action,
				type: 'POST',
				success: function(data){
					if(data == true){
						if(action == "en")
							$('#'+id+'Hdis').css('visibility','');
						else
							$('#'+id+'Hen').css('visibility','');
						$('#'+raw).css('visibility','hidden');
					}else{
						alert("Something went wrong");
					}
				}
			});
		});
	
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
		
		
		$('#Adateid').datepicker({
			format: "yyyy-mm-dd",
			todayHighlight: true,
			autoclose: true,
			endDate: today,
			//startDate: lastDate
		});	
		
		$('#mark_st').change(function(){
			var mentor = $('#mark_st').val();
			if(mentor != ""){
				$.ajax({
					url: 'todb.php',
					data: "viewMarks="+mentor,
					type: 'POST',
					success: function(data){
						$('#resultMark').html(data);
					}
				});
			}
		});
		
		$('#attmentorComp').change(function(){
			
			var mentor = $('#attmentorComp').val();
			
			if(mentor != ""){
				$.ajax({
					url: 'todb.php',
					data: "viewAttMentorComp="+mentor,
					type: 'POST',
					success: function(data){
						$('#resultAttComp').html(data);
					}
				});
			}
		});
	
        $("#btnPrint").on("click", function () {
            var divContents = $("#form_div_print").html();
            var printWindow = window.open('', '', 'height=800,width=1200');
            printWindow.document.write('<html><head><title>Request Report</title>');
            printWindow.document.write('<center><h2>Report</h2></center>');
            printWindow.document.write('</head><body >');
			printWindow.document.write("<table border=\"1\" cellpadding=\"3\" style=\"border-collapse:collapse;\"");
            printWindow.document.write(divContents);
			printWindow.document.write("</table>");
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
      
        });
		$("#btnPrint2").on("click", function () {
            var divContents = $("#form_div_print2").html();
            var printWindow = window.open('', '', 'height=800,width=1200');
            printWindow.document.write('<html><head><title>Request Report</title>');
			printWindow.document.write('<center><h2>Report</h2></center>');
            printWindow.document.write('</head><body >');
			printWindow.document.write("<table border=\"1\" cellpadding=\"3\" style=\"border-collapse:collapse;\"");
            printWindow.document.write(divContents);
			printWindow.document.write("</table>");
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
      
        });
		
		$("#btnPrint5").on("click", function () {
            var divContents = $("#form_div_print5").html();
            var printWindow = window.open('', '', 'height=800,width=1200');
            printWindow.document.write('<html><head><title>Request Report</title>');
			printWindow.document.write('<center><h2>Report</h2></center>');
            printWindow.document.write('</head><body >');
			printWindow.document.write("<table border=\"1\" cellpadding=\"3\" style=\"border-collapse:collapse;\"");
            printWindow.document.write(divContents);
			printWindow.document.write("</table>");
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
      
        });
		
		$("#print1").on("click", function () {
            var divContents = $("#div_print1").html();
            var printWindow = window.open('', '', 'height=800,width=1200');
            printWindow.document.write('<html><head><title>Synopsis Report</title>');
			printWindow.document.write('<center><h2>Report Submitted Students</h2></center>');
            printWindow.document.write('</head><body >');
			printWindow.document.write("<table border=\"1\" cellpadding=\"3\" style=\"width:100%;border-collapse:collapse;\"");
            printWindow.document.write(divContents);
			printWindow.document.write("</table>");
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
		$("#print2").on("click", function () {
            var divContents = $("#div_print2").html();
            var printWindow = window.open('', '', 'height=800,width=1200');
            printWindow.document.write('<html><head><title>Synopsis Report</title>');
			printWindow.document.write('<center><h2>Report Submitted Students</h2></center>');
            printWindow.document.write('</head><body >');
			printWindow.document.write("<table border=\"1\" cellpadding=\"3\" style=\"width:100%;border-collapse:collapse;\"");
            printWindow.document.write(divContents);
			printWindow.document.write("</table>");
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
		$("#print3").on("click", function () {
            var divContents = $("#div_print3").html();
            var printWindow = window.open('', '', 'height=800,width=1200');
            printWindow.document.write('<html><head><title>Synopsis Report</title>');
			printWindow.document.write('<center><h2>Report Submitted Students</h2></center>');
            printWindow.document.write('</head><body >');
			printWindow.document.write("<table border=\"1\" cellpadding=\"3\" style=\"width:100%;border-collapse:collapse;\"");
            printWindow.document.write(divContents);
			printWindow.document.write("</table>");
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
		$("#print4").on("click", function () {
            var divContents = $("#div_print4").html();
            var printWindow = window.open('', '', 'height=800,width=1200');
            printWindow.document.write('<html><head><title>Synopsis Report</title>');
			printWindow.document.write('<center><h2>Report not Submitted Students</h2></center>');
            printWindow.document.write('</head><body >');
			printWindow.document.write("<table border=\"1\" cellpadding=\"3\" style=\"width:100%;border-collapse:collapse;\"");
            printWindow.document.write(divContents);
			printWindow.document.write("</table>");
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
		$("#print5").on("click", function () {
            var divContents = $("#div_print5").html();
            var printWindow = window.open('', '', 'height=800,width=1200');
            printWindow.document.write('<html><head><title>Synopsis Report</title>');
			printWindow.document.write('<center><h2>Report not Submitted Students</h2></center>');
            printWindow.document.write('</head><body >');
			printWindow.document.write("<table border=\"1\" cellpadding=\"3\" style=\"width:100%;border-collapse:collapse;\"");
            printWindow.document.write(divContents);
			printWindow.document.write("</table>");
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
		$("#print6").on("click", function () {
            var divContents = $("#div_print6").html();
            var printWindow = window.open('', '', 'height=800,width=1200');
            printWindow.document.write('<html><head><title>Synopsis Report</title>');
			printWindow.document.write('<center><h2>Report not Submitted Students</h2></center>');
            printWindow.document.write('</head><body >');
			printWindow.document.write("<table border=\"1\" cellpadding=\"3\" style=\"width:100%;border-collapse:collapse;\"");
            printWindow.document.write(divContents);
			printWindow.document.write("</table>");
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });

		$('#ad_chpwd').submit(function(e){
				e.preventDefault();
				  
				$.ajax({
					url: 'todb.php',
					type: 'POST',
					data: $(this).serialize(),
					dataType: 'html'
				})
				.done(function(data){
					$('#ad_chpwd').find('input[type=email]').val(''); 
					$('#ad_chpwd').find('input[type=text]').val('');
					$('#result').fadeOut('fast', function(){
					  $('#result').fadeIn('fast').html(data);
					});
				})
				.fail(function(){
					alert('Ajax Submit Failed ...'); 
				});
			});
			$('#pidformatform').submit(function(e){
				e.preventDefault();
				  
				$.ajax({
					url: 'todb.php',
					type: 'POST',
					data: $(this).serialize(),
					dataType: 'html'
				})
				.done(function(data){
					alert(data);
				})
				.fail(function(){
					alert('Ajax Submit Failed ...'); 
				});
			});
	</script>
</body>
</html>