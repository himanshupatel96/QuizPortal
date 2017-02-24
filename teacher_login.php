<!DOCTYPE html>
<html>
<head>
	<title>Teacher Login Portal</title>
	<link rel="stylesheet" type="text/css" href="teacher_login.css">
	<script type="text/javascript">
		function submitData(){
			var u = document.getElementById("uname").value;
			var p = document.getElementById("passwd").value;
			if(u.length == 0){
				alert("Please Enter Username!!");
			}
			else if(p.length == 0){
				alert("Please Enter Password!!");
			}
			else{
				document.getElementById("formID").submit();
			}
		}
	</script>
</head>
<body>
	<div class="header">
		<div id="clg">
			MOTILAL NEHRU NATIONAL INSTITUTE OF TECHNOLOGY
		</div>
		<div id="dept">
			Department of Computer Science and Engineering
		</div>
	</div>
	<div class="heading" >
		Teacher Portal
	</div>
	<form method="post" id="formID" action="teacher.php">
		<input id="uname" type="text" placeholder="Enter username here" name="username" autocomplete="off" required ></input>
		<br>
		<input id="passwd" type="password" placeholder="Enter password here" name="password" autocomplete="off" required ></input>
		<br>
	<button id="butt" onclick = "submitData()">PROCEED</button>
	</form>
</body>
</html>