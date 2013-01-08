<?php
	if((!isset($_POST['username']) && !isset($_POST['password'])) ||
			(strlen($_POST['username']) == 0 && strlen($_POST['password']) == 0)) {
		header("Location: index.php?tab=2&errorLogin=3"); // nothing given
	}
	else if(!isset($_POST['username']) || strlen($_POST['username']) == 0) {
		header("Location: index.php?tab=2&errorLogin=1"); // no user
	}
	else if(!isset($_POST['password']) || strlen($_POST['password']) == 0) {
		header("Location: index.php?tab=2&errorLogin=2"); // no pass
	}
	else {
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		if($username == "jchang" && $password == "pass") {
			header("Location: register.php");
		}
		else {
			header("Location: index.php?tab=2&errorLogin=4"); // incorrect info
		}
	}
?>