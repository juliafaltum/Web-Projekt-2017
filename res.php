<?php include_once("functions.php");
include_once("userdata.php");?>

<!-- Javascript -->

<script src="js/jquery.min.js"></script>

<script type="text/javascript" src="js/ajax.js"></script>

<script src="js/bootstrap.min.js"></script>

<script src="js/ekko-lightbox.min.js"></script>


<!-- Stylesheets -->

<link rel="stylesheet" href="css/bootstrap.css">

<link rel="stylesheet" href="css/bootstrap-theme.css">

<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">

<link rel="stylesheet" type="text/css" href="css/hover-min.css" media="screen"/>

<link rel="stylesheet"  href="css/font_awesome/font-awesome.min.css">

<link rel="stylesheet" href="css/ekko-lightbox.min.css">

<!-- Custom Stylesheets -->

<link rel="stylesheet"  href="css/custom_css.css">

<!-- Bootstrap Viewport -->

<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Scripte auf der Seite -->

<script type="text/javascript">
    $(document).ready(function() {

        // Startet Tooltips
        $('[data-toggle="tooltip"]').tooltip();


        // Versieht aktive Seite/aktiven Link mit der Klasse .active
        // Markiert aktuellen Menüpunkt per jQuery, Quelle: https://stackoverflow.com/a/12950620/7391622
        var url = window.location;
        $('ul.nav a').filter(function() {
            return this.href == url;
        }).parent().addClass('active');

        // Lädt das Verfassen-Modul nach

        $("#tweetVerfassenButton").click(function(){
            $("#tweetformular").slideToggle(200);
        });

        // Lightbox für Bilder
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });

    });
</script>

