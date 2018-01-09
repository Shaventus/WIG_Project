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
  <form>
    <div class="form-group">
      <label for="login">LOGIN</label>
      <input type="text" class="form-control" id="login" placeholder="Login">
    </div>
    <div class="form-group">
      <label for="password">HASŁO</label>
      <input type="password" class="form-control" id="password" placeholder="Hasło">
    </div>
    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Zgadzam się z regulaminem strony</label>
    </div>
    <button type="submit" class="btn btn-primary">ZALOGUJ</button>
  </form>

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
