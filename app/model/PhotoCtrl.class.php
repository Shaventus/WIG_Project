<?php
class PhotoCtrl {
	public $db;
	public function __construct(){
		$this->db = new DatabaseCtrl();
	}
  //Show all photo
  public function getPhotos(){
		$datas = $this->db->connector()->select("photo", [
      "idPhoto",
			"path",
      "description",
			"Localization_idLocalization",
			"Account_idAccount"],[
			"ORDER" => "idPhoto DESC"
		]);
		echo json_encode($datas);
	}

  //Show currect photo
	public function getPhoto(){
		$datas = $this->db->connector()->select("photo", [
			"idPhoto",
      "path",
      "description",
			"Localization_idLocalization",
			"Account_idAccount"],[
			"ORDER" => "idPhoto DESC"
		],[
			"idPhoto" => $_POST["idPhoto"]
		]);
		echo json_encode($datas);
	}

	//Show currect photos localization
	public function getLocalizationPhotos(){
		$datas = $this->db->connector()->select("photo", [
			"idPhoto",
      "path",
      "description",
			"Localization_idLocalization",
			"Account_idAccount"
		],[
			"ORDER" => "idPhoto DESC",
			"Localization_idLocalization" => $_POST["idLocalization"]
		]);
		echo json_encode($datas);
	}

  //Delete photo
  public function delPhoto(){
    $datas = $this->db->connector()->delete("photo", [
      "idPhoto" => $_POST['idPhoto']
    ]);
    echo json_encode('ok');
  }

  //Add photo
  public function setPhoto(){
    $datas = $this->db->connector()->insert("photo", [
			"path" => $_POST['path'],
      "description" => $_POST['description'],
			"Localization_idLocalization" => $_POST['LocalizatinoID'],
      "Account_idAccount" => $_POST['AccountID'],
    ]);
    echo json_encode($datas);
  }

}
