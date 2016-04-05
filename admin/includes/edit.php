<?php
	//ini_set('display_errors',1);
	//error_reporting(E_ALL);
	include('connect.php');
	$count = 0;
	
	//http://localhost:8888/bluRay_inclass5/admin/includes/edit.php?tbl=tbl_movies&col=movies_id&id=1&movies_thumb=TH_Tremors.jpg&movies_fimg=Tremors.jpg&movies_bimg=nobImg.jpg&movies_title=Tremors2&movies_year=1990&movies_storyline=A+small+town+gradually+becomes+aware+of+a+strange+creature+which+picks+off+people+one+by+one.+But+what+is+this+creature%2C+and+where+is+it%3F+At+the+same+time%2C+a+seismologist+is+working+in+the+area%2C+she+detects+tremors.+The+creature+lives+underground%2C+and+can+pop+up+without+warning.+Trapped+in+their+town%2C+the+town-folk+have+no+escape.&movies_runtime=96+min&movies_trailer=trailer.mp4&movies_price=26.99
	
	$tbl = $_GET['tbl'];
	$col = $_GET['col'];
	$id = $_GET['id'];
	
	unset($_GET['tbl']);
	unset($_GET['col']);
	unset($_GET['id']);
	
	$num = count($_GET);
	//echo $num;
	
	$qstring = "UPDATE {$tbl} SET ";
	
	foreach($_GET as $key => $value) {
		$count++;
		if($count != $num) {
			$qstring .= "{$key}='{$value}',";		
		} else {
			$qstring .= "{$key}='{$value}'";
		}
	}
	$qstring .= " WHERE {$col} = {$id}";	
	//echo $qstring;
	
	$updateQuery = mysqli_query($link, $qstring);
	if($updateQuery) {
		header("Location:../../index.php");
	} else {
		echo "Fail...";
	}
	mysqli_close($link);
?>