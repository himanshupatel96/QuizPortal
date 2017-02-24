<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	session_start();
	if(isset($_POST["regno"])){
		session_destroy();
		unset($_POST);
		header("Location:index.php");
		exit;
	}
?>

</body>
</html>