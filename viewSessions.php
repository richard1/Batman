<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Justice Summit | View Sessions</title>
	<link rel="stylesheet" type="text/css" href="BCP.css" />
	<link href="metro/css/m-styles.min.css" rel="stylesheet">
	<link rel="icon" type="image/png" href="img/batman.png">
</head>

<body>
	<?php
		require_once("conf.inc.php");
		
		// Change session times and dates as necessary
		$day1 = "Monday, April 1st, 10:20 - 11:10 AM";
		$day2 = "Monday, April 1st, 11:20 - 12:10 PM";
		$day3 = "Tuesday, April 2nd, 10:20 - 11:10 AM";
		$day4 = "Tuesday, April 2nd, 11:20 - 12:10 PM";
		
        if(isset($_POST['id'])) {
            $id = $_POST['id'];
			if(strlen($id) != 6)
				header("Location: index.php?error=1");
			else if(!(is_int($id) || ctype_digit($id)))
				header("Location: index.php?error=2");
			else if(substr($id, 0, 2) != "21") {
				header("Location: index.php?error=3");
			}
					
			$mysqli = new mysqli($CFG->server, $CFG->user_name, $CFG->password, $CFG->database);
			if ($mysqli->connect_errno) {
				echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
			}
			
			$studNameQuery = $mysqli->query("SELECT name FROM users WHERE id = $id") or die("Failed to lookup student name");
			$studRow = $studNameQuery->fetch_assoc();
			$studName = $studRow['name'];
			echo "<a href='#' class='m-btn'>Showing sessions for <b>$id</b></a>";
			echo "<a href='index.php' class='m-btn blue'><i class='icon-circle-arrow-left icon-white'></i> Back</a>";
			echo "<a href='javascript:window.print()' class='m-btn blue'>Print <i class='icon-print icon-white'></i></a>";
			
			$query = $mysqli->query("SELECT sessionID FROM user_sessions WHERE userID = $id") or die("Failed to lookup session ID");
			echo "<br /><br />";
			while ($row = $query->fetch_assoc()) {
			
				//echo "<b>Session " . $row['sessionID'] . ": Monday April 1, 10:00 - 10:50 AM</b><br />";
				
				$dayQuery = $mysqli->query("SELECT day FROM sessions WHERE id = {$row['sessionID']}") or die("Failed to lookup day");
				while ($subrow = $dayQuery->fetch_assoc()) {
					$theDay = $subrow['day'];
					echo "<div class='well well-tiny'><b>Session " . $theDay . ": ";
					if($theDay == 1) echo $day1;
					else if($theDay == 2) echo $day2;
					else if($theDay == 3) echo $day3;
					else echo $day4;
					echo "</b>";
				}
				
				echo "<dl class='dl-horizontal'>";
				$nameQuery = $mysqli->query("SELECT name FROM sessions WHERE id = {$row['sessionID']}") or die("Failed to lookup session name");
				while ($subrow = $nameQuery->fetch_assoc()) {
					echo "<dt><b>Title</b></dt><dd>" . $subrow['name'] . "</dd>";
				}
				
				$speakerQuery = $mysqli->query("SELECT speaker FROM sessions WHERE id = {$row['sessionID']}") or die("Failed to lookup speaker");
				while ($subrow = $speakerQuery->fetch_assoc()) {
					echo "<dt><b>Speaker</b></dt><dd>" . $subrow['speaker'] . "</dd>";
				}
				
				$descQuery = $mysqli->query("SELECT description FROM sessions WHERE id = {$row['sessionID']}") or die("Failed to lookup description");
				while ($subrow = $descQuery->fetch_assoc()) {
					echo "<dt><b>Description</b></dt><dd>" . $subrow['description'] . "</dd>";
				}
				
				$roomQuery = $mysqli->query("SELECT room FROM sessions WHERE id = {$row['sessionID']}") or die("Failed to lookup room");
				while ($subrow = $roomQuery->fetch_assoc()) {
					echo "<dt><b>Room</b></dt><dd>" . $subrow['room'] . "</dd>";
				}
				echo "</dl></div>";
			}
		}
		else {
			echo "<h2>ID not given.</h2>";
			header("Location: index.php?error=3");
		}
    ?>
</body>
</html>