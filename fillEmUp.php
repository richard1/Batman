<?php
	/**
		** SET MAX OF ALL 27s TO 28s
	*/
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
	
	// Set maxes from 27 to 28
	$setupQuery = $mysqli->query("UPDATE sessions SET max = 28 WHERE max = 27") or die("Failed to increase maxes");
	echo "<h3>Maxes updated.</h3>";
	
	// Look up all student IDs to find a straggler
	$query = $mysqli->query("SELECT id FROM users ORDER BY id ASC") or die("Failed to lookup users");
	while ($row = $query->fetch_assoc()) {
		$studentID = $row['id'];
		
		// Find all stragglers
		$countQuery = $mysqli->query("SELECT count(*) FROM user_sessions WHERE userID = $studentID");
		$countRow = $countQuery->fetch_row();
		$count = (int) $countRow[0];
		if($count < 3) {
			echo "<p>Found straggler: <b>" . $studentID . "</b>; registered for: ";
			// Get class of straggler
			$class = floor($studentID / 1000);
			$sess1 = 0;
			$sess2 = 0;
			$sess3 = 0;
			
			// Mandatory session exceptions for straggler
			$nogo1 = 0;
			$nogo1b = 0;
			$nogo1dup = 0;
			$nogo2 = 0;
			$nogo2dup = 0;
			
			// Find random open sessions for said straggler, (3)
			$open3 = "SELECT id FROM sessions WHERE day = 3 AND current < max AND id <> 97 ORDER BY RAND() LIMIT 1"; // asc
			$open3Query = $mysqli->query($open3) or die("Failed to lookup open sess3");
			while ($subrow = $open3Query->fetch_assoc()) {
				$sessID = $subrow['id'];
				
				if($sessID == 94) { // trans. 3
					$nogo2 = 93;
					$nogo1 = 92;
				}
				else if($sessID == 91) { // corazon 3
					$nogo2 = 90;
					$nogo1 = 89;
				}
				else if($sessID < 89) { // eliminate duplicates
					$nogo1dup = $sessID - 2;
					$nogo2dup = $sessID - 1;
				}
				
				echo $sessID . ", ";
				$sess3 = $sessID;
				
				// Add entry on user_sessions for straggler
				$userSess3Query = $mysqli->query("INSERT INTO user_sessions (userID, sessionID, ip, time) VALUES (" . $studentID . ", " . $sessID . ", '" . $ip . "', '" . $date . "')") 
					or die("Failed to submit sess3");
				
				// Increment count on sessions for straggler
				$increment3Query = $mysqli->query("UPDATE sessions SET current = current + 1 WHERE id = " . $sessID) or die("Failed to increment 3");
			}
			
			// Find random open sessions for said straggler, (2)
			$open2 = "SELECT id FROM sessions WHERE day = 2 AND current < max AND id <> $nogo2 AND id <> 96 ";
			if($nogo2 != 0) {
				$open2 .= "AND id <> $nogo2 ";
			}
			if($nogo2dup != 0) {
				$open2 .= "AND id <> $nogo2dup ";
			}
			$open2 .= "ORDER BY id ASC LIMIT 1"; // asc
			$open2Query = $mysqli->query($open2) or die("Failed to lookup open sess2");
			while ($subrow = $open2Query->fetch_assoc()) {
				$sessID = $subrow['id'];
				
				if($sessID == 93) { // trans. 2
					$nogo1b = 92;
				}
				else if($sessID == 90) { // corazon 2
					$nogo1b = 89;
				}
				else if($sessID < 89) { // eliminate duplicates
					$nogo1dup = $sessID - 1;
				}
				
				echo $sessID . ", ";
				$sess2 = $sessID;
				
				// Add entry on user_sessions for straggler
				$userSess2Query = $mysqli->query("INSERT INTO user_sessions (userID, sessionID, ip, time) VALUES (" . $studentID . ", " . $sessID . ", '" . $ip . "', '" . $date . "')") 
					or die("Failed to submit sess2");
				
				// Increment count on sessions for straggler
				$increment2Query = $mysqli->query("UPDATE sessions SET current = current + 1 WHERE id = " . $sessID) or die("Failed to increment 2");
			}
			
			// Find random open sessions for said straggler, (1)
			$open1 = "SELECT id FROM sessions WHERE day = 1 AND current < max AND id <> $nogo1 AND id <> 95 ";
			if($nogo1 != 0) {
				$open1 .= "AND id <> $nogo1 ";
			}
			if($nogo1b != 0) {
				$open1 .= "AND id <> $nogo1b ";
			}
			if($nogo1dup != 0) {
				$open1 .= "AND id <> $nogo1dup ";
			}
			$open1 .= "ORDER BY id DESC LIMIT 1"; // desc
			$open1Query = $mysqli->query($open1) or die("Failed to lookup open sess1");
			while ($subrow = $open1Query->fetch_assoc()) {
				$sessID = $subrow['id'];
				
				echo $sessID . ".</p>";
				$sess1 = $sessID;
				
				// Add entry on user_sessions for straggler
				$userSess1Query = $mysqli->query("INSERT INTO user_sessions (userID, sessionID, ip, time) VALUES (" . $studentID . ", " . $sessID . ", '" . $ip . "', '" . $date . "')") 
					or die("Failed to submit sess1");
				
				// Increment count on sessions for straggler
				$increment1Query = $mysqli->query("UPDATE sessions SET current = current + 1 WHERE id = " . $sessID) or die("Failed to increment 1");
			}
			
			// Check for errors
			if($class == 213 || $class == 214) {
				if($sess1 == 0 || $sess2 == 0 || $sess3 == 0 || !($sess1 == 92 || $sess2 == 93 || $sess3 == 94)) {
					echo "<b>NO GOOD</b>";
				}
			}
			else if($class == 215 || $class == 216) {
				if($sess1 == 0 || $sess2 == 0 || $sess3 == 0 || !($sess1 == 89 || $sess2 == 90 || $sess3 == 91)) {
					echo "<b>NO GOOD</b>";
				}
			}
		}
	}
	
	echo "<h2>Done.</h2>";
?>