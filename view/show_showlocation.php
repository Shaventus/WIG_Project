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
  <h2>MIEJSCOWOŚĆ</h2>

  <!-- <button onclick="geoFindMe()" class="btn btn-danger btn-lg">POKAŻ LOKALIZACJĘ MIEJSCOWOŚCI</button>  -->
  <div id="out">
    <h3 id="lat"></h3> <h3 id="long"> </h3> <h3 id="inputloc"></h3>
  </div>
<hr></hr>
  <div class="alert alert-danger alert-dismissable" id="msg" style="display: none"></div>

<div class="container">
    <main role="main">
      <section class="jumbotron text-center">
        <div class="container">
          <h2 class="jumbotron-heading"  style="color:#333333"><i class="fa fa-image"></i></h2>
          <p class="lead text-muted"> Zdjęcia dotyczące owej lokalizacji.</p>
        </div>
      </section>
</div>
<hr></hr>
      <footer class="text-muted">
      <div class="container">
        <p>Panda3App &copy; Autorzy: Maciej Ciosk, Anna Grzywnowicz </p>
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
  <?php
        $request = str_replace($conf->app_root."/", "", $_SERVER['REQUEST_URI']);
        $params = mb_split("/", $request);
   ?>

   console.log(<?php echo $params[2]; ?>);

     var response = $.ajax({
       type: "POST",
       url: "<?php echo $conf->app_root.'/account/loccu' ?>",
       dataType : 'json',
       async: false,
       data: {
         id : "<?php echo $params[2]; ?>"
       },
       success: function(json){
         //console.log(json[0]['name'])
         $('#inputloc').append("Nazwa miejscowości: " + json[0]['name']);
         $('#lat').append("Szerokość: " + json[0]['latitude'] + "°");
         $('#long').append("Długość geograficzna: " + json[0]['longitude'] + "°");
       }
     }).responseText;
     //alert(response);

    $("#Back").click( function()
      {
        window.location.replace("<?php echo $conf->app_root.'/view/start' ?>");
      }
    );


});

</script>
