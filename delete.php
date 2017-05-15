<?php

$contentIDid = (int)$_GET["contentID"];

try {
    include_once("userdata.php");
    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "DELETE FROM content_txt WHERE contentID=$contentID";
    $db->prepare($sql)->execute();
    $db = null;
} catch (PDOException $e) {
    echo "Error!: Bitten wenden Sie sich an den Administrator...";
    die();
}
header('Location: index.php');
