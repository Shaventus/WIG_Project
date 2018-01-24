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
</div>
<!-- Page Content -->
<div class="container">
    <main role="main">
      <section class="jumbotron text-center" style="color:#333333">
        <div class="container">
                   <h1 class="jumbotron-heading" style="color:#333333"><i class="fa fa-camera-retro" aria-hidden="true"></i></h1>
		  <p class="lead text-muted">HOME. Główna strona aplikacji. Tabela pokazuje miejscowości wraz ze szczegółową lokalizacją. W celu dodania nowej miejscowości bądź sprawdzenia własnej lokalizacji należy skorzystać z poniższych opcji.</p>   
		</div>
      </section>
<hr></hr>
<button type="button" class="btn btn-primary" id="AddLocation">DODAJ MIEJSCOWOŚĆ</button>
	    <button onclick="geoFindMe()" class="btn btn-danger">POKAŻ MOJĄ LOKALIZACJĘ</button>
		<div id="out"></div>
<hr></hr>		
      <table class="table">
      <thead>
        <tr>
          <th scope="col">Miejscowość</th>
          <th scope="col">Szerokość</th>
          <th scope="col">Długość</th>
          <th scope="col">Opcje</th>
        </tr>
      </thead>
      <tbody class ="loc-wrap">
      </tbody>
    </table>
<hr></hr>
</div>
<!-- /.container -->
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

$( document ).ready(function() {
  var dataA = null;
  var response = $.ajax({
    type: "POST",
    url: "<?php echo $conf->app_root.'/account/locall' ?>",
    dataType : 'json',
    async: false,
    data: {
    },
    success: function(json){
      for (var i = 0; i < json.length; i++) {
        var el = "<tr><td>" + json[i]['name'] +"</td><td>" + json[i]['latitude'] +"</td><td>" + json[i]['longitude'] +"</td><td><button class='btn selectCity' data-id=" + json[i]['idLocalization'] + " name='Przycisk'>Przycisk</button></td></tr>";
        $(el).hide().prependTo('.loc-wrap').fadeIn(1000);
      }

    }
  }).responseText;
  //alert(response);
});


$("#AddLocation").click( function()
  {
    window.location.replace("<?php echo $conf->app_root.'/view/addLocation' ?>");
  }
);

$( document ).on('click', '.selectCity' , function(event){
  console.log($(this).data('id'));
  var iddata = $(this).data().id;
  window.location.replace("<?php echo $conf->app_root.'/view/editLocation/' ?>" + iddata);
  //alert(response);
});
</script>
