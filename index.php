<?PHP
    if(!isset($_SESSION))
        session_start();

    require_once "./config/setup.php";
    require_once "header.php";
    if (isset($_GET['err']))
        echo "<p id=err>".$_GET['err']."</p>";
?>