<?php include_once ("header.php");?>
<?php
include_once("session_check.php");
?>

<!DOCTYPE html> <!-- das ist HTML 5 -->
<html>
<head>
    <meta charset="utf-8">
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
        echo "<div class='col-md-3 left-element'></div>";
        echo "<div class='col-md-6 center-element'>";
        echo "<form action='content_edit_do.php' method='post'>";
        echo "<input type='hidden' name='contentID' value='$zeile->contentID' />";
        echo "<label for='input3'>Text der Welle:</label>";
        echo "<textarea id='input3' class='form-control' name='contentTXT' size='80' maxlength='500' rows='3' aria-describedby='basic-addon1'>";
        echo "$zeile->contentTXT";
        echo "</textarea><br>";
        echo "<label for='wellebild'>Bild:</label><br>";
        echo "<input type='text' name='contentPicture' value='$zeile->contentPicture' style='width: 300px' /><br>";
        echo "<input id='wellebild' type='file' name='fileToUpload' id='fileToUpload' value='$zeile->contentPicture'>";
        echo "<br>";
        echo "<label for='wellequelle'>Quelle:</label><br>";
        echo "<input style='width: 300px' id='wellequelle' type='text' name='contentSource' value='$zeile->contentSource'/><br><br>";
        echo "<div style=\"text-align: right\"><input class='btn btn-primary' type='submit' value='Welle bearbeiten'></div>";
        echo "</form>";
        echo "</div>";
    } else {
        echo "Datensatz nicht gefunden oder du bist nicht der Autor!";
    }
    echo "<div class='col-md-3 right-element'></div>";
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