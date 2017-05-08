<?php
include_once("session_check.php");
?>
<!DOCTYPE html>
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

    echo '<form action="edit_do.php" method = "post"><br>';
    echo "<input type='hidden' name='id' value='$zeile->contentID' />";

    echo "<h1>Tweet Nummer: $zeile->contentID<br></h1>";
    echo "<h3>Geschrieben am: $zeile->contentDate</h3>";

    if (!empty($zeile->contentTXT)) { // confirmation of an empty database
        $contentText = $zeile->contentTXT;
    }
    if (!empty($zeile->contentPicture)) {
        $contentPicture = $zeile->contentPicture;
    }
    if (!empty($zeile->contentID)) {
        $contentID = $zeile->contentPicture;
    }
    echo '<input type ="text" size="80" maxlength="300" value = "' . $content_txt . '" id="content_txt" name="content_txt"> <br>';
    echo "<img src='$contentPicture' alt=\"Mountain View\" style=\"width:304px;height:228px;\"> <br>";

    echo '<input type= "file" name = "fileToUpload" id="fileToUpload"><br><br>';  // select image to upload
    // echo '<input type="submit" value="Upload" name="upload"/><br><br>';
}

    if (!empty($zeile->contentSource)) {
        $contentSource = $zeile->contentSource;
    }

    echo '<input type ="text" size="80" maxlength="500" value = "' . $contentSource . '" id="contextSource" name="contextSource"> <br>';

    echo "_________________________________________________________ <br><br>";

    echo '<input type ="submit" value = "speichern" name="submit" id="submit"> <br>';
    echo '<input type = "submit" value = "abbrechen" name= "cancel" id="cancel"> <br>';
    echo '</form>';

