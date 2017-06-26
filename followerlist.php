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
    echo "<h1>$zeile->username wird von diesen Nutzern abonniert:<br></h1>";
    echo "<a href='profil.php?userid=$zeile->userid'>Zurück zum Profil</a>";
}

echo "<br><br>";
$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM followerlist INNER JOIN user ON followerlist.user=user.userid WHERE followerlist.follower = :festgelegteUserID";       // UserID = 19 zeigt alles von Nutzer 19 an
$query = $db->prepare($sql);
$query->bindParam(':festgelegteUserID', $festgelegteUserID);
$query->execute();

while ($zeile = $query->fetchObject()) {
    echo "<a href='profil.php?userid=$zeile->userid'>$zeile->username</a><br>";
}