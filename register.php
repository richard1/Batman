<?php
	global $page;
	$page = 1;
	if(!isset($_GET['page']) || ($_GET['page'] == '') || !is_numeric($_GET['page'])) {
		$page = 1;
	}
	else {
		$page = $_GET['page'];
	}
	
	session_start();
	
	if(!isset($_SESSION['id'])) {	
		header("Location: index.php?tab=2&errorLogin=5");
	}
	
	if(isset($_POST['sess1']))
		$_SESSION['sess1'] = $_POST['sess1'];
	if(isset($_POST['sess2']))
		$_SESSION['sess2'] = $_POST['sess2'];
	if(isset($_POST['sess3']))
		$_SESSION['sess3'] = $_POST['sess3'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Justice Summit | Register</title>
	<link rel="stylesheet" type="text/css" href="BCP.css" />
	<link href="metro/css/m-styles.min.css" rel="stylesheet" />
	<link href="bootstrap/pagination.css" rel="stylesheet" />
	<link href="bootstrap/body.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="bootstrap/buttons.css" />
	<link rel="stylesheet" type="text/css" href="bootstrap/css/icons.css" />
	<link rel="icon" type="image/png" href="img/batman.png">
	<script type="text/javascript">
	
	function showUser() {
		<?php
			if($page == 1) {
				echo 'var str = document.getElementById("sess1").value;';
			}
			else if($page == 2) {
				echo 'var str = document.getElementById("sess2").value;';
			}
			else {
				echo 'var str = document.getElementById("sess3").value;';
			}
			/*else {
				echo 'var str = document.getElementById("sess4").value;';
			}*/
		?>
		if (str == "" || str == "null") {
			document.getElementById("txtHint").innerHTML = "Select a session from the left to view details here";
			return;
		} 
		
		xmlhttp = new XMLHttpRequest();		
		xmlHttp = GetXmlHttpObject();

		if(xmlHttp == null) {
			alert("Your browser doesn't support some elements in this page.  Please consider using Chrome, Firefox, or Opera.");
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
		var xmlHttp = null;
		try {
			xmlHttp = new XMLHttpRequest();
		} catch (e) {
			try {
				xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {}
		}
		return xmlHttp;
	}	
	</script>
</head>
<body style="margin-left:20px; margin-right:20px">

	<div class="header">
		<table width=100%>
		<tr><td><h1>Register for Sessions</h1></td>
		<td><a href="index.php"><img src="bell.png" height=100px width=100px align=right /></a></td></tr>
		</table>
	</div>
	
	<?php
		if(isset($_GET['saved']) && $_GET['saved'] == 1) {
			$prev = $page - 1;
			echo "<br /><div class='alert alert-info' style='margin-right:20px'><i class='icon-ok-circle'></i> <b>SUCCESS!</b> Session <b>$prev</b> registration saved.</div>";
		}
	?>
	
	<div align="center">
	<?php
		if($page == 1) {
			echo '<form action="register.php?page=2&saved=1" method="post">';
		}
		else if($page == 2) {
			echo '<form action="register.php?page=3&saved=1" method="post">';
		}
		/*
		else if($page == 3) {
			echo '<form action="register.php?page=4" method="post">';
		}*/
		else {
			echo '<form action="registerReview.php" method="post">';
		}
	?>
		<table width="90%">
			<tr>
				<td width="50%">
				<?php
					$output = "";
					if($page == 1) {
						$output = <<<EOD
							<h2>Session 1</h2>
							<h3>Monday, April 1st, 10:20 - 11:10 AM</h3>
							<select name="sess1" id="sess1" class="m-wrap" size="20" style="width:80%; cursor:auto" onchange="showUser(); return false;">
								<option value="null" disabled>Select your Session 1 below...</option>
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
										$output .= '<option value="' . $sessID . '" ';
										if(isset($_SESSION['sess1']) && $sessID == $_SESSION['sess1']) {
											$output .= 'selected="selected"';
										}
										$output .= '>' . $sessName . '</option>';
									}
							$output .= "</select>";
					}
					else if($page == 2) {
						$output = <<<EOD
							<h2>Session 2</h2><h3>Monday, April 1st, 11:20 - 12:10 PM</h3>
							<select name="sess2" id="sess2" class="m-wrap" size="20" style="width:80%; cursor:auto" onchange="showUser(); return false;">
								<option value="null" disabled>Select your Session 2 below...</option>
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
										$output .= '<option value="' . $sessID . '" ';
										if(isset($_SESSION['sess2']) && $sessID == $_SESSION['sess2']) {
											$output .= 'selected="selected"';
										}
										$output .= '>' . $sessName . '</option>';
									}
							$output .= "</select>";
					}
					else if($page == 3) {
						$output = <<<EOD
							<h2>Session 3</h2><h3>Tuesday, April 2nd, 10:20 - 11:10 AM</h3>
							<select name="sess3" id="sess3" class="m-wrap" size="20" style="width:80%; cursor:auto" onchange="showUser(); return false;">
								<option value="null" disabled>Select your Session 3 below...</option>
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
										$output .= '<option value="' . $sessID . '" ';
										if(isset($_SESSION['sess3']) && $sessID == $_SESSION['sess3']) {
											$output .= 'selected="selected"';
										}
										$output .= '>' . $sessName . '</option>';
									}
							$output .= "</select>";
					}
					echo $output;
					?>
						
				</td>
				<td align="center">
					<div id="txtHint"><b>Select a session from the left to view details here.</b><br /><br/>
						<i>Hint</i>: you can browse the sessions and view their details with the up & down arrow keys.<br /><br />
						Clicking <b>Save and Next</b> will remember your choice, but isn't final until you review all.
				</td>
			</tr>
			
				<br />
				<br />
		</table>
		<button type="submit" class="btn btn-primary" name="submit"><?php if($page == 1 || $page == 2) echo "<i class='icon-plus-sign icon-white'></i> Save and Next"; else echo "<i class='icon-ok-sign icon-white'></i> Review"; ?></button>
	</form>
	<div>
	<div class="pagination pagination-centered">
		<ul>
			<li <?php if($page == 1) echo 'class="disabled"'; ?>><a href="register.php?page= <?php if($page == 2) echo "1"; else if($page == 3) echo "2"; ?>"><i class='icon-chevron-left'></i> Prev</a></li>
			<li <?php if($page == 1) echo 'class="active"'; ?>><a href="register.php?page=1">1</a></li>
			<li <?php if($page == 2) echo 'class="active"'; ?>><a href="register.php?page=2">2</a></li>
			<li <?php if($page == 3) echo 'class="active"'; ?>><a href="register.php?page=3">3</a></li>
			<li <?php if($page == 3) echo 'class="disabled"'; ?>><a href="register.php?page= <?php if($page == 1) echo "2"; else if($page == 2) echo "3"; ?>">Next <i class='icon-chevron-right'></i></a></li>
		</ul>
	</div>
</body>
</html>