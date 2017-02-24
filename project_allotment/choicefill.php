<?php
	session_start();
	if(isset($_POST["stuname"]) && isset($_POST["regno"]) && isset($_POST["key"])){

		//Step 1 :: making a Connection
		$connection = mysql_connect("localhost","root","117gaurav");
		if(!$connection){
			die("ERROR WITH THE DATABASE!!!<br>If problem persists, drop in a mail at glalchandanig@gmail.com");
		}

		//Step 2 :: Select Database
		$db_select = mysql_select_db("project_allotment",$connection);
		if(!$db_select){
			die("ERROR WITH THE DATABASE !!!<br>If problem persists, drop in a mail at glalchandanig@gmail.com");
		}

		//Step 3 :: Database query (Collection of rows)
		$result = mysql_query("SELECT * FROM user_details",$connection);
		if(!$result){
			die("ERROR WITH THE DATABASE!!!<br>If problem persists, drop in a mail at glalchandanig@gmail.com");
		}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Project Allotment Portal | M.Tech.</title>
	<link rel="stylesheet" type="text/css" href="choicefill.css">
	<script src = "choicefill.js"></script>
</head>
<body onload = "init()">
	<div class="header">
		<div id="heading">Project Allotment Portal (for M.Tech.)</div>
		<div id="dept">Department of Computer Science and Engineering</div>
	</div>

	<?php

		//Search for username and registration number combination
		$flag = 0;
		while($row = mysql_fetch_array($result)){
			if(strtoupper($row["NAME"]) == strtoupper($_POST["stuname"]) && $row["REGNO"] == $_POST["regno"]){
				//Valid user
				$flag = 1;
				break;
			}
		}

		if($flag == 0){
			echo "Invalid User";
			mysql_close($connection);
			die();
		}

		if($row["PASSWORD"] != $_POST["key"]){
			echo "Wrong Password";
			mysql_close($connection);
			die();
		}

		//Authenticated ;)

	?>

	<div id = "strip">
		<div id = "welcome">
			Welcome <?php echo $row["NAME"]; ?>
		</div>
		<div id = "logout-btn" onclick="logout()">
			Logout
		</div>
	</div>

	<form hidden="true" method = "post" action = "expired.php" id = "hidden_form">
		<input type = "hidden" name = "regno" value = "123" />
	</form>

	<?php


		$entry_found = 0;

		$result = mysql_query("SELECT * FROM preference_list", $connection);
		while($row = mysql_fetch_array($result)){
			if($row["REGNO"] == $_POST['regno']){
				$entry_found = 1;
				break;
			}
		}

		if($entry_found == 0){
			//make entry in this case
			mysql_query("INSERT INTO preference_list (NAME, REGNO) VALUES ('".$_POST['stuname']."', '".$_POST['regno']."');",$connection);
		}
		else if($row["SUBMITTED"] == 1){
			echo "You have already submitted your choices!!! Wait for the allotment results.";
			die();
		}


		$fd = fopen("teacher.txt", "r");
		$count = 0;
		while($line = fgets($fd)){
			$teacher[$line] = 0;
			$count++;
		}
		fclose($fd);
	?>

	<form id = "teacher-list" style="visibility:hidden; ">	
		<input type = "hidden" value = "<?php echo $count; ?>" id = "count" />
	<?php
		$i = 0;
		foreach($teacher as $key => $value){
			$i++;
	?>
		<input type = "hidden" value = "<?php echo trim($key); ?>" id = "t<?php echo $i; ?>"/>
	<?php	
		}
	?>
	</form>

	<form id = "alloted" style = "visibility: hidden;" action = "submission.php" method = "POST">
		<input type = "hidden" value = "<?php echo strtoupper($_POST["stuname"]); ?>" name = "submitted_stuname" />
		<input type = "hidden" value = "<?php echo $_POST["regno"]; ?>" name = "submitted_regno" />
	<?php
		$i = 0;
		foreach($teacher as $key => $value){
			$i++;
	?>
		<input type = "hidden" value = "" id = "a<?php echo $i; ?>" name = "pref<?php echo $i; ?>"/>
	<?php	
		}
	?>
	</form>


	<br><br><br>

	<div id = "container" >

		<div id = "left">

			<div id = "remaining">
				NUMBER OF TEACHERS REMAINING : <div id = "nRemaining"><?php echo $count; ?></div>
			</div>
			<br>

			<?php
				$i = 0;
				foreach($teacher as $key => $value){
					$i++;
					?>

					<div id = "l<?php echo $i; ?>" class = "card-left" style="display: block; ">
						<div id = "lname<?php echo $i; ?>" class = "name">
							<?php echo trim($key); ?>
						</div>
						<div id = "enter" onclick="addTeacher(<?php echo $i; ?>)" >
							ADD
						</div>
					</div>

					<?php
				}
			?>
		</div>

		<div id = "right">
			<div id = "selected" >
				NUMBER OF TEACHERS ADDED : <div id = "nSelected">0</div>
			</div>
			<br>
			<?php
				$i = 0;
				foreach($teacher as $key => $value){
					$i++;
					?>

					<div id = "r<?php echo $i; ?>" class = "card-right" style="display : none; ">
						<div id = "rname<?php echo $i; ?>" class="name"></div>
						<div id = "remove<?php echo $i; ?>" onclick="removeTeacher(<?php echo $i; ?>)" class = "remove">X</div>
						<div id = "up<?php echo $i; ?>" onclick = "moveUp(<?php echo $i; ?>)" class = "up">U</div>
						<div id = "down<?php echo $i; ?>" onclick = "moveDown(<?php echo $i; ?>)" class = "down">D</div>
					</div>

					<?php
				}
			?>
			<br><br>
			<div id = "submit-btn" onclick = "submitForm()">
				Submit Preferences
			</div>

		</div>

	</div>

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