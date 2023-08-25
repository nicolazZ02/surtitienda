<?php

if(!isset($_SESSION['usuario']) || !isset($_SESSION['tipo']))
{
    header("Location: ../index.php");
    exit;
}
?>