<?php

function showContentProfile ($userid)
{
    try {
        global $dsn, $dbuser, $dbpass;
        $db = new PDO($dsn, $dbuser, $dbpass);
        $sql = "SELECT * FROM content_txt INNER JOIN user ON content_txt.userID=user.userid WHERE content_txt.userID = $userid ORDER BY content_txt.contentID DESC";         // Können sow.rtiert werden mit "ORDER BY contentDate DESC" usw. WHERE content_txt.userID in (21, 19)
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

                    </div>
                    <div class="col-md-7 text-right">
                        <h5><?=$contentDate?></h5>
                        <div class="spacer"></div>
                        <?php echo voteButton($zeile->contentID); ?>
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

                <?php if ($contentPicture != '0') { ?>


                    <div class="row col-md-8 center-element">


                        <img src="<?=$contentPicture?>" class="img-responsive"><br>


                    </div>

                <?php } ?>
                <div class="col-md-12 left-element">

                    <?php

                    if ($zeile->contentSource) {
                        echo "Quelle: <a href='$zeile->contentSource'>$zeile->contentSource</a><br><br>";
                    }
                    ?>
                    <div class="col-md-8 right-element">
                        <?php
                    echo "<a style='text-align: right' href='show.php?contentID=$zeile->contentID'><i class='fa fa-eye'></i> Anzeigen</a>";


                    if ($_SESSION['userid'] == $zeile->userID) {
                    echo "<a class='strich'>|</a> <a href='content_edit.php?contentID=$zeile->contentID'><i class='fa fa-edit'></i> Bearbeiten</a>";
                    echo "<a class='strich'>|</a> <a href='delete_frage.php?contentID=$zeile->contentID'><i class='fa fa-remove'></i> Löschen</a><br>";
                    }

                    ?>
                </div>
                </div>
            </div>

            <?php
        }
    } catch (PDOException $e) {
        echo "Error!: Bitte wenden Sie sich an den Administrator!..." . $e;
        die();
    }
}              // Für Profilseite, generiert Inhalte aus GET ProfilID

function showContentAll ()
{
    try {
        global $dsn, $dbuser, $dbpass;
        $db = new PDO($dsn, $dbuser, $dbpass);
        $sql = "SELECT * FROM content_txt INNER JOIN user ON content_txt.userID=user.userid ORDER BY content_txt.contentID DESC";         // Können sow.rtiert werden mit "ORDER BY contentDate DESC" usw. WHERE content_txt.userID in (21, 19)
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
                    <div class="col-md-3 col-sm-3 col-xs-4">

                        <a data-toggle='tooltip' title='Profil von <?=$username?> aufrufen' data-placement='top' href="profil.php?userid=<?=$userID?>"><img src="<?=$profilePicture?>" class="img-responsive img-circle"></a>

                        <h4>Welle von <a href='profil.php?userid=<?=$userID?>'><?=$username?></a></h4>

                    </div>
                    <div class="col-md-9 text-right">
                        <?php followButtonAjaxNeu($_SESSION['userid'], $followerID, $contentID);?>
                        <div class="spacer"></div>
                        <h5><?=$contentDate?></h5>
                        <div class="spacer"></div>
                        <?php echo voteButton($zeile->contentID); ?>
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

                <?php if ($contentPicture != '0') { ?>


                <div class="row col-md-8 center-element">


                    <img src="<?=$contentPicture?>" class="img-responsive"><br>


                </div>

                <?php } ?>

                <div class="col-md-12 left-element">


                    <?php

                    if ($zeile->contentSource) {
                        echo "Quelle: <a href='$zeile->contentSource'>$zeile->contentSource</a><br><br>";
                    }
                    ?>
                    <div class="col-md-8 right-element">
                        <?php
                    echo "<a href='show.php?contentID=$zeile->contentID'><i class='fa fa-eye'></i> Anzeigen</a>";

                    if ($_SESSION['userid'] == $zeile->userID) {
                        echo "<a class='strich'>|</a> <a href='content_edit.php?contentID=$zeile->contentID'><i class='fa fa-edit'></i> Bearbeiten</a>";
                        echo "<a class='strich'>|</a> <a href='delete_frage.php?contentID=$zeile->contentID'><i class='fa fa-remove'></i> Löschen</a><br>";
                    }

                    ?>
                </div>
                </div>
            </div>

            <?php
        }
    } catch (PDOException $e) {
        echo "Error!: Bitte wenden Sie sich an den Administrator!..." . $e;
        die();
    }
}           // Zeigt alle Tweets an aus der DB

