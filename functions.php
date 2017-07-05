<?php

function showContent ($userid)
{
    try {
        global $dsn, $dbuser, $dbpass;
        $db = new PDO($dsn, $dbuser, $dbpass);
        $sql = "SELECT * FROM content_txt INNER JOIN user ON content_txt.userID=user.userid WHERE content_txt.userID = $userid";         // Können sow.rtiert werden mit "ORDER BY contentDate DESC" usw. WHERE content_txt.userID in (21, 19)
        $query = $db->prepare($sql);
        $query->execute();

        while ($zeile = $query->fetchObject()) {

            $followerID = $zeile->userid;
            $contentID = $zeile->contentID;

            echo "<h3>Welle von <a href='profil.php?userid=$zeile->userid'>$zeile->username</a></h3>";
            echo "<h5>$zeile->contentDate</h5";
            echo "<br>";
            // followButtonAjax ($_SESSION['userid'], $followerID, $contentID);
            // followButton ($_SESSION['userid'], $followerID);     // FUNKTION: Follow-Button

            followButtonAjaxNeu($_SESSION['userid'], $followerID, $contentID);

            echo "<br>";
            echo "<h4>Punkte: ";
            echo contentPoints($zeile->contentID);
            echo voteButton($_SESSION['userid'], $zeile->contentID);
            echo "</h4>";


            echo "<h5>$zeile->contentTXT</h5>";
            echo "<img src='$zeile->contentPicture' alt=\"Bild nicht verfügbar\" style=\"width:304px;height:228px;\"> <br>";
            echo "Quelle: <a href='$zeile->contentSource'>$zeile->contentSource</a><br><br>";
            echo "<a href='show.php?contentID=$zeile->contentID'>anzeigen</a><br>";


            if ($_SESSION['userid'] == $zeile->userID) {
                echo "<a href='edit.php?contentID=$zeile->contentID'>bearbeiten</a><br>";
                echo "<a href='delete_frage.php?contentID=$zeile->contentID'>l&ouml;schen</a><br>";
            }
            echo "_________________________________________________________";
            echo "<br>";
        }
    } catch (PDOException $e) {
        echo "Error!: Bitte wenden Sie sich an den Administrator!..." . $e;
        die();
    }
}           // Für Profilseite, generiert Inhalte aus FollowerID

function showContentAll ()
{
    try {
        global $dsn, $dbuser, $dbpass;
        $db = new PDO($dsn, $dbuser, $dbpass);
        $sql = "SELECT * FROM content_txt INNER JOIN user ON content_txt.userID=user.userid";         // Können sow.rtiert werden mit "ORDER BY contentDate DESC" usw. WHERE content_txt.userID in (21, 19)
        $query = $db->prepare($sql);
        $query->execute();

        while ($zeile = $query->fetchObject()) {

            $followerID = $zeile->userid;
            $contentID = $zeile->contentID;
            $username = $zeile->username;
            $userID = $zeile->userid;
            $profilePicture = profilePicture($userID);

            $contentDate = $zeile->contentDate;
            $contentTXT = $zeile->contentTXT;
            $contentPicture = $zeile->contentPicture;
            $contentSource = $zeile->contentSource;


            ?>

            <div class="well-own col-md-12">
                <div class="row">
                    <div class="col-md-5 col-xs-5">

                        <img src="<?=$profilePicture?>" class="img-responsive img-circle">

                        <h3>Welle von <a href='profil.php?userid=<?=$userID?>'><?=$username?></a></h3>

                    </div>
                    <div class="col-md-7 text-right">
                        <?php followButtonAjaxNeu($_SESSION['userid'], $followerID, $contentID);?>
                        <div class="spacer"></div>
                        <h5><?=$contentDate?></h5>
                        <div class="spacer"></div>
                        <?php echo voteButton($_SESSION['userid'], $zeile->contentID); ?>
                        <div class="spacer"></div>
                        Punkte: <?php echo contentPoints($zeile->contentID);?>




                    </div>

                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">

                        <?=$contentTXT?>


                    </div>


                </div>

                <div class="row col-md-8 center-element">


                    <img src="<?=$contentPicture?>" class="img-responsive">


                </div>
                <div class="col-md-5">

                    <?php

                    echo "Quelle: <a href='$zeile->contentSource'>$zeile->contentSource</a><br><br>";
                    echo "<a href='show.php?contentID=$zeile->contentID'>anzeigen</a><br>";


                    if ($_SESSION['userid'] == $zeile->userID) {
                        echo "<a href='edit.php?contentID=$zeile->contentID'>bearbeiten</a><br>";
                        echo "<a href='delete_frage.php?contentID=$zeile->contentID'>l&ouml;schen</a><br>";
                    }

                    ?>
                </div>
            </div>

            <?php
        }
    } catch (PDOException $e) {
        echo "Error!: Bitte wenden Sie sich an den Administrator!..." . $e;
        die();
    }
}           // Zeigt alle Tweets an

