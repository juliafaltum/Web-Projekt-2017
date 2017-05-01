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
    if (!empty($zeile->contentTXT)) {
        $contentText = $zeile->contentTXT;
    }

    if (!empty($zeile->contentPicture)) {
        $contentPicture = $zeile->contentPicture;
    }


    echo '<input type ="text" size="80" maxlength="500" value = "'.$contentText.'" id=contextText> <br>';
    echo "<img src='$contentPicture' alt=\"Mountain View\" style=\"width:304px;height:228px;\"> <br>";

    echo  '<form action= "uploadFile.php" method = "post" enctype="multipart/form-data"><br>';
    echo '<input type= "file" name = "fileToUpload" id="fileToUpload"><br><br>';  // select image to upload
    echo '<input type="submit" value="Upload" name="upload"/><br><br>';
    echo  '</form>';

    if (!empty($zeile->contentSource)) {
        $contentSource = $zeile->contentSource;
    }

   echo '<input type ="text" size="80" maxlength="500" value = "'.$contentSource.'" id=contextSource> <br>';



    /*echo "Quelle: <a href='$zeile->contentSource'>$zeile->contentSource</a><br><br>";
    echo "<a href='show.php?id=$zeile->contentID'>zeige</a><br>";
    echo "<a href='update_form.php?id=$zeile->contentID'>editiere</a><br>";
    echo "<a href='delete1.php?id=$zeile->contentID'>l&ouml;sche</a><br>";*/
    echo "_________________________________________________________ <br><br>";

    echo '<input type ="submit" value = "Save Changes" name="save"> <br>';


} else {
    print "Datensatz mit id=$contentID nicht gefunden!";
}
$db = null;
?>

<br>
<a href="index.php">zurück</a>

