<?php

include_once("../userdata.php");
include_once ("../functions.php");

$user = $_GET['userID'];
$follower = $_GET['followerID'];
$contentID = $_GET['contentID'];

followButtonAjaxNeu ($user, $follower, $contentID);
