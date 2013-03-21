<!DOCTYPE html>
<html lang="en">
<head>
<?php
	session_start();
	session_unset();
?>
<!--
             .  .
             |\_|\
             | a_a\
             | | "]
         ____| '-\___
        /.----.___.-'\
       //        _    \
      //   .-. (~v~) /|
     |'|  /\:  .--  / \
    // |-/  \_/____/\/~|
   |/  \ |  []_|_|_] \ |
   | \  | \ |___   _\ ]_}
   | |  '-' /   '.'  |
   | |     /    /|:  |
   | |     |   / |:  /\
   | |     /  /  |  /  \
   | |    |  /  /  |    \
   \ |    |/\/  |/|/\    \
    \|\ |\|  |  | / /\/\__\
     \ \| | /   | |__
          / |   |____)
          |_/
-->
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
	<script>
		var prev;
		$("document").ready(function(){
			var activeTab = null;
			$('a[data-toggle="tab"]').on('shown', function (e) {
			  activeTab = e.target;
			  var len = activeTab.toString().length;
			  
			  if (typeof prev != "undefined") {
					//alert("Changing... prev: " + prev);
					if(prev == 'contact') {
						$('i.icon-envelope').toggleClass('icon-white');
					}
					else if(prev == 'sign up') {
						$('i.icon-user').toggleClass('icon-white');
					}
					else if(prev == 'view') {
						$('i.icon-th-list').toggleClass('icon-white');
					}
				}
			  
			  if(activeTab.toString().charAt(len - 1) == 't') {
				$('i.icon-envelope').toggleClass('icon-white');
				prev = 'contact';
			  }
			  else if(activeTab.toString().charAt(len - 1) == 'n') {
				$('i.icon-user').toggleClass('icon-white');
				prev = 'sign up';
			  }
			  else if(activeTab.toString().charAt(len - 1) == 'w') {
				$('i.icon-th-list').toggleClass('icon-white');
				prev = 'view';
			  }
			});
			
			$("a.tabby1").hover(function(){
				$('i.icon-th-list').toggleClass('icon-white');
			});
			$("a.tabby2").hover(function(){
				$('i.icon-user').toggleClass('icon-white');
			});
			$("a.tabby3").hover(function(){
				$('i.icon-envelope').toggleClass('icon-white');
			});
		});
	</script>
	<script>
		function toggle() {
			document.getElementById("mainselection").style.visibility = "visible";
			document.getElementById("toggler").style.visibility = "hidden";
		}
	</script>
	<script>
		$(function(){
		  var hash = window.location.hash;
		  hash && $('ul.nav a[href="' + hash + '"]').tab('show');
		});
	</script>
</head>

