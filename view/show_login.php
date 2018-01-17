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

     <main role="main">
       <!-- Main jumbotron for a primary marketing message or call to action -->
       <div class="jumbotron">
         <div class="container">
           <h1 class="display-3">Hello, world!</h1>
           <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
           <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>
         </div>
       </div>

       <div class="container">
         <!-- Example row of columns -->
         <div class="row">
           <div class="col-md-4">
             <h2>Heading</h2>
             <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
             <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
           </div>
           <div class="col-md-4">
             <h2>Heading</h2>
             <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
             <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
           </div>
           <div class="col-md-4">
             <h2>Heading</h2>
             <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
             <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
           </div>
         </div>

         <hr>

       </div> <!-- /container -->

<div class="bd-pageheader">
  <h1>Logowanie</h1>
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
    <button type="button" class="btn btn-danger btn-lg" id="button">Rejestracja</button>
  </form>

  <div class="alert alert-danger alert-dismissable" id="msg" style="display: none"></div>

</div>
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
