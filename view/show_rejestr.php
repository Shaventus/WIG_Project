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
  <h3>UTWÓRZ MOJE KONTO</h3>
  <form id="form">
    <div class="form-group">
      <label for="login">LOGIN</label>
      <input type="text" class="form-control" id="inputLogin" placeholder="Login">
    </div>
    <div class="form-group">
      <label for="password">HASŁO</label>
      <input type="password" class="form-control" id="inputPassword" placeholder="Hasło">
    </div>
    <div class="form-group">
      <label for="email">EMAIL</label>
      <input type="email" class="form-control" id="inputEmail" placeholder="Email">
    </div>
    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Zgadzam się z regulaminem strony</label>
    </div>
    <button type="submit" class="btn btn-primary btn-lg">UTWÓRZ KONTO</button>
    <button type="button" class="btn btn-danger btn-lg" id="Back">POWRÓT DO STRONY LOGOWANIA</button>
  </form>
<hr></hr>
  <div class="alert alert-danger alert-dismissable" id="msg" style="display: none"></div>

<div class="container">
    <main role="main">
      <section class="jumbotron text-center">
        <div class="container">
          <h2 class="jumbotron-heading"  style="color:#333333">REGULAMIN STRONY</h2>
          <p class="lead text-muted"> </p>
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

$( document ).ready(function() {
  $('#form').submit(function(e) {
    e.preventDefault();
    var login = $("#inputLogin").val();
    var pass = $("#inputPassword").val();
    var email = $("#inputEmail").val();
    if(login == '' || pass == '' || email == ''){
			$('#msg').html('Nie wypełniono wszystkich pól');
			$('#msg').show();
			setTimeout(function() {
				$('#msg').fadeOut('fast');
			}, 1000);
		} else {
    var response = $.ajax({
        type: "POST",
        url: "<?php echo $conf->app_root.'/account/registr' ?>",
        dataType : 'json',
        async: false,
        data: {
          login : login,
          pass : pass,
          email : email
        },
        success: function(json){
          if (json[0]['status'] == 'err'){
						$('#msg').html('Wprowadzone dane są nieprawidłowe');
						$('#msg').show();
					}
					else if (json != "0"){
						window.location.replace("<?php echo $conf->app_root.'/view/login' ?>");
					}

          if(json == "0"){
            $('#msg').html('Nazwa konta już jest zajęta');
						$('#msg').show();
          }
        }
      }) .responseText;
      alert(response);
    }
    });

    $("#Back").click( function()
      {
        window.location.replace("<?php echo $conf->app_root.'/view/login' ?>");
      }
    );
});

</script>
