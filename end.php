<?php
	error_reporting(0);
	session_start();
	$_SESSION['name'] = $_POST['stuname'];
	if(isset($_SESSION["name"])){
?>


<html>
<head>

	<title>Result</title>
	<link rel="stylesheet" type="text/css" href="end.css" >
	
</head>
<?php
	

	if(!isset($_COOKIE['key']) || (isset($_COOKIE['key']) && $_COOKIE['key'] != ($_POST['key']."".$_POST['regno']) ) ) {
		$response_string = $_POST["response"];
		
		$fp = fopen("nq/".$_POST['group'].".txt","r");
		$l = fgets($fp);
		fclose($fp);
		
		$fp = fopen(md5("correct_answers")."/".$_POST['group'].".txt","r");
		$ans = fgets($fp);
		fclose($fp);
		
		$count = 0;
		
		//comparing the response of the students and the correct answers 
		for($i=0;$i<$l;$i++){
			$c1 = substr($ans, $i, 1);
			$c2 = substr($response_string, $i+1, 1);
			
			if($c1 == $c2){
				$count++;
			}
		}

		$cookie_name = "key";
		$cookie_value = $_POST['key']."".$_POST['regno'];
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
		//Storing data in a cookie
?>
<body>
	<div id="head">RESULT</div>
	<div id="wzs">You have secured <?php echo $count; ?> out of <?php echo $l; ?> marks.
	</div>
	<?php
		if($count==$l){ ?>
			<div id="medal"></div>
	<br><br>
	<?php
		}
		$group = $_POST['group'];
		if($_POST['stuname']!="teacher"){
			$fq = fopen("submissions/".$group.".csv","a");
			$data = array
			('',$_POST['regno'],$_POST['stuname'],(string)$count);
			fputcsv($fq, $data);
			fclose($fq);
		}
	}
// cookie wala else.
	else{
		?>
			<div id="bg">
				<img src = "warning.jpg"/>
			</div>
		<?php
	}
	}
// session wala else
	else{
		?>
		<div id="back" style = "background-image: url('lost.jpg'); height : 100% ; width : 100%;" >
		</div>
		<?php 
	}
	session_destroy();
	?>
</body>
