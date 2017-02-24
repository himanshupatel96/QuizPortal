<?php
	error_reporting(0);
	session_start();
	$success = 0;
	if(isset($_FILES['file_upload'])){
		$errors= array();
		$file_name = $_FILES['file_upload']['name'];
		$file_tmp = $_FILES['file_upload']['tmp_name'];

		if(empty($errors)==true){
		 	move_uploaded_file($file_tmp,"uploads/".$file_name);
		 	echo "Success";
		 	$success = 1;

		}
		else{
		 	print_r($errors);
		 	echo "Contact the Developers";
		}
		if($success){
			$handle = fopen("assignments.csv", "a");
			$fields = array($_POST['heading'], $file_name,$_POST['description'],'A');
			fputcsv($handle, $fields);
			fclose($handle);
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Uploading...</title>
	<script type="text/javascript" src="jquery-1.11.2.min.js"></script>
	<script type="text/javascript">
		$(window).load(function() {
			$("#formid").submit();
		});
</script>
</head>
<body>
	<form id="formid" action="index.php">
		File Uploaded Successfully.
	</form>
</body>
</html>