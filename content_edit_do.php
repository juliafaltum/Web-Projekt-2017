<?php
include_once("session_check.php");

$contentID = htmlspecialchars($_POST["contentID"], ENT_QUOTES, "UTF-8");
$contentTXT = htmlspecialchars($_POST["contentTXT"], ENT_QUOTES, "UTF-8");
$contentPicture = htmlspecialchars($_POST["contentPicture"], ENT_QUOTES, "UTF-8");
$fileToUploadwennLeer = htmlspecialchars($_POST["fileToUploadwennLeer"], ENT_QUOTES, "UTF-8");
$contentSource = htmlspecialchars($_POST["contentSource"], ENT_QUOTES, "UTF-8");


// Nur wenn Bild gesetzt ist, Wert in die DB schreiben!
if (file_exists($_FILES['fileToUpload']['tmp_name'])){

    include_once("Upload_do.php");
}
else {
    $uploadfile = $fileToUploadwennLeer;
}


if (!empty($contentID) && !empty($contentTXT)) {
    try {
        include_once("userdata.php");
        $db = new PDO($dsn, $dbuser, $dbpass);
        $query = $db->prepare(
            "UPDATE content_txt SET contentTXT = :contentTXT, contentPicture = :contentPicture, contentDate = :contentDate WHERE contentID = :contentID");
        $query->execute(array("contentTXT" => $contentTXT, "contentPicture" => $uploadfile, "contentDate" => date("Y/m/d"), "contentID" => $contentID));
        $db = null;
        header('Location: profil.php?notification=tweetEdited');
    } catch (PDOException $e) {
        echo "Error: Bitten wenden Sie sich an den Administrator!";
        die();
    }
} else {
    echo "Error: Bitte alle Felder ausfüllen!";

}