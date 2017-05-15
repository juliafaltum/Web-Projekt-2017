<?php
/**
 * Created by PhpStorm.
 * User: Christian
 * Date: 10.05.2017
 * Time: 21:49
 */
include_once("userdata.php");
include_once("session_check.php");

$festgelegteUserID = $_SESSION['userid'];

$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM user WHERE userid = :festgelegteUserID";       // UserID = 19 zeigt alles von Nutzer 19 an
$query = $db->prepare($sql);
$query->bindParam(':festgelegteUserID', $festgelegteUserID);
$query->execute();

while ($zeile = $query->fetchObject()) {
    echo "<h1>Du bist eingeloggt als Benutzer:  $zeile->username (Deine ID: $zeile->userid) <br></h1>";
}



echo "<br><br><br><br><br><br><br>";

$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM followerlist INNER JOIN user ON followerlist.follower=user.userid WHERE followerlist.user = :festgelegteUserID";       // UserID = 19 zeigt alles von Nutzer 19 an
$query = $db->prepare($sql);
$query->bindParam(':festgelegteUserID', $festgelegteUserID);
$query->execute();

while ($zeile = $query->fetchObject()) {
    echo "<h1>Du folgst:  $zeile->username (ID: $zeile->userid)<br></h1>";
}

echo "<br><br><br><br><br><br><br>";

$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM followerlist INNER JOIN user ON followerlist.user=user.userid WHERE followerlist.follower = :festgelegteUserID";       // UserID = 19 zeigt alles von Nutzer 19 an
$query = $db->prepare($sql);
$query->bindParam(':festgelegteUserID', $festgelegteUserID);
$query->execute();

while ($zeile = $query->fetchObject()) {
    echo "<h1>Dir folgt:  $zeile->username (ID: $zeile->userid)<br></h1>";
}