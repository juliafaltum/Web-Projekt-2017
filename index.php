<?php include_once ("header.php");?>

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


                echo "<input class=\"btn btn-primary\" id=\"tweetVerfassenButton\"  type=\"button\" value=\"Neue Welle verfassen\"/><div class=\"spacer\"></div>"; // Button und einblenden von Neuen Tweet verfassen
                echo "<a href='photoGallery.php'<button class=\"btn btn-info\" type=\"button\"/>Zur privaten Fotogalerie</button></a><div class=\"spacer\"></div>";
            }


            // Anzeigen von allen vorhandenen Tweets aus der Datenbank

            ?>
        </div>

        <div class="col-md-8 center-element">
            <div class="well-own" id="tweetformular" style="display: none;"><?php include_once ('create_form.php');?></div>

<?=showContentAll();?>



        </div>

    </div>
</div>


<br>
</body>
</html>