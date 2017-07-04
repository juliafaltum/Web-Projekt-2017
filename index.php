<?php include_once ("header.php");
include_once("userdata.php");
include_once("functions.php");?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>






<?php

session_start();
if(!isset($_SESSION['userid'])) {
    echo "<a href=\"create_user.php\">Registrieren</a><br><br>";
}  // Ausloggen nur anzeigen wenn Nutzer eingeloggt ist, Einloggen und Registrieren nur wenn Nutzer ausgeloggt

else {
    $username = $_SESSION['username'];
    echo "<h1>Hallo $username</h1>";
    echo "<br>";
}
tweetFormulartoggle(); // Button und einblenden von Neuen Tweet verfassen

 // Anzeigen von allen vorhandenen Tweets aus der Datenbank


try {
$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM content_txt INNER JOIN user ON content_txt.userID=user.userid";         // Können sow.rtiert werden mit "ORDER BY contentDate DESC" usw. WHERE content_txt.userID in (21, 19)
$query = $db->prepare($sql);
$query->execute();

while ($zeile = $query->fetchObject()) {

    $followerID = $zeile->userid;
    $contentID = $zeile->contentID;

    echo "<h3>Welle von <a href='profil.php?userid=$zeile->userid'>$zeile->username</a></h3>";
    echo "<h5>$zeile->contentDate</h5";
    echo "<br>";
    // followButtonAjax ($_SESSION['userid'], $followerID, $contentID);
    // followButton ($_SESSION['userid'], $followerID);     // FUNKTION: Follow-Button

    followButtonAjaxNeu($_SESSION['userid'], $followerID, $contentID);

    echo "<br>";
    echo "<h4>Punkte: ";
    echo contentPoints($zeile->contentID);
    echo voteButton($_SESSION['userid'], $zeile->contentID);
    echo "</h4>";





    echo "<h5>$zeile->contentTXT</h5>";
    echo "<img src='$zeile->contentPicture' alt=\"Bild nicht verfügbar\" style=\"width:304px;height:228px;\"> <br>";
    echo "Quelle: <a href='$zeile->contentSource'>$zeile->contentSource</a><br><br>";
    echo "<a href='show.php?contentID=$zeile->contentID'>anzeigen</a><br>";




    if($_SESSION['userid']==$zeile->userID) {
        echo "<a href='edit.php?contentID=$zeile->contentID'>bearbeiten</a><br>";
        echo "<a href='delete_frage.php?contentID=$zeile->contentID'>l&ouml;schen</a><br>";
    }
    echo "_________________________________________________________";
    echo "<br>";
}
?>
<br>
</body>
</html>

<?php
$db = null;
} catch (PDOException $e) {
    echo "Error!: Bitte wenden Sie sich an den Administrator!...".$e;
    die();
}
?>