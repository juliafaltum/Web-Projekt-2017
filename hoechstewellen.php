<?php include_once ("header.php");
include_once("session_check.php"); ?>

<div class="container">

    <div class="row">
        <div class="col-md-5 center-element text-center">
            <h1>Höchsten Wellen</h1><br>
        </div>


    </div>

    <div class="row">


        <div class="col-md-8 center-element">

<?php

try {
    global $dsn, $dbuser, $dbpass;
    $db = new PDO($dsn, $dbuser, $dbpass);
    // Quelle: https://stackoverflow.com/questions/15865311/order-by-sumvalue-sql     -->      Wie Ordnen per Summe
    // Quelle: https://stackoverflow.com/questions/2051162/sql-multiple-column-ordering         --> Da immer neue Ergebnisse wenn neuladen der Seite (Da Punkte oft gleichstand), noch ORDER BY contentID ASC
    $sql = "SELECT contentID, SUM(ratingValue) AS contentPoints FROM rating GROUP BY contentID ORDER BY contentPoints DESC, contentID ASC";
    $query = $db->prepare($sql);
    $query->execute();

    while ($zeile = $query->fetchObject()) {



        showContentSpecific($zeile->contentID);

        ?>

        <?php
    }
} catch (PDOException $e) {
    echo "Error!: Bitte wenden Sie sich an den Administrator!..." . $e;
    die();
}


?>




        </div>

    </div>


</div>