function showContentFollower ($userid)
{
    try {
        global $dsn, $dbuser, $dbpass;
        $db = new PDO($dsn, $dbuser, $dbpass);
        $sql = "SELECT * FROM content_txt INNER JOIN user ON content_txt.userID=user.userid WHERE content_txt.userID = $userid";         // Können sow.rtiert werden mit "ORDER BY contentDate DESC" usw. WHERE content_txt.userID in (21, 19)
        $query = $db->prepare($sql);
        $query->execute();

        while ($zeile = $query->fetchObject()) {

            $followerID = $zeile->userid;
            $contentID = $zeile->contentID;
            $username = $zeile->username;
            $userID = $zeile->userid;
            $profilePicture = profilePicture($userid);


            $contentDate = $zeile->contentDate;
            $contentTXT = $zeile->contentTXT;
            $contentPicture = $zeile->contentPicture;
            $contentSource = $zeile->contentSource;


            ?>

            <div class="well-own col-md-12">
        <div class="row">
                <div class="col-md-5 col-xs-5">

                    <img src="<?=$profilePicture?>" class="img-responsive img-circle">

                    <h3>Welle von <a href='profil.php?userid=<?=$userID?>'><?=$username?></a></h3>

                </div>
                <div class="col-md-7 text-right">
                    <?php followButtonAjaxNeu($_SESSION['userid'], $followerID, $contentID);?>
            <div class="spacer"></div>
                    <h5><?=$contentDate?></h5>
            <div class="spacer"></div>
            <i class="fa fa-arrow-up fa-3x" aria-hidden="true"></i>
            <i class="fa fa-arrow-down fa-3x" aria-hidden="true"></i>
            <div class="spacer"></div>
            Punkte: <?php echo contentPoints($zeile->contentID);?>
                    <br>
                    <?php echo voteButton($_SESSION['userid'], $zeile->contentID); ?>


            </div>

            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">

                    <?=$contentTXT?>


                </div>


            </div>

            <div class="row col-md-8 center-element">


                <img src="<?=$contentPicture?>" class="img-responsive">


            </div>
                <div class="col-md-5">

                <?php

                echo "Quelle: <a href='$zeile->contentSource'>$zeile->contentSource</a><br><br>";
                echo "<a href='show.php?contentID=$zeile->contentID'>anzeigen</a><br>";


                if ($_SESSION['userid'] == $zeile->userID) {
                    echo "<a href='edit.php?contentID=$zeile->contentID'>bearbeiten</a><br>";
                    echo "<a href='delete_frage.php?contentID=$zeile->contentID'>l&ouml;schen</a><br>";
                }

                ?>
                </div>
            </div>

            <?php
        }
    } catch (PDOException $e) {
        echo "Error!: Bitte wenden Sie sich an den Administrator!..." . $e;
        die();
    }
}           // Für Followerliste, generiert Inhalte aus FollowerID

function contentPoints ($contentID) {           // Punkte berechnen von Einträgen

    try {
        global $dsn, $dbuser, $dbpass;
        $db = new PDO($dsn, $dbuser, $dbpass);
        $sql = "SELECT SUM(ratingValue) AS contentPoints FROM rating WHERE contentID = :contentID";
        $query = $db->prepare($sql);
        $query->bindParam(':contentID', $contentID);
        $query->execute();

        if ($zeile = $query->fetchObject()) {
            $summe = $zeile->contentPoints;

            if ($summe == 0) {
                echo "0";
            } else {
                echo $summe;
            }
        }
    }

catch (PDOException $e) {
    echo "Error!: Bitte wenden Sie sich an den Administrator!...".$e;
    die();
}

}




function followButton ($user, $follower) {       // Follow-Button

if (($user != $follower) && (!empty($user))) {       // überprüfen ob man selbst Autor des Tweets ist & eingeloggt ist, wenn ja ab zur else unten

    global $dsn, $dbuser, $dbpass;
    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "SELECT * FROM followerlist WHERE user = :user AND follower = :follower";
    $query = $db->prepare($sql);
    $query->bindParam(':user', $user);
    $query->bindParam(':follower', $follower);
    $query->execute();

    while ($zeile = $query->fetchObject()) {
        $folgt = 1;

    }

    if ($folgt == 1) {
        echo "<a href='unfollow_do.php?entfolgeuser=$follower'>(Entfolgen)</a>";


    } else {
        echo "<a href='follower_do.php?user=$follower'>(Folgen)</a>";
    }

}
else {
    // Es wird kein Follow Knopf angezeigt
}
}

