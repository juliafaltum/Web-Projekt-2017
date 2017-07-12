<?php include_once ("header.php");?>

<!DOCTYPE html> <!-- das ist HTML 5 -->
<html>
<head>
    <meta charset="utf-8">
</head>
<body>

<?php

$contentID = $_GET["contentID"];

try {
    include_once("userdata.php");
    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "SELECT * FROM content_txt WHERE contentID=$contentID";
    $query = $db->prepare($sql);
    $query->execute();
    if (($zeile = $query->fetchObject()) && ($_SESSION['userid']==$zeile->userID)) {
        ?>
<div class='col-md-6 center-element'>
        <form action="content_edit_do.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="contentID" value="<?=$zeile->contentID;?>" />
        <div class="form-group">
            <label for="input3">Text der Welle:</label>
            <textarea  id="input3"  class="form-control" name="contentTXT" size="80" maxlength="500" rows="3" aria-describedby="basic-addon1"><?=$zeile->contentTXT;?></textarea>
        </div>
            <?php if ($zeile->contentPicture != '0') {
                echo "Aktuelles Bild: <br><img height ='200px' src ='$zeile->contentPicture'><br>";
                }?>



            <label for="wellebild">Neues Bild:</label>
            <input type="hidden" name="fileToUploadwennLeer" value="<?=$zeile->contentPicture;?>" />
            <input type="file" name="fileToUpload" id="fileToUpload">
            <br>
            <label for="wellequelle">Quelle:</label><br>
            <input value="<?=$zeile->contentSource;?>" style="width: 300px" id="wellequelle" type="text" name="contentSource" /><br><br>

            <div style="text-align: right"><a href="index.php" class="btn btn-danger">Abbrechen</a>&emsp;<input class="btn btn-primary" type="submit" value="Absenden" /></div>
        </form>
</div>
<?php

    } else {
        echo "Datensatz nicht gefunden oder du bist nicht der Autor!";
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