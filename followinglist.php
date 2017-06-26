<?php
include_once ("header.php");
include_once ("userdata.php");
include_once ("session_check.php");

$festgelegteUserID = $_GET["userid"];

$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM user WHERE userid = :festgelegteUserID";
$query = $db->prepare($sql);
$query->bindParam(':festgelegteUserID', $festgelegteUserID);
$query->execute();

while ($zeile = $query->fetchObject()) {
    echo "<h1>$zeile->username abonniert diese Nutzer:<br></h1>";
    echo "<a href='profil.php?userid=$zeile->userid'>Zurück zum Profil</a>";
}

echo "<br><br>";

$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM followerlist INNER JOIN user ON followerlist.follower=user.userid WHERE followerlist.user = :festgelegteUserID";       // UserID = 19 zeigt alles von Nutzer 19 an
$query = $db->prepare($sql);
$query->bindParam(':festgelegteUserID', $festgelegteUserID);
$query->execute();

while ($zeile = $query->fetchObject()) {
    echo "<a href='profil.php?userid=$zeile->userid'>$zeile->username</a></h1><br>";
}