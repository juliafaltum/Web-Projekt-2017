<?php
include_once("session_check.php");
?>

    <html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="mystyle.css" media="screen"/>
    </head>

<body>

<script src="js/jquery.min.js"></script>

<?php

$geholteuserID = $_GET['userid'];

include_once("userdata.php");
include_once("functions.php");

    $geholteuserID = $_GET['userid'];

    try {
        global $dsn, $dbuser, $dbpass;
        $db = new PDO($dsn, $dbuser, $dbpass);
        $sql = "SELECT * FROM content_txt INNER JOIN user ON content_txt.userID=user.userid WHERE user.userid = :userid";
        $query = $db->prepare($sql);
        $query->bindParam(':userid', $geholteuserID);
        $query->execute();

        $i = false;

        while ($zeile = $query->fetchObject()) {

            if (!$i) {
                echo "<h1>Profilseite von $zeile->username</h1>";
                $i = true;
            }

            followButton($_SESSION['userid'], $geholteuserID);
            followButtonAjax ($_SESSION['userid'], $geholteuserID, 1);

            echo "<h3>Geschrieben von $zeile->username</h3>";
            echo "<h3>Tweet Nummer: $zeile->contentID<br></h3>";
            echo "<h3>Geschrieben am: $zeile->contentDate</h3>";
            echo "<h4>$zeile->contentTXT</h4>";
            echo "<img src='$zeile->contentPicture' alt=\"Bild nicht vorhanden\" style=\"width:304px;height:228px;\"> <br>";
            echo "Quelle: <a href='$zeile->contentSource'>$zeile->contentSource</a><br><br>";

            if ($_SESSION['userid'] == $zeile->userID) {
                echo "Du bist Autor dieses Posts, also kannst du folgendes machen: <br>";
                echo "<a href='edit.php?contentID=$zeile->contentID'>editieren</a><br>";
                echo "<a href='delete_frage.php?contentID=$zeile->contentID'>l&ouml;schen</a><br>";
                echo "_________________________________________________________";
            }

            $db = null;
        }
    }
    catch
    (PDOException $e) {
        echo "Error!: Bitte wenden Sie sich an den Administrator!..." . $e;
        die();
    }

    ?>
    <br>



    </body>
    </html>
