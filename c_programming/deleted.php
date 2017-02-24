<?php

		$count = 0;
		$reach = $_POST['val'];
		$in = fopen( 'assignments.csv', 'r');
		$contents = array();
		while(($row = fgetcsv($in))) {
	  		array_push($contents, $row);
		}
		$old_row = $contents[$reach-1];
		$old_row[3] = 'N';
		$contents[$reach-1] = $old_row;
		$out = fopen('assignments.csv', 'w');
		foreach ($contents as $row) {
			fputcsv($out, $row);
		}
	?>
<!DOCTYPE html>
<html>
<head>
	<title>Deleting...</title>
	<script type="text/javascript" src="jquery-1.11.2.min.js"></script>
	<script type="text/javascript">
		$(window).load(function() {
			$("#formid").submit();
		});
</script>
</head>
<body>
	<form id="formid" action="index.php">
		File Deleted Successfully.
	</form>
</body>
</html>
