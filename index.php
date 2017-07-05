<?php include_once ("header.php");
include_once("userdata.php");
include_once("functions.php");?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>







<div class="container">


    <div class="row">
        <div class="col-md-2">

            <?php

            session_start();
            if(!isset($_SESSION['userid'])) {
                echo "<a href=\"create_user.php\">Registrieren</a><br><br>";
            }  // Ausloggen nur anzeigen wenn Nutzer eingeloggt ist, Einloggen und Registrieren nur wenn Nutzer ausgeloggt

            else {
                $username = $_SESSION['username'];
                echo "<h1>Hallo $username</h1>";
                echo "<br>";
                echo "<input class=\"btn btn-primary\" id=\"tweetVerfassenButton\" type=\"button\" value=\"Neue Welle verfassen\"/><div class=\"spacer\"></div>"; // Button und einblenden von Neuen Tweet verfassen
            }


            // Anzeigen von allen vorhandenen Tweets aus der Datenbank

            ?>
        </div>

        <div class="col-md-8 center-element">
            <div class="well-own" id="tweetformular" style="display: none;">Hier steht Inhalt</div>

<?=showContentAll();?>



        </div>

    </div>
</div>


<br>
</body>
</html>