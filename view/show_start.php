<?php
if (!isset($_SESSION)) session_start();
include $conf->root_path.'/view/header.php';
?>
<style>
#required {
  display: none;
}
</style>

<!-- Page Content -->
<div class="container">
<h1>menu czy coś z przejsciem do panelu użytkowniak</h1>
<h1>Przycisk dodania miejscowości</h1>
<h1>Tu jakieś wyszukiwanie</h1>
<h1>elementy w jakich miejscowości mają być wyświetlane</h1>

<p><button onclick="geoFindMe()">Show my location</button></p>
<div id="out"></div>

</div>
<!-- /.container -->

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

    var img = new Image();
    img.src = "https://maps.googleapis.com/maps/api/staticmap?center=" + latitude + "," + longitude + "&zoom=13&size=300x300&sensor=false";

    output.appendChild(img);
  }

  function error() {
    output.innerHTML = "Unable to retrieve your location";
  }

  output.innerHTML = "<p>Locating…</p>";

  navigator.geolocation.getCurrentPosition(success, error);
}

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

</script>