<body style="margin-left:20px; margin-right:20px;">

	<div class="page-header"><a href="index.php" class="thehead" id="thehead">
	  <h1>Justice Summit <small>Restorative Justice</small></h1></a>
	  </a>
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
				echo "<li class='active'><a href='#view' data-toggle='tab' class='tabby1'><i class='icon-th-list icon-white'></i> View Sessions</a></li>
					<li><a href='#login' data-toggle='tab' class='tabby2'><i class='icon-user icon-white'></i> Sign Up</a></li>
					<li><a href='#contact' data-toggle='tab' class='tabby3'><i class='icon-envelope icon-white'></i> Contact Us</a></li>";
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
						echo "<div class='alert alert-success'>";
						echo "<i class='icon-ok-sign'></i> <b>AWESOME!</b> You have successfully registered for your sessions.";
						echo "</div><br />";
					}
				?>
					<h4><span class="label label-important">Registrations are now closed.</span>
					<br />
					<br/ >
					</h4>
					<h4>Check out who's going to an event!</h4>
					<br />
		        	<div id="mainselection">
						<form action="index.php" method="get">
							<select name="sessionID" onChange="this.form.submit()" style="width:30%">
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
		            <h4>Check or print a list of events you've signed up for!</h4>
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
							
							echo "<br /><div class='alert alert-block'>";
							$sessInfoQuery = $mysqli->query("SELECT speaker, room FROM sessions WHERE id = $sessID") or die("Failed to lookup student ID");
							$sessRow = $sessInfoQuery->fetch_assoc();
							echo "<b>Location</b>: " . $sessRow['room'] . "</br><b>Speaker</b>: " . $sessRow['speaker'] . "</br><br />";
							echo "<table width='30%'><tr><td><b>Name</b></td><td><b>Year</b></td></tr>";
							$userIDQuery = $mysqli->query("SELECT userID FROM user_sessions WHERE sessionID = $sessID ORDER BY userID") or die("Failed to lookup student ID");
							while ($row = $userIDQuery->fetch_assoc()) {
								$userID = $row['userID'];
								$year = floor($userID / 1000) % 100;
								$nameQuery = $mysqli->query("SELECT name FROM users WHERE id = $userID") or die("Failed to lookup student name");
								while ($subrow = $nameQuery->fetch_assoc()) {
									echo "<tr><td>" . $subrow['name'] . "</td><td>'" . $year . "</tr>";
								}
							}
							echo "</table><br /><button type='button' onclick='window.location=\"roster.php?sessID=$sessID\"' class='btn btn-primary' name='submit'>Print Roster <i class='icon-print icon-white'></i></button></div>";
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
								echo "<b>ERROR!</b> Student ID is required.";
							else if($_GET['errorLogin'] == $errNothing)
								echo "<b>ERROR!</b> Username and student ID are required.";
							else if($_GET['errorLogin'] == $errIncorrect)
								echo "<b>ERROR!</b> Username or student ID is incorrect.";
							else if ($_GET['errorLogin'] == $errRestricted)
								echo "<b>ERROR!</b> You have been signed out, or this page you requested is restricted.  Please sign in.";
							else if ($_GET['errorLogin'] == $errOverflow)
								echo "<b>ERROR!</b> You have already signed up for your justice summit sessions.";
							echo "</div><br />";
						}
					?>
					<h3>Justice summit registrations have now closed.</h3><br /><h5>If you did not have the chance to sign up, your sessions have been auto-filled.<br />
					To view your sessions, click the <i>View Sessions</i> tab and enter your student ID number.</h5><br />
					<h3>Have fun!</h3>			

			</div>
			<div class="tab-pane" id="contact">
				<div class="hero-unit">
				  <h1>Welcome!</h1>
				  <br />
				  <p>Created by <a href="mailto:richard.lin13@bcp.org">Richard Lin '13</a> for Mr. Lindemann's Fall 2012 Web Apps class.</p>
				  <p>This website would not be possible without the help of the following students:</p>
				  	<ul>
				  		<li><a href="mailto:jonathan.chang13@bcp.org">Jonathan Chang '13</a></li>
						<li><a href="mailto:francisco.sanchez13@bcp.org">Francisco Sanchez '13</a></li>
				  		<li><a href="mailto:stephen.pinkerton14@bcp.org">Stephen Pinkerton '14</a></li>				  		
				  	</ul>
				<br />
				<p>Built with the help of the incredible <a href="http://twitter.github.com/bootstrap/">Twitter Bootstrap</a> framework.</p><br />
				<p>Comments?  Questions?  Suggestions?  Please feel free to let us know.</p>
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
<!--
                                                                            
                                 ,:;;''';''';;:,                            
                            ;'';;;'''''''''''''''':                         
                        ;;';';;;;''';''''';;'''''+'''                       
                    :;''''';;;;;;;;;';';'''''''''''''''                     
                   ;;;''';';;;;'';''''''';;''''''''''''';                   
                  ;;''''';;;;''''''''';;;'''''''''++++''';                  
                ;;';';;';;;;;;''''';;;'''++###+++'''+++'+''                 
               ;;;;;;';;;;;;;'''';''''++++#######+++'+++++++                
              ;;;;;;';;;';''';'''''''++############++'++++++'               
             ;;;;;'';;''';''';''''''+++###############++++++'+              
            ';''''';'''''''';;;'''''++++++#############++++++++             
           ;'''''''''''''''';''''+''''''++++############++++++++            
           ''''''''''''''''''''++'''''''''''++++##########+++++++           
          '''''''+''''';'''''''''+++++++++''''''+++########+++++++          
          '''++'''''''''''''+++++'++++#++++++++++'+++#######+++++++         
         '''+'+''''''''''''+++++++++++.`,;+#+++++++++++######++++++;        
         ''+++''''''''+'''+++++++++++:,;;,`  `;#+#++++++######++++++        
        +''+'++'''''+'+++++++++++++++.:#+.` :,:`+##+++++++#+###+++++;       
        '+'++++++'''+++++++++++++++#+.;++:  + # ########++#+###++++++       
       '++++++++++++'+'++++++++++++++`' +     ` ##########+#+##++++++       
       +++++++++++'++++++++++++++++++.  ..   `  ############++++++++++      
       ++++++'++'+'+'++++++++++++++++##';,``  ` +#+###########++++++++      
      '++++++++'++++++++##+##+###########+####;;###################+++;     
      ++++++'+++++++++++''+''+++++##################################+++     
      +++++++++++++''''+++#+#++##++#+#++++++###########################     
      ++++++++++''+#####@###+++##############++#######################+     
      ++++++#+'+####+';:,,,:,:,,::::;;'+##@@@@#########################+    
      ++++#+++####';:::,,,,,,::,,:,,,,,,,::;''+##@######################    
      ++###+#@##';;::,,,,,,,,:,:::::::,,,,,,,:::;'##@@#####@############    
      +##++#@#';::,,,,,:,,,,,,,:,:::::::,,,,,,,:::;'+#@@#####@##########    
      ##++##'':..,,,,,::::::,,:::::::::::,,,,,,,,,:;;''##@##############    
      ##+@#;,,.....,::;;;;;;:::::;;;;;;::::..,::;;;;;;;;'+#@@###########    
      ;;;''+++++++++'';:;''''';;'''''';;'+#########+++++''+::+##########    
      ++++##@####@#'###+++':,::;;;;''++####@#########+++++#:;::+########    
      +++##'#####'++###@##++#+++#+++#@#@@@#############+++#:;:;;;#######    
      +############@###@###+#+++##+####################+#+#;;:::;'######    
      +#@############+#@#####+++#######''#####@###+++###+#++;;;;;;######    
      ++#++###+#####+#'#@++#+#######+++++#@@#+######+##++####';;;;'#@###    
      +##++#,'':##'#++######+##+++###+#++#@@+###########+######';;;#@###    
      :+##+#'+'##@#@@@###@@#+##++++##@##@######@######@##+++##+##''#####    
       ##########@@#@@#####+##+++++@@@@@@#@######'+######+++++++######@#    
       +#####@##@@@#@@#@#@#+##+''#+##@@##################++++++++#####@#    
       +#####@####@##''+##@+##';'#+#@##'''+##@######@#@###+++++++#####'''   
       '###########';''''##+#+:,,;#+#;''''''##@@@@@@#@@##++'+++++####''++   
      ''##########'''''''++#+:,,,.'#+'''''''+@@#@@#@#####+++++++++##+'###'  
      ';+#######@@++''+++++#:,.,..:+##+'+'+++@@##@#@#@#++;;;'+++++#++####+  
      ;;,+######@#+#++++'+#;:,,,.,:;#+#++++++##+#######:;;;;'+++++#+++###+  
      ;;::+##++##@##+++++#;::,,,.,,:;#+@##+++++++##+@#:::;;;''++++#+''+##'  
     :;::,;+#####@@@'+++#;;::,,,,,:::;#++@#+++++##+##+:,:;;'''++++++''++#'  
     ;;;:::'#++####+''+#;;;:,..```,:::,,'+++++++'+#+;:,::;;'''+++++##+'++'  
     ;:;::::,:;'+####'::;;:,.`.``.:::,:::.,:;;;::,,,,.,::;;''+++++###+'+';  
     ;;::,,,.,,,,,,,,:;'';:.``..`,,:::::';:,.,,,,,,,.,.,:;''''++++###+'''   
     ;;;::,,,,,,,::;;'+;::,.`.......,,,:;+';:,,,.,,.,..,::;''+++++'##+'';   
     ;;;;::,,::::;''++:,,,,,,,,...,...,::'++';:::,,,,:,::;;'''++++'++';';   
     ;;;;::::;;;;'''';::::;::::::;;;;;;;;'++++';;::::,,:;;'''+++++''';:';   
     ;;;;;;::;;''''';;;'''';;;;;''''++''''+++++'';;;:::;;''''+++++';';:';   
     ;;;;;;;;;'''+';;;'##@+''''''+#@###+++++++++'';;;;;;''''++++++''';;;,   
     ;';;;;;;''+++';;;'++##+''+'+###++++++''+++++'''''''''''++++++':;'+:    
     ;';'';''''+'';;;:++++++++++########';''''++++''''''''+'+++++++;;'::    
     ;'''''''++++';;;;;+#+++++###++'+';;:;;;''++#++''''''''++++++++;'+;,    
     :''''''+++++';;;;;;''+#+++'''';;;;;::;;'''++#++''''''++++#++++:;::     
     ,''''+++++++'';';;;;;;;'+'''''';;;:::;;'''+++++++++++++++++++++'';     
      ''''+++#+++;;'''';;;;;:;'''''::::;;::;;;''++#++++++++++++++++#+';     
      ''''+++#+++;;;;;;;;;;;::::::;;:::;::::;;'++++#+++++++++++++++##+      
      +++++++#++''';;;;;;;;'''';;''''';::;;;;'''+++#+++++++++++++++##+      
      '++++++#++''';;'';;;;;'''';''''''''';;;'''+++#+++++++++++++++#+;      
      '++++++#+++'''''''''''''++++'+'+++++'';;'''++#+++++++++++++++++       
      ;++++'+++++#+++'+++++++'''++++#++++++++++++++#'++++++++++++++++       
       +'++'+++++++##+';;;;'+++++++''+###+++####++++'+++++++++++++++        
       +''++++++''''';;::::,,,;::,,,,:;;'####++++++''++++++++++++++'        
       '+'++'+++''''';;;;:,.....,...,::;'''''''++++''++++++++++++++'        
       ''+++++++';;'';;;;;:,,,,,,,,::;;;:;;';''++++++++++++++++++++         
        +'++++++'''''';;;;;::::::::;;;;;'''';''++++++++++++++++++++         
        '++++++++'''''''';;;;;;;;;;;;;''+'';'''+++++++++++++++++++;         
        :'+++++++'''''''++'''''''''''+++'''''''+++++++++++++++++++          
         '++++++'''''''+++++++++++++++'''''''''+++++++++++++++++++          
          ++++++''''''+++++++++++++++++''''''''+'++++++++++++++++:          
          ;++++++''''''++++++++++++++++''''''''++++++++++++++++++           
           ''++''''''''''''+##++####++++'''''+++++++++++++++++++            
            ++'''''''''';;;;:;';;'''''''''''''+++++++++++++++++;            
             +''''''''';;;;;;;;;;';;;;;''''++++++++++++++++++++             
             ;''+'''''''';;;;;;'''';;;'''''''+++++++++++++++++              
              ;++'''''''''''';'''''''''''''+++++++++++++++++;               
               ;'''''''''''''''''''''''''+'++++++++++++++++                 
                ''''''''''''''''''''''''++++++++++++++++++                  
                 ''''''''''''+++++++++++++++++++++++++++'                   
                  :''''''''''++++++++++++++++++++++++++;                    
                   ,'''++'''++++'++++++++++++'+++++++'                      
                     ++++++'+++++++++++++++++++++++:                        
                      :++''+++++++++++++++++++++'                           
                        '++++++++++++++++++#+;                              
                           '+++++++++##+'                                   
-->