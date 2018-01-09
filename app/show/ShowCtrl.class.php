<?php
class ShowCtrl {
	public $db;
	private $number;
	public function __construct($number){
		$this->db = new DatabaseCtrl();
		$this->number = $number;
	}

	public function showStart(){
		global $conf;
		include $conf->root_path.'/view/'.'show_start.php';
	}

	public function showLogin(){
		global $conf;
		include $conf->root_path.'/view/'.'show_login.php';
	}

}
