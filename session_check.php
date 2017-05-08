<?php
//auf allen Seiten an erster Stelle:
session_start();
if(!isset($_SESSION['userid'])) {
    session_destroy ();
    header('Location:login.html');
}
    ?>
