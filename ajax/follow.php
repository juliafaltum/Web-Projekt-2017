<?php


include_once("../userdata.php");
include_once("../session_check.php");

$festgelegteUserID = $_SESSION['userid'];
$GetParameterUserID = $_POST['followerID'];

if ($festgelegteUserID != $GetParameterUserID) {

    global $dsn, $dbuser, $dbpass;
    include("../userdata.php");
    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "SELECT * FROM followerlist WHERE user = :user AND follower = :follower";
    $query = $db->prepare($sql);
    $query->bindParam(':user', $festgelegteUserID);
    $query->bindParam(':follower', $GetParameterUserID);
    $query->execute();

    while ($zeile = $query->fetchObject()) {
        $folgtschon = 1;

    }}

if ($festgelegteUserID == $GetParameterUserID) {
    $selbstfolgen = 1;
    echo "Du kannst dir nicht selbst folgen";
}

if (!empty($folgtschon)) {
    echo "Du folgst dieser Person schon";
}


if ((!empty($GetParameterUserID) && (empty($folgtschon)))&& (empty($selbstfolgen))) {
    try {
        $db = new PDO($dsn, $dbuser, $dbpass);
        $query = $db->prepare(
            "INSERT INTO followerlist (user, follower) VALUES(:user, :follower)");
        $query->execute(array("user" => $festgelegteUserID, "follower" => $GetParameterUserID) );
        $db = null;
        echo "success";
    } catch (PDOException $e) {
        echo "Error!: Bitten wenden Sie sich an den Administrator...";
        die();
    }
}
?>