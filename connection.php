<?php
    if(!isset($_SESSION))
        session_start();
    include_once "header4.php";
    if (isset($_GET['err']))
        echo "<p id=err>$_GET[err]</p>";
   // header("Location: index.php");
    define( 'DB_NAME', 'camagram' );
    define( 'DB_USER', 'root' );
    define( 'DB_PASSWORD', 'rootpass' );
    define( 'DB_HOST', '172.18.0.2' );
    define( 'DB_TABLE', 'users' );
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
    if(isset($_POST['submit']))
    {
        if (!empty($_POST['login']) || !empty($_POST['password']))
        {
            $login = htmlspecialchars($_POST['login']);
            $password = hash("Whirlpool", $_POST['password']);

            $reqLogin = $pdo->prepare("SELECT * FROM users WHERE login = ? AND password = ?");
            $reqLogin->execute(array($login, $password));
            $loginExist = $reqLogin->rowCount();

            if($loginExist == 1)
            {
                $loginInfo = $reqLogin->fetch();
                $_SESSION['id'] = $loginInfo['id'];
                $_SESSION['login'] = $loginInfo['login'];
                $_SESSION['password'] = $loginInfo['password'];
                header("Location: header2.php");
            }
            else
            {
                header("Location: connection.php?err=Login ou mot de passe erroné !\n");
                exit();
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
            <div class="box centerbox">
                <br/>
                <form action="connection.php" method="POST">
                    <center>Identifiant: </span><input type="text" name="login" value="" autofocus="autofocus" tabindex="1"/></center>
                    <br/>
                    <center>Mot de passe: <input type="password" name="password" value="" tabindex="2"/></center>
                    <br/>
                    <center><button type="submit" name="submit" value="OK" id="button2" tabindex="3">Connection</button></center>
                </form>
            </div>
        </body>
    </html>
