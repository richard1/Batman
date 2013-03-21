<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Justice Summit | View Sessions</title>
	<link rel="stylesheet" type="text/css" href="BCP.css" />
	<link rel="icon" type="image/png" href="img/batman.png">
	<link rel="stylesheet" type="text/css" href="bootstrap/buttons.css" />
	<link rel="stylesheet" type="text/css" href="bootstrap/css/icons.css" />
</head>

<body>
	<?php
		require_once("conf.inc.php");
		
		// Change session times and dates as necessary
		$day1 = "Thursday, March 21st, 11:20 AM - 12:10 PM";
		$day2 = "Thursday, March 21st, 12:55 PM - 1:45 PM";
		$day3 = "Thursday, March 21st, 1:55 PM - 2:45 PM";
		
		$info1 = "";
		$info2 = "";
		$info3 = "";

        if(isset($_POST['id'])) {
            $id = $_POST['id'];
			if(strlen($id) != 6)
				header("Location: index.php?error=1");
			else if(!(is_int($id) || ctype_digit($id)))
				header("Location: index.php?error=2");
			else if(substr($id, 0, 2) != "21") {
				header("Location: index.php?error=3");
			}
			else if(substr($id, 0, 3) != "213" && substr($id, 0, 3) != "214" && substr($id, 0, 3) != "215" && substr($id, 0, 3) != "216") {
				header("Location: index.php?error=3");
			}
					
			$mysqli = new mysqli($CFG->server, $CFG->user_name, $CFG->password, $CFG->database);
			if ($mysqli->connect_errno) {
				echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
			}
			
			/*
			echo "<a href='#' class='m-btn'>Showing sessions for <b>$id</b></a>";
			echo "<a href='index.php' class='m-btn blue'><i class='icon-circle-arrow-left icon-white'></i> Back</a>";
			echo "<a href='javascript:window.print()' class='m-btn blue'>Print <i class='icon-print icon-white'></i></a>";
			*/

			echo '<button type="button" class="btn">Showing sessions for <b>' . $id . '</b></button>&nbsp;&nbsp;&nbsp;';
			echo '<button class="btn btn-primary" onclick="window.location.href=' . '\'index.php\'' . '"><i class="icon-circle-arrow-left icon-white"></i> Back</button>&nbsp;&nbsp;&nbsp;';
			echo '<button class="btn btn-primary" onclick="window.print();">Print <i class="icon-print icon-white"></i></button>';
			
			$query = $mysqli->query("SELECT sessionID FROM user_sessions WHERE userID = $id") or die("Failed to lookup session ID");
			echo "<br /><br />";
			while ($row = $query->fetch_assoc()) {				
				$subQuery = $mysqli->query("SELECT * FROM sessions WHERE id = {$row['sessionID']}") or die("Failed to lookup day");
				while ($subrow = $subQuery->fetch_assoc()) {
					$theDay = $subrow['day'];
					//echo "<div class='well well-tiny'><b>Session " . $theDay . ": ";
					if($theDay == 1) {
						$info1 .= "<div class='well well-tiny'><b>Session " . $theDay . ": " . $day1 . "</b>"; 
						if($row['sessionID'] == 89 || $row['sessionID'] == 90 || $row['sessionID'] == 92 || $row['sessionID'] == 93) {
							// Too much of a hassle, especially since we're mixing and matching
							// $info1 .= "&nbsp;&nbsp;&nbsp;<span class='label label-important'>Required</span>";
						}
						$info1 .= "<dl class='dl-horizontal'>" . "<dt><span class='label label-info'>Title</span></dt><dd>" . $subrow['name'];
						$info1 .= "</dd><dt><span class='label label-info'>Speaker</span></dt><dd>" . $subrow['speaker'] . "</dd>";
						$info1 .=  "<dt><span class='label label-info'>Description</span></dt><dd>" . $subrow['description'] . "</dd>";
						$info1 .=  "<dt><span class='label label-info'>Room</span></dt><dd>" . $subrow['room'] . "</dd>";
						$info1 .=  "</dl></div>";
					}
					else if($theDay == 2) {
						$info2 .= "<div class='well well-tiny'><b>Session " . $theDay . ": " . $day2 . "</b>"; 
						if($row['sessionID'] == 89 || $row['sessionID'] == 90 || $row['sessionID'] == 92 || $row['sessionID'] == 93) {
							// Too much of a hassle, especially since we're mixing and matching
							// $info2 .= "&nbsp;&nbsp;&nbsp;<span class='label label-important'>Required</span>";
						}
						$info2 .= "<dl class='dl-horizontal'>" . "<dt><span class='label label-info'>Title</span></dt><dd>" . $subrow['name'];
						$info2 .= "</dd><dt><span class='label label-info'>Speaker</span></dt><dd>" . $subrow['speaker'] . "</dd>";
						$info2 .=  "<dt><span class='label label-info'>Description</span></dt><dd>" . $subrow['description'] . "</dd>";
						$info2 .=  "<dt><span class='label label-info'>Room</span></dt><dd>" . $subrow['room'] . "</dd>";
						$info2 .=  "</dl></div>";
					}
					else if($theDay == 3) {
						$info3 .= "<div class='well well-tiny'><b>Session " . $theDay . ": " . $day3;
						$info3 .= "</b>" . "<dl class='dl-horizontal'>" . "<dt><span class='label label-info'>Title</span></dt><dd>" . $subrow['name'] . "</dd>";
						$info3 .= "<dt><span class='label label-info'>Speaker</span></dt><dd>" . $subrow['speaker'] . "</dd>";
						$info3 .=  "<dt><span class='label label-info'>Description</span></dt><dd>" . $subrow['description'] . "</dd>";
						$info3 .=  "<dt><span class='label label-info'>Room</span></dt><dd>" . $subrow['room'] . "</dd>";
						$info3 .=  "</dl></div>";
					}
					/*
					echo "</b>";
					
					echo "<dl class='dl-horizontal'>";
					echo "<dt><span class='label label-info'>Title</span></dt><dd>" . $subrow['name'] . "</dd>";
					echo "<dt><span class='label label-info'>Speaker</span></dt><dd>" . $subrow['speaker'] . "</dd>";
					echo "<dt><span class='label label-info'>Description</span></dt><dd>" . $subrow['description'] . "</dd>";
					echo "<dt><span class='label label-info'>Room</span></dt><dd>" . $subrow['room'] . "</dd>";
					echo "</dl></div>";
					*/
				}
			}
			echo $info1 . $info2 . $info3;
		}
		else {
			echo "<h2>ID not given.</h2>";
			header("Location: index.php?error=3");
		}
    ?>
</body>
</html>