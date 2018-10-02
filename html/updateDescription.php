<?php
	$servername = "159.89.120.122";
	$username = "root";
	$password = "eec554aa0b590b0e19d13facac0ebabbd73339de5251b818";
	$dbname = "gocapture";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	$id = $_POST["id"];
	$description = $_POST["description"];
	
	$badWord = false;
	
	$lines = explode("\n", file_get_contents('badWords.txt'));
	foreach($lines as $word) {
		
		$word = preg_replace('/\s+/', '', $word);
		if (strpos(strtoupper($description), strtoupper($word)) !== false) {
			$badWord = true;
			break;
		} 
	}
	
	if ($badWord){
		echo "Please do not enter inappropriate language.";
	}
	
	else{
		$sql = "Update location set description = '" . $description . "' where location_id = " . $id;
		if ($conn->query($sql) === TRUE) {
			echo "The description has been updated. Thanks!";
		} else {
			echo "There was an issue with updating the description.";
		}
	}

	
?>