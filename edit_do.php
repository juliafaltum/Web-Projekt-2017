<?php
include_once("session_check.php");

$contentID = htmlspecialchars($_POST["contentID"], ENT_QUOTES, "UTF-8");
$contentTXT = htmlspecialchars($_POST["contentTXT"], ENT_QUOTES, "UTF-8");
$contentPicture = htmlspecialchars($_POST["contentPicture"], ENT_QUOTES, "UTF-8");
$contentSource = htmlspecialchars($_POST["contentSource"], ENT_QUOTES, "UTF-8");


if (!empty($contentID) && !empty($contentTXT) && !empty($contentPicture) && !empty($contentSource)) {
    try {
        include_once("userdata.php");
        $db = new PDO($dsn, $dbuser, $dbpass);
        $query = $db->prepare(
            "UPDATE content_txt SET contentTXT = :contentTXT, contentPicture= :contentPicture, contentDate = :contentDate WHERE contentID = :contentID");
        $query->execute(array("contentTXT" => $contentTXT, "contentPicture" => $contentPicture, "contentDate" => date("Y/m/d"), "contentID" => $contentID));
        $db = null;
        header('Location: index.php');
    } catch (PDOException $e) {
        echo "Error: Bitten wenden Sie sich an den Administrator!";
        die();
    }
} else {
    echo "Error: Bitte alle Felder ausfüllen!";

}