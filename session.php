<?php

session_start();

if(!isset($_SESSION["cliente"])){
    header("Location: loginCli.php");
    exit;
}

?>