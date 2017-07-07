<?php include_once("functions.php");
include_once("userdata.php");?>

<script src="js/jquery.min.js"></script>

<script type="text/javascript" src="js/ajax.js"></script>

<!-- Das neueste kompilierte und minimierte CSS -->
<link rel="stylesheet" href="css/bootstrap.css">

<!-- Optionales Theme -->
<link rel="stylesheet" href="css/bootstrap-theme.css">

<!-- Das neueste kompilierte und minimierte JavaScript -->
<script src="js/bootstrap.js"></script>


<link rel="stylesheet" type="text/css" href="css/hover-min.css" media="screen"/>

<!-- <script src="js/instantclick.min.js" data-no-instant></script>
<script data-no-instant>InstantClick.init();</script> Skript wieder auskommentiert für Instantklick -->

<link rel="stylesheet"  href="css/custom_css.css">
<link rel="stylesheet"  href="css/font_awesome/font-awesome.min.css">

<meta name="viewport" content="width=device-width, initial-scale=1">

<script type="text/javascript">
    $(document).ready(function() {

        // Startet Tooltips
        $('[data-toggle="tooltip"]').tooltip();


        // Versieht aktive Seite/aktiven Link mit der Klasse .active
        var url = window.location;
        $('ul.nav a').filter(function() {
            return this.href == url;
        }).parent().addClass('active');

        // Lädt das Verfassen-Modul nach

        $("#tweetVerfassenButton").click(function(){
            $("#tweetformular").slideToggle(200);
        });


// Markiert aktuellen Menüpunkt per jQuery, Quelle: https://stackoverflow.com/a/12950620/7391622

    });
</script>

