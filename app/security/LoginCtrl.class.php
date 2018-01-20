<?php
if (!isset($_SESSION)){
	session_start();
}
require_once dirname(__FILE__).'/../../config.php';
require_once $conf->root_path.'/app/security/User.class.php';

class LoginCtrl{
	private $login;
	private $pass;
	private $db;
	public function __construct(){
		$this->db = new DatabaseCtrl();
	}
	public function getParams(){
		if (! (isset ( $_POST['pass'] ))){
			echo '[LoginCtrl] Runtime error';
			exit();
		}
		$this->login = $_POST ['login'];
		$this->pass = $_POST ['pass'];
	}
	public function validate() {
		$this->getParams();
		if (! (isset ( $this->login ) && isset ( $this->pass ))) {
			echo "Runtime error";
			exit();
		}
		$datas = $this->db->connector()->select("account", [
								"email",
								"login",
								"pass",
								"idAccount",
								"Role_idRole"
							], [
								"AND" => [
									"login" => $this->login,
									"pass" => $this->pass,
								]
							]);
		if( $datas){
			foreach($datas as $data){
				$user = new User($data["login"], $data['idAccount'], $data['Role_idRole']);
				if ($data['Role_idRole'] == '1'){
					$_SESSION['admin'] = 'true';
				}
				else{
					$_SESSION['admin'] = 'false';
				}
				$_SESSION['type'] = $data['Role_idRole'];
				$_SESSION['user'] = $data['login'];
				$_SESSION['name'] = $data['login'];
				$_SESSION['id']   = $data['idAccount'];
				$datas[0]['status'] = "ok";
			}
			echo json_encode($datas);
		}
		else{
			$datas[0]['status'] = "err";
			echo json_encode($datas);
		}
	}
	public function doLogin(){
		global $conf;
		$this->getParams();
		$this->validate();
	}
	public function doLogout(){
		session_destroy();
		$this->showLogout();
	}
	public function showLogout(){
		global $conf;
		header("Location: ".$conf->app_url."/view/login");
	}
}
