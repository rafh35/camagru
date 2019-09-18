<?php
    if(!isset($_SESSION))
        session_start();

    require_once "controlers/get_images.php";
    require_once "controlers/utils.php";
    require_once("plugins/includes.php");


    if(isset($_SESSION['id']) && (isset($_GET['img']) || isset($_POST['img'])))
    {
        $pdo = dbConnect();
        $del_req = $pdo->prepare("DELETE FROM images WHERE id = ? AND author_id = ?");
        $del_req->execute(array($_GET['img'], $_SESSION['id']));
        header("Location: header2.php");
    } else {
        header("Location: index.php");
    }
?>