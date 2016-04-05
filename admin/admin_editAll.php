<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit</title>
</head>
<body>
<h2>Edit All</h2>
<?php
	require_once('includes/init.php');
	$tbl = "tbl_movies";
	$col = "movies_id";
	//$tbl = "tbl_cast";
	//$col = "cast_id";
	$id = 1;
	echo single_edit($tbl,$col,$id);
?>
</body>
</html>