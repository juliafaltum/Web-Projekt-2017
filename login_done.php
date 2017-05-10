<?php
/**
 * Created by PhpStorm.
 * User: Julia
 * Date: 08.05.2017
 * Time: 12:32
 */
include_once("session_check.php");

echo $_SESSION["username"];
echo $_SESSION["userid"];

header ("refresh:2;url=index.php");