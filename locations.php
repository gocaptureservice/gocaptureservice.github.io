<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../Css/style.css">
</head>

<body background="Images/background.png">
	<div class="container" style="background-color:white; border-radius:.25rem!important">
		<div class="jumbotron">
			<div class="row">
				<div class="col-md-12">
					<h1>Locations</h1>
				</div>
			</div>	
		</div>
					
				

<?php
	$servername = "159.89.120.122";
	$username = "root";
	$password = "eec554aa0b590b0e19d13facac0ebabbd73339de5251b818";
	$dbname = "gocapture";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	// Check connection
	if ($conn->connect_error) {
		echo' failed';
	} 
	else{
		
		$query = "SELECT * from location ";
		$results = $conn->query($query);
		
		if ($results->num_rows > 0) {	
			
			$columnsTaken = 0;
			$numColumns = 4;
			$firstRow = 1;
			
			echo'
				<div class="row">
			';
			
			// output data of each row
			while($row = $results->fetch_assoc()) {
							
				
				
				if ($columnsTaken >= 12 && $firstRow == 0){
					
					$columnsTaken = 0;
					
					echo'
						</div>
						<div class="row">
					';
					$firstRow == 0;
				}
			
				echo'
				
					
				
					<div class="col-sm-' . $numColumns . '">
						<h3 style=\'align="center"\'><a href=locationPages/' . str_replace(' ', '_', $row["name"]) . '.php>' . $row["name"] . '</a> </h3>
					</div>
				';
				
				
				
				$columnsTaken .= $numColumns;
				
				
				
			}
			
			//End the last row
			echo '
				</div>
			';
			
		}
		
	}
?>
		
	<!-- container -->
	</div>
<body>