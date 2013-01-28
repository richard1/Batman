<?php
	global $page;
	$page = 1;
	if(!isset($_GET['page']) || ($_GET['page'] == '') || !is_numeric($_GET['page'])) {
		$page = 1;
	}
	else {
		$page = $_GET['page'];
	}
	// Submit pages 1-3 here
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Justice Summit | Register</title>
	<link rel="stylesheet" type="text/css" href="BCP.css" />
	<link href="metro/css/m-styles.min.css" rel="stylesheet" />
	<!-- 
		jQuery is messin' up my javascripts
		<script src="lib/jquery-1.8.3.min.js" type="text/javascript" />
	-->
	<script type="text/javascript">
	
	function showUser() {
		<?php
			if($page == 1) {
				echo 'var str = document.getElementById("sess1").value;';
			}
			else if($page == 2) {
				echo 'var str = document.getElementById("sess2").value;';
			}
			else if($page == 3) {
				echo 'var str = document.getElementById("sess3").value;';
			}
			else {
				echo 'var str = document.getElementById("sess4").value;';
			}
		?>
		//var str = document.getElementById("sess1").value;
		if (str == "") {
			document.getElementById("txtHint").innerHTML = "";
			return;
		} 
		
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
	</script>
</head>
<body>

	<div class="header">
		<table width=100%>
		<tr><td>Register for Sessions <?php echo $page; ?></td>
		<td><a href="index.php"><img src="bell.png" height=100px width=100px align=right /></a></td></tr>
		</table>
	</div>
    <br />
	
	<div align="center">
	<?php
		if($page == 1) {
			echo '<form action="register.php?page=2" method="post">';
		}
		else if($page == 2) {
			echo '<form action="register.php?page=3" method="post">';
		}
		else if($page == 3) {
			echo '<form action="register.php?page=4" method="post">';
		}
		else {
			echo '<form action="registerProcess.php" method="post">';
		}
	?>
		<table width="90%">
			<tr>
				<td width="50%">
				<?php
					$output = "";
					if($page == 1) {
						$output = <<<EOD
							<h1>Session 1</h1>
							<h2>Monday, April 1st, 10:20 - 11:10 AM</h2>
							<select name="sess1" id="sess1" class="m-wrap" size="20" style="width:80%" onchange="showUser(); return false;">
								<option value="null" selected="selected">Select your Session 1 below...</option>
EOD;
								
									require_once("conf.inc.php");
									$mysqli = new mysqli($CFG->server, $CFG->user_name, $CFG->password, $CFG->database);
									if ($mysqli->connect_errno) {
										echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
									}
									
									$sess1Query = $mysqli->query("SELECT id, name FROM sessions WHERE day = 1 AND max > current") or die("Failed to lookup sess1");
									while ($row = $sess1Query->fetch_assoc()) {
										$sessID = $row['id'];
										$sessName = $row['name'];
										$output .= '<option value="' . $sessID . '">' . $sessName . '</option>';
									}
							$output .= "</select>";
					}
					else if($page == 2) {
						$output = <<<EOD
							<h1>Session 2</h1><h2>Monday, April 1st, 11:20 - 12:10 PM</h2>
							<select name="sess2" id="sess2" class="m-wrap" size="20" style="width:80%" onchange="showUser(); return false;">
								<option value="null" selected="selected">Select your Session 2 below...</option>
EOD;
								
									require_once("conf.inc.php");
									$mysqli = new mysqli($CFG->server, $CFG->user_name, $CFG->password, $CFG->database);
									if ($mysqli->connect_errno) {
										echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
									}
									
									$sess1Query = $mysqli->query("SELECT id, name FROM sessions WHERE day = 2 AND max > current") or die("Failed to lookup sess2");
									while ($row = $sess1Query->fetch_assoc()) {
										$sessID = $row['id'];
										$sessName = $row['name'];
										$output .= '<option value="' . $sessID . '">' . $sessName . '</option>';
									}
							$output .= "</select>";
					}
					else if($page == 3) {
						$output = <<<EOD
							<h1>Session 3</h1><h2>Tuesday, April 2nd, 10:20 - 11:10 AM</h2>
							<select name="sess3" id="sess3" class="m-wrap" size="20" style="width:80%" onchange="showUser(); return false;">
								<option value="null" selected="selected">Select your Session 3 below...</option>
EOD;
								
									require_once("conf.inc.php");
									$mysqli = new mysqli($CFG->server, $CFG->user_name, $CFG->password, $CFG->database);
									if ($mysqli->connect_errno) {
										echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
									}
									
									$sess1Query = $mysqli->query("SELECT id, name FROM sessions WHERE day = 3 AND max > current") or die("Failed to lookup sess3");
									while ($row = $sess1Query->fetch_assoc()) {
										$sessID = $row['id'];
										$sessName = $row['name'];
										$output .= '<option value="' . $sessID . '">' . $sessName . '</option>';
									}
							$output .= "</select>";
					}
					else if($page == 4) {
						$output = <<<EOD
							<h1>Session 4</h1><h2>Tuesday, April 2nd, 11:20 - 12:10 PM</h2>
							<select name="sess4" id="sess4" class="m-wrap" size="20" style="width:80%" onchange="showUser(); return false;">
								<option value="null" selected="selected">Select your Session 4 below...</option>
EOD;
									require_once("conf.inc.php");
									$mysqli = new mysqli($CFG->server, $CFG->user_name, $CFG->password, $CFG->database);
									if ($mysqli->connect_errno) {
										echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
									}
									
									$sess1Query = $mysqli->query("SELECT id, name FROM sessions WHERE day = 4 AND max > current") or die("Failed to lookup sess4");
									while ($row = $sess1Query->fetch_assoc()) {
										$sessID = $row['id'];
										$sessName = $row['name'];
										$output .= '<option value="' . $sessID . '">' . $sessName . '</option>';
									}
							$output .= "</select>";
					}
					echo $output;
					?>
						
				</td>
				<td align="center">
					<div id="txtHint">Select a session from the left to view details here</p>
				</td>
			</tr>
			
				<br />
				<br />
		</table>
		<input type="submit" class="submitbutton" name="submit" value="Submit" />
	</form>
	<div>
	
</body>
</html>