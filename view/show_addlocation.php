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
              <h4 class="text-white">O NAS</h4>
              <p>Aplikacja dotyczy fotografii, korzysta z technologii AJAX wraz z elementami języka JavaScript (jQuery).</p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4 class="text-white">KONTAKT</h4>
              <ul class="list-unstyled">
				<p>W przypadku pytań, uwag, wątpliwości lub sugestii proszę skontaktować się z autorami strony.</p>
                <li><a href="#" class="text-white">Email</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="#" class="navbar-brand d-flex align-items-center">
            <strong>Panda3App</strong>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
	  </div>
    </header>
<div class="container">
	<hr></hr>
    <main role="main">
      <section class="jumbotron text-center">
        <div class="container">
          <h2 class="jumbotron-heading"  style="color:#333333"><i class="fa fa-plus-square" aria-hidden="true"></i></h2>
          <p class="lead text-muted">Dodawanie lokalizacji.</p>
        </div>
      </section>
</div>
<div class="container">
<hr></hr>
  <button onclick="geoFindMe()" class="btn btn-danger btn-lg">POKAŻ MOJĄ LOKALIZACJĘ</button>
  <div id="out"></div>
<hr></hr>
  <h3>UTWÓRZ NOWĄ MIEJSCOWOŚĆ</h3>
  <form id="form">
    <div class="form-group">
      <label for="login">Nazwa miejscowości</label>
      <input type="text" class="form-control" id="inputLogin" placeholder="Nazwa miejscowości">
    </div>
    <button type="submit" class="btn btn-primary btn-lg">DODAJ MIEJSCOWOŚĆ</button>
    <button type="button" class="btn btn-danger btn-lg" id="Back">POWRÓT NA STRONE GŁOWNĄ</button>
  </form>
<hr></hr>
  <div class="alert alert-danger alert-dismissable" id="msg" style="display: none"></div>
	
	      <footer class="text-muted">
      <div class="container">
				<?php
					if (isset($_SESSION["name"])){
						echo '<p>Zalogowany jako: <strong class="btn-default">'.$_SESSION["name"]. '      </strong>    <a class="btn-danger" href="'.$conf->app_root.'/logout'.'">Wyloguj</a></p>';
					}
					?>
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

    output.innerHTML = '<h3 id="lat">Szerokość: ' + latitude + '°</h3><h3 id="long" >Długość geograficzna ' + longitude + '°</h3>';
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

$( document ).ready(function() {

    $("#Back").click( function()
      {
        window.location.replace("<?php echo $conf->app_root.'/view/start' ?>");
      }
    );
});

</script>
