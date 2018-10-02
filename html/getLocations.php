		

<?php
	$servername = "159.89.120.122";
	$username = "root";
	$password = "eec554aa0b590b0e19d13facac0ebabbd73339de5251b818";
	$dbname = "gocapture";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	$locations = [];
	// Check connection
	if ($conn->connect_error) {
		echo' failed';
	} 
	else{
		
		$query = "SELECT * from location ";
		$results = $conn->query($query);
		
		if ($results->num_rows > 0) {	
			
			// output data of each row
			while($row = $results->fetch_assoc()) {
							
				$locations[] = $row;
				
			}
			
		}
		
	}
	echo json_encode($locations);
?>
		
