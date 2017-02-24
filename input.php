<html>
	<head>
		<title>Teacher Input Page</title>
		<link rel="stylesheet" type="text/css" href="input.css">
		<script>
			function formsubmit(){
				document.getElementById("ques").submit();
			}
		</script>
	</head>
	
	<body>
		<div id="header">
			<div id="head">Teacher Input Portal</div>
		</div>
		<form id = "ques" method = "post" action = "tmp.php">
			<br><br>
			<input type="hidden" name="group_name" value="<?php echo $_GET['alpha'].$_GET['numeric']; ?>"></input>
			<?php
				$n = $_GET["ques"];
				$fp = fopen("nq/".$_GET['alpha'].$_GET['numeric'].".txt","w");
				fwrite($fp, $n);
				fclose($fp);
				$time=$_GET["time"];
				$ft = fopen("time/".$_GET['alpha'].$_GET['numeric'].".txt","w");
				fwrite($ft, $time);
				fclose($ft);

				$fq = fopen("submissions/".$_GET['alpha'].$_GET['numeric'].".csv","wb");
				$heading = array
				(array('S.No.','Registration Number','Name','Marks'), array(' '));
				foreach($heading as $fields)
					fputcsv($fq, $fields);
				fclose($fq);

				for($i = 1; $i <= $n; $i++){
			?>

			<div id="ques-holder">
			<br>
				<div id="question">Question #<?php echo $i." "; ?></div>
				<br>
				<textarea class="q-field" type = "text" autocomplete="off" name = '<?php echo "q".$i; ?>'></textarea>
				<br><br>
				<div id="opt-holder">
					A. <input type = "radio" name = "<?php echo 'answer'.$i ?>" value = "A" />
						<input class="opt" type = "text" autocomplete="off" name = "<?php echo 'a'.$i; ?>" />
					&nbsp;&nbsp;
					B. <input type = "radio" name = "<?php echo 'answer'.$i ?>" value = "B" />
						<input class="opt" type = "text" autocomplete="off" name = "<?php echo 'b'.$i; ?>" />
					<br><br>
					C. <input type = "radio" name = "<?php echo 'answer'.$i ?>" value = "C" />
						<input class="opt" type = "text" autocomplete="off" name = "<?php echo 'c'.$i; ?>" />
					&nbsp;&nbsp;
					D. <input type = "radio" name = "<?php echo 'answer'.$i ?>" value = "D" />
						<input class="opt" type = "text" autocomplete="off" name = "<?php echo 'd'.$i; ?>" />
					<br>
				</div>
			</div>
			<br><br><br>
			<?php
				}
			?>
		</form>
		<div id = "save">
		
				<br><br>
			<button id="savebtn" onclick = "formsubmit()">SAVE AND PROCEED</button>
		</div>
	</body>
</html>