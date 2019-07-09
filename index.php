<?PHP
    if(!isset($_SESSION))
        session_start();
    include "./config/install.php";
    install();
    include_once "header.php";
    if (isset($_GET['err']))
        echo "<p id=err>".$_GET['err']."</p>";
?>