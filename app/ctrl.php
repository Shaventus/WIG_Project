<?php
require_once dirname (__FILE__).'/../config.php';
require_once $conf->root_path.'/app/database/DatabaseCtrl.class.php';

// Split address to $_GET params format: $params[0], $params[1] etc.
$request = str_replace($conf->app_root."/", "", $_SERVER['REQUEST_URI']);
$params = mb_split("/", $request);

// View routing
if ($params[0] == "view"){
	if ($params[1] == "start"){
		include_once $conf->root_path.'/app/show/ShowCtrl.class.php';
		$ctrl = new ShowCtrl(null);
		$ctrl->showStart();
	}
}
?>
