<?php include_once ("header.php");?>

<?php
include_once("session_check.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="mystyle.css" media="screen"/>
</head>

<?php // Anzeigen von einzelnem Tweet
include_once("userdata.php");

$contentID = (int)$_GET["contentID"];
$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM content_txt INNER JOIN user ON content_txt.userID=user.userid WHERE contentID=$contentID"; //Join, damit man den username auslesen kann
$query = $db->prepare($sql);
$query->execute();
if ($zeile = $query->fetchObject()) {
    echo "<h3>Welle von <a href='profil.php?userid=$zeile->userid'>$zeile->username</a></h3>";
    echo "<h5>$zeile->contentDate</h5>";
    echo "<h5>$zeile->contentTXT</h5>";
    echo "<img src='$zeile->contentPicture' alt=\"Bild nicht verfügbar\" style=\"width:304px;height:228px;\"> <br>";
    echo "Quelle: <a href='$zeile->contentSource'>$zeile->contentSource</a><br><br>";
    if($_SESSION['userid']==$zeile->userID) {
        echo "<a href='edit.php?contentID=$zeile->contentID'>bearbeiten</a><br>";
        echo "<a href='delete_frage.php?contentID=$zeile->contentID'>l&ouml;schen</a><br>";
    }
    echo "_________________________________________________________";
} else {
    print "Datensatz mit id=$contentID nicht gefunden!";
}
$db = null;
?>

<br>
<a href="index.php">zurück</a>

