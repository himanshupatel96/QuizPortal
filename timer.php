<html>
<head>
	<title>Timer</title>
	<script type = "text/javascript">
		var h,m,s;
		function func(){
			var gh = document.getElementById("h").value;
			var gm = document.getElementById("m").value;
			var gs = document.getElementById("s").value;
			h = gh;
			m = gm;
			s = gs;
			var x = setInterval(show, 1000);
		}
		function show(){
			var a,b,c;
			if(h >= 0 && m >= 0 && s >= 0){
				if(h <= 9)
					a="0"+h;
				else
					a=h;
				if(m <= 9)
					b="0"+m;
				else
					b=m;
				if(s <= 9)
					c="0"+s;
				else
					c=s;
				document.getElementById("time").innerHTML = a+" : "+b+" : "+c;
				s--;
				if(s < 0){
					s = 59;
					m--;
				}
				if(m < 0){
					m = 59;
					h--;
				}
			}
			if(s==0&&m==0&&h==0){
		//		window.location.href = 'nothing.php';
			}
		}
	</script>
</head>

<body onload = "func()">

<?php

//$file = fopen("time.txt","r");
$m =0; // fgets($file);
$h =0; // floor($m/60);
$m =0; // $m%60;
$s = 50;

//echo $h." ".$m." ".$s;
//fclose($file);

?>

	<input id = "h" type = "hidden" value = "<?php echo $h; ?>" />
	<input id = "m" type = "hidden" value = "<?php echo $m; ?>" />
	<input id = "s" type = "hidden" value = "<?php echo $s; ?>" />

	<div>
		<p id = "time" ></p>
	</div>
</body>
</html>