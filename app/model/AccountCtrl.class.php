<?php
class AccountCtrl {
	public $db;
	private $login, $pass, $email;
	public function __construct(){
		$this->db = new DatabaseCtrl();
	}
  //Show all account
  public function getAccounts(){
		$datas = $this->db->connector()->select("account", [
      "idAccount",
			"login",
			"pass",
			"email"],[
			"ORDER" => "idAccount DESC"
		]);
		echo json_encode($datas);
	}

  //Show currect account
	public function getAccount(){
		$datas = $this->db->connector()->select("account", [
			"idAccount" => $_POST['LoginId'],
	    "login",
	    "pass",
	    "email"],[
	    "ORDER" => "idAccount DESC"
		]);
		echo json_encode($datas);
	}

  //Delete currect account
  public function delAccount(){
    $datas = $this->db->connector()->delete("account", [
      "idAccount" => $_POST['id']
    ]);
    echo json_encode('ok');
  }

  //Add account
  public function setAccount(){
    $datas = $this->db->connector()->insert("account", [
      "login" => $_POST['login'],
      "pass" => $_POST['pass'],
      "email" => $_POST['email'],
    ]);
    echo json_encode($datas);
  }

	public function doRegistr(){
		global $conf;
		$this->validate();
	}

	public function getParams(){
		$this->login = $_POST ['login'];
		$this->pass = $_POST ['pass'];
		$this->email = $_POST ['email'];
	}
	public function validate() {
		$this->getParams();
		if (! (isset ( $this->login ) && isset ( $this->pass ) && isset ( $this->email ))) {
			echo "Runtime error";
			exit();
		}

		$datas = $this->db->connector()->insert("account", [
			"login" => $this->login,
			"pass" => $this->pass,
			"email" => $this->email,
			"Role_idRole" => 2
		]);
		echo json_encode($datas);
	}

}
