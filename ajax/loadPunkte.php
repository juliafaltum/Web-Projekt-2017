<?php

include_once("../userdata.php");
include_once ("../functions.php");
include_once ('../session_check.php');

$user = $_SESSION['userid'];
$contentID = $_GET['contentID'];

contentPoints ($contentID);
