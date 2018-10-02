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
			//Description in db isn\'t filled in yet, create a filler description for meta tag
			if ($description == ""){
				$description = $row["name"] . " doesn\'t have a description in the database yet. Feel free to add your own to help support GoCapture!";
			}
			
			$fileText = 
				'
					<html>
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

					<body background="../images/background.png">
						<div class="container" style="background-color:white;" border-radius:.25rem!important">

							<div id="content">
							
							</div>
							 
						</div>
					</body>

					<script src="https://maps.googleapis.com/maps/api/js?callback=myMap&key=AIzaSyCA4ELTgSMDXIDiq91JXN2RfRDSm5JGmM8"></script>

					<script
					  src="https://code.jquery.com/jquery-3.3.1.js"
					  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
					  crossorigin="anonymous"></script>
					  
					<script>

						$( document ).ready(function() {
						
							$.ajax({
								type: \'POST\',
								url: \'http://159.89.120.122/getLocation.php\',
								data: { 
									locationId : ' . $row["location_id"] . ', 
								},
								success: function(locationJSON){
									var location = JSON.parse(locationJSON);
									SetHtmlText(location);
								}
								
							});
						
							
						});
						
						function SetHtmlText(location){
							var locationId = location["location_id"];
							var galleryId = location["gallery_id"];
							var lat = location["latitude"];
							var lng = location["longitude"];
							var name = location["name"];
							var description = location["description"];
							var placeholder = "";
							var hasImage = false;
							var images = [];
							
							//Description in db isn\'t filled in yet, create a filler description for meta tag
							if (description == ""){
								placeholder = name + " doesn\'t have a description in the database yet. Feel free to add your own to help support GoCapture!";
							}
							
							//Check if location has photos
							if (galleryId == null){
								//no photo
								hasImage = false;
							}
							else{
								//photo exists
								hasImage = true;
								images.push("http://138.197.162.81/GoCapture/images/" + galleryId + ".jpg");
							}
							
							var htmlText = "";
							
							htmlText += \'<div class="jumbotron">\'
										+\'<!-- Lets Google know that this section can be displayed in a search-->\'
										+\'<div itemscope>\'
										+\'	<div class="row">\'
										+\'		<div class="col-md-12">\'
										+\'			<h1>\' + name + \' </h1>\'
										+\'		</div>\'
										+\'	</div>\'
										+\'	<div class="row">\'
										+\'		<div class="col-md-12">\'
										+\'			   <textarea class="form-control headerText" id="description" placeholder="\' + placeholder + \'">\' + description + \'</textarea>	<br>\'					  
										+\'		</div>\'
										+\'	</div>\'
										+\'	<div class="row">\'
										+\'		<div class="col-md-12">\'
										+\'			<button onclick="UpdateDescription(\' + locationId + \')" type="button" class="btn btn-primary">Update Description</button>\'
										+\'		</div>\'
										+\'	</div>\'
										+\'	<div class="row">\'
										+\'		<div class="col-md-12">\'
										+\'			<br>\'
										+\'			<p class="headerText"> Join the GoCapture community today!</p>\'
										+\'		</div>\'
										+\'	</div>\'
										+\'	<div class="row">\'
										+\'		<div class="col-md-12">\'
										+\'			<a id ="downloadLink"\'
										+\'				class="btn btn-primary"\'
										+\'				style="margin-bottom: 20px;"\'
										+\'				href="https://itunes.apple.com/us/app/gocapture/id1160876840">Download App</a><br>\'
										+\'		</div>\'
										+\'	</div>\'
										+\'</div>\'
										+\'</div>\'
									
										+\'<div class = "row">\'
										+\'	<div class="col-md-12">\'
										+\'			<div id="myCarousel" class="carousel slide" data-ride="carousel">\'
										+\'		  <!-- Indicators -->\'
										+\'		  <ol class="carousel-indicators">\';
											  
										
									if (images.length > 1){
										
										for (var i = 0; i < images.length; i++){
											var active = "";
											if (i == 0){
												active = "active";
											}
												htmlText += \'<li data-target="#myCarousel" data-slide-to="\' + i + \'" class=\' + active + \'></li>\';
										}
									}
									
									htmlText += \'</ol>\'
											 +  \'<!-- Wrapper for slides -->\'
											 +	\'<div class="carousel-inner">\';
												 
									if (hasImage == false){
										htmlText += \'<div class="item active">\'
												 + 		\'<img src="../images/noimage.png" >\'
												 + 		\'</div>\';
																				
									}
									else{
										for (var i = 0; i < images.length; i++){
											var active = "";
											if (i == 0){
												active = "active";
											}
											htmlText    +=\'<div class="item \' + active + \'">\'
														+ \'  <img src="\' + images[i] + \'" >\'
														+ \'</div>\';
										}
										  
									}
									
									htmlText+=\' </div>\'
											+ \'	  <!-- Left and right controls -->\'
											+ \'	  <a class="left carousel-control" href="#myCarousel" data-slide="prev">\';
										
									if (images.length > 1){
										htmlText += \'<span class="glyphicon glyphicon-chevron-left"></span>\';
									}
										
									htmlText += \'<span class="sr-only">Previous</span>\'
											 +  \'</a>\'
											 +  \'<a class="right carousel-control" href="#myCarousel" data-slide="next">\';
										
									if (images.length > 1){
										htmlText += \'<span class="glyphicon glyphicon-chevron-right"></span>\';
									}
										
									htmlText+=\' 			<span class="sr-only">Next</span>\'
											 +\' 			</a>\'
											 +\'		</div>\'
											 +\'	</div>\'
											 +\'</div>\'
											 +\'		<div id="map_container"></div>\'
											 +\'		<div id="map" ></div>\'
											 +\'		<a href="../locations.html"> Return to Home </a>\'
											 +\'		<!-- end container -->\'
											 +\'		</div>\';
								
									
								
							$(\'#content\').html(htmlText);
							
							// Get Browser
							getMobileOperatingSystem();
							
							myMap(lat,lng,name);
						}
						
						function UpdateDescription(id){
							var description = $("textarea#description").val();
							
							if (description == ""){
								alert("Please enter a description");
							}
							else{
								
								$.ajax({
									type: \'POST\',
									url: \'http://159.89.120.122/updateDescription.php\',
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

						function myMap(lat, lng, name) {
						
							var latLng = new google.maps.LatLng(lat, lng);
						
							var mapOptions = {
								center: latLng,
								zoom: 13,
								mapTypeId: google.maps.MapTypeId.HYBRID
							}
							var map = new google.maps.Map(document.getElementById("map"), mapOptions);
							
							
							var marker = new google.maps.Marker({
								  position: latLng,
								  map: map,
								  title: name
							});
						}
									</script>
					</html>
				'
			;
			
			if (!file_exists('../gocaptureservice.github.io/locationPages')){
				mkdir('../gocaptureservice.github.io/locationPages',0777,true);
			}
			
			$fp = fopen("../gocaptureservice.github.io/locationPages/" . str_replace(' ', '_', $row["name"]) . '.html',"wb");
			fwrite($fp,$fileText);
			fclose($fp);
			
			
		}
	}
}





