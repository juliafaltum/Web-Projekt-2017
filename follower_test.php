<?php
/**
 * Created by PhpStorm.
 * User: Christian
 * Date: 10.05.2017
 * Time: 17:00
 */


include_once("userdata.php");
include_once("session_check.php");

$festgelegteUserID = $_SESSION['userid'];

$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM followerlist INNER JOIN content_txt ON followerlist.follower=content_txt.userID INNER JOIN user ON content_txt.userID=user.userid WHERE followerlist.user = :festgelegteUserID";         // UserID = 19 zeigt alles von Nutzer 19 an
$query = $db->prepare($sql);
$query->bindParam(':festgelegteUserID', $festgelegteUserID);
$query->execute();

while ($zeile = $query->fetchObject()) {
    echo "<h1>Tweet Nummer: $zeile->contentID<br></h1>";
    echo "<h3>Geschrieben am: $zeile->contentDate</h3>";
    echo "<h3>Geschrieben von: $zeile->username</h3>";
    echo "<h4>$zeile->contentTXT</h4>";
    echo "<img src='$zeile->contentPicture' alt=\"Mountain View\" style=\"width:304px;height:228px;\"> <br>";
    echo "Quelle: <a href='$zeile->contentSource'>$zeile->contentSource</a><br><br>";
    echo "<a href='content_show.php?contentID=$zeile->contentID'>zeige</a><br>";
    echo "<a href='update_form.php?id=$zeile->contentID'>editiere</a><br>";
    echo "<a href='delete1.php?id=$zeile->contentID'>l&ouml;sche</a><br>";
    echo "_________________________________________________________";

}