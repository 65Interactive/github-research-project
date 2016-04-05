<?php
	require_once('includes/init.php');
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	$tbl = "tbl_cat";
	$catQuery = getAll($tbl);

	if(isset($_POST['submit'])) {
		//echo "works";
		$fimg = trim($_FILES['movie_fimg']['name']);
		$thumb = "TH_".$fimg;
		$title = trim($_POST['movie_title']);
		$year = trim($_POST['movie_year']);
		$storyline = trim($_POST['movie_storyline']);
		$runtime = trim($_POST['movie_runtime']);
		$trailer = trim($_POST['movie_trailer']);
		$price = trim($_POST['movie_price']);
		$cat = trim($_POST['catlist']);
		$uploadMovie = addMovie($fimg, $thumb, $title, $year, $storyline, $runtime, $trailer, $price, $cat);
		$message = $uploadMovie;
	}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
	<title>Add Movie</title>
</head>
<body>
	<h1>Add Movie</h1>
	<?php if(!empty($message)){echo $message;} ?>
	<form action="admin_addMovie.php" method="post" enctype="multipart/form-data">
		<label>Front Image:</label>
		<input type="file" name="movie_fimg" value=""><br><br>

		<label>Movie Title:</label>
		<input type="text" name="movie_title" value=""><br><br>

		<label>Movie Year:</label>
		<input type="text" name="movie_year" value=""><br><br>

		<label>Movie Storyline:</label>
		<textarea name="movie_storyline"></textarea><br><br>

		<label>Movie Runtime</label>
		<input type="text" name="movie_runtime" value=""><br><br>

		<label>Movie Trailer</label>
		<input type="text" name="movie_trailer" value=""><br><br>

		<label>Movie Price:(Do not add the '$', the system will do this for you)</label>
		<input type="text" name="movie_price" value=""><br><br>

		<label>Select Category:</label>
		<select name="catlist">
			<option>Please select a category...</option>
			<?php
				while($row = mysqli_fetch_array($catQuery)) {
					echo "<option value=".$row['cat_id'].">".$row['cat_name']."</option>";

				}
			?>
		</select><br><br><br>
		<input type="submit" name="submit" value="Add Movie">
	</form>
</body>
</html>