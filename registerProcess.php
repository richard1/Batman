<?php
	session_start();
	
	/*
	if(isset($_SESSION['id'])) {
		echo "Registering events for: " . $_SESSION['id'];
	}
	
	// Debug
	if(isset($_SESSION['sess1'])) {
		echo "<br />Session 1: " . $_SESSION['sess1'];
	}
	if(isset($_SESSION['sess2'])) {
		echo "<br />Session 2: " . $_SESSION['sess2'];
	}
	if(isset($_SESSION['sess3'])) {
		echo "<br />Session 3: " . $_SESSION['sess3'];
	}
	*/
	
	// Registers a session for a user.
	if(isset($_SESSION['id']) && isset($_SESSION['sess1']) && isset($_SESSION['sess2']) && isset($_SESSION['sess3'])) {
		//echo "<br /><br />All parameters valid.";
		require_once("conf.inc.php");
		$mysqli = new mysqli($CFG->server, $CFG->user_name, $CFG->password, $CFG->database);
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		
		$ip = "No IP.";
		$date = "No date.";
		if(isset($_SERVER['REMOTE_ADDR'])) {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		if(date("r") != "") {
			$date = date("r");
		}
		// Register user-session pair in user_sessions
		$userSess1Query = $mysqli->query("INSERT INTO user_sessions (userID, sessionID, ip, time) VALUES (" . mysql_real_escape_string($_SESSION['id']) . ", " . mysql_real_escape_string($_SESSION['sess1']) . ", '" . $ip . "', '" . $date . "')") 
			or die("Failed to submit sess1");
		$userSess2Query = $mysqli->query("INSERT INTO user_sessions (userID, sessionID, ip, time) VALUES (" . mysql_real_escape_string($_SESSION['id']) . ", " . mysql_real_escape_string($_SESSION['sess2']) . ", '" . $ip . "', '" . $date . "')")  
			or die("Failed to submit sess2");
		$userSess3Query = $mysqli->query("INSERT INTO user_sessions (userID, sessionID, ip, time) VALUES (" . mysql_real_escape_string($_SESSION['id']) . ", " . mysql_real_escape_string($_SESSION['sess3']) . ", '" . $ip . "', '" . $date . "')") 
			or die("Failed to submit sess3");
		
		// Increment current registrants count by 1
		$increment1Query = $mysqli->query("UPDATE sessions SET current = current + 1 WHERE id = " . mysql_real_escape_string($_SESSION['sess1'])) or die("Failed to increment 1");
		$increment2Query = $mysqli->query("UPDATE sessions SET current = current + 1 WHERE id = " . mysql_real_escape_string($_SESSION['sess2'])) or die("Failed to increment 2");
		$increment3Query = $mysqli->query("UPDATE sessions SET current = current + 1 WHERE id = " . mysql_real_escape_string($_SESSION['sess3'])) or die("Failed to increment 3");
		
		//echo "<br /><br />Done, son.";
		header("Location: index.php?tab=1&success=1");
	}	
	
	// Unset the session
	session_unset();
?>