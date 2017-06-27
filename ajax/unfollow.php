<?php


include_once("../userdata.php");
include_once("../session_check.php");

$festgelegteUserID = $_SESSION['userid'];
$GetParameterUserIDEntfolgen = $_POST['followerID'];

if (!empty($GetParameterUserIDEntfolgen)) {


    try {
        $db = new PDO($dsn, $dbuser, $dbpass);
        $sql = "DELETE FROM followerlist WHERE user=$festgelegteUserID AND follower=$GetParameterUserIDEntfolgen";
        $db->prepare($sql)->execute();
        $db = null;
        echo "success";
    } catch (PDOException $e) {
        echo "Error!: Bitten wenden Sie sich an den Administrator...";
        die();
    }

}
else {

}