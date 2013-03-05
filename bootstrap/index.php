<?php
	session_start();
	session_unset();
?>
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

<body style="margin-left:20px; margin-right:20px;">
	<!--<div class="header">
		<table width=100%>
		<tr><td><h1>Justice Summit</h1>
		</div></td>
		<td><a href="index.php"><img src="bell.png" height=10% width=10% align=right /></a></td></tr>
		</table>
	</div>-->

	<div class="page-header">
	  <h1>Justice Summit <small>Restorative Justice</small></h1>
	</div>

    <br />

    <?php
    	$tabView = 1;
    	$tabLogin = 2;
    	$tabContact = 3;
    	$tabNum;
    	if(isset($_GET['tab'])) {
    		$tabNum = $_GET['tab'];
    	}
    ?>

    <div class="tabbable tabs-left">
		<ul class="nav nav-tabs" id="myTab">
			<?php
		    	$tabLogin = 2;
		    	$tabContact = 3;
		    	global $tabNum;
		    	if(isset($_GET['tab'])) {
		    		$tabNum = $_GET['tab'];
		    		if($tabNum == $tabLogin) {
		    			echo "<li><a href='#view' data-toggle='tab' class='tabby'><i class='icon-th-list icon-white'></i> View Sessions</a></li>
		  					<li class='active'><a href='#login' data-toggle='tab' class='tabby'><i class='icon-user'></i> Sign Up</a></li>
		  					<li><a href='#contact' data-toggle='tab' class='tabby'><i class='icon-envelope icon-white'></i> Contact Us</a></li>";
		    		}
		    		else {
		    			echo "<li class='active'><a href='#view' data-toggle='tab' class='tabby'><i class='icon-th-list'></i> View Sessions</a></li>
		  					<li><a href='#login' data-toggle='tab' class='tabby'><i class='icon-user'></i> Sign Up</a></li>
		  					<li><a href='#contact' data-toggle='tab' class='tabby'><i class='icon-envelope'></i> Contact Us</a></li>";
		    		}
		    	}
		    	else {
		    			echo "<li class='active'><a href='#view' data-toggle='tab' class='tabby'><i class='icon-th-list'></i> View Sessions</a></li>
		  					<li><a href='#login' data-toggle='tab' class='tabby'><i class='icon-user'></i> Sign Up</a></li>
		  					<li><a href='#contact' data-toggle='tab' class='tabby'><i class='icon-envelope'></i> Contact Us</a></li>";
		    	}
		    ?>
		    <!--
		  <li><a href="#view" data-toggle="tab">View Sessions</a></li>
		  <li class="active"><a href="#login" data-toggle="tab">Sign Up</a></li>
		  <li><a href="#contact" data-toggle="tab">Contact Us</a></li>
			-->
		</ul>

		<div class="tab-content">
			<?php
				if(!isset($tabNum) || $tabNum != 2) {
					echo "<div class='tab-pane active' id='view'>";
				}
				else {
					echo "<div class='tab-pane' id='view'>";
				}
			?>
			<!--<div class="tab-pane " id="view">-->


				<?php
					$errTooLong = 1;
					$errNotNumber = 2;
					$errNoExist = 3;
					if(isset($_GET['error'])) {
						echo "<div class='alert alert-info'>";
						if($_GET['error'] == $errTooLong)
							echo "<i class='icon-remove'></i> <b>ERROR!</b> Student ID is not 6 digits.";
						else if($_GET['error'] == $errNotNumber)
							echo "<i class='icon-remove'></i> <b>ERROR!</b> Student ID is not a valid number.";
						else if($_GET['error'] == $errNoExist)
							echo "<i class='icon-remove'></i> <b>ERROR!</b> Student ID is not valid.";
						echo "</div><br />";
					}
					else if(isset($_GET['success']) && $_GET['success'] == 1) {
						echo "<div class='alert alert-info'>";
						echo "<i class='icon-ok-sign'></i> <b>AWESOME!</b> You have successfully registered for your sessions.";
						echo "</div><br />";
					}
				?>
					<h4>Check out who's going to an event!</h4>
					<br />
		        	<div id="mainselection">
						<form action="index.php" method="get">
					    <select name="sessionID" onChange="this.form.submit()">
						<?php
							echo "<option>Select an event...</option>";
							require("conf.inc.php");
							$mysqli = new mysqli($CFG->server, $CFG->user_name, $CFG->password, $CFG->database);
							if ($mysqli->connect_errno) {
								echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
							}
							
							$dayQuery = $mysqli->query("SELECT id, day, name FROM sessions ORDER BY day, name") or die("Failed to lookup sesion days");
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
		            <h4>Check out what events people are going to!</h4>
		            <br />
					<form action="viewSessions.php" class="form-inline" method="post">
					<input type="text" name="id" placeholder="Student ID Number" maxlength=6 autocomplete="off" />&nbsp;&nbsp;
					<button type="submit" class="btn btn-primary" name="submit">Submit</button>
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

			<?php
				if(isset($tabNum) && $tabNum == 2) {
					echo "<div class='tab-pane active' id='login'>";
				}
				else {
					echo "<div class='tab-pane' id='login'>";
				}
			?>

			<!--<div class="tab-pane active" id="login">-->
			

				<?php
						$errNoUser = 1;
						$errNoPass = 2;
						$errNothing = 3;
						$errIncorrect = 4;
						$errRestricted = 5;
						$errOverflow = 6;
						if(isset($_GET['errorLogin'])) {
							echo "<div class='alert alert-info'>";
							if($_GET['errorLogin'] == $errNoUser)
								echo "<b>ERROR!</b> Username is required.";
							else if($_GET['errorLogin'] == $errNoPass)
								echo "<b>ERROR!</b> Password is required.";
							else if($_GET['errorLogin'] == $errNothing)
								echo "<b>ERROR!</b> Username and password are required.";
							else if($_GET['errorLogin'] == $errIncorrect)
								echo "<b>ERROR!</b> Username or password is incorrect.";
							else if ($_GET['errorLogin'] == $errRestricted)
								echo "<b>ERROR!</b> You have been signed out, or this page you requested is restricted.  Please sign in.";
							else if ($_GET['errorLogin'] == $errOverflow)
								echo "<b>ERROR!</b> You have already signed up for your justice summit sessions.";
							echo "</div><br />";
						}
					?>
					<h4>Please login with your Bellarmine email address and student ID.</h4>
					<br />
					<form action="loginProcess.php" class="form-inline" method="post">
						
						<div class="input-append">
							<input type="text" class="span2" maxlength="50" id="appendedInput" name="email" placeholder="BCP Email" autocomplete="off" style="width:200px" />
							<span class="add-on" style="color:#000000">@bcp.org</span>
						</div>&nbsp;&nbsp;
						<input type="text" name="studentID" placeholder="Student ID" maxlength="6" />&nbsp;&nbsp;
						<button type="submit" class="btn btn-primary" name="submit">Login</button>
					</form>
			

			</div>
			<div class="tab-pane" id="contact">
				<div class="hero-unit">
				  <h1>Welcome!</h1>
				  <br />
				  <p>Created by <a href="mailto:richard.lin13@bcp.org">Richard Lin '13</a> for Mr. Lindemann's Fall 2012 Web Apps class.</p>
				  <p>This website would not be this awesome without the help of the following students:</p>
				  	<ul>
				  		<li><a href="mailto:jonathan.chang13@bcp.org">Jonathan Chang '13</a></li>
				  		<li><a href="mailto:stephen.pinkerton14@bcp.org">Stephen Pinkerton '14</a></li>
				  		<li><a href="mailto:francisco.sanchez13@bcp.org">Francisco Sanchez '13</a></li>
				  	</ul>
				<br />
				<p>Built with the help of the incredible <a href="http://twitter.github.com/bootstrap/">Twitter Bootstrap</a> framework.</p><br />
				<p>Comments?  Questions?  Suggestions?  Please feel free to let me know.</p>
				<p>Enjoy, and <b>Go Bells!</b></p>
				  <!--<p>
					<a class="btn btn-primary btn-large">
					  Learn more
					</a>
				  </p>-->
				</div>

				

			</div>
		</div>
	</div>
</body>
</html>