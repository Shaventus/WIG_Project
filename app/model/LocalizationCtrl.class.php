<?php
class AccountCtrl {
	public $db;
	public function __construct(){
		$this->db = new DatabaseCtrl();
	}
  //Show all localizations
  public function getLocalizations(){
		$datas = $this->db->connector()->select("localization", [
      "idLocalization",
			"latiitude",
			"longitude",
			"name",
			"Account_idAccount"],[
			"ORDER" => "idLocalization DESC"
		]);
		echo json_encode($datas);
	}

  //Show currect localization
	public function getLocalization(){
		$datas = $this->db->connector()->select("localization", [
			"idLocalization" => $_POST['LocalizationId'],
			"latiitude",
			"longitude",
			"name"],[
	    "ORDER" => "idLocalization DESC"
		]);
		echo json_encode($datas);
	}

  //Delete localization
  public function delLocalization(){
    $datas = $this->db->connector()->delete("localization", [
      "idLocalization" => $_POST['id']
    ]);
    echo json_encode('ok');
  }

  //Add localization
  public function setLocalization(){
    $datas = $this->db->connector()->insert("localization", [
      "latiitude" => $_POST['latiitude'],
			"longitude" => $_POST['longitude'],
			"name" => $_POST['name'],
      "Account_idAccount" => $_POST['AccountID'],
    ]);
    echo json_encode($datas);
  }

}
