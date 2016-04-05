<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	require_once('includes/init.php');
	$result = multiReturns(6);
	list($add, $multiply) = multiReturns(142);
	//list — Assign variables as if they were an array
	//Like array(), this is not really a function, but a language construct. list() is used to assign a list of variables in one operation.
	//Returns the assigned array.
	echo var_dump($result)."<br>";
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Multiple Returns</title>
</head>
<body>
<?php
	echo "Result 1: {$result[0]}<br>";
	echo "Result 2: {$result[1]}<br><br><br>";
	echo "Result 1(List): {$add}<br>";
	echo "Result 2(List): {$multiply}<br><br><br>";

	$pageArray = array();

	while($row = mysqli_fetch_array($result)) {
		array_push($pageArray, $row);
	}
?>
</body>
</html>