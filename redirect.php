<?php
	
	session_start();
	if(isset($_SESSION['username1'])){

		$acctype = $_SESSION['acctype1'];
		
		if($acctype == 1){
			header('location: admin.php');
		}else{
			header('location: idea.php');
		}
	}
?>