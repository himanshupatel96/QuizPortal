<html>
<head>

	<title>Question Paper set</title>
	<script>
	</script>
</head>

<?php
	session_start();
	//echo file_exists(nq.txt");
	$fp = fopen("nq/".$_POST['group_name'].".txt","r");
	$n = fgets($fp);
	fclose($fp);
	
	$f = fopen(md5("correct_answers")."/".$_POST['group_name'].".txt","w");		//now using hash of "correct_answers"
	for($i=1;$i<=$n;$i++){
		fwrite($f, $_POST["answer".$i]);
	}
	fclose($f);
	//echo $n;
	//creating files of php for each individual question
	//random files are created by the sequence ques1.php, ques2.php, ... and so on
	for($i = 1; $i <= $n; $i++){
		$fp = fopen("questions/".$_POST['group_name']."/ques".$i.".php","wb");
		fwrite($fp, '<?php session_start();
		if(isset($_SESSION["name"])){ ?>'.
		
		"
		<html>
		<head>
		
		<title>Question".$i."</title>
		<script>
		function addToUserResponse(x){
			parent.recordResponse(x);
		}
		
		function load(x){
			parent.loadFromFrame(x);
		}
		
		</script>
		<link rel=\"stylesheet\" type=\"text/css\" href=\"ques.css\">
		</head>
		<body onload = \"load(".$i.")\">
		<div id=\"content-holder\">
			<div id=\"ques-holder\" class=\"unselectable\">
				");
//add new line
		$contents = $_POST["q".$i];
		$str = str_split($contents);	// Breaking string into array
		$g = sizeof($str);
		for ( $j = 0 ; $j < $g ; $j++ ) {
				if(ord($str[$j]) == 10)
					$str[$j] = "<br>";
				else if(ord($str[$j]) == 32)
					$str[$j] = "&nbsp";
				else if(ord($str[$j]) == 60)
					$str[$j] = "&lt";
				else if(ord($str[$j]) == 62)
					$str[$j] = "&gt";
				else if(ord($str[$j]) == 38)
					$str[$j] = "&amp";

		}
		$contents = implode($str);		// Converting array into string
		fwrite($fp, $contents);
		fwrite($fp,"
			</div>
			<br><br>
			<div id=\"opt-holder\" class=\"unselectable\">
				<div class=\"opt\">
				<input type = \"radio\" id = \"A\" name = \"option\" value = \"A\" onclick=\"addToUserResponse('A')\"><label for=\"A\">".$_POST["a".$i]."</label></input><br>
				</div>
				<div class=\"opt\">
				<input type = \"radio\" id = \"B\" name = \"option\" value = \"B\" onclick=\"addToUserResponse('B')\"><label for=\"B\">".$_POST["b".$i]."</label></input><br>
				</div>
				<div class=\"opt\">
				<input type = \"radio\" id = \"C\" name = \"option\" value = \"C\" onclick=\"addToUserResponse('C')\"><label for=\"C\">".$_POST["c".$i]."</label></input><br>
				</div>
				<div class=\"opt\">
				<input type = \"radio\" id = \"D\" name = \"option\" value = \"D\" onclick=\"addToUserResponse('D')\"><label for=\"D\">".$_POST["d".$i]."</label></input><br>
				</div>
			</div>
		</div>
		</body>
		
		</html>".'<?php 
		}
		else{
		?>
		<html>
		<head>
		</head>
		<body>
			Not allowed
		</body>
		</html>
		<?php
		}
		?>');
		fclose($fp);
	}
?>
<body>
	<div id="msg" style="text-align: center; font-size: 40px; border-bottom: dashed 5px black; padding: 5px; ">Questions successfully set for Group : <?php echo $_POST['group_name']; ?>
	</div>	
	<div style="text-align: right; font-size: 20px; margin-top: 10px;">Go to <a href="teacher_login.php">Login</a> page</div>
	<br><br>
	<?php
		for($i = 1; $i <= $n; $i++){
	?>
    	<iframe src="<?php echo 'questions/'.$_POST['group_name'].'/ques'.$i.'.php'; ?>" height="70%" width="49%"></iframe>
	<?php
		}
	?>
	
</body>
</html>