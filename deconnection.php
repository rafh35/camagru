<?php
  if(!isset($_SESSION))
  {
      session_start();
  }
  $_SESSION['Username'] = "";
  header("Location: index.php?c=Tout");
?>
