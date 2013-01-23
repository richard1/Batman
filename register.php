<!DOCTYPE html>
<html lang="en">
<head>
	<title>Justice Summit | Register</title>
	<link rel="stylesheet" type="text/css" href="BCP.css" />
	<link href="metro/css/m-styles.min.css" rel="stylesheet">
	<script src="lib/jquery-1.8.3.min.js" type="text/javascript" />
	<script type="text/javascript">
	//alert("hi");
	//var xmlhttp;
	
	window.onload = function() { alert("hi dere"); }
	
	/*
	function showUser() {
		var str = document.getElementById("sess1").value;
		alert("SHOW USER: " + str);
		if (str == "") {
			document.getElementById("txtHint").innerHTML = "";
			return;
		} 
		/*
		//if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		//}
		//else { // code for IE6, IE5
		//	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		//}
		
		xmlHttp = GetXmlHttpObject();

		if(xmlHttp == null) {
			alert("Your browser is not supported")
		}
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET", "getSessInfo.php?q=" + str,true);
		xmlhttp.send();
	}
	
	function GetXmlHttpObject() {
		var xmlHttp=null;
		try
		{
			xmlHttp=new XMLHttpRequest();
		}catch (e)
		{

			try
			{
				xmlHttp =new ActiveXObject("Microsoft.XMLHTTP");
			} 
			catch (e) {}

		}
	return xmlHttp;
	}
	*/
	
	</script>
</head>
<body>

	<div class="header">
		<table width=100%>
		<tr><td>Register for Sessions</td>
		<td><a href="index.php"><img src="bell.png" height=100px width=100px align=right /></a></td></tr>
		</table>
	</div>
    <br />
	<div align="center">
	<form action="registerProcess.php" method="post">
		<table width="90%">
			<tr>
				<td>
				<h1>Session 1</h1>
				<h2>Monday, April 1st, 10:20 - 11:10 AM</h2>
				<select name="sess1" id="sess1" multiple="multiple" class="m-wrap" size="20" style="width:80%" onchange="derp(); return false;">
					<option value="null" selected="selected">Select your Session 1 below...</option>
					<?php
						require_once("conf.inc.php");
						$mysqli = new mysqli($CFG->server, $CFG->user_name, $CFG->password, $CFG->database);
						if ($mysqli->connect_errno) {
							echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
						}
						
						$sess1Query = $mysqli->query("SELECT id, name FROM sessions WHERE day = 1 AND max > current") or die("Failed to lookup sess1");
						while ($row = $sess1Query->fetch_assoc()) {
							$sessID = $row['id'];
							$sessName = $row['name'];
							echo '<option value="' . $sessID . '">' . $sessName . '</option>';
						}
					?>
				</select>
				</td>
				<td>
					<div id="txtHint">HEEEEY</p>
				</td>
			</tr>
			<tr>
				<td>
				<br />
				<br />
				<h1>Session 2</h1><h2>Monday, April 1st, 11:20 - 12:10 PM</h2>
				<select name="sess2" multiple="multiple" class="m-wrap" size="20" style="width:80%">
					<option value="null" selected="selected">Select your Session 2 below...</option>
					<?php
						require_once("conf.inc.php");
						$mysqli = new mysqli($CFG->server, $CFG->user_name, $CFG->password, $CFG->database);
						if ($mysqli->connect_errno) {
							echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
						}
						
						$sess1Query = $mysqli->query("SELECT id, name FROM sessions WHERE day = 2 AND max > current") or die("Failed to lookup sess2");
						while ($row = $sess1Query->fetch_assoc()) {
							$sessID = $row['id'];
							$sessName = $row['name'];
							echo '<option value="' . $sessID . '" onClick="displayText(' . $sessID . '); return false">' . $sessName . '</option>';
						}
					?>
				</select>
				</td>
				<td>
					<p>Hey there</p>
				</td>
			</tr>
			<tr>
				<td>			
				<br />
				<br />
				<h1>Session 3</h1><h2>Tuesday, April 2nd, 10:20 - 11:10 AM</h2>
				<select name="sess3" multiple="multiple" class="m-wrap" size="20" style="width:80%">
					<option value="null" selected="selected">Select your Session 3 below...</option>
					<?php
						require_once("conf.inc.php");
						$mysqli = new mysqli($CFG->server, $CFG->user_name, $CFG->password, $CFG->database);
						if ($mysqli->connect_errno) {
							echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
						}
						
						$sess1Query = $mysqli->query("SELECT id, name FROM sessions WHERE day = 3 AND max > current") or die("Failed to lookup sess3");
						while ($row = $sess1Query->fetch_assoc()) {
							$sessID = $row['id'];
							$sessName = $row['name'];
							echo '<option value="' . $sessID . '" onClick="displayText(' . $sessID . '); return false">' . $sessName . '</option>';
						}
					?>
				</select>
				</td>
				<td>
					<p>Hey there</p>
				</td>
			</tr>
			<tr>
				<td>
				<br />
				<br />
				<h1>Session 4</h1><h2>Tuesday, April 2nd, 11:20 - 12:10 PM</h2>
				<select name="sess4" multiple="multiple" class="m-wrap" size="20" style="width:80%">
					<option value="null" selected="selected">Select your Session 4 below...</option>
					<?php
						require_once("conf.inc.php");
						$mysqli = new mysqli($CFG->server, $CFG->user_name, $CFG->password, $CFG->database);
						if ($mysqli->connect_errno) {
							echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
						}
						
						$sess1Query = $mysqli->query("SELECT id, name FROM sessions WHERE day = 4 AND max > current") or die("Failed to lookup sess4");
						while ($row = $sess1Query->fetch_assoc()) {
							$sessID = $row['id'];
							$sessName = $row['name'];
							echo '<option value="' . $sessID . '" onClick="displayText(' . $sessID . '); return false">' . $sessName . '</option>';
						}
					?>
				</select>
				</td>
				<td>
					<p>Hey there</p>
				</td>
			</tr>
				<br />
				<br />
		</table>
		<input type="hidden" value="
		<?php
		
		?>
		"/>
		<input type="submit" class="submitbutton" name="submit" value="Submit" />
	</form>
	<div>
</body>
</html>