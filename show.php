<!DOCTYPE html> <!-- das ist HTML 5 -->
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="mystyle.css" media="screen"/>
</head>

<?php
include_once("userdata.php");

$contentID = (int)$_GET["contentID"];
$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM content_txt WHERE contentID=$contentID";
$query = $db->prepare($sql);
$query->execute();
if ($zeile = $query->fetchObject()) {
    echo "<h1>Tweet Nummer: $zeile->contentID<br></h1>";
    echo "<h3>Geschrieben am: $zeile->contentDate</h3>";
    echo "<h4>$zeile->contentTXT</h4>";
    echo "<img src='$zeile->contentPicture' alt=\"Mountain View\" style=\"width:304px;height:228px;\"> <br>";
    echo "Quelle: <a href='$zeile->contentSource'>$zeile->contentSource</a><br><br>";
    echo "<a href='show.php?id=$zeile->contentID'>zeige</a><br>";
    echo "<a href='update_form.php?id=$zeile->contentID'>editiere</a><br>";
    echo "<a href='delete1.php?id=$zeile->contentID'>l&ouml;sche</a><br>";
    echo "_________________________________________________________";
} else {
    print "Datensatz mit id=$contentID nicht gefunden!";
}
$db = null;
?>

<br>
<a href="alletexte.php">zurück</a>