function showContentFollower ($festgelegteUserID)
{
    try {
        global $dsn, $dbuser, $dbpass;
        $db = new PDO($dsn, $dbuser, $dbpass);
        $sql = "SELECT * FROM content_txt INNER JOIN user ON content_txt.userID=user.userid WHERE content_txt.userID = $festgelegteUserID ORDER BY content_txt.contentID DESC";         // Können sow.rtiert werden mit "ORDER BY contentDate DESC" usw. WHERE content_txt.userID in (21, 19)
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
                    <div class="col-md-3 col-sm-3 col-xs-4">

                        <a data-toggle='tooltip' title='Profil von <?=$username?> aufrufen' data-placement='top' href="profil.php?userid=<?=$userID?>"><img src="<?=$profilePicture?>" class="img-responsive img-circle"></a>

                        <h4>Welle von <a href='profil.php?userid=<?=$userID?>'><?=$username?></a></h4>

                    </div>
                    <div class="col-md-9 text-right">
                        <?php followButtonAjaxNeu($_SESSION['userid'], $followerID, $contentID);?>
                        <div class="spacer"></div>
                        <h5><?=$contentDate?></h5>
                        <div class="spacer"></div>
                        <?php echo voteButton($zeile->contentID); ?>
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


                    <img src="<?=$contentPicture?>" class="img-responsive"><br>


                </div>
                <div class="col-md-12 left-element">

                    <?php


                    if ($zeile->contentSource) {
                        echo "Quelle: <a href='$zeile->contentSource'>$zeile->contentSource</a><br><br>";
                    }
                    ?>
                    <div class="col-md-8 right-element">
                        <?php
                    echo "<a href='show.php?contentID=$zeile->contentID'><i class='fa fa-eye'></i> Anzeigen</a>";


                    if ($_SESSION['userid'] == $zeile->userID) {
                        echo "<a class='strich'>|</a> <a href='content_edit.php?contentID=$zeile->contentID'><i class='fa fa-edit'></i> Bearbeiten</a>";
                        echo "<a class='strich'>|</a> <a right' href='delete_frage.php?contentID=$zeile->contentID'><i class='fa fa-remove'></i> Löschen </a><br>";
                    }

                    ?>
                </div>
                </div>
            </div>

            <?php
        }
    } catch (PDOException $e) {
        echo "Error!: Bitte wenden Sie sich an den Administrator!..." . $e;
        die();
    }
}               // Zeigt nur die Tweets der Leute an, denen gefolgt wird (TODO)

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
                echo "<points class='Punkte$contentID'>0</points>";
            } else {
                echo "<points class='Punkte$contentID'>$summe</points>";
            }
        }
    }

catch (PDOException $e) {
    echo "Error!: Bitte wenden Sie sich an den Administrator!...".$e;
    die();
}

}           // Gibt die Summe der Punkte für einen Post aus

function voteButton ($contentID) {     // Vote-Button



    $userID = $_SESSION['userid'];
    $negativ = "negativ";
    $positiv = "positiv";
    $delete = "delete";
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
        echo "<div class='Votebutton$contentID'><a data-toggle='tooltip' title='Positiv bewerten' data-placement='bottom' href='#!' onclick='voteJS($contentID, 1)'><i class=\"fa fa-arrow-up fa-3x\" aria-hidden=\"true\"style='color: black'></i></a><a data-toggle='tooltip' title='Bewertung löschen' data-placement='bottom' onclick='voteJS($contentID, 3)' href='#!'><i class=\"fa fa-arrow-down fa-3x\" aria-hidden=\"true\" style='color: red'></i></a></div>";
    }
    elseif (($WertinDB == 1) && ($schonBewertet == 1)) {
        echo "<div class='Votebutton$contentID'><a data-toggle='tooltip' title='Bewertung löschen' data-placement='bottom' href='#!' onclick='voteJS($contentID, 3)'><i class=\"fa fa-arrow-up fa-3x\" aria-hidden=\"true\" style='color: green'></i></a><a data-toggle='tooltip' title='Negativ bewerten' data-placement='bottom' onclick='voteJS($contentID, 2)' href='#!'><i class=\"fa fa-arrow-down fa-3x\" aria-hidden=\"true\" style='color: black'></i></a></div>";
    }
    elseif ($schonBewertet == 0) {
        echo "<div class='Votebutton$contentID'><a data-toggle='tooltip' title='Positiv bewerten' data-placement='bottom' href='#!' onclick='voteJS($contentID, 1)'><i class=\"fa fa-arrow-up fa-3x\" aria-hidden=\"true\" style='color: black'></i></a><a data-toggle='tooltip' title='Negativ bewerten' data-placement='bottom' onclick='voteJS($contentID, 2)' href='#!'><i class=\"fa fa-arrow-down fa-3x\" aria-hidden=\"true\" style='color: black'></i></a></div>";
    }

    }

    else {
        // Es wird kein Follow Knopf angezeigt
    }
}           // Up-Downvote Button

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
            echo "<div class='Folgenbutton$follower'><a data-toggle='tooltip' title='Entfolgen' data-placement='bottom' href='#!Folgen$follower' onclick='entfolgenJS($user, $follower, $contentID)'><img height='50px' src='img/unfollowbutton.jpg'></a></div>";


        } else {
            echo "<div class='Folgenbutton$follower'><a data-toggle='tooltip' title='Folgen' data-placement='bottom' href='#!Entfolgen$follower' onclick='folgenJS($user, $follower, $contentID)'><img height='50px' src='img/followbutton.jpg'></a></div>";
        }

    }
    else {
        // Es wird kein Follow Knopf angezeigt
    }
}           // Follow-Button wird damit angezeigt

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


function deleteTweetPicturefromServer ($contentID)
{

    try {
        global $dsn, $dbuser, $dbpass;
        $db = new PDO($dsn, $dbuser, $dbpass);
        $sql = "SELECT * FROM content_txt WHERE contentID=$contentID";
        $query = $db->prepare($sql);
        $query->execute();
        if ($zeile = $query->fetchObject()) {
            $pictureURL = $zeile->contentPicture;
            $db = null;
        }
        echo $pictureURL;
        if (isset($pictureURL)) {

            echo $pictureURL;

            if (unlink($pictureURL)) {

                echo 'success';
            } else {

                echo 'fail';
            }


        }
    } catch (PDOException $e) {
        echo "Error!: Bitte wenden Sie sich an den Administrator!..." . $e;
        die();
    }
}// Tweet-Bild löschen wenn


function showTooltipp($tooltipText){
    echo "data-toggle='tooltip' title='$tooltipText' data-placement='bottom'";

}