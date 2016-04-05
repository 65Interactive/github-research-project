<?php
	require_once("includes/init.php");
	//confirm_logged_in();
	$tbl = "tbl_user";
	$user = getAll($tbl);
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Canned...</title>
</head>
<body>
	<h1>Bye, Bye...</h1>
    <?php
		while($row = mysqli_fetch_array($user)) {
			echo "{$row['user_fname']} <a href=\"includes/caller.php?caller_id=delete&id={$row['user_id']}\">DELETE USER</a><br>";
		}
	?>
</body>
</html>