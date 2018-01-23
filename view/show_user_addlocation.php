<?php
if (!isset($_SESSION)) session_start();
include $conf->root_path.'/view/header.php';
?>
<style>
#required {
  display: none;
}
</style>

<header>
<div class="container">
<div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <h4 class="text-white">O nas</h4>
              <p class="text-muted">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4 class="text-white">Kontakt</h4>
              <ul class="list-unstyled">
                <li><a href="#" class="text-white">Follow on Twitter</a></li>
                <li><a href="#" class="text-white">Like on Facebook</a></li>
                <li><a href="#" class="text-white">Email me</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="#" class="navbar-brand d-flex align-items-center">
            <strong>Nazwa</strong>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
</header>
</div>
<!-- Page Content -->
<div class="container">
    <main role="main">
      <section class="jumbotron text-center" style="color:#333333">
        <div class="container">
          <h2 class="jumbotron-heading" >Home</h2>
          <p class="lead text-muted"> Opis </p>
		<button type="button" class="btn btn-primary btn-lg" id="AddLocation">DODAJ MIEJSCOWOŚĆ</button>
	    <button onclick="geoFindMe()" class="btn btn-danger btn-lg">POKAŻ MOJĄ LOKALIZACJĘ</button>
	 <div id="out"></div>
	 </div>
      </section>
<hr></hr>
</div>
<!-- /.container -->
      <footer class="text-muted">
      <div class="container">
        <p>Nazwa strony &copy; Autorzy: Maciej Ciosk, Anna Grzywnowicz </p>
      </div>
    </footer>

<script>

function geoFindMe() {
  var output = document.getElementById("out");

  if (!navigator.geolocation){
    output.innerHTML = "<p>Geolocation is not supported by your browser</p>";
    return;
  }

  function success(position) {
    var latitude  = position.coords.latitude;
    var longitude = position.coords.longitude;

    output.innerHTML = '<p>Szerokość: ' + latitude + '° <br>Długość geograficzna ' + longitude + '°</p>';
    /*
    var img = new Image();
    img.src = "https://maps.googleapis.com/maps/api/staticmap?center=" + latitude + "," + longitude + "&zoom=13&size=300x300&sensor=false";

    output.appendChild(img);*/
  }

  function error() {
    output.innerHTML = "Unable to retrieve your location";
  }

  output.innerHTML = "<p>Locating…</p>";

  navigator.geolocation.getCurrentPosition(success, error);
}
/*
  $( document ).ready(function() {
    var response = $.ajax({
      type: "POST",
      url: "<?php echo $conf->app_root.'/account/all' ?>",
      dataType : 'json',
      async: false,
      data: {
      },
      success: function(json){
      }
    }).responseText;
    alert(response);
  });
*/

$("#AddLocation").click( function()
  {
    window.location.replace("<?php echo $conf->app_root.'/view/addLocation' ?>");
  }
);
</script>
