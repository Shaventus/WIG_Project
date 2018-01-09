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

  <form>
    <div class="form-group">
      <label for="login">LOGIN</label>
      <input type="text" class="form-control" id="login" placeholder="Login">
    </div>
    <div class="form-group">
      <label for="password">HASŁO</label>
      <input type="password" class="form-control" id="password" placeholder="Hasło">
    </div>
    <div class="form-group">
      <label for="email">EMAIL</label>
      <input type="email" class="form-control" id="email" placeholder="Email">
    </div>
    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Zgadzam się z regulaminem strony</label>
    </div>
    <button type="submit" class="btn btn-primary btn-lg">UTWÓRZ KONTO</button>
    <button type="button" class="btn btn-danger btn-lg">POWRÓT DO STRONY LOGOWANIA</button>
  </form>
</div>

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
