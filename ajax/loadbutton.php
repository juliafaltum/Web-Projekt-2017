<?php

include_once("../userdata.php");
include_once ("../functions.php");

$user = $_GET['userID'];
$follower = $_GET['followerID'];
$contentID = $_GET['contentID'];

followButtonNeu ($user, $follower, $contentID);
