<?php
	require_once("conf.inc.php");
	$q=$_GET["q"];

	$con = mysql_connect($CFG->server, $CFG->user_name, $CFG->password);
	if (!$con) {
		die('Could not connect: ' . mysql_error());
	}

	mysql_select_db($CFG->database, $con);

	$sql="SELECT name FROM sessions WHERE id = '".$q."'";

	$result = mysql_query($sql);

	/*echo "<table border='1'>
	<tr>
	<th>Firstname</th>
	<th>Lastname</th>
	<th>Age</th>
	<th>Hometown</th>
	<th>Job</th>
	</tr>";*/

	while($row = mysql_fetch_array($result)) {
		echo $row['name'];		
	}

	mysql_close($con);
?>