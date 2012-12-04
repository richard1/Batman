<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>View Sessions</title>
	<link rel="stylesheet" type="text/css" href="BCP.css" />
</head>

<body>
	<?php
		require("conf.inc.php");
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
			echo "<h2>Welcome, $id</h2>";
		}
		
		$mysqli = new mysqli($CFG->localhost, $CFG->username, $CFG->password, $CFG->database);
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		
		$query = $mysqli->query("SELECT sessionID FROM user_sessions WHERE userID = $id") or die("Failed to lookup session ID");
		while ($row = $query->fetch_assoc()) {
			$query2 = $mysqli->query("SELECT name FROM sessions WHERE userID = $row['sessionID']") or die("Failed to lookup session name");
			while ($row2 = $query2->fetch_assoc()) {
				echo " name = " . $row2['name'] . "\n";
			}
			echo " sessionID = " . $row['sessionID'] . "\n";
		}
    ?>
</body>
</html>