<?php
    if (!isset($_SESSION['login']) && empty($_SESSION['login']))
        require_once "galerie.php";
    else if (isset($_SESSION['login']) && !empty($_SESSION['login']))
    {
        require_once "header2.php";
        echo "<p id=user>Bonjour <i>".$_SESSION['login']."</i></p>";
    }
    else
        require_once "header1.php";
?>
