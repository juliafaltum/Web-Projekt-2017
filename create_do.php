<?php

$contentTXT = htmlspecialchars($_POST["contentTXT"], ENT_QUOTES, "UTF-8");
$contentPicture = htmlspecialchars($_POST["contentPicture"], ENT_QUOTES, "UTF-8");
$contentSource = htmlspecialchars($_POST["contentSource"], ENT_QUOTES, "UTF-8");

if (!empty($contentTXT) && !empty($contentPicture) && !empty($contentSource)) {
    include_once("userdata.php");
    try {
        $db = new PDO($dsn, $dbuser, $dbpass);
        $query = $db->prepare(
            "INSERT INTO content_txt (contentTXT, contentPicture, contentSource, contentDate) VALUES(:contentTXT, :contentPicture, :contentSource, NOW())");
        $query->execute(array("contentTXT" => $contentTXT, "contentPicture" => $contentPicture, "contentSource" => $contentSource) );
        $db = null;
    } catch (PDOException $e) {
        echo "Error!: Bitten wenden Sie sich an den Administrator...";
        die();
    }
    header('Location: alletexte.php');
}
else {
    echo "Error: Bitte alle Felder ausfüllen!<br/>";
}