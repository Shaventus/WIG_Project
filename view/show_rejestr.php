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
<div class="bd-pageheader">
  <h2>UTWÓRZ MOJE KONTO</h2>

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
</div>

  <div class="alert alert-danger alert-dismissable" id="msg" style="display: none"></div>

<div class="bd-pageheader2">
    <!-- Example row of columns -->
    <div class="row">
      <div class="col-md-6">
        <h2>Regulamin strony</h2>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
      </div>
      <div class="col-md-6">
        <h2>O nas</h2>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
      </div>
</div>

</div>

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
						$("#inputPassword").val('');
						$("#inputPassword").prop('disabled', true);
						setTimeout(function() {
							$('#msg').fadeOut('slow');
							$("#inputPassword").prop('disabled', false);
						}, 5000);
					}
					else if (json[0]['status'] == 'ok'){
						window.location.replace("<?php echo $conf->app_root.'/view/login' ?>");
					} else if(json == "0"){
            $('#msg').html('Nazwa konta już jest zajęta');
						$('#msg').show();
						$("#inputPassword").val('');
						$("#inputPassword").prop('disabled', true);
          }
        }
      }) .responseText;
      //alert(response);
    }
    });

    $("#Back").click( function()
      {
        window.location.replace("<?php echo $conf->app_root.'/view/login' ?>");
      }
    );
});

</script>
