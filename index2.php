<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Justice Summit</title>
	<link rel="stylesheet" type="text/css" href="BCP.css" />
</head>

<body>
	<div class="header">
		<table width=100%>
		<tr><td>Justice Summit - Registration</td>
		<td><a href="index.php"><img src="bell.png" height=100px width=100px align=right /></a></td></tr>
		</table>
	</div>
    <br />
	<div class="main">
	<!--
	<div class="tabbable tabs-left">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab1" data-toggle="tab">Section1</a></li>
			<li><a href="#tab2" data-toggle="tab">Section2</a></li>
		</ul>
		<div class="tab content">
			<div class="tab-pane active" id="tab1">
				-->
				<?php
					$errTooLong = 1;
					$errNotNumber = 2;
					$errNoExist = 3;
					if(isset($_GET['error'])) {
						echo "<div class='alert alert-info'>";
						if($_GET['error'] == $errTooLong)
							echo "<b>ERROR!</b> Student ID is not 6 digits.";
						else if($_GET['error'] == $errNotNumber)
							echo "<b>ERROR!</b> Student ID is not a valid number.";
						else if($_GET['error'] == $errNoExist)
							echo "<b>ERROR!</b> Student ID is not valid.";
						echo "</div><br />";
					}
				?>
					<form action="login.php" method="GET">
						<input type="submit" class="signup" value="Sign up for an event" />
					</form>
					<h3>Check out who's going to an event!</h3>
					<br />
		        	<div id="mainselection">
						<form action="index.php" method="get">
					    <select name="sessionID" style="border:0px" onChange="this.form.submit()">
						<?php
							echo "<option>Select an event...</option>";
							require("conf.inc.php");
							$mysqli = new mysqli($CFG->server, $CFG->user_name, $CFG->password, $CFG->database);
							if ($mysqli->connect_errno) {
								echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
							}
							
							$dayQuery = $mysqli->query("SELECT id, day, name FROM sessions") or die("Failed to lookup sesion days");
							while ($row = $dayQuery->fetch_assoc()) {
								echo "<option ";
								if(isset($_GET['sessionID'])) {
									if($_GET['sessionID'] == $row['id'])
										echo "selected = 'selected'";
								}
								echo "value='" . $row['id'] . "'>Session " . $row['day'] . ": " . $row['name'];
							}
						?>
					    </select>
						</form>
					</div>
		            <br />
					<form action="viewSessions.php" method="post">
					<h3>Check out what events people are going to!</h3>
					<table>
					<tr>
		            <td><input type="text" class="textbox" name="id" placeholder="Student ID Number" maxlength=6 autocomplete="off" /></td>
					
					<td><input type="submit" class="submitbutton" name="submit" value="Submit" /></td>
					</tr>
					</table>
				</form>
				
				<?php
					if(isset($_GET['sessionID'])) {
						require_once("conf.inc.php");
						$sessID = $_GET['sessionID'];
						if(is_numeric($sessID)) {
							$mysqli = new mysqli($CFG->server, $CFG->user_name, $CFG->password, $CFG->database);
							if ($mysqli->connect_errno) {
								echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
							}
							
							echo "<br /><div class='alert alert-block'><table width='30%'><tr><td><b>Student ID</b></td><td><b>Name</b></td></tr>";
							$userIDQuery = $mysqli->query("SELECT userID FROM user_sessions WHERE sessionID = $sessID") or die("Failed to lookup student ID");
							while ($row = $userIDQuery->fetch_assoc()) {
								$userID = $row['userID'];
								$nameQuery = $mysqli->query("SELECT name FROM users WHERE id = $userID") or die("Failed to lookup student name");
								while ($subrow = $nameQuery->fetch_assoc()) {
									echo "<tr><td>" . $userID . "</td><td>" . $subrow['name'] . "</td></tr>";
								}
							}
							echo "</table></div>";
						}
					}
				?>
				<!--
				<p>hi</p>
			</div>
			<div class="tab-pane" id="tab2">
				<p>howdy</p>
			</div>
		</div>
	-->
	</div>
</body>
</html>