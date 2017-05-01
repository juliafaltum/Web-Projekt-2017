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
$sql = "SELECT * FROM content_txt WHERE contentID=$contentID";
$query = $db->prepare($sql);
$query->execute();
if ($zeile = $query->fetchObject()) {
    echo "<h1>Tweet Nummer: $zeile->contentID<br></h1>";
    echo "<h3>Geschrieben am: $zeile->contentDate</h3>";
    if (!empty($zeile->contentTXT)) { // confirmation of an empty database
        $contentText = $zeile->contentTXT;
    }

    if (!empty($zeile->contentPicture)) {
        $contentPicture = $zeile->contentPicture;
    }

    echo  '<form action= "uploadFile.php" method = "post" enctype="multipart/form-data"><br>';   //formular von html fängt hier an. Get und post! Bilder mit encriptet data.

    echo '<input type ="text" size="80" maxlength="500" value = "'.$contentText.'" id="contextText" name="contextText"> <br>';
    echo "<img src='$contentPicture' alt=\"Mountain View\" style=\"width:304px;height:228px;\"> <br>";


    echo '<input type= "file" name = "fileToUpload" id="fileToUpload"><br><br>';  // select image to upload
   // echo '<input type="submit" value="Upload" name="upload"/><br><br>';


    if (!empty($zeile->contentSource)) {
        $contentSource = $zeile->contentSource;
    }

   echo '<input type ="text" size="80" maxlength="500" value = "'.$contentSource.'" id="contextSource" name="contextSource"> <br>';

    echo "_________________________________________________________ <br><br>";

    echo '<input type ="submit" value = "speichern" name="submit" id="submit"> <br>';
    echo  '</form>';
    echo '<input type = "submit" value = "abbrechen" name= "cancel" id="cancel"> <br>';
} else {
    print "Datensatz mit id=$contentID nicht gefunden!";
}
$db = null;
?>

<br>
<a href="index.php">zurück</a>

