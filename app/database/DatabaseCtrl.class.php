<?php
require_once $conf->root_path.'/lib/medoo.min.php';

class DatabaseCtrl{
	private $db;
	public function __construct(){
		$this->db = new medoo(array(
			'database_type' => 'mysql',
			'database_name' => 'wig',
			'server' => 'localhost',
			'username' => 'Master',
			'password' => 'master',
			'charset' => 'utf8',
		));
	}
	public function connector(){
		return $this->db;
	}
}
