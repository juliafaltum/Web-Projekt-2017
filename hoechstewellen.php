<?php include_once ("header.php");?>
<?php include_once("session_check.php"); ?>

<?php

echo "<div class='col-md-3 left-element'></div>";
echo "<div class='col-md-6 center-element'>";

    echo "Die Wellen mit den besten Bewertungen";

try {
    global $dsn, $dbuser, $dbpass;
    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "SELECT * FROM content_txt INNER JOIN user ON content_txt.userID=user.userid INNER JOIN rating ON content_txt.userID=rating.userID ORDER BY ABS(ratingValue) ASC ";
    $query = $db->prepare($sql);
    $query->execute();

    while ($zeile = $query->fetchObject()) {

        $followerID = $zeile->userid;
        $contentID = $zeile->contentID;
        $username = $zeile->username;
        $userID = $zeile->userid;
        $profilePicture = $zeile->profilePicture;

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
         // Zeigt die am besten bewertetsten Tweets aus der DB





echo "</div>";
echo "<div class='col-md-3 right-element'></div>";