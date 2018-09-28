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
	
	$locationQuery = "SELECT * from location";
	$locations = $conn->query($locationQuery);
	
	if ($locations->num_rows > 0) {
		// output data of each row
		$counter = 0;
		while($row = $locations->fetch_assoc()) {
			
			$description = $row["description"];
			//Description in db isn't filled in yet, create a filler description for meta tag
			if ($description == ""){
				$description = $row["name"] . " doesn't have a description in the database yet. Feel free to add your own to help support GoCapture!";
			}
			
			$fileText = 
				'
				<head>
					<title>GoCapture - ' . $row["name"] . '</title>
					<meta name="description" content=" ' . $description . '">
					<meta name="viewport" content="width=device-width, initial-scale=1">
					<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
					  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
					  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
					  <script src="../javascript/location.js"></script>  
					<link rel="stylesheet" type="text/css" href="../css/style.css">
				</head>

				<body background="../Images/background.png">
					<div class="container" style="background-color:white;" border-radius:.25rem!important">

				<?php
					$servername = "159.89.120.122";
					$username = "root";
					$password = "eec554aa0b590b0e19d13facac0ebabbd73339de5251b818";
					$dbname = "gocapture";

					// Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);
					
					$id = 0;
					$lat = 0;
					$lng = 0;
					$name = "";
					$description = "";
					$placeholder = "";
					$hasImage = 0;
					
					$images = array();
					
					
					
					// Check connection
					if ($conn->connect_error) {
						echo\' failed\';
					} 
					else{
						
						$query = "SELECT location.location_id as location_id, name, description, latitude, longitude, gallery.gallery_id as gallery_id from location left join gallery on gallery.location_id = location.location_id where location.location_id = ' . $row["location_id"] . '";
						$results = $conn->query($query);
						
						if ($results->num_rows > 0) {
							// output data of each row
							while($row = $results->fetch_assoc()) {
								$id = $row["location_id"];
								$name = $row["name"];
								$description = $row["description"];
								//Description in db isn\'t filled in yet, create a filler description for meta tag
								if ($description == ""){
									$placeholder = $row["name"] . " doesn\'t have a description in the database yet. Feel free to add your own to help support GoCapture!";
								}
								
								$lat = $row["latitude"];
								$lng = $row["longitude"];
								
								//Check if location has photos
								if ($row["gallery_id"] == ""){
									//no photo
									$hasImage = 0;
								}
								else{
									//photo exists
									$hasImage = 1;
									array_push($images, "http://138.197.162.81/GoCapture/Images/" . $row["gallery_id"] . ".jpg");
								}
							}
							
						}
						
					}

				echo\'
				<div class="jumbotron">
					<!-- Lets Google know that this section can be displayed in a search-->
					<div itemscope>
						<div class="row">
							<div class="col-md-12">
								<h1>\' . $name . \' </h1>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								   <textarea class="form-control headerText" id="description" placeholder="\' . $placeholder . \'">\' . $description . \'</textarea>	<br>						  
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<button onclick="UpdateDescription(\' . $id . \')" type="button" class="btn btn-primary">Update Description</button>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<br>
								<p class="headerText"> Join the GoCapture community today!</p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<a id ="downloadLink"
								    class="btn btn-primary"
									style="margin-bottom: 20px;"
									href="https://itunes.apple.com/us/app/gocapture/id1160876840">Download App</a><br>
									<!-- Get Browser -->
									<script>getMobileOperatingSystem();</script>
							</div>
						</div>
					</div>
				</div>
				\';

				?>

				<div class = "row">
					<div class="col-md-12">
							<div id="myCarousel" class="carousel slide" data-ride="carousel">
						  <!-- Indicators -->
						  <ol class="carousel-indicators">
							<?php
								if (sizeof($images) > 1){
									
									for ($i = 0; $i < sizeof($images); $i++){
										$active = "";
										if ($i == 0){
											$active = "active";
										}
										echo\'
											<li data-target="#myCarousel" data-slide-to="\' . $i . \'" class=\' . $active . \'></li>
										\';
									}
								}
							?>
							
					
						  </ol>

						  <!-- Wrapper for slides -->
						  <div class="carousel-inner">
						  
						  <?php
						  if ($hasImage == 0){
							  echo\'
								<div class="item active">
								  <img src="../Images/noimage.png" >
								</div>
							  \';
						  }
						  else{
							  for ($i = 0; $i < sizeof($images); $i++){
								  $active = "";
								  if ($i == 0){
									  $active = "active";
								  }
								   echo\'
									<div class="item \' . $active . \'">
									  <img src="\' . $images[$i] . \'" >
									</div>
								   \';
							  }
							  
						  }
						  ?>

						  </div>
								  <!-- Left and right controls -->
								  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
									<?php
										 if (sizeof($images) > 1){
											echo\'
												<span class="glyphicon glyphicon-chevron-left"></span>
											\';
										 }
									?>
									<span class="sr-only">Previous</span>
								  </a>
								  <a class="right carousel-control" href="#myCarousel" data-slide="next">
									<?php
										 if (sizeof($images) > 1){
											echo\'
												<span class="glyphicon glyphicon-chevron-right"></span>
											\';
										 }
									?>
									
									<span class="sr-only">Next</span>
								  </a>
							  
						 
						</div>
					</div>
				</div>

					<div id="map_container"></div>
					<div id="map" ></div>
					
					<a href="../locations.php"> Return to Home </a>
						
					<!-- end container -->
					</div>
				<!-- end body -->
				</div>
				</body>

				<script src="https://maps.googleapis.com/maps/api/js?callback=myMap&key=AIzaSyCA4ELTgSMDXIDiq91JXN2RfRDSm5JGmM8"></script>

				<script
				  src="https://code.jquery.com/jquery-3.3.1.js"
				  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
				  crossorigin="anonymous"></script>
				  
				<script>

					$( document ).ready(function() {
						myMap();
					});
					
					function UpdateDescription(id){
						var description = $("textarea#description").val();
						
						if (description == ""){
							alert("Please enter a description");
						}
						else{
							
							$.ajax({
								type: \'POST\',
								url: \'../UpdateDescription\',
								data: { 
									id : id, 
									description : description 
								},
								success: function(msg){
									alert(msg);
								}
							});
							
						}
						
					}

					function myMap() {
					
					<?php
					
						echo\'var lat = \' . $lat . \';\';
						echo\'var lng = \' . $lng . \';\';
						echo\'var name = "\' . $name . \'";\';
					
					?>
					
					
					var mapOptions = {
						center: new google.maps.LatLng(lat, lng),
						zoom: 13,
						mapTypeId: google.maps.MapTypeId.HYBRID
					}
					var map = new google.maps.Map(document.getElementById("map"), mapOptions);
					
					var latLng = {lat: lat, lng: lng};
					var marker = new google.maps.Marker({
						  position: latLng,
						  map: map,
						  title: name
						});
				}
				</script>

				'
			;
			
			$fp = fopen("locationPages/" . str_replace(' ', '_', $row["name"]) . '.php',"wb");
			fwrite($fp,$fileText);
			fclose($fp);
			
			
		}
	}
}





