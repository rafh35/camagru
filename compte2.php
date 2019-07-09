<?php
  if(!isset($_SESSION))
      session_start();
  if (empty($_SESSION['login'])){
    header("Location: index.php");
    exit();
  }
  header("Location: compte.php");

  if (empty($_POST['login']) || empty($_POST['password']) || empty($_POST['newpassword']) || $_POST['submit'] != "OK")
  {
    header("Location: compte.php?err=Merci de remplir tous les champs.\n");
    exit();
  }
  $login = $_POST['login'];
  $mysqli = mysqli_connect('172.18.0.2', 'root', 'rootpass', 'camagram');
  $result = mysqli_query($mysqli, "SELECT * FROM users WHERE login = '$login'");
  if (!$result->num_rows)
  {
    header("Location: compte.php?err=Le compte n'existe pas.\n");
    exit();
  }
  else {
    $password = hash("Whirlpool", $_POST['password']);
    $result = mysqli_fetch_row(mysqli_query($mysqli, "SELECT passwd FROM users WHERE login = '$login'"));
    $newpassword = hash("Whirlpool", $_POST['newpassword']);
    if ($result[0] == $password){
      mysqli_query($mysqli, "UPDATE users SET password = '$newpassword 'WHERE login = '$login'");
      header("Location: compte.php?err=Votre mot de passe a été modifié.\n");
      exit();
    }
    else
    {
      header("Location: compte.php?err=Mauvais mot de passe.\n");
      exit();
    }
  }
?>
