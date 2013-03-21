<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Justice Summit</title>
	<link rel="stylesheet" type="text/css" href="BCP.css" />
	<script src="http://code.jquery.com/jquery.min.js"></script>
	<link href="http://twitter.github.com/bootstrap/assets/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
	<script src="http://twitter.github.com/bootstrap/assets/js/bootstrap.js"></script>
	<!---<link href="metro/css/m-styles.min.css" rel="stylesheet">-->
	<link rel="stylesheet" type="text/css" href="bootstrap/buttons.css" />
	<link rel="stylesheet" type="text/css" href="bootstrap/forms.css" />
	<link rel="stylesheet" type="text/css" href="bootstrap/body.css" />
	<link rel="stylesheet" type="text/css" href="bootstrap/css/icons.css" />
	<link rel="icon" type="image/png" href="img/batman.png">
</head>
<body style="margin-left:20px; margin-right:20px;" onload="window.print();">

<?php
	if(isset($_GET['sessID'])) {
		require_once("conf.inc.php");
		$sessID = $_GET['sessID'];
		if(is_numeric($sessID)) {
			$mysqli = new mysqli($CFG->server, $CFG->user_name, $CFG->password, $CFG->database);
			if ($mysqli->connect_errno) {
				echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
			}
			$current = 0;
			$sessQuery = $mysqli->query("SELECT name, day, current, speaker, room FROM sessions WHERE id=$sessID") or die("Failed to find session info");
			while ($row = $sessQuery->fetch_assoc()) {
				echo '<p>';
				echo '<b>' . $row['name'] . '</b> ' . '<small>| Session #' . $row['day'] . ' | <i>Attendees: ' . $row['current'] . '</i>';
				echo '</small></p>';
				echo '<p><small><b>Speaker</b>: ' . $row['speaker'] . ' &nbsp;| &nbsp;<b>Room</b>: ' . $row['room'] . '</small></p>';
				$current = $row['current'];
			}
						
			echo "<table class='table table-striped'><tr><td><b>Name</b></td><td><b>Year</b></td>";
			if($current > 30) {
				echo "<td><b>Name</b></td><td><b>Year</b></td><td><b>Name</b></td><td><b>Year</b></td>";
			}
			echo "</tr>";
			$userIDQuery = $mysqli->query("SELECT userID FROM user_sessions WHERE sessionID = $sessID ORDER BY userID") or die("Failed to lookup student ID");
			$i = 0;
			while ($row = $userIDQuery->fetch_assoc()) {
				$userID = $row['userID'];
				$year = floor($userID / 1000) % 100;
				$nameQuery = $mysqli->query("SELECT name FROM users WHERE id = $userID") or die("Failed to lookup student name");
				while ($subrow = $nameQuery->fetch_assoc()) {
					if($current > 30) {
						if($i == 0) {
							echo "<tr>";
						}
						echo "<td>" . $subrow['name'] . "</td><td>'" . $year . "</td>";
						if($i == 2) {
							echo "</tr>";
						}
						
						$i = $i + 1;
						
						if($i > 2) {
							$i = 0;
						}
					} 
					else {
						echo "<tr><td>" . $subrow['name'] . "</td><td>'" . $year . "</td></tr>";
					}
					
				}
			}
			echo "</table>";
		}
	}
?>

</body>
</html>