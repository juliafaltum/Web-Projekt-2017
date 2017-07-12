<?php

include_once ('session_check.php');

$userID = $_SESSION['userid'];


try {
include_once("userdata.php");
$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "DELETE FROM user WHERE userid = $userID";
$db->prepare($sql)->execute();
$db = null;
    header('Location: logout.php');


} catch (PDOException $e) {
echo "Error!: Bitten wenden Sie sich an den Administrator...";
die();
}

