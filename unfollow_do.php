<?php
/**
 * Created by PhpStorm.
 * User: Christian
 * Date: 10.05.2017
 * Time: 21:21
 */

include_once("userdata.php");
include_once("session_check.php");

$festgelegteUserID = $_SESSION['userid'];
$GetParameterUserID = $_GET['user'];
$GetParameterUserIDEntfolgen = $_GET['entfolgeuser'];

if (!empty($GetParameterUserIDEntfolgen)) {


    try {
        $db = new PDO($dsn, $dbuser, $dbpass);
        $sql = "DELETE FROM followerlist WHERE user=$festgelegteUserID AND follower=$GetParameterUserIDEntfolgen";
        $db->prepare($sql)->execute();
        $db = null;
    } catch (PDOException $e) {
        echo "Error!: Bitten wenden Sie sich an den Administrator...";
        die();
    }
    header('Location: index.php');

}
else {
    echo "Du bist dieser Person schon entfolgt";
}