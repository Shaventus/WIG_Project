<?php
class LocalizationCtrl {
	public $db;
	public function __construct(){
		$this->db = new DatabaseCtrl();
	}
  //Show all localizations
  public function getLocalizations(){
		$datas = $this->db->connector()->select("Localization", [
      "idLocalization",
			"latitude",
			"longitude",
			"name",
			"Account_idAccount"],[
			"ORDER" => "idLocalization DESC"
		]);
		echo json_encode($datas);
	}

	public function getUserLocalizations(){
		$datas = $this->db->connector()->select("Localization", [
			"idLocalization",
			"latitude",
			"longitude",
			"name",
			"Account_idAccount"],[
			"ORDER" => "idLocalization DESC",
			"Account_idAccount" => $_SESSION["id"]
		]);
		echo json_encode($datas);
	}

  //Show currect localization
	public function getLocalization(){
		$datas = $this->db->connector()->select("Localization", [
      "idLocalization",
			"name",
			"latitude",
			"longitude",
			"Account_idAccount"],[
			"idLocalization" => $_POST['id']
		]);
		echo json_encode($datas);
	}

	//Search localizations
	public function searchLocalization(){
		$datas = $this->db->connector()->select("Localization", [
			"idLocalization",
			"name",
			"latitude",
			"longitude",
			"Account_idAccount"],[
			"name[~]" => $_POST['search']
		]);
		echo json_encode($datas);
	}

	//Search user localizations
	public function searchUserLocalization(){
		$datas = $this->db->connector()->select("Localization", [
			"idLocalization",
			"name",
			"latitude",
			"longitude",
			"Account_idAccount"],[
				"AND" => [
					"Account_idAccount" => $_SESSION["id"],
					"name[~]" => $_POST['search']
				]
		]);
		echo json_encode($datas);
	}

  //Delete localization
  public function delLocalization(){
    $datas = $this->db->connector()->delete("Localization", [
      "idLocalization" => $_POST['id']
    ]);
    echo json_encode('ok');
  }

  //Add localization
  public function setLocalization(){
    $datas = $this->db->connector()->insert("Localization", [
      "latitude" => $_POST['latitude'],
			"longitude" => $_POST['longitude'],
			"name" => $_POST['name'],
      "Account_idAccount" => $_SESSION["id"],
    ]);
    echo json_encode($datas);
  }

}
