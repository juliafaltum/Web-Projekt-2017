<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="mystyle.css" media="screen"/>
</head>
<h1>Alle Tweets</h1>
<body>


<!-- <script src="js/instantclick.min.js" data-no-instant></script>
<script data-no-instant>InstantClick.init();</script> Skript wieder auskommentiert für Instantklick -->


<a href="create_form.php">neuer Tweet</a><br>
<a href="create_user.php">neuer Benutzer</a><br>

<?php
session_start();
if(!isset($_SESSION['userid'])) {
    echo "<a href=\"login.html\">Einloggen</a><br><br>"; }  // Ausloggen nur anzeigen wenn Nutzer eingeloggt ist, Einloggen nur wenn Nutzer ausgeloggt

else {
    echo "<a href=\"logout.php\">Ausloggen</a><br><br>";
    echo "Hallo Nutzer: " .$_SESSION['userid'];
}
?>

<?php // Anzeigen von allen vorhandenen Tweets aus der Datenbank

include_once("userdata.php");

try {
$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM content_txt INNER JOIN user ON content_txt.userID=user.userid";         // Können sow.rtiert werden mit "ORDER BY contentDate DESC" usw. WHERE content_txt.userID in (21, 19)
$query = $db->prepare($sql);
$query->execute();

while ($zeile = $query->fetchObject()) {

    echo "<h2>Tweet Nummer: $zeile->contentID<br></h2>";
    echo "<h3>Geschrieben am: $zeile->contentDate</h3>";
    echo "<h3>Geschrieben von: <a href='profil.php?userid=$zeile->userid'>$zeile->username</a> <a href='follower_do.php?user=$zeile->userID'>(Folgen)<a href='unfollow_do.php?entfolgeuser=$zeile->userID'>(Entfolgen)</a></h3>";              // Der Wert des "username" kann aufgrund des Inner Join oben ausgelesen werden!
    echo "<h4>$zeile->contentTXT</h4>";
    echo "<img src='$zeile->contentPicture' alt=\"Mountain View\" style=\"width:304px;height:228px;\"> <br>";
    echo "Quelle: <a href='$zeile->contentSource'>$zeile->contentSource</a><br><br>";
    echo "<a href='show.php?contentID=$zeile->contentID'>zeige</a><br>";


    if($_SESSION['userid']==$zeile->userID) {
        echo "Du bist Autor dieses Posts, also kannst du folgendes machen: <br>";
        echo "<a href='edit.php?contentID=$zeile->contentID'>editiere</a><br>";
        echo "<a href='delete1.php?id=$zeile->contentID'>l&ouml;sche</a><br>";
    }
    echo "_________________________________________________________";
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