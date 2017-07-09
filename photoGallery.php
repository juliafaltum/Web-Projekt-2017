<?php
include_once('header.php');
include_once ('session_check.php');

$userID = $_SESSION['userid']

?>

<div class="container" xmlns="http://www.w3.org/1999/html">

<div class="row">

    <div class="col-md-4">

        <form action="photoActions.php?action=newupload" method="post" enctype="multipart/form-data">

            <input id="wellebild" type="file" name="fileToUpload" id="fileToUpload">
            <div class="spacer"></div>
            <input class="btn btn-success" type="submit" value="Neues Foto hochladen" />
        </form>

    </div>

    <div class="col-md-8 text-right">

        <a href="photoActions.php?action=manage"><button class="btn btn-primary" />Fotos verwalten</button></a>
        <div class="spacer"></div>

    </div>


</div>





<div id="myCarousel" class="carousel slide" data-ride="carousel">

        <div class="carousel-inner">


<?php
include_once ('userdata.php');
    try {
    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "SELECT * FROM privatePhoto WHERE userID = $userID";         // Können sow.rtiert werden mit "ORDER BY contentDate DESC" usw. WHERE content_txt.userID in (21, 19)
    $query = $db->prepare($sql);
    $query->execute();

    while ($zeile = $query->fetchObject()) {

   $photoURL = $zeile->photoURL;
   $photoDate = $zeile->photoDate;
   $public = $zeile->public;

        if ($aktiv == 0) {

            ?>




                    <div class="item active">
                        <img src="<?=$photoURL?>" alt="Chania">
                        <div class="carousel-caption">
                            <a style="color: lightskyblue" class="btn-link" href="<?=$photoURL?>"><h3>Foto teilen!</h3></a>
                        </div>
                    </div>



            <?php
            $aktiv =1;
        }
        else {
?>
            <div class="item">
                <img src="<?=$photoURL?>" alt="Foto">
                <div class="carousel-caption">
                    <a style="color: lightskyblue" class="btn-link" href="<?=$photoURL?>"><h3>Foto teilen!</h3></a>
                </div>
            </div>
            <?php
        }


}
} catch (PDOException $e) {
    echo "Error!: Bitte wenden Sie sich an den Administrator!..." . $e;
    die();
}
?>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon fa glyphicon-chevron-left fa-caret-left">Zurück</span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right fa fa-caret-right">Weiter</span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div class="spacer"></div>

    <?php

if (empty($photoURL)) {

    ?>

    <div class="col-md-12 text-center">
        <div class="spacer"></div>
        <div class="spacer"></div>
        <h2>Du hast noch keine Bilder! Lade nun dein erstes Bild hoch!</h2>

        <div class="spacer"></div>
        <div class="spacer"></div>

        <form action="photoActions.php?action=newupload" method="post" enctype="multipart/form-data">

            <input class="center-element" id="wellebild" type="file" name="fileToUpload" id="fileToUpload">
            <div class="spacer"></div>
            <input class="btn btn-success" type="submit" value="Neues Foto hochladen" />
        </form>

    </div>

<?php
}

?>


</div>
