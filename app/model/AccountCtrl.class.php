<?php
class AccountCtrl {
	public $db;
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

}
