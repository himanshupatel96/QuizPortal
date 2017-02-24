
<!DOCTYPE html>
<html>
<head>
	<title>Expired</title>
</head>
<body>
	<div>Logged out successfully!!!</div>
	<div>Please close the tab for security reasons.</div>
	<?php
		session_start();
		unset($_SESSION["name"]);
		session_destroy();
	?>
</body>
</html>