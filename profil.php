<?php include_once ("header.php");?>
<?php
include_once("session_check.php");

?>

    <html>
    <head>
        <meta charset="utf-8">
    </head>

<body>



<?php

include_once("userdata.php");

    $geholteuserID = $_GET['userid'];

    try {
        global $dsn, $dbuser, $dbpass;
        $db = new PDO($dsn, $dbuser, $dbpass);
        $sql = "SELECT * FROM user LEFT JOIN content_txt ON user.userid=content_txt.userID WHERE user.userid = :userid";
        $query = $db->prepare($sql);
        $query->bindParam(':userid', $geholteuserID);
        $query->execute();

        $i = false;

        $profilePictureURL = profilePicture($geholteuserID);

        while ($zeile = $query->fetchObject()) {

            if (!$i) { ?>
                <div class="container">
                <div class="row equalheight">
                <div class="col-md-4 equal">
                    <?php
                    echo "<br>";
                    echo "<br>";
                    echo "<img src='$profilePictureURL' alt='Profilbild' width='200px' height='200px' class='img-responsive'>";
                    ?>
                </div>
                <div class="col-md-8 equal">

                    <div class="page-header">
                        <?php
                        echo "<div class=\"panel-title\"><h2>Profilseite von $zeile->username</h2></div>";
                        ?>
                    </div>

                    <?php
                    followButtonAjaxNeu($_SESSION['userid'], $geholteuserID, 1);
                    echo "<br>";
                    echo "<a href=\"followinglist.php?userid=$zeile->userid'\">Abonnements anzeigen</a>";
                    echo " <br>";
                    echo "<a href=\"followerlist.php?userid=$zeile->userid'\">Abonnenten anzeigen</a>";
                    echo " <br>";
                    echo " <br>";


                    if ($_SESSION['userid'] == $zeile->userID and !$i) {
                        echo "<a href=\"profil_edit.php\">Profil bearbeiten</a><br><br>";
                    }
                    $i = true;

                     showContentProfile($geholteuserID);

                            ?>


                </div>
                </div>
                </div>


           <?php      $db = null;
            }
        }
    } catch
    (PDOException $e) {
        echo "Error!: Bitte wenden Sie sich an den Administrator!..." . $e;
        die();
    }

    ?>
    <br>



    </body>
    </html>
