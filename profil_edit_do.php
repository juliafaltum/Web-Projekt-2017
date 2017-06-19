<?php
include_once("session_check.php");

$userid = htmlspecialchars($_POST["userid"], ENT_QUOTES, "UTF-8");
$fullname = htmlspecialchars($_POST["fullname"], ENT_QUOTES, "UTF-8");
$email = htmlspecialchars($_POST["email"], ENT_QUOTES, "UTF-8");

if (!empty($fullname) && !empty($email)) {
    try {
        include_once("userdata.php");
        $db = new PDO($dsn, $dbuser, $dbpass);
        $query = $db->prepare(
            "UPDATE user SET fullname = :fullname, email = :email WHERE userid = :userid");
        $query->execute (array("fullname" => $fullname, "email" => $email, "userid" => $userid));
        $db = null;
        header('Location: index.php'); //ToDo Wohin soll weitergeleitet werden?
    } catch (PDOException $e) {
        echo "Error: Bitten wenden Sie sich an den Administrator!";
        die();
    }
} else {
    echo "Error: Bitte alle Felder ausfüllen!";

}