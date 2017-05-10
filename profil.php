<?php
include_once("session_check.php");
?>

    <html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="mystyle.css" media="screen"/>
    </head>

<body>

<?php

include_once("userdata.php");

try {
    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "SELECT * FROM content_txt INNER JOIN user ON content_txt.userID=user.userid";
    $sql = "SELECT * FROM content_txt INNER JOIN user ON content_txt.userID=user.userid WHERE userid=$_SESSION.userid";         // Können sortiert werden mit "ORDER BY contentDate DESC" usw.
    $query = $db->prepare($sql);
    $query->execute();

    $zeile = $query->fetchObject();
    echo "<h1>Profilseite von $zeile->username</h1>";

    while ($zeile = $query->fetchObject()) {

        echo "<h2>Tweet Nummer: $zeile->contentID<br></h2>";
        echo "<h3>Geschrieben am: $zeile->contentDate</h3>";
        echo "<h3>Geschrieben von: $zeile->username</h3>";              // Der Wert des "username" kann durch den Inner Join oben ausgelesen werden!
        echo "<h4>$zeile->contentTXT</h4>";
        echo "<img src='$zeile->contentPicture' alt=\"Mountain View\" style=\"width:304px;height:228px;\"> <br>";
        echo "Quelle: <a href='$zeile->contentSource'>$zeile->contentSource</a><br><br>";
        echo "<a href='show.php?contentID=$zeile->contentID'>zeige</a><br>";
        echo "<a href='edit.php?contentID=$zeile->contentID'>editiere</a><br>";
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
    echo "Error!: Bitte wenden Sie sich an den Administrator!...".$e;
    die();
}
?>