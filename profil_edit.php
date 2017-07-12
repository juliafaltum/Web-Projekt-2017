<?php include_once("session_check.php");
include_once ("header.php"); ?>

<!-- datepicker für die geburtsdatum alte library version, sonst wird die gesamte design verändert-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/js/bootstrap-datepicker.js"></script>


<!DOCTYPE html> <!-- das ist HTML 5 -->
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="mystyle.css" media="screen"/>
</head>
<body>

<?php
try {
    include_once("userdata.php");
    $userid = $_SESSION["userid"];
    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "SELECT * FROM user WHERE userid = $userid";
    $query = $db->prepare($sql);
    $query->bindParam('userid', $userid);
    $query->execute();
    if (($zeile = $query->fetchObject()) && ($_SESSION['userid']==$zeile->userid)) { // Abgleichen der UserID mit der Session --> Kann nur von jeweiliger Person verändert werden

        // Birthdate ausgeben das schon vorhanden ist für Formular
        $Birthdate = date("d-m-Y", strtotime($zeile->Birthdate));

        ?>

        <div class='col-md-6 center-element'>
        <form action='profil_edit_do.php' method='post'>
        <input type='hidden' name='userid' value='<?=$zeile->userid?>' />
        <h2>Bearbeite dein Profil:</h2>
        <div class='input-group''>
        <span class='input-group-addon' id='basic-addon1'>Name:</span><input type='text' class='form-control' name='fullname' value='<?=$zeile->fullname?>' aria-describedby='basic-addon1'>
        </div><br>
        <div class='input-group''>
        <span class='input-group-addon' id='basic-addon1'>E-Mail:</span><input type='text' class='form-control' name='email' value='<?=$zeile->email?>' aria-describedby='basic-addon1''>
        </div><br>

        <div class="input-group">
            <span  class= "input-group-addon" id="basic-addon1">Geburtsdatum:</span>
            <div class='input-group date' id='datepicker1'  class="form-control">
                <input value='<?=$Birthdate?>' type='text' class="form-control" name="birthdate"/>
                <span class="input-group-addon">
                                <span class="fa fa-calendar"></span>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#datepicker1').datepicker();
            });
        </script>

        <br>
        <div style="text-align: right"><a href='profil.php' class='btn btn-primary' type='submit'>Abbrechen</a> <input class='btn btn-success' type='submit' value='Profil bearbeiten'></div>
        </form>

        <div class="row">
            <hr>
            <h2>Weitere Einstellungen:</h2>

            <a data-toggle="modal" data-target="#passwordReset" class='btn btn-primary' type='submit'>Passwort zurücksetzen</a><br><br>
            <a data-toggle="modal" data-target="#deleteAccount" class='btn btn-danger' type='submit'>Account löschen</a>

        </div>





        </div>



        <div id="deleteAccount" class="modal fade" role="dialog">
            <div class="modal-dialog">


                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <div class="modal-header">Account löschen!</div>

                    <div class="modal-body">
                            <div class="alert alert-danger">
                                <strong><h3>Wichtig!</h3></strong>Möchtest du deinen Account wirklich löschen?<br> Dies kann nicht Rückgängig gemacht werden.<br> Alle deine Tweets und Medien werden dabei gelöscht!
                            </div>
                    </div>
                    <div class="modal-footer">
                        <a href='delete_user.php' class='btn btn-danger' type='submit'>Account löschen</a>
                        <button type="button" class="btn btn-success" data-dismiss="modal">Abbrechen</button>
                    </div>
                </div>



            </div>
        </div>

        <div id="passwordReset" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <div class="modal-header">Neues Passwort anfordern</div>

                    <div class="modal-body">
<p>
                            <?php include_once ('reset_password.php')?>
</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Abbrechen</button>
                    </div>
                </div>

            </div>
        </div>


<?php
    } else {
        echo "Datensatz nicht gefunden oder das ist nicht dein Profil!";
    }
    $db = null;
} catch (PDOException $e) {
    echo "Error!: Bitten wenden Sie sich an den Administrator...";
    die();
}

?>


</body>
</html>
