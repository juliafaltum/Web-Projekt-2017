<?php
include_once("session_check.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="mystyle.css" media="screen"/>
</head>
<body>

<?php
try {
    include_once("userdata.php");
    $contentID = (int)$_GET["contentID"];
    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "SELECT * FROM content_txt WHERE contentID=$contentID";
    $query = $db->prepare($sql);
    $query->execute();
    if ($zeile = $query->fetchObject()) {

        echo "<form action='edit_do.php' method='post'>";
        echo "<input type='hidden' name='id' value='$zeile->contentID' />";

        echo "<h1>Tweet Nummer: $zeile->contentID</h1>";
        echo "<h3>Geschrieben am: $zeile->contentDate</h3><br>";

        if (!empty($zeile -> contentTXT))
        {$contentext = $zeile->contentTXT;}
        if (!empty($zeile -> contentPicture))
        {$contentPicture = $zeile->contentPicture;}
        if (!empty($zeile -> contentID))
        {$contentID  = $zeile->contentID;}

        echo "<input type ='text' size='80' maxlength='300' value =' . $contentTXT . ' id= 'contentText' name= 'contentText'> <br>";
        echo "<img src='$contentPicture' alt=\"Mountain View\" style=\"width:304px;height:228px;\"> <br>";
        echo "<input type = 'file' name= 'fileToUpload' id= 'fileToUpload'><br><br>";

        echo "<input type='text' name='text' size='40' maxlength='80' value='$zeile->text' /><br><br>";
        echo "<input type ='text' size='80' maxlength='500' value = ' . $contentSource . ' id= 'contentSource' name='contentSource'> <br>";

        echo "<input type='submit' value='speichern' name=' submit' id='submit'><br>";
        echo "</form>";


    } else {
        echo "Datensatz nicht gefunden!";
    }
    $db = null;
} catch (PDOException $e) {
    echo "Error!: Bitten wenden Sie sich an den Administrator...";
    die();
}
?>


</body>
</html>