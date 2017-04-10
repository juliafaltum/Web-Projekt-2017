<!DOCTYPE html> <!-- das ist HTML 5 -->
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="mystyle.css" media="screen"/>
</head>
<h1>Alle Tweets</h1>
<body>

<a href="create_form.html">neuer Tweet</a><br>
<a href="create_user.html">neuer Benutzer</a>
    <?php

    include_once("userdata.php");

    try {
    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "SELECT * FROM content_txt";         // ORDER BY contentDate DESC
    $query = $db->prepare($sql);
    $query->execute();

    while ($zeile = $query->fetchObject()) {
        echo "<h1>Tweet Nummer: $zeile->contentID<br></h1>";
        echo "<h3>Geschrieben am: $zeile->contentDate</h3>";
        echo "<h4>$zeile->contentTXT</h4>";
        echo "<img src='$zeile->contentPicture' alt=\"Mountain View\" style=\"width:304px;height:228px;\"> <br>";
        echo "Quelle: <a href='$zeile->contentSource'>$zeile->contentSource</a><br><br>";
        echo "<a href='show.php?contentID=$zeile->contentID'>zeige</a><br>";
        echo "<a href='update_form.php?id=$zeile->contentID'>editiere</a><br>";
        echo "<a href='delete1.php?id=$zeile->contentID'>l&ouml;sche</a><br>";
        echo "_________________________________________________________";
    }
    ?>
<br>




</body>
</html>

<?php
$db = null;
} catch (PDOException $e) {
    echo "Error!: Bitte wenden Sie sich an den Administrator!?...".$e;
    die();
}
?>