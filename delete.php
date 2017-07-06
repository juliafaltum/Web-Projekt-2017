<?php
include_once ('session_check.php');

$contentID = (int)$_GET["contentID"];
$userID = $_SESSION['userid'];


try {
    include_once("userdata.php");
    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "DELETE FROM content_txt WHERE contentID=$contentID AND userid=$userID";
    $db->prepare($sql)->execute();
    $db = null;
} catch (PDOException $e) {
    echo "Error!: Bitten wenden Sie sich an den Administrator...";
    die();
}
header('Location: index.php');
