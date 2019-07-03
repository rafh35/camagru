<?php
  include_once "header3.php";
  if (isset($_GET['err']))
  echo "<p id=err>$_GET[err]</p>";
?>
<html><body>
  <br/>
  <div class="box centerbox">
      <br/>
<form action="inscription2.php" method="post">
  <center>Identifiant: </span><input type="text" name="login" value="" autofocus="autofocus" tabindex="1"/></center>
  <br/>
  <center>Mot de passe: <input type="password" name="passwd" value="" tabindex="2"/></center>
  <br/>
  <center>Adresse mail: </span><input type="text" name="email" value="" autofocus="autofocus" tabindex="3"/></center>
  <br/>
  <center><button type="submit" name="submit" value="OK" id="button2" tabindex="3">Inscription</button></center>
</form>
</div>
</body></html>
