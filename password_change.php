<!DOCTYPE html>
<html>
<head>
	<title>Password change</title>
</head>
<body>
	<?php
		$fp = fopen(md5("teacher_details").".txt","r");
	//	$n = fgets($fp);
		$p = fgets($fp);
		fclose($fp);
		if(md5($_POST['curr_pass']) == $p){
			if($_POST['new_pass'] == $_POST['confirm_pass']){
				echo "Successfully changed!!!";
				$fp = fopen(md5("teacher_details").".txt","w");
			//	fwrite($fp, $n);
				fwrite($fp, md5($_POST['new_pass']));
				fclose($fp);
			}
			else{
				echo "New password does not matches confirm password";
			}
		}
		else{
			echo "Current password is wrong!!. Please try again.";
		}
	?>

	<a href="teacher_login.php">Go to login page</a>
</body>
</html>