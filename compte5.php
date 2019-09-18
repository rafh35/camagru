<?php
    if(!isset($_SESSION))
        session_start();

    require_once "header5.php";
    require_once "./config/database.php";
    require_once "./controlers/utils.php";

    if (isset($_GET['err']))
        echo "<p id=err>$_GET[err]</p>";

    $pdo = dbConnect();
    $err = 0;
    $exec = 0;
    if (isset($_POST['login'])) {
        $login = htmlentities($_POST['login']);
        $select = $pdo->prepare("UPDATE users SET login = ? WHERE id = ?");
        $select->execute(array($login, $_SESSION["id"]));
    }
    if ($err == 0 && isset($_POST['email'])) {
        if (isset($_POST['email']) && !(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))) {
            setMessageForm("L'email n'est pas valide.", 'error');
            $err = 1;
        }
        if ($err == 0) {
            $email = htmlentities($_POST['email']);
            $select = $pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
            $select->execute(array($email, $_SESSION["id"]));
            $exec = 1;
        }
    }
    if ($err == 0 && isset($_POST['password1']) && isset($_POST['password2']) && strlen($_POST['password1']) > 7 && strlen($_POST['password2']) > 7) {
        if ($_POST['password1'] != $_POST['password2']) {
            setMessageForm("Le mot de passe ne correspond pas, merci de corriger.", 'error');
            $err = 1;
        }
        if ($err == 0 && isset($_POST['password1']) && !(preg_match('/^(?=.*\d)(?=.*[a-zA-Z]).{8,}$/', $_POST['password1'])))
        {
            setMessageForm("Le mot de passe n'est pas securise, minimum 8 caracteres et un chiffre.", 'error');
            $err = 1;
        }
        if ($err == 0) {
            $password = htmlentities(sha1($_POST['password1']));
            $select = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            $select->execute(array($password, $_SESSION["id"]));
            $exec = 1;
        }
    }
    if ($err == 0) {
        if (isset($_POST['mail_comment'])) {
            $select = $pdo->prepare("UPDATE users SET mail_comment = 1 WHERE id = ?");
            $select->execute(array($_SESSION["id"]));
            $exec = 1;
        } else if (count($_POST) > 0) {
            $select = $pdo->prepare("UPDATE users SET mail_comment = 0 WHERE id = ?");
            $select->execute(array($_SESSION["id"]));
            $exec = 1;
        }
    }
    if ($exec == 1) {
        session_destroy();
        header('Location: connection.php');
    }
    $select = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $select->execute(array($_SESSION['id']));
    $result = $select->fetchAll();
    if (count($result) > 0) {
        $user = $result[0];
        $_SESSION['login'] = $user['login'];
        $_SESSION['user'] = $user;
    }
    $title = "Votre compte";
    ob_start();
    ?>

    <?php if (isset($_SESSION['messageForm']) && $_SESSION['messageForm']['type'] == 'error') { ?>
<div classe="">
        <form action="compte.php" method="POST">
            <?php echo extractMessageForm(); ?>
            <div class="field">
                <label>Nom d'utilisateur</label>
                <input type="text" id="login" name="login" value="<?php echo $_SESSION["login"] ?>">
            </div>
            <div class="field">
                <label>Mot de passe</label>
                <input type="password" id="password1" name="password1">
            </div>
            <div class="field">
                <label>Confirmation du mot de passe</label>
                <input type="password" id="password2" name="password2">
            </div>
            <div class="field">
                <label>Email</label>
                <input type="text" id="email" name="email" value="<?php echo $_SESSION["user"]["email"] ?>">
            </div>
            <div class="field">
                <label>Mail commentaire</label>
                <input type="checkbox" name="mail_comment" value="comment" <?php if ($_SESSION["user"]["mail_comment"] == 1) {echo 'checked';} ?>>
            </div>
            <button class="ui button teal right floated" type="submit">Valider</button>
        </form>
</div>

    <?php } else { ?>
    <div class="box centerbox" style="width: 350px; height: 160px; top: 25px">
        <p id="mdp">Nom d'utilisateur</p>
        <form action="compte.php" method="POST">
            <center>Identifiant: </span><input type="text" name="login" value="<?php echo $user['login']?>" autofocus="autofocus" tabindex="1"/></center>
            <br/>
            <center>Nouvel identifiant: </span><input type="text" name="newlogin" value="" autofocus="autofocus" tabindex="2"/></center>
            <br/>
            <center><button type="submit" name="submit" value="OK" id="button2" tabindex="3">Valider</button></center>
        </form>
    </div>
    <div class="box centerbox" style="width: 350px; height: 160px;">
        <p id="mdp">Modifier mot de passe</p>
        <form action="compte.php" method="POST">
            <center>Ancien mot de passe: <input type="password" name="password" value="" tabindex="1"/></center>
            <br/>
            <center>Nouveau mot de passe: <input type="password" name="newpassword" value="" tabindex="2"/></center>
            <br/>
            <center><button type="submit" name="submit" value="OK" id="button2" tabindex="3">Valider</button></center>
        <form/>
    <div/>
    <div class="box centerbox" style="width: 350px; height: 160px; top: 50px">
        <p id="mdp">Modifier adresse mail</p>
        <form action="compte.php" method="POST">
            <center>Adresse mail: </span><input type="email" name="email" value="<?php echo $user['email']?>" autofocus="autofocus" tabindex="1"/></center>
            <br/>
            <center>Nouvelle adresse mail: </span><input type="email" name="newemail" value="" autofocus="autofocus" tabindex="2"/></center>
            <br/>
            <center><button type="submit" name="submit" value="OK" id="button2" tabindex="3">Valider</button></center>
        </form>
    </div>
    <div class="box centerbox" style="width: 350px; height: 160px; top: 20px">
        <p id="mdp">Notification commentaire par mail</p>
        <form action="compte.php" method="POST">
            <input type="checkbox" name="mail_comment" value="comment" <?php if ($_SESSION["user"]["mail_comment"] == 1) {echo 'checked';} ?>>
            <button class="ui button teal right floated" type="submit">Valider</button>
        </form>
    </div>

    <?php }
    //$content = ob_get_clean();
    //require('templates/layout.php');
    ?>
