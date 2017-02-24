<?php
	$fd = fopen(md5("teacher_details").".txt", "r");
//	$n = fgets($fd);
	$p = fgets($fd);
	if($_POST['username'] == "admin" && md5($_POST['password']) == $p){
		session_start();
		$_SESSION["name"] = "teacher";
?>


<html>
	<head>
		<title>Teacher Input Page</title>
		<link rel="stylesheet" type="text/css" href="teacher.css">
		<script type="text/javascript">
			function showKey(){
				document.getElementById("key").style.display = "block";
				document.getElementById("genkey").style.display = "none";
			}
			function logout(){
				document.getElementById("hidden_form").submit();
			}

			function changepasswd(){
				if(document.getElementById("newpasswd").style.display == "block"){
					document.getElementById("newpasswd").style.display = "none";
				}
				else{
					document.getElementById("newpasswd").style.display = "block";
				}
			}
		</script>
		<style type="text/css">
			#btn25 {
				margin-top: 20px;
				width: 400px;
				font-size: 20px;
				height:50px;
			}
		</style>
	</head>
	
	<body>
		<div class="header">
			<div id="clg">
				MOTILAL NEHRU NATIONAL INSTITUTE OF TECHNOLOGY
			</div>
			<div id="dept">
				Department of Computer Science and Engineering
			</div>
		</div>
		<div class="heading">
			<div id="uname">
				Hello 
				<?php
					echo $_POST['username'];
				?>
			</div>
			<button id="logout" onclick = "logout()">Logout</button>
			<form id="hidden_form" hidden="true" action="expired.php" method="post">
			</form>
			<button id="change" onclick = "changepasswd()" >Change Password</button>
			
		</div>

		
		<div class="initial" id="form">
			<form action = "input.php" action="get">
				<div id="details-head">
					Fill the Details
				</div>
				<br>
				<input type="text" name="ques" id="ques" placeholder="Enter Number of Questions" required autocomplete="off"></input>
				<br><br>
				<input type="number" min="0" name="time" id="time" placeholder="Specify Time Limit in Minutes " autocomplete="off" required></input>
				<br><br>
				<div id="group">Group</div>
				<div id="an">
					<br>
					<select name="alpha">
						<option value="A">A
						<option value="B">B
						<option value="C">C
						<option value="D">D
						<option value="E">E
						<option value="F">F
						<option value="G">G

					</select>
					<select name="numeric">
						<option value="1">1
						<option value="2">2
						<option value="3">3
					</select>
				</div>
				<br>
				<input type = "submit" value = "Submit" id="submit"></input>
			</form>
		</div>
		<div id="placeholder">
			<div id="newpasswd" style="display: none;">
				Change Password Details
				<form method="post" action="password_change.php">
					<input id="cp" name="curr_pass" type="password" placeholder="Current password" required ></input><br>
					<input id="np" name="new_pass" type="password" placeholder="New password" required ></input><br>
					<input id="cnp" name="confirm_pass" type="password" placeholder="Confirm New password" required ></input><br><br>
					<input id="final" type="submit" value="Confirm"></input>
				</form>
			</div>
			<button id = "genkey" onclick="showKey()">
				GENERATE UNIQUE KEY <br><br>
			</button>
			<div id="key" style="display:none;">
				UNIQUE KEY FOR THIS QUIZ: <br>
				<?php
					$key = array('0','0','0','0','0','0');
					for( 	$i = 0 ; $i < 6 ; $i++ ){
						$c = rand()%3+1;
						switch ($c) {
							case 1:
								$key[$i] = chr(rand()%10+48);
								break;
							
							case 2:
								$key[$i] = chr(rand()%26+65);
								break;
							
							case 3:
								$key[$i] = chr(rand()%26+97);
								break;
						}
					}
				?>
				<div id="random">
				<?php
					echo implode($key);
				?>
				</div>
				<?php
					$fp = fopen("key.txt","w");
					fwrite($fp,implode($key));
					fclose($fp);
				?>
			</div>
			<br>
			<div>
				<a href="c_programming/index.php"><button id = "btn25"> Upload Section </button> </a>
			</div>
		</div>
	</body>

</html>

<?php

}
else{

?>

<!DOCTYPE html>
<html>
<head>
	<title>Error</title>
</head>
<body>
Wrong Details.
</body>
</html>

<?php
}

?>