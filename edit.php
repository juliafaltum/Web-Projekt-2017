<?php include_once ("header.php");?>
<?php
include_once("session_check.php");
?>

<!DOCTYPE html> <!-- das ist HTML 5 -->
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
    if (($zeile = $query->fetchObject()) && ($_SESSION['userid']==$zeile->userID)) { // Abgleichen der UserID mit der Session --> Kann nur von jeweiliger Person verändert werden

        echo "<h1>Tweet ID: $zeile->contentID</h1>";
        echo "<form action='edit_do.php' method='post'>";
        echo "<input type='hidden' name='contentID' value='$zeile->contentID' />";
        echo "Tweet Inhalt <input type='text' name='contentTXT' size='400' value='$zeile->contentTXT' /><br>";
        echo "Bild URL: <input type='text' name='contentPicture' value='$zeile->contentPicture' /><br>";
        echo "Quelle: <input type='text' name='contentSource' value='$zeile->contentSource' /><br><br>";
        echo "<input type='submit' value='Tweet bearbeiten' />";
        echo "</form>";

    } else {
        echo "Datensatz nicht gefunden, oder du bist nicht der Autor!!";
    }
    $db = null;
} catch (PDOException $e) {
    echo "Error!: Bitten wenden Sie sich an den Administrator...";
    die();
}

?>


</body>
</html>


</body>
</html>