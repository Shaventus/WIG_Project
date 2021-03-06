<?php require_once dirname(__FILE__) .'/../config.php';
if (!isset($_SESSION)){
		session_start();
	}
?>

<!DOCTYPE html>
<html lang="pl" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>violin - php framework | your code sounds great</title>

		<link href='http://fonts.googleapis.com/css?family=Advent+Pro&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Lato:300,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,600,700' rel='stylesheet' type='text/css'>
		<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>


		<?php
		echo'



			<script type="text/javascript" src="'.$conf->app_root.'/js/jquery.cookie.js"></script>
			<link rel="stylesheet" type="text/css" href="'.$conf->app_root.'/css/jquery.cookie.css" />

			<link rel="stylesheet" type="text/css" href="'.$conf->app_root.'/css/special/demo.css" />
			<link rel="stylesheet" type="text/css" href="'.$conf->app_root.'/css/special/form.css" />
      <link rel="stylesheet" type="text/css" href="'.$conf->app_root.'/css/style.css" />
		';

		?>
<style>
.boldGray{
	font-weight: bold;
	color: gray;
}
.no-bullet{
	list-style: none;
}
.horizontal-list{
	float: left;
}
.marked{
	text-decoration: underline;
	font-weight: bold;
}
</style>


	</head>
    <body>
	<p></p>
	<?php
	if (isset($_SESSION["name"])){
		echo '<div class="container">';
		echo '<ul class="nav nav-tabs">';
  	echo '	<li class="nav-item">';
    echo '		<a class="nav-link active" id="home" href="'.$conf->app_root.'/view/start'.'">Home</a>';
  	echo '	</li>';
		echo '	</li>';
		echo '		<li class="nav-item">';
		echo '		<a class="nav-link" id="logout" href="'.$conf->app_root.'/view/userloca'.'">Miejscowości użytkownika</a>';
		echo '	</li>';
  	echo '	<li class="nav-item">';
    echo '		<a class="nav-link" id="userPanel" href="'.$conf->app_root.'/view/userpanel'.'"> Panel użytkownika</a>';
  	echo '	</li>';
    echo '		<li class="nav-item">';
    echo '		<a class="nav-link" id="logout" href="'.$conf->app_root.'/logout'.'">Wyloguj</a>';
  	echo '	</li>';
		echo '	</li>';
		echo '		<li class="nav-item">';
		echo '		<a class="nav-link">Zalogowany jako: '.$_SESSION["name"]. '</a>';
		echo '	</li>';
		echo '</ul>';
		echo '</div>';
		}
		?>
