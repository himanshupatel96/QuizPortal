<?php 
	error_reporting(0);
	session_start();
?>
<html style="position: relative;">
	<head><title>Assignments and Study Material </title>
	<link rel="stylesheet" type="text/css" href="upload.css">
	</head>
   	<body>
   		<div id="header" align="center"> Assignments and Study Material - For 1<sup>st</sup> Year </div><br>
   		<div align="center" id="instructor">By- Dr. Shashank Srivastava</div>
   		<?php
   			if(isset($_SESSION["name"]) && $_SESSION["name"] == "teacher") {
   		?>		
   				<hr>
		   		<div id ="upload"> Upload Files </div>
				<form id = "addform" action="uploaded.php" method="POST" enctype="multipart/form-data">
					Heading : <input type = "text" id="text-input" name = "heading" placeholder="Enter Assignment heading" /><br/><br/>
					Description : <input type="text" id="text-input" name = "description" placeholder="Enter Description" />
					<br/><br/>
					<input id="add-form-sbmt" type = "file" name="file_upload" autocomplete="off" required /><br/><br/>
					<input id="add-form-sbmt" type = "submit" value="Upload Assignment" /><br/><br/>
			  	</form><hr>
	  	<?php
	  		} ?>
	  		<div>
		  	<div id="content-holder">
		  	<?php
	  		$f = fopen("assignments.csv", "r");
	  		$count = 1;
	  		while($line = fgetcsv($f)) {
	  			if($line[3]=='A') {
	  	?>
				  	<div id = "<?php echo $count; ?>" class = "result" >
				  		<div class = "head"> <?php echo $line[0]; ?> </div>
				  		<div class = "description"> <?php echo $line[2]; ?> </div>
				  		<a target="_blank" href = "<?php echo 'uploads/'.$line[1]; ?>" ><button class = "download_button"> Download </button></a>
				  		<?php
				  		if(isset($_SESSION["name"]) && $_SESSION["name"] == "teacher") {
				  		?>
					  		<form id="delform" action="deleted.php" method="post">
					  			<input type="hidden" name="val" value = "<?php echo $count; ?>"/>
					  			<button class="delete_button">Remove Assignment</button>
					  		</form>
					  	<?php } ?>
				  	</div>
	  	<?php
	  			}
	  		$count++;
	  		}
	  		fclose($f);
	  	?>
  				</div>
  				<div id="links" align="center">
  					<div style="font-size: 25px;font-weight: 600;">Useful Links</div>
  					<hr>
  					Learn Programming:<br>
  					<a href="http://www.geeksforgeeks.org" target="_blank"><button style="margin-top:10px;width: 278px; height: 75px; background-image: url(images/geeks-logo.png);background-repeat: no-repeat;"></button></a><br><br>
  					<a href="http://www.tutorialspoint.com" target="_blank"><button style="margin-top:10px;width: 165px; height: 100px; background-image: url(images/tutorialspoint.png);background-repeat: no-repeat;"></button></a><br><br>
  					<a href="http://quiz.geeksforgeeks.org" target="_blank"><button style="margin-top:10px;width: 90px; height: 90px; background-image: url(images/geeksquiz.png);background-repeat: no-repeat;"></button></a>
  					<br><br><hr>
  					Practice Programming Questions:<br>
  					<a href="http://www.spoj.com" target="_blank"><button style="margin-top:10px;width: 255px; height: 70px; background-image: url(images/spoj.png);background-repeat: no-repeat;"></button></a><br><br>
  					<a href="http://www.hackerrank.com" target="_blank"><button style="margin-top:10px;width: 225px; height: 75px; background-image: url(images/hackerrank.png);background-repeat: no-repeat;"></button></a><br><br>
  					<a href="http://www.codechef.com" target="_blank"><button style="margin-top:10px;width: 225px; height: 90px; background-image: url(images/codechef.png);background-repeat: no-repeat;"></button></a><br><br>
  				</div><br>
  				
  	</body>
</html>