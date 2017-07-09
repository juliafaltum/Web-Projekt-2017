<?php include_once ("header.php");?>
<?php include_once("session_check.php"); ?>

<?php

echo "<div class='col-md-3 left-element'></div>";
echo "<div class='col-md-6 center-element'>";

    echo "Die Wellen mit den besten Bewertungen";

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
         // Zeigt die am besten bewertetsten Tweets aus der DB





echo "</div>";
echo "<div class='col-md-3 right-element'></div>";