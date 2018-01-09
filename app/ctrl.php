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
	if ($params[1] == "login"){
		include_once $conf->root_path.'/app/show/ShowCtrl.class.php';
		$ctrl = new ShowCtrl(null);
		$ctrl->showLogin();
	}
}

// AJAX requests
if ($params[0] == "account"){
	if ( isset($params[1]) && ($params[1] == "cu") ) {
		global $conf;
		include_once $conf->root_path.'/app/model/AccountCtrl.class.php';
		$ctrl = new AccountCtrl(null);
		$ctrl->getAccount();
	}
	if ( isset($params[1]) && ($params[1] == "all") ) {
		global $conf;
		include_once $conf->root_path.'/app/model/AccountCtrl.class.php';
		$ctrl = new AccountCtrl(null);
		$ctrl->getAccounts();
	}
	if ( isset($params[1]) && ($params[1] == "del") ) {
		global $conf;
		include_once $conf->root_path.'/app/model/AccountCtrl.class.php';
		$ctrl = new AccountCtrl(null);
		$ctrl->delAccount();
	}
	if ( isset($params[1]) && ($params[1] == "set") ) {
		global $conf;
		include_once $conf->root_path.'/app/model/AccountCtrl.class.php';
		$ctrl = new AccountCtrl(null);
		$ctrl->setAccount();
	}

}

?>
