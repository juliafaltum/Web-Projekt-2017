<?php include_once ("header.php");?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>







<div class="container">


    <div class="row">
        <?php
        session_start();
        if(!isset($_SESSION['userid'])) {
            ?>

        <div class="col-md-1 left-element"></div>
        <div class="col-md-10 center-element">

            <div class="col-md-6 left-element">
                <br>
                <div class="Schriftzug"><img src="img/Schriftzug_blau.png" alt="ola" style="height: 70px" ></div>
                <br> <br>
                Ola ist eine Plattform für junge Künstler und Kunstinteressierte, die sich hier austauschen und neue Inspirationen holen können.
                <br><br>Werde jetzt ein Teil von ola!

            </div>
            <div class="col-md-6 right-element">
            <h2>Jetzt registrieren!</h2>
            <br>
            <form action="create_user_do.php" method="post" enctype="multipart/form-data">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Benutzername:*</span><input type="text" class="form-control" placeholder="Benutzername" name="username" aria-describedby="basic-addon1">
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Voller Name:*</span><input type="text" class="form-control" placeholder="Voller Name" name="fullname" aria-describedby="basic-addon1">
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">E-Mail:*</span><input type="text" class="form-control" placeholder="E-Mail" name="email" aria-describedby="basic-addon1">
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon">Passwort:*</span><input id="txtNewPassword" type="password" class="form-control" placeholder="Passwort" name="password" onChange="checkPasswordMatch();" aria-describedby="basic-addon1">
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon" >Passwort wiederholen:*</span><input id="txtConfirmPassword" type="password" class="form-control" placeholder="Passwort" onChange="checkPasswordMatch();" name="password2" aria-describedby="basic-addon1">
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon" >Profilbild hochladen:</span><input type="file" class="form-control" placeholder="Profilbild hochladen" name="fileToUpload" id="fileToUpload" aria-describedby="basic-addon1">
                </div>
                <br>

                <div class="registrationFormAlert" id="divCheckPasswordMatch">        </div>
                <div style="text-align: right"><input id="absenden" class="btn btn-primary"disabled type="submit" value="Benutzer erstellen" /></div>  <!-- Disabled macht den Button nicht klickbar, wird später per JS aktiviert -->
            </form>
                <br>
            </div>


        </div>
            <?php
        }
        ?>
        <div class="col-md-12">
        <div class="col-md-2">

            <?php

            session_start();
            if(!isset($_SESSION['userid'])) {

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
        <div class="col-md-1 right-element"></div>

</div>
</div>

<br>
</body>
</html>