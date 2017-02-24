<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="login.css">
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
	<div id = "form">
		<form method="POST" action="assignment.php">
			<div id="login-head" >
				Login
			</div>
			<br>
			<input type="text" name="regno" id="regno" placeholder="Registration Number" autocomplete = "off" required>
			<br><br>
			<input type="text" name="stuname" autocomplete = "off" id="stuname" placeholder="Name" required><br>
			<div id="group">Group </div>
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

			<input type="text" placeholder="Enter Key" id="key" autocomplete = "off" name="key" required />
			<br><br>
			<input type="submit" value="ENTER" id="enter"><br>
		</form>
	</div>

	<div id="info">
		<div id="msg">
			Read it carefully before logging in.
		</div>
		<div id="inst">
			<ul>
				<br>
				<li>Fill in all the details carefully.</li>
				<br>
				<li>Write your full name as per the records.</li>
				<br>
				<li>The key will be provided by the teacher.</li>
				<br>
				<li>After logging in, you will be in the quiz page.</li>
				<br>
				<li>You will be able to login and submit <em>only once</em>.</li>
				<br>
				<li>In case of any doubts, contact your instructor or invigilator.</li>
				<br>
				<br>
				<h2 align="center">Happy Quizzing!!!</h2>
			</ul>
		</div>
	</div>

</body>
</html>