function voteButton ($userID, $contentID) {     // Vote-Button

    if (!empty($userID)) {


        // Überprüfen ob schon gevotet

    global $dsn, $dbuser, $dbpass;
$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM rating WHERE contentID=$contentID AND userID=$userID";
$query = $db->prepare($sql);
$query->execute();
if ($zeile = $query->fetchObject()) {
    $WertinDB = $zeile->ratingValue;
    $userIDinDB = $zeile->userID;
    $schonBewertet = 1;
}
else {
    $schonBewertet = 0;
}
$db = null;


    if (($WertinDB == -1) && ($schonBewertet == 1)) {
        echo "<a href='rating_do.php?contentID=$contentID&wertung=positiv'><i class=\"fa fa-arrow-up fa-3x\" aria-hidden=\"true\"style='color: black'></i></a><a href='rating_do.php?contentID=$contentID&wertung=delete'><i class=\"fa fa-arrow-down fa-3x\" aria-hidden=\"true\" style='color: red'></i></a>";
    }
    elseif (($WertinDB == 1) && ($schonBewertet == 1)) {
        echo "<a href='rating_do.php?contentID=$contentID&wertung=delete'><i class=\"fa fa-arrow-up fa-3x\" aria-hidden=\"true\" style='color: green'></i></a><a href='rating_do.php?contentID=$contentID&wertung=negativ'><i class=\"fa fa-arrow-down fa-3x\" aria-hidden=\"true\" style='color: black'></i></a>";
    }
    elseif ($schonBewertet == 0) {
        echo "<a href='rating_do.php?contentID=$contentID&wertung=positiv'><i class=\"fa fa-arrow-up fa-3x\" aria-hidden=\"true\" style='color: black'></i></a><a href='rating_do.php?contentID=$contentID&wertung=negativ'><i class=\"fa fa-arrow-down fa-3x\" aria-hidden=\"true\" style='color: black'></i></a>";
    }

    }

    else {
        // Es wird kein Follow Knopf angezeigt
    }
}

function followButtonAjax ($userID, $followerID, $contentID) {
?>
    <div id="followButton<?php echo $contentID;?>"></div>
    <script type="text/javascript">
        $(document).ready(function() {


            $(function () {
                $('#followButton<?php echo $contentID;?>').load("follow_Button.php?user=<?php echo $userID;?>&follower=<?php echo $followerID;?>&contentID=<?php echo $contentID;?>", function(response) {
                    $("#followButton<?php echo $contentID;?>").html(response).hide().fadeIn(350);
                });
            });
        });

    </script>


<?php
}

function followButtonAjaxNeu ($user, $follower, $contentID) {       // Follow-Button

    if (($user != $follower) && (!empty($user))) {       // überprüfen ob man selbst Autor des Tweets ist & eingeloggt ist, wenn ja ab zur else unten

        global $dsn, $dbuser, $dbpass;
        $db = new PDO($dsn, $dbuser, $dbpass);
        $sql = "SELECT * FROM followerlist WHERE user = :user AND follower = :follower";
        $query = $db->prepare($sql);
        $query->bindParam(':user', $user);
        $query->bindParam(':follower', $follower);
        $query->execute();

        while ($zeile = $query->fetchObject()) {
            $folgt = 1;

        }

        if ($folgt == 1) {
            echo "<div class='Folgenbutton$follower'><a href='#!Folgen$follower' onclick='entfolgenJS($user, $follower, $contentID)'><img height='50px' src='img/unfollowbutton.jpg'></a></div>";


        } else {
            echo "<div class='Folgenbutton$follower'><a href='#!Entfolgen$follower' onclick='folgenJS($user, $follower, $contentID)'><img height='50px' src='img/followbutton.jpg'></a></div>";
        }

    }
    else {
        // Es wird kein Follow Knopf angezeigt
    }
}

function tweetFormulartoggle () {
?>

    <input class="btn btn-primary" id="tweetVerfassenButton" type="button" value="Neue Welle verfassen"/>

    <script>
    $(document).ready(function(){
        $("#tweetformular").load("create_form.php").hide();
        $("#tweetVerfassenButton").click(function(){
            $("#tweetformular").toggle(200);
        });
    });
    </script>



    <div id="tweetformular" style="display: none;">Hier steht Inhalt</div>


<?php
}


function profilePicture ($userid)
{
    try {
        global $dsn, $dbuser, $dbpass;
        $db = new PDO($dsn, $dbuser, $dbpass);
        $sql = "SELECT * FROM user WHERE userid = $userid";         // Können sow.rtiert werden mit "ORDER BY contentDate DESC" usw. WHERE content_txt.userID in (21, 19)
        $query = $db->prepare($sql);
        $query->execute();

        while ($zeile = $query->fetchObject()) {

            $profilePictureURL = $zeile->profilePicture;


        }

        if (!empty($profilePictureURL))        {
            return $profilePictureURL;
        }

        else {
            $profilePictureURL = "img/kein_Profilbild.png";
            return $profilePictureURL;
        }

    } catch (PDOException $e) {
        echo "Error!: Bitte wenden Sie sich an den Administrator!..." . $e;
        die();
    }
}           // Für Profilseite, generiert ProfilbildURL