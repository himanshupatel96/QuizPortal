<?php
		error_reporting(0);
		session_start();
		$_SESSION["name"] = $_POST['stuname'];
		$xq = fopen("key.txt", "r");
		$fk = fgets($xq);
		fclose($xq);
		if(isset($_SESSION["name"])){
			if($_POST['key'] == $fk || $_SESSION["name"] == "teacher"){
				if(!isset($_COOKIE['time'.$_POST['regno']])){
					$f = fopen("time/".$_POST['alpha'].$_POST['numeric'].".txt","r");
					$p = fgets($f);
					fclose($f);
					//p contains time of test actual one
					setcookie('time'.$_POST['regno'], $p, time()+3*60*60);
				}
				else{
					$p = $_COOKIE['time'.$_POST['regno']];
				}
				$gp_name = $_POST['alpha'].$_POST['numeric'];
?>
<html>
<head>
		<title>Quiz</title>
		<link rel="stylesheet" type="text/css" href="assignment.css">
		<script src="assignment.js"></script>
</head>

<body onload = "init()">
    <div id="header">
		<div id="head"> Quiz Portal </div>
		<div id="details">
			Hello <?php echo $_SESSION['name'] ; ?>
			(@<?php echo $_POST["regno"]; ?>)
		</div>
	</div>
	
	<div class="instructions" id="instructions" style="display: block;">
		<div id="heading">
			ABOUT THE QUIZ
		</div>
		<br>
		<br>
		<div id="mt">
			Time : <?php echo $p; ?> minutes.
		</div>
		<div id="mm">
			Maximum marks : <?php 
							$f = fopen("nq/".$gp_name.".txt", "r");
							$mm = fgets($f);
							fclose($f);
							echo $mm;
							?>
		</div>
		<br><br>
		<div id="inst">
			<ul>
				<li>Once you press the Start button, the timer will start.</li><br>
				<li>You can submit the test <em>only once</em>.</li><br>
				<li>All questions carry equal marks. There's no negetive marking.</li><br>
				<li>You can edit your responses anytime you feel.</li><br>
				<li>You can submit your responses, once you are done, by clicking the "End the test" button.</li><br>
				<li>However, after the time is over, your responses will be automatically submitted.</li><br>
				<li><em>Do not refresh any page after the timer starts. You will be penalized appropiately</em></li><br>
				<li>On submission, you will be redirected to the results page wherein you can see the marks obtained.</li><br>
			</ul>
		</div>
	</div>

	<?php
				$ques1 = $mm;
				$random = array(0);
				$check = array(0);
				for($i=1;$i<=$ques1;$i++){
					array_push($check,0);
				}
				for($i=1;$i<=$ques1;$i++){
					while(1){
						$r = rand()%$ques1 + 1;
						if($check[$r]==0){
							array_push($random,',');
							array_push($random,$r);
							$check[$r] = 1;
							break;
						}
					}
				}
			?>
	<input type="hidden" id="jsrand" value="<?php echo implode($random);?>">

	<div id="total-holder">
		<div id="num-holder">
			Question #1
		</div>
		<div class="question" id="question" style="display:none;">
				<iframe id="ifr" src="questions/<?php echo $_POST['alpha'].$_POST['numeric']; ?>/ques<?php echo $random[2];?>.php" frameBorder="0"></iframe>
		</div>
	</div>

	<div class="panel">
			<br>
			<!--START THE TEST-->
			<div id="start-holder">
					<button name="start" class="stbtn" id="start" onclick = "swap();timer()"> START THE TEST </button>
			</div>
			<!--TIMER-->
			<div id="timer-holder" style="display:none;">
					<div id="timer">
						<?php
							$m = $p;
							if($m>0){
								$h = floor($m/60);
								$s = ceil(($m - floor($m))*60);
								$m = $m%60;
							}
							else{
								$h = 0;
								$s = 0;
								$m = 0;
							}

							fclose($file);
						?>

							<input id = "h" type = "hidden" value = "<?php echo $h; ?>" />
							<input id = "m" type = "hidden" value = "<?php echo $m; ?>" />
							<input id = "s" type = "hidden" value = "<?php echo $s; ?>" />
							<input id = "nro" type = "hidden" value = "<?php echo $_POST['regno']; ?>" />
							<div>
								<p id = "time"></p>
							</div>
					</div>
			</div>
			<br><br>
			<div class="navigate" id="navigate" style="display:none;">
					<button class="btn" name="prev" id="prev" onClick="previousQuestion()">PREVIOUS</button>
					<button class="btn" id="next" name="next" onClick="nextQuestion()">NEXT</button>
			</div>
			
			<br><br>

			<div class="ques" id="ques" style="display : none ; ">
				<?php
					
					$file = fopen("nq/".$gp_name.".txt","r");
					$ques = fgets($file);
					fclose($file);
					for($i=1;$i<=$ques;$i++){ 
				?>
				<button class="btn" id="<?php echo $i; ?>" onclick = "func(<?php echo $i; ?>)"><?php echo $i; ?></button>
				
				<?php if($i%3==0){ ?>
				<br><br>
				
				<?php } } ?>
			</div>
			
			<?php
				$group = $_POST['alpha'].$_POST['numeric'];
			?>
			<br><br>
			<form id="formID" method="post" action="end.php" onsubmit="return confirm('Are you sure you want to submit?' ); " style="display:none;">
					<input type="hidden" name="stuname" value="<?php echo $_POST['stuname']; ?>" />
					<input type="hidden" name="regno" value="<?php echo $_POST['regno']; ?>" />
					<input type="hidden" name="group" value="<?php echo $group; ?>" id="qwerty"/>
					<input type="hidden" name="key" value="<?php echo $_POST['key']; ?>" /> 
					<input id = "xyz" type="hidden" name="response" value="" />
					
			</form>
			<button id = "xlr" class = "xlr" onclick = "final()" style="display: none;">End the Test</button>
	</div>
	
	<input type = "hidden" id = "temp" name = "temp" value = "<?php echo $ques; ?>" />
	
	<?php
		}
		else{
			session_destroy();
			?>
			<div id="wk" style="font-size: 50px; text-align: center; margin-top: 240px; ">Wrong Key entered. Please Try Again.</div>
			<?php 
		}
		}
		else{
			session_destroy();
			?>
			<div id="back" style="background-image: url('lost.jpg'); height : 100% ; width : 100%; ">
			</div>
			<?php 
		}
	?>
</body>
</html>
