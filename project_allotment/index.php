<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Project Allotment Portal | M.Tech.</title>
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
	<div class="header">
		<div id="heading">Project Allotment Portal (for M.Tech.)</div>
		<div id="dept">Department of Computer Science and Engineering</div>
	</div>
	<div id = "form">
		<form method="POST" action="choicefill.php">
			<div id="login-head">
				Login
			</div>
			<br>
			<input type="text" name="stuname" autocomplete = "off" id="stuname" placeholder="Name" required><br>
			<br>
			<input type="text" name="regno" id="regno" placeholder="Registration Number" autocomplete = "off" required>
			<br><br>
			<input type="password" placeholder="Enter Password" id="key" autocomplete = "off" name="key" required />
			<br><br>
			<input type="submit" value="ENTER" id="enter"><br>
		</form>
	</div>

	<div id="info">
		<div id="msg">
			Instructions for choice filling and using the portal
		</div>
		<div id="inst">
			<ul>
				<br>
				<li>Login the portal using the password sent to your respective Email ID.</li>
				<br>
				<li>After successful login, fill your preference order of Professors.</li>
				<br>
				<li>Please Note : IT IS COMPULSORY TO ADD ALL PROFESSORS.</li>
				<br>
				<li>After adding the professors to your list, you can change the order by using the up<br>
				and down buttons of the respective block.</li>
				<br>
				<li>You can submit your preferences <em>only once</em>. So make sure about it.</li>
			</ul>
		</div>
	</div>

</body>
</html>