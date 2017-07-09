<?php

include_once("session_check.php");
$target_dir = 'profilbildupload/';
$temp_file = basename($_FILES ["fileToUpload"]["tmp_name"]);
$upload_file = basename($_FILES ["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($upload_file, PATHINFO_EXTENSION);
$random_name = rand().uniqid();
$uploadfile = $target_dir.$random_name.'.'.$imageFileType;
$upload_only_filename = $random_name.'.'.$imageFileType;
$userid = $_SESSION ['userid'];


//Fakes oder echtes Bild

if (isset ($_POST["submit"])){
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ( $check !== false) {
        echo "Datei ist eine Bilddatei - " . $check["mime"] . ".";


        $uploadOk = 1;}

    else {
        echo "Datei ist nicht eine Bilddatei.";
        $uploadOk = 0;
    }
}

// Size limitation
if ($_FILES["fileToUpload"]["size"] > 500000000) {
    echo "sorry, die datei ist zu groß.";
    $uploadOk = 0;
}

//Überprüfung der Dateiendung
$allowed_extensions = array('png', 'jpg', 'jpeg', 'gif', 'JPG');
if(!in_array($imageFileType, $allowed_extensions)) {
    echo "Ungültige Dateiendung. Nur png, jpg, jpeg und gif-Dateien sind erlaubt";
    $uploadOk = 0;
}


//Überprüfung auf Bildfehler
if(function_exists('exif_imagetype')) {
    $allowed_types = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
    $detected_type = exif_imagetype($_FILES['fileToUpload']['tmp_name']);
    if(!in_array($detected_type, $allowed_types)) {
        echo "Bilddatei hat einen Fehler!";
        $uploadOk = 0;
    }
}

// $uploadOK muss beim Error zum 0 gesetzt
if ($uploadOk == 0) {
    echo "sorry, Datei wurde nicht hochgeladen.";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $uploadfile)) {
        echo "Die Datei " . $uploadfile . " wurde hochgeladen.";
        try {
            include_once("userdata.php");
            $db = new PDO($dsn, $dbuser, $dbpass);
            $query = $db->prepare(
                "UPDATE user SET profilePicture = :profilePicture WHERE userid = :userid");
            $query->execute(array("profilePicture" => $uploadfile, "userid" => $userid));
            $db = null;
            header('Location: profil.php');
        } catch (PDOException $e) {
            echo "Error: Bitten wenden Sie sich an den Administrator!";
            die();
       }
    } else {
        echo "sorry, Fehler beim hochladen.";
    }
}

echo $imageFileType;


/**
 * Created by PhpStorm.
 * User: molin
 * Date: 27.06.2017
 * Time: 19:04
 */