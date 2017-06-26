<?php
include_once ("header.php");
include_once("session_check.php");
include_once("userdata.php");
include_once("functions.php");
?>

    <html>
    <head>
        <meta charset="utf-8">
    </head>

<body>

    <script src="js/jquery.min.js"></script>

<?php

$geholteuserID = $_GET['userid'];

try {
    global $dsn, $dbuser, $dbpass;
    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "SELECT * FROM followerlist INNER JOIN user ON followerlist.follower=user.userid WHERE user.userid = :userid";
    $query = $db->prepare($sql);
    $query->bindParam(':userid', $geholteuserID);
    $query->execute();

    $i = false;

    while ($zeile = $query->fetchObject()) {

        if (!$i ) {
            echo "<h1>$zeile->username folgt folgenden Nutzern:</h1>";
            $i = true;
        }

            echo "<a href='profil.php?userid=$zeile->userid'>$zeile->username</a></h3>";
            echo "<br>";

    }
    ?>

    <?php

    $db = null;
}

catch (PDOException $e) {
    echo "Error!: Bitte wenden Sie sich an den Administrator!...".$e;
    die();
}
?>

</body>
</html>