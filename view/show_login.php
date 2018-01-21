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
	  </div>
    </header>
<div class="container">
    <main role="main">

      <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading" style="color:#333333">Album example</h1>
          <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
          <p>
            <a href="#" class="btn btn-primary my-2">Main call to action</a>
            <a href="#" class="btn btn-danger my-2">Secondary action</a>
          </p>
        </div>
      </section>
     
	<hr></hr>
       <div class="container">
         <!-- Example row of columns -->
         <div class="row">
           <div class="col-md-6">
             <h2>Heading</h2>
             <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
           </div>
           <div class="col-md-6">
             <h2>Heading</h2>
             <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
           </div>
         </div>
       </div> <!-- /container -->

<hr></hr>

  <h1>LOGOWANIE</h1>
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
	<div class="alert alert-danger alert-dismissable" id="msg" style="display: none"></div>
	<hr></hr>
	</div>
  </form>
  
      <footer class="text-muted">
      <div class="container">
        <p>Nazwa strony &copy; Autorzy: Maciej Ciosk, Anna Grzywnowicz </p>
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
