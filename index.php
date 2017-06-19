<?php include_once ("header.php");?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<h1>Alle Tweets</h1>
<body>






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


 // Anzeigen von allen vorhandenen Tweets aus der Datenbank

include_once("userdata.php");
include_once("functions.php");

try {
$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM content_txt INNER JOIN user ON content_txt.userID=user.userid";         // Können sow.rtiert werden mit "ORDER BY contentDate DESC" usw. WHERE content_txt.userID in (21, 19)
$query = $db->prepare($sql);
$query->execute();

while ($zeile = $query->fetchObject()) {

    echo "<h4>Tweet Nummer: $zeile->contentID<br></h4>";
    echo "<h4>Geschrieben am: $zeile->contentDate</h4>";
    echo "Punkte: ";
    echo contentPoints($zeile->contentID);
    echo voteButton($_SESSION['userid'], $zeile->contentID);
    echo "<h3>Geschrieben von: <a href='profil.php?userid=$zeile->userid'>$zeile->username</a></h3><br><br>";
    $followerID = $zeile->userid;
    $contentID = $zeile->contentID;


    followButtonAjax ($_SESSION['userid'], $followerID, $contentID);
    // followButton ($_SESSION['userid'], $zeile->userid);          // FUNKTION: Follow-Button



    echo "<h4>$zeile->contentTXT</h4>";
    echo "<img src='$zeile->contentPicture' alt=\"Mountain View\" style=\"width:304px;height:228px;\"> <br>";
    echo "Quelle: <a href='$zeile->contentSource'>$zeile->contentSource</a><br><br>";
    echo "<a href='show.php?contentID=$zeile->contentID'>zeige</a><br>";




    if($_SESSION['userid']==$zeile->userID) {
        echo "Du bist Autor dieses Posts, also kannst du folgendes machen: <br>";
        echo "<a href='edit.php?contentID=$zeile->contentID'>editieren</a><br>";
        echo "<a href='delete_frage.php?contentID=$zeile->contentID'>l&ouml;sche</a><br>";
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