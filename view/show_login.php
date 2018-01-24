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
    <main role="main">

      <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading" style="color:#333333"><i class="fa fa-camera-retro" aria-hidden="true"></i></h1>
          <p class="lead text-muted">Aplikacja dotyczy fotografii, korzysta z technologii AJAX wraz z elementami języka JavaScript (jQuery).</p>   
        </div>
      </section>

	<hr></hr>
       <div class="container">
         <!-- Example row of columns -->
         <div class="row">
           <div class="col-md-6">
             <h3>FUNKCJONALNOŚCI*</h3>
			 <h4> - dodawanie miejscowości</h4>
			 <h4> - edycja i usuwanie dodanych miejscowości</h4>
			 <h4> - wyszukiwarka działająca w czasie rzeczywistym</h4>
			 <h4> - wykresy</h4>
           </div>
           <div class="col-md-6">
             <h3>MODUŁY*</h3>
			 <h4> - geolokalizacja IP</h4>
             <h4> - pobieranie/wyliczanie czasu(niebieska oraz złota godzina dla konkretnego dnia domyślnie - dzisiejszego) </h4>
           <small> * Strona jest stale rozwijana, część elementów może nie być dostępna </small>
		   </div>
         </div>
       </div> <!-- /container -->

<hr></hr>

  <h3>LOGOWANIE</h3>
  <form id="form">
    <div class="form-group">
      <label for="login">LOGIN</label>
      <input type="text" class="form-control" id="inputLogin" placeholder="Login">
    </div>
    <div class="form-group">
      <label for="password">HASŁO</label>
      <input type="password" class="form-control" id="inputPassword" placeholder="Hasło">
    </div>
    <button type="submit" class="btn btn-primary">ZALOGUJ</button>
    <button type="button" class="btn btn-danger" id="button">REJESTRACJA</button>
	<p></p>
	<div class="alert alert-danger alert-dismissable" id="msg" style="display: none"></div>
	<hr></hr>
	</div>
  </form>

      <footer class="text-muted">
      <div class="container">
        <p>Panda3App &copy; Autorzy: Maciej Ciosk, Anna Grzywnowicz </p>
      </div>
    </footer>

</div>

<script>

$( document ).ready(function() {
  $('#form').submit(function(e) {
    e.preventDefault();
    var login = $("#inputLogin").val();
    var pass = $("#inputPassword").val();
    console.log(login + ":" + pass);
    if(login == '' || pass == ''){
			$('#msg').html('Nie wypełniono wszystkich pól');
			$('#msg').show();
			setTimeout(function() {
				$('#msg').fadeOut('fast');
			}, 1000);
		} else {
    var response = $.ajax({
        type: "POST",
        url: "<?php echo $conf->app_root.'/login' ?>",
        dataType : 'json',
        async: false,
        data: {
          login : login,
          pass : pass
        },
        success: function(json){
          if (json[0]['status'] == 'err'){
						$('#msg').html('Wprowadzone dane są nieprawidłowe');
						$('#msg').show();
						$("#inputPassword").val('');
						$("#inputPassword").prop('disabled', true);
						$('#login').attr('disabled','disabled');
						setTimeout(function() {
							$('#msg').fadeOut('slow');
							$('#login').removeAttr('disabled');
							$("#inputPassword").prop('disabled', false);
						}, 5000);
					}
					else if (json[0]['status'] == 'ok'){
						window.location.replace("<?php echo $conf->app_root.'/view/start' ?>");
					}
        }
      }) .responseText;
      //alert(response);
    }
    });
    $("#button").click( function()
      {
        window.location.replace("<?php echo $conf->app_root.'/view/registr' ?>");
      }
    );
});


</script>
