<?php

$target_dir = "tweetbildupload/";
$target_file = $target_dir . basename($_FILES ["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

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

// existiert bild?
if (file_exists($target_file)) {
    echo "sorry, die Datei existiert schon.";
        $uploadOk = 0;
    }

// Size limitation
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "sorry, die datei ist zu groß.";
        $uploadOk = 0;
    }

// Datei Formaten
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "sorry, nur JPG, JPEG, PNG & GIF Dateien sind erlaubt.";
        $uploadOk = 0;
    }

// $uploadOK muss beim Error zum 0 gesetzt
if ($uploadOk == 0) {
        echo "sorry, Datei wurde nicht hochgeladen.";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "Die Datei" . basename($_FILES["fileToUpload"]["name"]) . "Datei hochgeladen.";
    } else {
        echo "sorry, Fehler beim hochladen.";
    }
}


/**
 * Created by PhpStorm.
 * User: molin
 * Date: 15.05.2017
 * Time: 13:20
 */