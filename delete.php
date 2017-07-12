<?php
include_once ('session_check.php');
include_once ('functions.php');
include_once("userdata.php");

$contentID = $_GET["contentID"];
$userID = $_SESSION['userid'];



deleteTweetPicturefromServer($contentID);




// Tweet wird aus DB gelöscht

try {
    include_once("userdata.php");
    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "DELETE FROM content_txt WHERE contentID=$contentID AND userid=$userID";
    $db->prepare($sql)->execute();
    $db = null;

    header('Location: profil.php?notification=tweetDeleted');


} catch (PDOException $e) {
    echo "Error!: Bitten wenden Sie sich an den Administrator...";
    die();
}

