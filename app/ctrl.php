<?php
require_once dirname (__FILE__).'/../config.php';
require_once $conf->root_path.'/app/security/LoginCtrl.class.php';
require_once $conf->root_path.'/app/database/DatabaseCtrl.class.php';

// Split address to $_GET params format: $params[0], $params[1] etc.
$request = str_replace($conf->app_root."/", "", $_SERVER['REQUEST_URI']);
$params = mb_split("/", $request);

// Login routing
if ($params[0] == "login"){
	$ctrl = new LoginCtrl();
	$ctrl->doLogin();
}
if ($params[0] == "logout"){
	$ctrl = new LoginCtrl();
	$ctrl->doLogout();
}

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
	if ($params[1] == "registr"){
		include_once $conf->root_path.'/app/show/ShowCtrl.class.php';
		$ctrl = new ShowCtrl(null);
		$ctrl->showRejestr();
	}
	if ($params[1] == "addLocation"){
		include_once $conf->root_path.'/app/show/ShowCtrl.class.php';
		$ctrl = new ShowCtrl(null);
		$ctrl->showAddLocation();
	}
	if ($params[1] == "editLocation"){
		include_once $conf->root_path.'/app/show/ShowCtrl.class.php';
		$ctrl = new ShowCtrl(null);
		$ctrl->showEditLocation($params[2]);
	}
}

// AJAX requests
if ($params[0] == "account"){
	if ( isset($params[1]) && ($params[1] == "cu") ) {
		global $conf;
		include_once $conf->root_path.'/app/model/AccountCtrl.class.php';
		$ctrl = new AccountCtrl();
		$ctrl->getAccount();
	}
	if ( isset($params[1]) && ($params[1] == "all") ) {
		global $conf;
		include_once $conf->root_path.'/app/model/AccountCtrl.class.php';
		$ctrl = new AccountCtrl();
		$ctrl->getAccounts();
	}
	if ( isset($params[1]) && ($params[1] == "del") ) {
		global $conf;
		include_once $conf->root_path.'/app/model/AccountCtrl.class.php';
		$ctrl = new AccountCtrl();
		$ctrl->delAccount();
	}
	if ( isset($params[1]) && ($params[1] == "set") ) {
		global $conf;
		include_once $conf->root_path.'/app/model/AccountCtrl.class.php';
		$ctrl = new AccountCtrl();
		$ctrl->setAccount();
	}
	if ( isset($params[1]) && ($params[1] == "registr") ) {
		global $conf;
		include_once $conf->root_path.'/app/model/AccountCtrl.class.php';
		$ctrl = new AccountCtrl();
		$ctrl->doRegistr();
	}

	if ( isset($params[1]) && ($params[1] == "locall") ) {
		global $conf;
		include_once $conf->root_path.'/app/model/LocalizationCtrl.class.php';
		$ctrl = new LocalizationCtrl();
		$ctrl->getLocalizations();
	}

	if ( isset($params[1]) && ($params[1] == "loccu") ) {
		global $conf;
		include_once $conf->root_path.'/app/model/LocalizationCtrl.class.php';
		$ctrl = new LocalizationCtrl();
		$ctrl->getLocalization();
	}
	if ( isset($params[1]) && ($params[1] == "locdel") ) {
		global $conf;
		include_once $conf->root_path.'/app/model/LocalizationCtrl.class.php';
		$ctrl = new LocalizationCtrl();
		$ctrl->delLocalization();
	}
	if ( isset($params[1]) && ($params[1] == "locset") ) {
		global $conf;
		include_once $conf->root_path.'/app/model/LocalizationCtrl.class.php';
		$ctrl = new LocalizationCtrl();
		$ctrl->setLocalization();
	}
}


?>
