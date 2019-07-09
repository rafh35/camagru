<?php
  if(!isset($_SESSION))
      session_start();
  if (empty($_SESSION['login'])){
    header("Location: connection.php");
    exit();
  }
  include_once "header.php";
  if (isset($_GET['err']))
    echo "<p id=err>$_GET[err]</p>";
  $mysqli = mysqli_connect('172.18.0.2', 'root', 'rootpass', 'camagram');
?>
<html>
    <body>
      <div class="box" style="width: 350px; top:40;">
        <p id="mdp">Modifier son mot de passe</p><br/>
        <form action="compte2.php" method="post">
          <center>Identifiant: </span><input type="text" name="login" value="" autofocus="autofocus" tabindex="1"/></center>
          <br/>
          <center>Ancien mot de passe: <input type="password" name="password" value="" tabindex="2"/></center>
          <br/>
          <center>Nouveau mot de passe: <input type="password" name="newpassword" value="" tabindex="3"/></center>
          <br/>
          <center><button type="submit" name="submit" value="OK" id="button2" tabindex="4">Valider</button></center>
        </form>
        </div>
    </body>
</html>
