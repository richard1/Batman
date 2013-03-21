<?php
	$isFound = false;
	session_start();
	
	if((!isset($_POST['email']) && !isset($_POST['studentID'])) ||
			(strlen($_POST['email']) == 0 && strlen($_POST['studentID']) == 0)) {
		header("Location: index.php?errorLogin=3#login"); // nothing given
	}
	else if(!isset($_POST['email']) || strlen($_POST['email']) == 0) {
		header("Location: index.php?errorLogin=1#login"); // no user
	}
	else if(!isset($_POST['studentID']) || strlen($_POST['studentID']) == 0) {
		header("Location: index.php?errorLogin=2#login"); // no pass
	}
	else {
		$email = $_POST['email'] . "@bcp.org";
		$email = mysql_real_escape_string($email);
		$studentID = $_POST['studentID'];
		$studentID = mysql_real_escape_string($studentID);
		
		require_once("conf.inc.php");
		$mysqli = new mysqli($CFG->server, $CFG->user_name, $CFG->password, $CFG->database);
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		
		$query = $mysqli->query("SELECT id, email FROM users") or die("Failed to lookup users");
		while ($row = $query->fetch_assoc()) {
			$theEmail = $row['email'];
			$theID = $row['id'];
			//echo $theEmail . " " . $row['email'] . "<br />" . $theID . " " . $row['id'];
			//if($email == $theEmail && $studentID == $theID) {
			if(strcasecmp($email, $theEmail) == 0 && $studentID == $theID) {
				$isFound = true;
				$_SESSION['id'] = $studentID;
			}
		}
		
		if($isFound == true) {
			$countQuery = $mysqli->query("SELECT count(*) FROM user_sessions WHERE userID = $studentID");
			$countRow = $countQuery->fetch_row();
			$count = (int) $countRow[0];
			if($count >= 3) {
				header("Location: index.php?tab=2&errorLogin=6");
			}
			else {
				header("Location: register.php?count=$count");
			}
		}
		else {
			header("Location: index.php?errorLogin=4#login"); // incorrect info
		}
	}
?>