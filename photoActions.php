<?php
include_once ('session_check.php');
include_once ('res.php');



$action = $_GET['action'];

$userID = $_SESSION['userid'];

switch ($action) {

    // Neuer Upload
    case newupload:


        $target_dir = 'photoGallery/';
        $temp_file = basename($_FILES ["fileToUpload"]["tmp_name"]);
        $upload_file = basename($_FILES ["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($upload_file, PATHINFO_EXTENSION);
        $random_name = rand() . uniqid();
        $uploadfile = $target_dir . $random_name . '.' . $imageFileType;
        $upload_only_filename = $random_name . '.' . $imageFileType;
        $userid = $_SESSION['userid'];


//Fakes oder echtes Bild

        if (isset ($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "Datei ist eine Bilddatei - " . $check["mime"] . ".";


                $uploadOk = 1;
            } else {
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
        if (!in_array($imageFileType, $allowed_extensions)) {
            echo "Ungültige Dateiendung. Nur png, jpg, jpeg und gif-Dateien sind erlaubt";
            $uploadOk = 0;
        }


//Überprüfung auf Bildfehler
        if (function_exists('exif_imagetype')) {
            $allowed_types = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
            $detected_type = exif_imagetype($_FILES['fileToUpload']['tmp_name']);
            if (!in_array($detected_type, $allowed_types)) {
                echo "Bilddatei hat einen Fehler!";
                $uploadOk = 0;
            }
        }

// $uploadOK muss beim Error zum 0 gesetzt
        if ($uploadOk == 0) {
            echo "sorry, Datei wurde nicht hochgeladen.";
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $uploadfile)) {

                try {
                    include_once("userdata.php");
                    $db = new PDO($dsn, $dbuser, $dbpass);
                    $query = $db->prepare(
                        "INSERT INTO privatePhoto (userID, photoURL, photoDate, public) VALUES(:userID, :photoURL, NOW(), 0)"); // Aktuelles Datum wird per NOW() Funktion geholt
                    $query->execute(array("userID" => $userid, "photoURL" => $uploadfile));
                    $db = null;


                    header('location: photoGallery.php');
                } catch (PDOException $e) {
                    echo "Error: Bitten wenden Sie sich an den Administrator!";
                    die();
                }
            } else {
                echo "sorry, Fehler beim hochladen.";
            }
        }



        break;


// Bilder verwalten
    case manage:
        include_once ('navigation.php');
        include_once('userdata.php');

        ?>
        <div class="row">
            <div class="col-md-5 center-element">
        <a href="photoGallery.php"><button class="btn btn-success">Zurück zur persönlichen Gallerie</button></a>
                <div class="spacer"></div>
                <div class="spacer"></div>
                <div class="spacer"></div>
                <div class="spacer"></div>
                <div class="spacer"></div>
            </div>
        </div>

        <?php
        try {
            $db = new PDO($dsn, $dbuser, $dbpass);
            $sql = "SELECT * FROM privatePhoto WHERE userID = $userID";         // Können sow.rtiert werden mit "ORDER BY contentDate DESC" usw. WHERE content_txt.userID in (21, 19)
            $query = $db->prepare($sql);
            $query->execute();

            while ($zeile = $query->fetchObject()) {

                $photoID = $zeile->photoID;
                $photoURL = $zeile->photoURL;
                $photoDate = $zeile->photoDate;
                $public = $zeile->public;

                ?>


                <div class="col-md-3">


                        <img class="img-thumbnail" src="<?= $photoURL ?>"><br>
                    <div class="spacer"></div>
                    <a href="<?=$photoURL?>"><h3>Foto teilen!</a> | <a href="photoActions.php?action=delete&photoID=<?=$photoID?>">Foto löschen</a></h3>


                </div>


                <?php

            }
        } catch (PDOException $e) {
            echo "Error!: Bitte wenden Sie sich an den Administrator!..." . $e;
            die();
        }


break;



    case delete:

        $photoID = $_GET['photoID'];

        try {
            $db = new PDO($dsn, $dbuser, $dbpass);
            $sql = "SELECT * FROM privatePhoto WHERE photoID=$photoID AND userID=$userID";
            $query = $db->prepare($sql);
            $query->execute();
            if ($zeile = $query->fetchObject()) {
                $photoURL = $zeile->photoURL;
                $db = null;
            }
            echo $photoURL;
            if (isset($photoURL)) {

                echo $photoURL;

                if (unlink($photoURL)) {

                    echo 'success';
                } else {

                    echo 'fail';
                }


            }
        } catch (PDOException $e) {
            echo "Error!: Bitte wenden Sie sich an den Administrator!..." . $e;
            die();
        }

        try {
            include_once("userdata.php");
            $db = new PDO($dsn, $dbuser, $dbpass);
            $sql = "DELETE FROM privatePhoto WHERE photoID=$photoID AND userID=$userID";
            $db->prepare($sql)->execute();
            $db = null;


        } catch (PDOException $e) {
            echo "Error!: Bitten wenden Sie sich an den Administrator...";
            die();
        }

        header('location: photoActions.php?action=manage');

        break;


}