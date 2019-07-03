<?PHP
    if(!isset($_SESSION))
        session_start();
    include "install.php";
    install();
    include_once "header.php";
    if (isset($_GET['err']))
        echo "<p id=err>".$_GET['err']."</p>";
    $mysqli = mysqli_connect('172.18.0.2', 'root', 'rootpass', 'camagram');
    mysqli_close($mysqli);
?>