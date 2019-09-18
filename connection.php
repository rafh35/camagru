<?php
    if(!isset($_SESSION))
        session_start();

    require_once "header4.php";
    require_once "./config/database.php";
    require_once "./controlers/utils.php";

    if (isset($_GET['err']))
        echo "<p id=err>$_GET[err]</p>";

    if(isset($_POST['submit']))
    {
        $pdo = dbConnect();
        if (!empty($_POST['login']) || !empty($_POST['password']))
        {
            $login = htmlspecialchars($_POST['login']);
            $password = hash("Whirlpool", $_POST['password']);

            $reqLogin = $pdo->prepare("SELECT * FROM users WHERE login = ? AND password = ?");
            $reqLogin->execute(array($login, $password));
            $loginExist = $reqLogin->rowCount();

            if($loginExist == 1)
            {
                $user = $reqLogin->fetch();
                if($user['confirme'] == 1)
                {
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['login'] = $user['login'];
                    $_SESSION['password'] = $user['password'];
                    header("Location: header2.php");
                }
                else
                {
                    header("Location: connection.php?err=Merci de confirmer votre compte");
                    exit();
                }
            }
            else
            {
                echo "<p id=err>Identifiant ou mot de passe incorrect</p>";
            }
        }
        else
        {
            echo "<p id=err>Merci de remplir tous les champs.\n</p>";
        }
    }
    ?>
    <html>
        <body>
            <div class="box centerbox" style="height: 160px;">
                <br/>
                <form action="connection.php" method="POST">
                    <center>Identifiant: </span><input type="text" name="login" value="" autofocus="autofocus" tabindex="1"/></center>
                    <br/>
                    <center>Mot de passe: <input type="password" name="password" value="" tabindex="2"/></center>
                    <br/>
                    <center><button type="submit" name="submit" value="OK" tabindex="3">Connection</button></center>
                </form>
                <form action="resetpassword.php" method="POST">
                    <center><button type="submit" name="submit_reset" value="OK" tabindex="4">Mot de passe oublié</button></center>
                </form>
            </div>
        </body>
    </html>
