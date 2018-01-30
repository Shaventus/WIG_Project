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
			"ORDER" => "idPhoto DESC",
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
			"ORDER" => "idPhoto INC",
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

	public function uploadPhoto(){
		global $conf;
		$target_dir = "data/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		    if($check !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file)) {
		    echo "Sorry, file already exists.";
		    $uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
		    echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		    }
		}
		$datas = $this->db->connector()->insert("photo", [
			"path" => $_FILES["fileToUpload"]["name"],
			"description" => $_POST['description'],
			"Localization_idLocalization" => $_POST['LocalizatinoID'],
			"Account_idAccount" => $_SESSION["id"],
		]);
		echo json_encode($datas);

	}

}
