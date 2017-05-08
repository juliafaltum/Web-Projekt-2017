<?php
include_once("session_check.php");

$id = htmlspecialchars($_POST["id"], ENT_QUOTES, "UTF-8");
$content_txt = htmlspecialchars($_POST["content_txt"], ENT_QUOTES, "UTF-8");
$contentPicture = htmlspecialchars($_POST["contentPicture"], ENT_QUOTES, "UTF-8");
$contentDate = htmlspecialchars($_POST["contentDate"], ENT_QUOTES, "UTF-8");

if (!empty($id) && !empty($content_txt) && !empty($contentPicture) && !empty($contentDate)) {
    try {
        include_once("userdata.php");
        $db = new PDO($dsn, $dbuser, $dbpass);
        $query = $db->prepare(
            "UPDATE content_txt SET content_txt = :content_txt, contentPicture= :contentPicture, contentDate= :contentDate WHERE contentID= :id");
        $query->execute(array("content_txt" => $content_txt, "contentPicture" => $contentPicture, "contentDate" => $contentDate, "id" => $id));
        $db = null;
        header('Location: index.php');
    } catch (PDOException $e) {
        echo "Error: Bitten wenden Sie sich an den Administrator!";
        die();
    }
} else {
    echo "Error: Bitte alle Felder ausfüllen!";

}