<?php
	require_once("conf.inc.php");
	$q=$_GET["q"];

	$con = mysql_connect($CFG->server, $CFG->user_name, $CFG->password);
	if (!$con) {
		die('Could not connect: ' . mysql_error());
	}

	mysql_select_db($CFG->database, $con);

	$sql="SELECT * FROM sessions WHERE id = '".$q."'";

	$result = mysql_query($sql);

	while($row = mysql_fetch_array($result)) {
		echo "<h3>" . $row['name'] . "</h3><h5>" . $row['speaker'] . " - " . $row['room'] . "</h5><p>" . $row['description'];
	}

	mysql_close($con);
?>