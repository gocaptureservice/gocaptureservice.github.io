		

<?php
	$servername = "159.89.120.122";
	$username = "root";
	$password = "eec554aa0b590b0e19d13facac0ebabbd73339de5251b818";
	$dbname = "gocapture";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	$locationId = $_POST["locationId"];
	
	// Check connection
	if ($conn->connect_error) {
		echo' failed';
	} 
	else{
		
		$query = "SELECT location.location_id as location_id, name, description, latitude, longitude, gallery.gallery_id as gallery_id from location
					left join gallery on gallery.location_id = location.location_id 
					where location.location_id = " . $locationId;
		$results = $conn->query($query);
		
		if ($results->num_rows > 0) {	
			
			// output data of each row
			while($row = $results->fetch_assoc()) {			
				echo json_encode($row);
			}
			
		}
		
	}
	
?>
		
