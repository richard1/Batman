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

	global $class;
	$class = floor($_SESSION['id'] / 1000);
	
	if(!isset($_SESSION['id'])) {	
		header("Location: index.php?tab=2&errorLogin=5");
	}

	if(isset($_POST['sess1'])) {
		if(isset($_SESSION['sess2']))
			if($_POST['sess1'] == $_SESSION['sess2'] - 1)
				header("Location: register.php?page=1&error=2");
		if(isset($_SESSION['sess3']))
			if($_POST['sess1'] == $_SESSION['sess3'] - 2)
				header("Location: register.php?page=1&error=2");
		$_SESSION['sess1'] = $_POST['sess1'];
	}
	if(isset($_POST['sess2'])) {
		if(isset($_SESSION['sess1']))
			if($_POST['sess2'] == $_SESSION['sess1'] + 1)
				header("Location: register.php?page=1&error=2");
		if(isset($_SESSION['sess3']))
			if($_POST['sess2'] == $_SESSION['sess3'] - 1)
				header("Location: register.php?page=1&error=2");
		$_SESSION['sess2'] = $_POST['sess2'];
	}
	if(isset($_POST['sess3'])) {
		if(isset($_SESSION['sess2']))
			if($_POST['sess3'] == $_SESSION['sess2'] + 1)
				header("Location: register.php?page=1&error=2");
		if(isset($_SESSION['sess1']))
			if($_POST['sess3'] == $_SESSION['sess1'] + 2)
				header("Location: register.php?page=1&error=2");
		$_SESSION['sess3'] = $_POST['sess3'];
	}

	if(!isset($_SESSION['sess1'])) {
		if($class == 214) {
			$_SESSION['sess1'] = 92;
		}
		else if($class == 215) {
			$_SESSION['sess1'] = 89;
		}
	}
	else if(!isset($_SESSION['sess2'])) {
		if($class == 213) {
			$_SESSION['sess2'] = 93;
		}
		else if($class == 216) {
			$_SESSION['sess2'] = 90;
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Justice Summit | Register</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
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

	<div class="page-header"><a href="index.php" class="thehead" id="thehead">
	  <h1>Justice Summit <small>Restorative Justice</small></h1></a>
	</div>
	
	<?php
		if(isset($_GET['saved']) && $_GET['saved'] == 1) {
			$prev = $page - 1;
			if(($page == 2 && !isset($_SESSION['sess1'])) || ($page == 3 && !isset($_SESSION['sess2']))) {
				echo "<br /><div class='alert alert-warning' style='margin-right:20px'><i class='icon-flag'></i> <b>Save unsuccessful.</b> No Session <b>$prev</b> preference was detected.</div>";
			}
			else {
				echo "<br /><div class='alert alert-info' style='margin-right:20px'><i class='icon-ok-circle'></i> <b>Save successful!</b> Session <b>$prev</b> registration saved.</div>";
			}
		}
		else if(isset($_GET['error']) && $_GET['error'] == 1) {
			echo "<br /><div class='alert alert-error' style='margin-right:20px'><i class='icon-remove'></i> Please select and save your Session <b>$page</b> preference.</div>";
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
							<h3>Session 1</h3>
							<h4>Monday, April 1st, 10:20 - 11:10 AM</h4>
							<select name="sess1" id="sess1" class="m-wrap" size="20" style="width:80%; cursor:auto" onchange="showUser(); return false;">
							<option value="null" disabled>Select your Session 1 below...</option>
EOD;
									require_once("conf.inc.php");
									$mysqli = new mysqli($CFG->server, $CFG->user_name, $CFG->password, $CFG->database);
									if ($mysqli->connect_errno) {
										echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
									}
									
									$sess1Query = $mysqli->query("SELECT id, name FROM sessions WHERE day = 1 AND max > current ORDER BY name") or die("Failed to lookup sess1");
									while ($row = $sess1Query->fetch_assoc()) {
										$sessID = $row['id'];
										$sessName = $row['name'];
										$prefix = '<option value="' . $sessID . '" ';
										if(isset($_SESSION['sess1']) && $sessID == $_SESSION['sess1'] ) {
											$output .= $prefix . 'selected="selected"' . '>' . $sessName . '</option>';
										}
										else if($class == 214) {
											if($sessID == 92) { // Juniors in leontyne for sesssion 1
												$output .= $prefix . 'selected="selected"' . '>' . $sessName . '</option>';
											}
											else {
												$output .= $prefix . 'disabled' . '>' . $sessName . '</option>';
											}
										}
										else if($class == 215) {
											if($sessID == 89) { // Sophs in sobrato for session 1
												$output .= $prefix . 'selected="selected"' . '>' . $sessName . '</option>';
											}
											else {
												$output .= $prefix . 'disabled' . '>' . $sessName . '</option>';
											}
										}
										else {
											if($sessID != 92 && $sessID != 89) { // don't show at all if senior/frosh
												$output .= $prefix . '>' . $sessName . '</option>';
											}
										}
									}
							$output .= "</select>";
					}
					else if($page == 2) {
						$output = <<<EOD
							<h3>Session 2</h3><h4>Monday, April 1st, 11:20 - 12:10 PM</h4>
							<select name="sess2" id="sess2" class="m-wrap" size="20" style="width:80%; cursor:auto" onchange="showUser(); return false;">
								<option value="null" disabled>Select your Session 2 below...</option>
EOD;
								
									require_once("conf.inc.php");
									$mysqli = new mysqli($CFG->server, $CFG->user_name, $CFG->password, $CFG->database);
									if ($mysqli->connect_errno) {
										echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
									}
									
									$sess1Query = $mysqli->query("SELECT id, name FROM sessions WHERE day = 2 AND max > current ORDER BY name") or die("Failed to lookup sess2");
									while ($row = $sess1Query->fetch_assoc()) {
										$sessID = $row['id'];
										$sessName = $row['name'];

										$prefix = '<option value="' . $sessID . '" ';
										if(isset($_SESSION['sess1']) && $sessID == $_SESSION['sess1'] ) {
											$output .= $prefix . 'selected="selected"' . '>' . $sessName . '</option>';
										}
										else if($class == 213) {
											if($sessID == 93) { // Juniors in leontyne for sesssion 1
												$output .= $prefix . 'selected="selected"' . '>' . $sessName . '</option>';
											}
											else {
												$output .= $prefix . 'disabled' . '>' . $sessName . '</option>';
											}
										}
										else if($class == 216) {
											if($sessID == 90) { // Sophs in sobrato for session 1
												$output .= $prefix . 'selected="selected"' . '>' . $sessName . '</option>';
											}
											else {
												$output .= $prefix . 'disabled' . '>' . $sessName . '</option>';
											}
										}
										else {
											if($sessID != 90 && $sessID != 93) { // don't show at all if senior/frosh
												$output .= $prefix . '>' . $sessName . '</option>';
											}
										}
									}
							$output .= "</select>";
					}
					else if($page == 3) {
						$output = <<<EOD
							<h3>Session 3</h3><h4>Tuesday, April 2nd, 10:20 - 11:10 AM</h4>
							<select name="sess3" id="sess3" class="m-wrap" size="20" style="width:80%; cursor:auto" onchange="showUser(); return false;">
								<option value="null" disabled>Select your Session 3 below...</option>
EOD;
								
									require_once("conf.inc.php");
									$mysqli = new mysqli($CFG->server, $CFG->user_name, $CFG->password, $CFG->database);
									if ($mysqli->connect_errno) {
										echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
									}
									
									$sess1Query = $mysqli->query("SELECT id, name FROM sessions WHERE day = 3 AND max > current ORDER BY name") or die("Failed to lookup sess3");
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
					<div id="txtHint">
						<?php
							require_once("conf.inc.php");
							$mysqli = new mysqli($CFG->server, $CFG->user_name, $CFG->password, $CFG->database);
							if ($mysqli->connect_errno) {
								echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
							}

							if($page == 1 && $class == 214) {
								$sess1Query = $mysqli->query("SELECT * FROM sessions WHERE id = 92") or die("Failed to lookup sess1 mand jun");
								while ($row = $sess1Query->fetch_assoc()) {
									echo '<span class="label label-important">All juniors must attend <i>' . $row['name'] . '</i> in Session 1.</span>';
									echo "<h3>" . $row['name'] . "</h3><h5>" . $row['speaker'] . " - " . $row['room'] . "</h5><p>" . $row['description'];
								}
							}
							else if($page == 1 && $class == 215) {
								$sess1Query = $mysqli->query("SELECT * FROM sessions WHERE id = 89") or die("Failed to lookup sess1 mand soph");
								while ($row = $sess1Query->fetch_assoc()) {
									echo '<span class="label label-important">All sophomores must attend <i>' . $row['name'] . '</i> in Session 1.</span>';
									echo "<h3>" . $row['name'] . "</h3><h5>" . $row['speaker'] . " - " . $row['room'] . "</h5><p>" . $row['description'];
								}
							}
							else if($page == 2 && $class == 213) {
								$sess1Query = $mysqli->query("SELECT * FROM sessions WHERE id = 93") or die("Failed to lookup sess2 mand sen");
								while ($row = $sess1Query->fetch_assoc()) {
									echo '<span class="label label-important">All seniors must attend <i>' . $row['name'] . '</i> in Session 2.</span>';
									echo "<h3>" . $row['name'] . "</h3><h5>" . $row['speaker'] . " - " . $row['room'] . "</h5><p>" . $row['description'];
								}
							}
							else if($page == 2 && $class == 216) {
								$sess1Query = $mysqli->query("SELECT * FROM sessions WHERE id = 90") or die("Failed to lookup sess2 mand frsh");
								while ($row = $sess1Query->fetch_assoc()) {
									echo '<span class="label label-important">All freshmen must attend <i>' . $row['name'] . '</i> in Session 2.</span>';
									echo "<h3>" . $row['name'] . "</h3><h5>" . $row['speaker'] . " - " . $row['room'] . "</h5><p>" . $row['description'];
								}
							}
							else {
								echo '<b>Select a session from the left to view details here.</b><br /><br/><span class="label label-info">Protip</span> You can browse the sessions and view their details with the up & down arrow keys.';
							}
						?>
				</td>
			</tr>
			
				<br />
				<br />
		</table>
		<button type="submit" class="btn btn-primary" name="submit"><?php if($page == 1 || $page == 2) echo "<i class='icon-plus-sign icon-white'></i> Save and Next"; else echo "<i class='icon-ok-sign icon-white'></i> Save and Review"; ?></button>
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
