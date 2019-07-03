<?php
    if(!isset($_SESSION))
        session_start();
    if (isset($_SESSION['Username']) && !empty($_SESSION['Username'])){
        include_once "header2.php";
        echo "<p id=user>Bonjour <i>".$_SESSION['Username']."</i></p>";}
    else
        include_once "header1.php";
    if (isset($_SESSION['Username']) == "admin")
        echo '<button type="submit" name="submit" value="OK" class="button" style="top: 35px;" onclick="location.href = \'admin.php\'">Panel Admin</button>';
    else if (isset($_SESSION['Username']))
        echo '<button type="submit" name="submit" value="OK" class="button" style="top: 35px;" onclick="location.href = \'compte.php\'">Compte</button>';
    $mysqli = mysqli_connect('172.18.0.2', 'root', 'rootpass', 'camagram');
    $tab = mysqli_query($mysqli, "SELECT name FROM category");
?>
