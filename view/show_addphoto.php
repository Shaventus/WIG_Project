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
  <?php

print_r($_POST);
print_r($_FILES);
?>

<hr></hr>
  <h3>DODAJ ZDJĘCIE</h3>
  <form id="form" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="login">Opis zdjęcia</label>
      <textarea type="text" class="form-control" id="inputdescription" name="description" placeholder="Opis"></textarea>
    </div>
    <div class="form-group">
      Wybierz zdjęcie do dodania:
      <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
    </div>
    <button type="submit" class="btn btn-primary btn-lg" value="Upload Image" name="submit">DODAJ ZDJĘCIE</button>
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

  <?php
        $request = str_replace($conf->app_root."/", "", $_SERVER['REQUEST_URI']);
        $params = mb_split("/", $request);
   ?>

   $('#form').submit(function(e) {
     e.preventDefault();

     var des = $("#inputdescription").val();

     var formData = new FormData(this);
     formData.set('LocalizatinoID', "<?php echo $params[2]; ?>");
     console.log(formData);
     var response = $.ajax({
         type: "POST",
         url: "<?php echo $conf->app_root.'/view/addphoto/upload.php' ?>",
         async: false,
         data: formData,
         cache: false,
         contentType: false,
         processData: false,
         success: function(data){
           window.location.replace("<?php echo $conf->app_root.'/view/start' ?>");
         }
       }) .responseText;
       //alert(response);


     });

});

</script>
