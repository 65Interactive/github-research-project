<?php
	require_once('init.php');
	
	if(isset($_GET['caller_id'])) {
		$dir = $_GET['caller_id'];
		
		if($dir === "logout") {
			logged_out();
		} else if($dir == "delete") {
			$id = $_GET['id'];
			//echo $id;
			deleteUser($id);
		} else {
			echo "caller id does not exist.";		
		}
	}
?>