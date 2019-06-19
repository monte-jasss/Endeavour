<?php
		
		error_reporting(0);
		session_start();
		unset($_SESSION['username1']);
		unset($_SESSION['email1']);
		unset($_SESSION['acctype1']);
		header('location: index.php');
?>