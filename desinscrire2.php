<?php
  if(!isset($_SESSION))
  {
      session_start();
  }
  header("Location: index.php");
  if (empty($_POST['login']) || empty($_POST['passwd']) || $_POST['submit'] != "OK")
  {
    header("Location: desinscrire.php?err=Merci de remplir tous les champs.\n");
    exit();
  }
  $login = $_POST['login'];
  $mysqli = mysqli_connect('172.18.0.2', 'root', 'rootpass', 'data');
  $result = mysqli_query($mysqli, "SELECT * FROM users WHERE login = '$login'");
  if (!$result->num_rows)
  {
    header("Location: desinscrire.php?err=Le compte n'existe pas.\n");
    exit();
  }
  else {
    $passwd = hash("md5", $_POST['passwd']);
    $result = mysqli_fetch_row(mysqli_query($mysqli, "SELECT passwd FROM users WHERE login = '$login'"));
    if ($result[0] == $passwd){
      mysqli_query($mysqli, "DELETE FROM users WHERE login = '$login'");
      $_SESSION['Username'] = "";
      header("Location: index.php?err=Votre compte a été supprimé.\n");
      exit();
    }
    else
    {
      header("Location: desinscrire.php?err=Mauvais mot de passe.\n");
      exit();
    }
  }
?>
