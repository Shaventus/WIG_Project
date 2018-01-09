<?php
class AccountCtrl {
	public $db;
	public function __construct(){
		$this->db = new DatabaseCtrl();
	}
  //Show all localizations
  public function getAccounts(){
		$datas = $this->db->connector()->select("localization", [
      "idLocalization",
			"geoIP",
			"Account_idAccount"],[
			"ORDER" => "idLocalization DESC"
		]);
		echo json_encode($datas);
	}

  //Show currect localization
	public function getAccount(){
		$datas = $this->db->connector()->select("localization", [
			"idLocalization" => $_POST['LocalizationId'],
	    "login",
	    "pass",
	    "email"],[
	    "ORDER" => "idAccount DESC"
		]);
		echo json_encode($datas);
	}

  //Delete localization
  public function delAccount(){
    $datas = $this->db->connector()->delete("localization", [
      "idLocalization" => $_POST['id']
    ]);
    echo json_encode('ok');
  }

  //Add localization
  public function setAccount(){
    $datas = $this->db->connector()->insert("localization", [
      "geoIP" => $_POST['GeoIP'],
      "Account_idAccount" => $_POST['AccountID'],
    ]);
    echo json_encode($datas);
  }

}