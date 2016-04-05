<?php
	//echo "login";
	function login($username, $password, $ip) {
		//echo "from login function";
		require_once('connect.php'); //include, with mysqli_close
		$username = mysqli_real_escape_string($link, $username);
		$password = mysqli_real_escape_string($link, $password);
		//mysqli_real_escape_string. This function is used to create a legal SQL string that you can use in an SQL statement. The given string is encoded to an escaped SQL string, taking into account the current character set of the connection.
		//mysql_real_escape_string — Escapes special characters in a string for use in an SQL statement
		
		$loginstring = "SELECT * FROM tbl_user WHERE user_name = '{$username}' AND user_pass = '{$password}'";
		//echo $loginstring;
		$user_set = mysqli_query($link, $loginstring); //Shut down automatically after get data by using with "require_once('admin/includes/connect.php')";
		//echo mysqli_num_rows($user_set);
		if(mysqli_num_rows($user_set)) {
			//echo "Found a user.";
			$found_user = mysqli_fetch_array($user_set, MYSQLI_ASSOC);
			$id = $found_user['user_id'];
			//echo $id;
			
			$_SESSION['user_id'] = $id;
			$_SESSION['user_name'] = $found_user['user_name']; //to maintain URL refresh stay
			
			if(mysqli_query($link, $loginstring)) {
				$updatestring = "UPDATE tbl_user SET user_ip='{$ip}' WHERE user_id={$id}";
				//echo $updatestring;
				$updatequery = mysqli_query($link, $updatestring);
			}
			redirect_to("admin_index.php");
		} else {
			//echo "No user found.";
			$message = "Username/Password combination was incorrect.<br>Please make sure that your cap locks key is turned off.";
			return $message;	
		}
		
		mysqli_close($link); //Closes a previously opened database connection by using include();
	}
?>