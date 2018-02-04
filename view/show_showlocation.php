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
  <div class="BlueHour1">

  </div>
  <div class="Sunrise">

  </div>
  <div class="GoldenHour1">

  </div>
  <div class="Daytime">

  </div>
  <div class="GoldenHour2">

  </div>
  <div class="Sunset">

  </div>
  <div class="BlueHour2">

  </div>

<hr></hr>
  <div class="alert alert-danger alert-dismissable" id="msg" style="display: none"></div>
<button type="button" class="btn btn-primary" id="AddPhoto">DODAJ ZDJĘCIE</button>
<br></br>
<div class="container">
    <main role="main">
      <section class="jumbotron text-center">
        <div class="container">
          <h2 class="jumbotron-heading"  style="color:#333333"><i class="fa fa-image"></i></h2>
          <p class="lead text-muted"> Zdjęcia dotyczące owej lokalizacji.</p>
        </div>
      </section>
      <br>
      <div class="img-wrap">

      </div>
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

         var response = $.ajax({
           type: "POST",
           url: "https://api.sunrise-sunset.org/json?lat="+ json[0]['latitude'] +"&lng=" + json[0]['longitude'] + '&date=today&formatted=0',
           dataType : 'json',
           async: false,
           data: {
           },
           success: function(data){
             var d = new Date(data['results']['nautical_twilight_begin']);
             var el = '<h2>Niebieska godzina: '+ d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds() + '</h2>';
             $(el).hide().prependTo('.BlueHour1').fadeIn(1000);

             var d = new Date(data['results']['sunrise']);
             var el = '<h2>Wschód słońca: '+ d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds() + '</h2>';
             $(el).hide().prependTo('.Sunrise').fadeIn(1000);

             var d = new Date(data['results']['solar_noon']);
             var el = '<h2>Czas dzienny: '+ d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds() + '</h2>';
             $(el).hide().prependTo('.Daytime').fadeIn(1000);

             var d = new Date(data['results']['civil_twilight_begin']);
             var el = '<h2>Złota godzina: '+ d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds() + '</h2>';
             $(el).hide().prependTo('.GoldenHour1').fadeIn(1000);

             var d = new Date(data['results']['civil_twilight_end']);
             var el = '<h2>Złota godzina: '+ d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds() + '</h2>';
             $(el).hide().prependTo('.GoldenHour2').fadeIn(1000);

             var d = new Date(data['results']['sunset']);
             var el = '<h2>Zachód słońca: '+ d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds() + '</h2>';
             $(el).hide().prependTo('.Sunset').fadeIn(1000);

             var d = new Date(data['results']['nautical_twilight_end']);
             var el = '<h2>Niebieska godzina: '+ d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds() + '</h2>';
             $(el).hide().prependTo('.BlueHour2').fadeIn(1000);
           }
         }).responseText;
       }
     }).responseText;
     //alert(response);

    $("#Back").click( function()
      {
        window.location.replace("<?php echo $conf->app_root.'/view/start' ?>");
      }
    );

    $("#AddPhoto").click( function()
      {
        window.location.replace("<?php echo $conf->app_root.'/view/addphoto/' ?>" + "<?php echo $params[2] ?>");
      }
    );

    var response = $.ajax({
      type: "POST",
      url: "<?php echo $conf->app_root.'/account/locphotos' ?>",
      dataType : 'json',
      async: false,
      data: {
        idLocalization : "<?php echo $params[2]; ?>"
      },
      success: function(json){
        console.log(json)
        for (var i = 0; i < json.length; i++) {
          console.log(json[i]);
          var el = '<img src="<?php echo $conf->app_root;?>/app/data/' + json[i]['path'] + '" class="img-responsive" style="margin: auto"><br></br>';
          $(el).hide().prependTo('.img-wrap').fadeIn(1000);
        }
      }
    }).responseText;
    //alert(response);



});

</script>
