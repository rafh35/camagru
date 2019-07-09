<?php
  if(!isset($_SESSION))
      session_start();
  header("Location: index.php");

  if (empty($_POST['login']) || empty($_POST['password']) || $_POST['submit'] != "OK")
  {
    header("Location: connection.php?err=Merci de remplir tous les champs.\n");
    exit();
  }
  $login = $_POST['login'];
  $mysqli = mysqli_connect('172.18.0.2', 'root', 'rootpass', 'camagram');
  $result = mysqli_query($mysqli, "SELECT * FROM users WHERE login = '$login'");
  if (!$result->num_rows)
  {
    header("Location: connection.php?err=Le compte n'existe pas.\n");
    exit();
  }
  else {
    $password = hash("Whirlpool", $_POST['password']);
    $result = mysqli_fetch_row(mysqli_query($mysqli, "SELECT password FROM users WHERE login = '$login'"));
    if ($result[0] == $password)
      $_SESSION['login'] = $login;
    else
    {
      header("Location: connection.php?err=Mot de passe erroné.\n");
      exit();
    }
  }
?>
