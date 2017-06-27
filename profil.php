<?php include_once ("header.php");?>
<?php
include_once("session_check.php");
?>

    <html>
    <head>
        <meta charset="utf-8">
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
                echo "<a href=\"followinglist.php?userid=$zeile->userid'\">Abonnements anzeigen</a>";
                echo" <br>";
                echo "<a href=\"followerlist.php?userid=$zeile->userid'\">Abonnenten anzeigen</a>";
                echo" <br>";
            }

            if ($_SESSION['userid'] == $zeile->userID and !$i) {
                echo "<a href=\"profil_edit.php\">Profil bearbeiten</a>";
                $i = true;
            }

            followButtonAjaxNeu ($_SESSION['userid'], $geholteuserID, 1);

            echo "<h3>Welle von $zeile->username</h3>";
            echo "<h5>$zeile->contentDate</h5>";
            echo "$zeile->contentTXT <br>";
            echo "<img src='$zeile->contentPicture' alt=\"Bild nicht verfügbar\" style=\"width:304px;height:228px;\"> <br>";
            echo "Quelle: <a href='$zeile->contentSource'>$zeile->contentSource</a><br><br>";
            echo "<a href='show.php?contentID=$zeile->contentID'>anzeigen</a><br>";

            if ($_SESSION['userid'] == $zeile->userID) {
                echo "<a href='edit.php?contentID=$zeile->contentID'>bearbeiten</a><br>";
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
