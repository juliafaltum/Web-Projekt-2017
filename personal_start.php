<?php
include_once ("header.php");
include_once ("userdata.php");
include_once ("session_check.php");
include_once ("functions.php");

$festgelegteUserID = $_SESSION['userid'];





echo "<h1>Deine Persönliche Startseite</h1><br>Du folgst: <br>";

$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM followerlist INNER JOIN user ON followerlist.follower=user.userid WHERE followerlist.user = :festgelegteUserID";       // UserID = 19 zeigt alles von Nutzer 19 an
$query = $db->prepare($sql);
$query->bindParam(':festgelegteUserID', $festgelegteUserID);
$query->execute();

while ($zeile = $query->fetchObject()) {
    echo "<a href='profil.php?userid=$zeile->userid'>$zeile->username</a></h1><br>";
}
tweetFormulartoggle();
echo "<h1>Wellen deiner Freunde</h1><br>";

$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM followerlist INNER JOIN user ON followerlist.follower=user.userid WHERE followerlist.user = :festgelegteUserID";       // UserID = 19 zeigt alles von Nutzer 19 an
$query = $db->prepare($sql);
$query->bindParam(':festgelegteUserID', $festgelegteUserID);
$query->execute();

while ($zeile = $query->fetchObject()) {
    showContent($zeile->userid);
}

