<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Justice Summit</title>
	<link rel="stylesheet" type="text/css" href="BCP.css" />
	<script src="http://code.jquery.com/jquery.min.js"></script>
	<link href="http://twitter.github.com/bootstrap/assets/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
	<script src="http://twitter.github.com/bootstrap/assets/js/bootstrap.js"></script>
</head>

<body>
	<div class="header">
		<table width=100%>
		<tr><td>Justice Summit - Registration</td>
		<td><a href="index.php"><img src="bell.png" height=100px width=100px align=right /></a></td></tr>
		</table>
	</div>
    <br />
    <div class="tabbable tabs-left">
		<ul class="nav nav-tabs" id="myTab">
		  <li class="active"><a href="#view" data-toggle="tab">View Sessions</a></li>
		  <li><a href="#login" data-toggle="tab">Sign Up</a></li>
		  <li><a href="#contact" data-toggle="tab">Contact Us</a></li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane active" id="view">


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
			

			</div>
			<div class="tab-pane" id="login">
			

				<?php
						$errNoUser = 1;
						$errNoPass = 2;
						$errNothing = 3;
						$errIncorrect = 4;
						if(isset($_GET['error'])) {
							echo "<div class='alert alert-info'>";
							if($_GET['error'] == $errNoUser)
								echo "<b>ERROR!</b> Username is required.";
							else if($_GET['error'] == $errNoPass)
								echo "<b>ERROR!</b> Password is required.";
							else if($_GET['error'] == $errNothing)
								echo "<b>ERROR!</b> Username and password are required.";
							else if($_GET['error'] == $errIncorrect)
								echo "<b>ERROR!</b> Username or password is incorrect.";
							echo "</div><br />";
						}
					?>
					<h3>Please login with your Bellarmine username and password.</h3>
					<br />
					<form action="loginProcess.php" method="post">
						<table>
							<tr>
							<td><input type="text" class="textbox" name="username" placeholder="BCP Username" autocomplete="off" /></td>
							
							<td><input type="password" class="textbox" name="password" placeholder="Password" /></td>
							
							<td><input type="submit" class="submitbutton" name="submit" value="Login" /></td>
							</tr>
						</table>
					</form>
			

			</div>
			<div class="tab-pane" id="contact">
			

				<p>Created by Richard Lin '13 and Jonathan Chang '13</p>
				<p>If you experience any difficulties, please contact us.</p>
			

			</div>
		</div>
	</div>
	<!--
	<div class="tabbable tabs-left">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab1" data-toggle="tab">Section1</a></li>
			<li><a href="#tab2" data-toggle="tab">Section2</a></li>
		</ul>
		<div class="tab content">
			<div class="tab-pane active" id="tab1">
				
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
				--><!---
				<p>hi</p>
			</div>
			<div class="tab-pane" id="tab2">
					<!---
					<br />
					<br />
					<?php
						$errNoUser = 1;
						$errNoPass = 2;
						$errNothing = 3;
						$errIncorrect = 4;
						if(isset($_GET['error'])) {
							echo "<div class='alert alert-info'>";
							if($_GET['error'] == $errNoUser)
								echo "<b>ERROR!</b> Username is required.";
							else if($_GET['error'] == $errNoPass)
								echo "<b>ERROR!</b> Password is required.";
							else if($_GET['error'] == $errNothing)
								echo "<b>ERROR!</b> Username and password are required.";
							else if($_GET['error'] == $errIncorrect)
								echo "<b>ERROR!</b> Username or password is incorrect.";
							echo "</div><br />";
						}
					?>
					<h3>Please login with your Bellarmine username and password.</h3>
					<br />
					<form action="loginProcess.php" method="post">
						<table>
							<tr>
							<td><input type="text" class="textbox" name="username" placeholder="BCP Username" autocomplete="off" /></td>
							
							<td><input type="password" class="textbox" name="password" placeholder="Password" /></td>
							
							<td><input type="submit" class="submitbutton" name="submit" value="Login" /></td>
							</tr>
						</table>
					</form>
					
					<p>howdy!</p>
			</div>
		</div>
	</div>
	-->
</body>
</html>

<!--
<!DOCTYPE html>
<html>
<head>
<script src="http://code.jquery.com/jquery.min.js"></script>

<link href="BCP.css" rel="stylesheet" type:"text/css" />
<link href="http://twitter.github.com/bootstrap/assets/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
<script src="http://twitter.github.com/bootstrap/assets/js/bootstrap.js"></script>
<meta charset=utf-8 />
<title>JS Bin</title>
</head>
<body>
	<div class="tabbable tabs-left">
		<ul class="nav nav-tabs" id="myTab">
		  <li class="active"><a href="#address" data-toggle="tab">Address</a></li>
		  <li><a href="#contact" data-toggle="tab">Contact Information</a></li>
		  <li><a href="#settings" data-toggle="tab">Settings</a></li>
		</ul>

		<div class="tab-content">
		  <div class="tab-pane active" id="address">Pizza</div>
		  <div class="tab-pane" id="contact">Steak</div>
		  <div class="tab-pane" id="settings">Cheeseburger</div>
		</div>
	</div>
</body>
</html>
-->