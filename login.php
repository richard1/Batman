<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Justice Summit | Login</title>
	<link rel="stylesheet" type="text/css" href="BCP.css" />
</head>
<body>
	<div class="header">
		<table width=100%>
		<tr><td>Justice Summit - Login</td>
		<td><a href="index.php"><img src="bell.png" height=100px width=100px align=right /></a></td></tr>
		</table>
	</div>
	<div class="main">
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
	</div>
</body>
</html>