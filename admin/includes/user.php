<?php
	function getUser($id) {
		//echo $id;
		include('connect.php');
		$userstring = "SELECT * FROM tbl_user WHERE user_id={$id}";
		//echo $userstring;
		$userquery = mysqli_query($link, $userstring);
		if($userquery) {
			$found_user = mysqli_fetch_array($userquery, MYSQLI_ASSOC);
			return $found_user;
		} else {
			$message = "I do not like change, so leave me alone...";
			return $message;
		}
		mysqli_close($link);
	}
	
	function createUser($fname,$lname,$username,$password,$level) {
		//echo "works";
		include('connect.php'); //The include construct will emit a warning if it cannot find a file; this is different behavior from require, which will emit a fatal error.
		//Warnings in PHP are represented by E_WARNING. When these error occur execution of the script is not halted. For example, error in DB connections throws E_WARNING
		//Fatal error are represented by E_ERROR. The system cant recover from these kind of errors and the execution is halted. For example, Division by zero throws E_ERROR
		$fname = mysqli_real_escape_string($link, $fname);
		$lname = mysqli_real_escape_string($link, $lname);
		$username = mysqli_real_escape_string($link, $username);
		$password = mysqli_real_escape_string($link, $password);
		$ip = 0;
		$userstring = "INSERT INTO tbl_user VALUES(NULL,'{$fname}','{$lname}','{$username}','{$password}','{$level}','{$ip}')";
		//echo $userstring;
		$userquery = mysqli_query($link,$userstring);
		if($userquery){
			redirect_to('admin_index.php');	
		}else{
			$message = "There was a problem setting up this user. Please contact your web admin.";
			return $message;	
		}
		mysqli_close($link);
	}
	
	function editUser($id, $fname, $lname, $username, $password) {
		//echo $id;	
		include('connect.php');
		$updatestring = "UPDATE tbl_user SET user_fname='{$fname}', user_lname='{$lname}', user_name='{$username}', user_pass='{$password}' WHERE user_id={$id}";
		//echo $updatestring;
		$updatequery = mysqli_query($link, $updatestring);
		if($updatequery) {
			redirect_to("admin_index.php");	
		} else {
			$message = "Whoops, you broke the internet...";
			return $message;
		}
		mysqli_close($link);
	}
	
	function deleteUser($id) {
		include('connect.php');
		$delstring = "DELETE FROM tbl_user WHERE user_id={$id}";
		//echo $delstring;
		$delquery = mysqli_query($link, $delstring);
		if($delquery) {
			redirect_to("../admin_deleteUser.php");
		} else {
			$message = "This person does not want to leave, call the police...";	
		}
		
		mysqli_close($link);
	}
	
?>