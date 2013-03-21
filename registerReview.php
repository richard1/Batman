<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Justice Summit | Review Registrations</title>
	<link rel="stylesheet" type="text/css" href="BCP.css" />
	<link href="metro/css/m-styles.min.css" rel="stylesheet">
	<link rel="icon" type="image/png" href="img/batman.png">
	<link rel="stylesheet" type="text/css" href="bootstrap/buttons.css" />
	<link rel="stylesheet" type="text/css" href="bootstrap/forms.css" />
	<link rel="stylesheet" type="text/css" href="bootstrap/css/icons.css" />
</head>

<body>
	<?php
		require_once("conf.inc.php");
		
		session_start();
		
		$sessID1 = "";
		$sessID2 = "";
		$sessID3 = "";
	
		// Take care of page 3
		if(isset($_POST['sess3'])) {
			if(isset($_SESSION['sess2'])) {
				if($_POST['sess3'] == $_SESSION['sess2'] + 1 && $_POST['sess3'] != 97)
					header("Location: register.php?page=3&error=2");
			}
			if(isset($_SESSION['sess1'])) {
				if($_POST['sess3'] == $_SESSION['sess1'] + 2 && $_POST['sess3'] != 97)
					header("Location: register.php?page=3&error=2");
			}
			$_SESSION['sess3'] = $_POST['sess3'];
		}
		
		if(isset($_SESSION['sess1'])) {
			$sessID1 = $_SESSION['sess1'];

			if(isset($_SESSION['sess2'])) {
				$sessID2 = $_SESSION['sess2'];

				if(isset($_SESSION['sess3'])) {
					$sessID3 = $_SESSION['sess3'];
				}
				else {
					header("Location: register.php?page=3&error=1");
				}
			}
			else {
				header("Location: register.php?page=2&error=1");
			}
		}
		else {
			header("Location: register.php?page=1&error=1");
		}
		
		// Change session times and dates as necessary
		$day1 = "Thursday, March 21st, 11:20 AM - 12:10 PM";
		$day2 = "Thursday, March 21st, 12:55 PM - 1:45 PM";
		$day3 = "Thursday, March 21st, 1:55 PM - 2:45 PM";
		
        if(isset($_SESSION['id'])) {
            $id = $_SESSION['id'];
					
			$mysqli = new mysqli($CFG->server, $CFG->user_name, $CFG->password, $CFG->database);
			if ($mysqli->connect_errno) {
				echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
			}
			
			echo "<h2>Reviewing sessions for: <b>$id</b></h2><h4>Click <i>Register</i> once you've finalized your choices.  If you'd like to change your mind, click <i>Revise</i>.</h4><br />";
			//echo "<a href='#' class='m-btn'>Showing sessions for <b>$id</b></a><br /><br />";
			
			if(strlen($sessID1) > 0) {
				$query = $mysqli->query("SELECT * FROM sessions WHERE id = $sessID1") or die("Failed to lookup session1 info");
				while ($row = $query->fetch_assoc()) {
					$theDay = $row['day'];
					echo "<div class='well well-tiny'><b>Session " . $theDay . ": ";
					if($theDay == 1) echo $day1;
					else if($theDay == 2) echo $day2;
					else if($theDay == 3) echo $day3;
					else echo $day4;
					
					echo "</b>";
					if($sessID1 == 89 || $sessID1 == 90 || $sessID1 == 92 || $sessID1 == 93) {
						echo "&nbsp;&nbsp;&nbsp;<span class='label label-important'>Required</span>";
					}
					
					echo "<dl class='dl-horizontal'>";
					echo "<dt><span class='label label-info'>Title</span></dt><dd>" . $row['name'] . "</dd>";
					echo "<dt><span class='label label-info'>Speaker</span></dt><dd>" . $row['speaker'] . "</dd>";
					echo "<dt><span class='label label-info'>Description</span></dt><dd>" . $row['description'] . "</dd>";
					echo "<dt><span class='label label-info'>Room</span></dt><dd>" . $row['room'] . "</dd>";
					echo "</dl></div>";
				}
			}
			
			if(strlen($sessID2) > 0) {
				$query = $mysqli->query("SELECT * FROM sessions WHERE id = $sessID2") or die("Failed to lookup session1 info");
				while ($row = $query->fetch_assoc()) {
					$theDay = $row['day'];
					echo "<div class='well well-tiny'><b>Session " . $theDay . ": ";
					if($theDay == 1) echo $day1;
					else if($theDay == 2) echo $day2;
					else if($theDay == 3) echo $day3;
					else echo $day4;
					
					echo "</b>";
					if($sessID2 == 89 || $sessID2 == 90 || $sessID2 == 92 || $sessID2 == 93) {
						echo "&nbsp;&nbsp;&nbsp;<span class='label label-important'>Required</span>";
					}
					
					echo "<dl class='dl-horizontal'>";
					echo "<dt><span class='label label-info'>Title</span></dt><dd>" . $row['name'] . "</dd>";
					echo "<dt><span class='label label-info'>Speaker</span></dt><dd>" . $row['speaker'] . "</dd>";
					echo "<dt><span class='label label-info'>Description</span></dt><dd>" . $row['description'] . "</dd>";
					echo "<dt><span class='label label-info'>Room</span></dt><dd>" . $row['room'] . "</dd>";
					echo "</dl></div>";
				}
			}
			
			if(strlen($sessID3) > 0) {
				$query = $mysqli->query("SELECT * FROM sessions WHERE id = $sessID3") or die("Failed to lookup session1 info");
				while ($row = $query->fetch_assoc()) {
					$theDay = $row['day'];
					echo "<div class='well well-tiny'><b>Session " . $theDay . ": ";
					if($theDay == 1) echo $day1;
					else if($theDay == 2) echo $day2;
					else if($theDay == 3) echo $day3;
					else echo $day4;
					echo "</b>";
					
					echo "<dl class='dl-horizontal'>";
					echo "<dt><span class='label label-info'>Title</span></dt><dd>" . $row['name'] . "</dd>";
					echo "<dt><span class='label label-info'>Speaker</span></dt><dd>" . $row['speaker'] . "</dd>";
					echo "<dt><span class='label label-info'>Description</span></dt><dd>" . $row['description'] . "</dd>";
					echo "<dt><span class='label label-info'>Room</span></dt><dd>" . $row['room'] . "</dd>";
					echo "</dl></div>";
				}
			}
		}
		echo '<button type="submit" class="btn btn-primary" name="submit" onclick="window.location.href=' . '\'register.php\'' . '""><i class="icon-pencil icon-white"></i> Revise</button>&nbsp;&nbsp;&nbsp;';
		echo '<button type="submit" class="btn btn-primary" name="submit" onclick="window.location.href=' . '\'registerProcess.php\'' . '""><i class="icon-ok icon-white"></i> Register</button>';
    ?>
</body>
</html>