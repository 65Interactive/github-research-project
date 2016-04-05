<?php
	//TURN THIS OFF WHEN THE SITE GOES LIVE
	ini_set('display_errors', 1); //need to delete it when put onto online webhost  //Sets the value of a configuration option
	error_reporting(E_ALL); //need to delete it when put onto online webhost
	//
	require_once('includes/init.php');
	$ip = $_SERVER['REMOTE_ADDR']; //The IP address from which the user is viewing the current page.
	//echo $ip;
			
	if(isset($_POST['submit'])) {
		//echo "Submit works.";
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		//echo $username."<br>";
		//echo $password;
		if($username != "" && $password != "") {
			//echo "yup";
			$result = login($username, $password, $ip);
			$message = $result;
		} else {
			//echo "nope";
			$message = "Please fill in the required fields.";
		}
	}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Welcome Company Name</title>
</head>
<body>
Content Management<br><br>
<?php if(!empty($message)){echo $message;} ?>
<form action="admin_login.php" method="post">
	<label>username:</label> 
	<input type="text" name="username" value="">
	<br>
	<label>password:</label>
	<input type="password" name="password" value="">
	<input type="submit" name="submit" value="go">
</form>
</body>
</html>
