
function setFooter(rootPath){
	if (rootPath == null){
		rootPath = "";
	}
	var footerHtml = '<link rel="stylesheet" type="text/css" href="' + rootPath + 'css/socialMediaIcons.css">'
					+'<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">'
					+'<div id="footer">'
					+' <div class="container-fluid bg-dark py-3">'
					+'    <div class="container">'
					+'      <div class="row">'
					+'		<div class="col-md-12 text-center">'
					+'			<div class="d-inline-block">'
					+'			    <a href="http://instagram.com/gocapture_app" target="_blank" class="btn-social btn-instagram"><i class="fa fa-instagram"></i></a>'
					+'           </div>'
					+'           <div class="d-inline-block">'
					+'				<a href="https://www.facebook.com/GoCaptureapp/" target="_blank" class="btn-social btn-facebook"><i class="fa fa-facebook"></i></a>'
					+'           </div>'
					+'         <div class="d-inline-block">'
					+'            <a href="mailto:kirkleary@gmail.com" target="_blank" class="btn-social btn-google-plus"><i class="fa fa-envelope align-middle"></i></a>'
					+'            </div>'
					+'        </div>  '
					+'      </div>'
					+'     </div>'
					+'  </div>'
					+'</div>';
	$("#footer").html(footerHtml);
}
	
	


        

  
 