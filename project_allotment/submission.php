<?php
	session_start();
	if(isset($_POST["submitted_stuname"]) && isset($_POST["submitted_regno"])) {

?>

<!DOCTYPE html>
<html>
<head>
	<title>Project Allotment Portal | M.Tech.</title>
	<link rel="stylesheet" type="text/css" href="submission.css">
	<script type = "text/javascript" src = "submission.js">
	</script>
</head>
<body>
	<div class="header">
		<div id="heading">Project Allotment Portal (for M.Tech.)</div>
		<div id="dept">Department of Computer Science and Engineering</div>
	</div>
	<div id = "strip">
		<div id = "welcome">
			Welcome <?php echo $_POST["submitted_stuname"]; ?>
		</div>
		<div id = "logout-btn" onclick="logout()">
			Logout
		</div>
	</div>
	<form hidden="true" method = "post" action = "expired.php" id = "hidden_form">
		<input type = "hidden" name = "regno" value = "123" />
	</form>


	<?php

		//Step 1 :: making a Connection
		$connection = mysql_connect("localhost","root","117gaurav");
		if(!$connection){
			die("ERROR WITH THE DATABASE!!!<br>If problem persists, drop in a mail at glalchandanig@gmail.com");
		}

		//Step 2 :: Select Database
		$db_select = mysql_select_db("project_allotment",$connection);
		if(!$db_select){
			die("ERROR WITH THE DATABASE!!!<br>If problem persists, drop in a mail at glalchandanig@gmail.com");
		}
		

		$result = mysql_query("SELECT * FROM preference_list WHERE REGNO='".$_POST["submitted_regno"]."'");
		$row = mysql_fetch_array($result);

		if($row["SUBMITTED"] == 1){
			echo "You have already submitted your choices!!! Wait for the allotment result.";
			die();
		}

		$count = 0;

		foreach ($_POST as $key => $value) {
			$count++;
			if(substr($key, 0, 4) == "pref"){
				$result = mysql_query("UPDATE preference_list SET TEACHER".substr($key,4,5)."='".$value."' WHERE REGNO='".$_POST["submitted_regno"]."'; ", $connection);

				if(!$result){
					$count = -1;
					break;
				}
			}
		}

		if($count == -1){
			die(mysql_error());
		}

		$result = mysql_query("UPDATE preference_list SET SUBMITTED='1';", $connection);

		echo "Your submission has been recorded!!!"

	?>

</body>

<?php
	mysql_close($connection);
	}
	else
	{
		session_destroy();

		?>

		<img src = "./images/lost.jpg" width = "100%" height = "100%"/>

		<?php

	}
?>