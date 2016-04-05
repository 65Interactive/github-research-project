<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	function single_edit($tbl,$col,$id) {
		$result = getSingle($tbl,$col,$id);
			//print_r($result);
			//mysqli_result Object ( [current_field] => 0 [field_count] => 10 [lengths] => [num_rows] => 1 [type] => 0 )
		$getResult = mysqli_fetch_array($result);
			//print_r($getResult); 
			//Array ( [0] => 1 [movies_id] => 1 [1] => TH_Tremors.jpg [movies_thumb] => TH_Tremors.jpg [2] => Tremors.jpg [movies_fimg] => Tremors.jpg [3] => nobImg.jpg [movies_bimg] => nobImg.jpg [4] => Tremors [movies_title] => Tremors [5] => 1990 [movies_year] => 1990 [6] => A small town gradually becomes aware of a strange creature which picks off people one by one. But what is this creature, and where is it? At the same time, a seismologist is working in the area, she detects tremors. The creature lives underground, and can pop up without warning. Trapped in their town, the town-folk have no escape. [movies_storyline] => A small town gradually becomes aware of a strange creature which picks off people one by one. But what is this creature, and where is it? At the same time, a seismologist is working in the area, she detects tremors. The creature lives underground, and can pop up without warning. Trapped in their town, the town-folk have no escape. [7] => 96 min [movies_runtime] => 96 min [8] => trailer.mp4 [movies_trailer] => trailer.mp4 [9] => 26.99 [movies_price] => 26.99 )			
			//print_r(mysqli_num_fields($result));	//10
		
		echo "<form action=\"includes/edit.php\" method=\"get\">";
		
		echo "<input hidden name=\"tbl\" value=\"{$tbl}\">";
		echo "<input hidden name=\"col\" value=\"{$col}\">";
		echo "<input hidden name=\"id\" value=\"{$id}\">";
		
		for($i=0; $i < mysqli_num_fields($result); $i++) { 	//Get the number of fields in a result
			//Deal with ID
			//Deal with inputs vs textarea
			$dataType = mysqli_fetch_field_direct($result,$i);
			//Fetch meta-data for a single field
			//Returns an object which contains field definition information from the specified result set.
			
			//print_r($dataType);
			//stdClass Object ( [name] => movies_id [orgname] => movies_id [table] => tbl_movies [orgtable] => tbl_movies [def] => [db] => db_bluray_inclass [catalog] => def [max_length] => 1 [length] => 4 [charsetnr] => 63 [flags] => 49699 [type] => 2 [decimals] => 0 ) stdClass Object ( [name] => movies_thumb [orgname] => movies_thumb [table] => tbl_movies [orgtable] => tbl_movies [def] => [db] => db_bluray_inclass [catalog] => def [max_length] => 14 [length] => 50 [charsetnr] => 8 [flags] => 1 [type] => 253 [decimals] => 0 ) movies_thumb
			//stdClass Object ( [name] => movies_fimg [orgname] => movies_fimg [table] => tbl_movies [orgtable] => tbl_movies [def] => [db] => db_bluray_inclass [catalog] => def [max_length] => 11 [length] => 50 [charsetnr] => 8 [flags] => 1 [type] => 253 [decimals] => 0 ) movies_fimg
			//stdClass Object ( [name] => movies_title [orgname] => movies_title [table] => tbl_movies [orgtable] => tbl_movies [def] => [db] => db_bluray_inclass [catalog] => def [max_length] => 7 [length] => 75 [charsetnr] => 8 [flags] => 4097 [type] => 253 [decimals] => 0 ) movies_title
			
			//stdClass Object ( 
				//[name] => movies_year 
				//[orgname] => movies_year 
				//[table] => tbl_movies 
				//[orgtable] => tbl_movies 
				//[def] => [db] => db_bluray_inclass 
				//[catalog] => def 
				//[max_length] => 4 
				//[length] => 20
				//[charsetnr] => 8 
				//[flags] => 4097 
				//[type] => 253 
				//[decimals] => 0 
			//) movies_year
			
			//echo $dataType;
			//echo $fieldName = $dataType->name;
			//echo $fieldType = $dataType->type;
						//movies_id2movies_thumb253movies_fimg253movies_bimg253movies_title253movies_year253movies_storyline252movies_runtime253movies_trailer253movies_price253
			$fieldName = $dataType->name; //The object operator, "->", is used in object scope to access methods and properties of an object. It's meaning is to say that what is on the right of the operator is a member of the object instantiated into the variable on the left side of the operator.
			$fieldType = $dataType->type;
			
			if($fieldName != $col) { //stdClass Object ([name] => movies_id) //$col = "movies_id";
				echo "<label>{$fieldName}</label><br>";
				if($fieldType != "252") {
					echo "<input type=\"text\" name=\"{$fieldName}\" value=\"{$getResult[$i]}\"><br><br>";
				}else{
					echo "<textarea name=\"{$fieldName}\">{$getResult[$i]}</textarea><br><br>";
				}
				//	  1=>'tinyint',
				//    2=>'smallint',
				//    3=>'int',
				//    4=>'float',
				//    5=>'double',
				//    7=>'timestamp',
				//    8=>'bigint',
				//    9=>'mediumint',
				//    10=>'date',
				//    11=>'time',
				//    12=>'datetime',
				//    13=>'year',
				//    16=>'bit',
				//    //252 is currently mapped to all text and blob types (MySQL 5.0.51a)
				//    253=>'varchar',
				//    254=>'char',
				//    246=>'decimal'
			}
		}
		echo "<input type=\"submit\" value=\"Update Content\">";
		echo "</form>";		
	}
?>