<?php
	function redirect_to($location) {
		if($location != NULL) {
			header("Location: {$location}");
			exit;
		}
	}
	
	function submitMessage($direct, $name, $email, $message) {
			$to = "address";
			$subj = "Message From Customer submitted via site.com";
			$extra = $email."\r\nReply-To: ".$email."\r\n";			
			$msg = "Name: ".$name."\n\nEmail address: ".$email."\n\nComments: ".$message;
			$go = mail($to,$subj,$msg,$extra);
			$direct = $direct."?name={$name}";
			redirect_to($direct);
	}

	function addMovie($fimg, $thumb, $title, $year, $storyline, $runtime, $trailer, $price, $cat) {
		include('connect.php');
		//$fimg = mysqli_real_escape_string($link, $fimg);  //in admin_addMovie.php, $fimg = trim($_FILES['movie_fimg']['name']);

		
		//echo $_FILES['movie_fimg']['name']."<br><br>"; //test_img.jpg     
		//in admin_addMovie.php, $fimg = trim($_FILES['movie_fimg']['name']);    
		
		//echo $_FILES['movie_fimg']['type']."<br><br>"; //image/jpeg
		//echo $_FILES['movie_fimg']['tmp_name']."<br><br>"; //  /Applications/MAMP/tmp/php/php2nIMky


		if($_FILES['movie_fimg']['type'] == "image/jpeg" || $_FILES['movie_fimg']['type'] == "image/jpg") {
			//echo "you win";
			$targetpath = "../images/{$fimg}";

			if(move_uploaded_file($_FILES['movie_fimg']['tmp_name'], $targetpath)) {

				$orig = "../images/{$fimg}";
				$th_copy = "../images/{$thumb}";

				if(!copy($orig, $th_copy)) {
					echo "Failed to copy.";
				}

				//JavaScript library to control images landscape
				//JSON to trim image size

				//$size = getimagesize($orig);
				//echo $size[0]." x ".$size[1]; //1260 x 1156

				$qstring = "INSERT INTO tbl_movies VALUES(NULL,'{$thumb}','{$fimg}','noBG.jpg','{$title}','{$year}','{$storyline}','{$runtime}','{$trailer}','{$price}')";
				//echo $qstring;
				$result = mysqli_query($link, $qstring);
				if($result) {
					$qstring2 = "SELECT * FROM tbl_movies ORDER BY movies_id DESC LIMIT 1";
					//echo $qstring2;
					$result2 = mysqli_query($link, $qstring2);
					$row = mysqli_fetch_array($result2);
					//echo $row['movies_id']; //movies_id: 35
					$lastID = $row['movies_id'];
					$qstring3 = "INSERT INTO tbl_l_mc VALUES(NULL,{$lastID},{$cat})";
					$result3 = mysqli_query($link, $qstring3);
					if($result3){
						redirect_to("admin_index.php");
					} else {
						echo "File upload failed...";
					}
				}
			}
		}
		mysqli_close($link);
	}

	function multiReturns($value) {
		$addPassed = $value;
		$newResult = 6 + $addPassed;
		$newResult2 = $addPassed * 12;
		return array($newResult, $newResult2);
	}
?>