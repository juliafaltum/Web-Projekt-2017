<?php include_once("session_check.php"); ?>
<?php include_once ("header.php");?>


    <html>
    <head>
        <meta charset="utf-8">
    </head>

<body>



<?php

include_once("userdata.php");

    $geholteuserID = $_GET['userid'];

    if (empty($geholteuserID = $_GET['userid'])) {

        $geholteuserID = $_SESSION['userid'];
    }

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

        $Birthdate = date("d-m-Y", strtotime($zeile->Birthdate));       // Konvertiere in Europäisches Zeitformat

            if (!$i) { ?>
                <div class="container">
                <div class="row">
                <div class="col-md-3">

                    <?php
                    echo "<br>";
                    echo "<br>";
                    echo "<img src='$profilePictureURL' alt='Profilbild' class='img-responsive'>";
                    echo "<br>";


                    if ($geholteuserID == $_SESSION['userid']) {
?>
                        <!-- Modal für Profilbild öffnen -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadPicture">Bild hochladen <i class="fa fa-upload"></i></button><br><br>
                    <a href="profil_edit.php"><button type="button" class="btn btn-success">Profil bearbeiten <i class="fa fa-edit"></i> </button></a>

                    <?php
                    }

                    ?>



                </div>
                <div class="col-md-8 equal">
                    <div class="well-own" id="tweetformular" style="display: none;"><?php include_once ('create_form.php');?></div>
                    <div class="page-header">
                        <?php
                        echo "<div class=\"panel-title\"><h2>Profilseite von $zeile->username</h2></div>";
                        ?>
                    </div>

                    <div class="row">
                        <div class="personal-header col-md-4">
                            Name: <?=$zeile->fullname;?><br>
                            Geburtsdatum: <?=$Birthdate?><br><br>
                        </div>
                        <div class="col-md-4 text-center">
                            <a href='followinglist.php?userid=<?=$zeile->userid?>'>Abonnements anzeigen</a> <span class='badge'><?=countAbonements($geholteuserID);?></span>
                            <br>
                            <a href='followerlist.php?userid=<?=$zeile->userid?>'>Abonnenten anzeigen</a> <span class='badge'><?=countFollower($geholteuserID)?></span>
                            <br><br>
                        </div>

                        <div class="personal-header col-md-4 text-right">
                            <?=followButtonAjaxNeu($_SESSION['userid'], $geholteuserID, 1);?>
                            <?php

                            if($_SESSION['userid'] == $geholteuserID) {

                                echo "<input class='btn btn-primary' id = 'tweetVerfassenButton'  type = 'button' value = 'Neue Welle verfassen' /><br><br>";
                                }
                                ?>
                            <br><br>
                        </div>

                    <br>
                    <br>
                    <br>

                        <?php

                    $i = true;

                     showContentProfile($geholteuserID);

                            ?>
                    </div>
                    <!-- Modal, function for the button "upload picture "-->
                    <div id="uploadPicture" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <div class="modal-header">Neues Profilbild hochladen!</div>

                                <div class="modal-body">
                                    <p><form action="profilbild_upload_do.php" method="post" enctype="multipart/form-data">
                                        Bild auswählen:
                                        <input type="file" name="fileToUpload" id="fileToUpload">

                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success" value="Bild hochladen" name="submit">Bild hochladen</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                                </div>
                            </div>



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
