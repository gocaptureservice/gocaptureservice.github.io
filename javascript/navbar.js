
function setNavBar(rootPath){
	
	if (rootPath == null){
		rootPath = "";
	}
	
	var navHtml = '<div class="row">'
					+'	<div class="col-md-12">'
					+'		<!-- Navigation -->'
					+'		<nav class="navbar navbar-expand-lg navbar-light static-top">'
					+'			<a class="navbar-brand" href="#">'
					+'				  <img id="logo" class="logo" src="' + rootPath + 'icon.png" style="width:100px" alt="">'
					+'				</a>'
					+'			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">'
					+'				  <span class="navbar-toggler-icon"></span>'
					+'				</button>'
					+'			<div class="collapse navbar-collapse" id="navbarResponsive">'
					+'			  <ul class="navbar-nav ml-auto">'
					+'				<li class="nav-item">'
					+'						<a id="homeNav" class="nav-link navButton" href="' + rootPath + 'index.html">Home</a>'
					+'					</li>'
					+'					<li class="nav-item">'
					+'						<a id="locationsNav" class="nav-link navButton" href="' + rootPath + 'locations.html">Locations</a>'
					+'					</li>'
					+'					<li class="nav-item">'
					+'						<a id="serviceNav" class="nav-link navButton" href="' + rootPath + 'service.html">Terms of Service</a>'
					+'					</li>'
					+'					<li class="nav-item">'
					+'						<a id="privacyNav" class="nav-link navButton" href="' + rootPath + 'privacy.html">Privacy Policy</a>'
					+'				</li>'
					+'			  </ul>'
					+'			</div>'
					+'		</nav>'
					+'	</div>'
					+'</div>';
	
	$("#navbar").html(navHtml);
}