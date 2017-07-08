<?php include_once ("header.php");

$festgelegteUserID = $_SESSION['userid'];

?>


<div class="container">


    <div class="row">
        <div class="col-md-2">

            <?php

            session_start();
            if(!isset($_SESSION['userid'])) {
                header('Location: index.php');
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

            <?php

            $db = new PDO($dsn, $dbuser, $dbpass);
            $sql = "SELECT * FROM followerlist INNER JOIN user ON followerlist.follower=user.userid WHERE followerlist.user = :festgelegteUserID";       // UserID = 19 zeigt alles von Nutzer 19 an
            $query = $db->prepare($sql);
            $query->bindParam(':festgelegteUserID', $festgelegteUserID);
            $query->execute();

            while ($zeile = $query->fetchObject()) {
                showContentFollower($zeile->userid);
            }


            ?>



        </div>

    </div>
</div>