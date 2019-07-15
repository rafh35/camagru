<?php
    if(!isset($_SESSION))
        session_start();
    include_once "header4.php";
    include "./config/database.php";

    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    if($pdo)
    {
        // on créer la requête
        $requete = "CREATE TABLE IF NOT EXISTS `".DB_NAME."`.`recup_password` (
                    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
                    `email` VARCHAR( 255 ) NOT NULL ,
                    `code` INT NOT NULL
                    ) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";
        // on prépare et on exécute la requête
        $pdo->prepare($requete)->execute();
    }

    if(isset($_GET['section']))
    {
        $section = htmlspecialchars($_GET['section']);
    }
    else
    {
        $section = "";
    }
    if (isset($_POST['submit'], $_POST['email']))
    {
        if(!empty($_POST['email']))
        {
            $email = htmlspecialchars($_POST['email']);
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $emailexist = $pdo->prepare("SELECT id, login FROM users WHERE email = ?");
                $emailexist->execute(array($email));
                $emailexist_count = $emailexist->rowCount();
                if($emailexist_count == 1)
                {
                    $login = $emailexist->fetch();
                    $login = $login['login'];
                    $_SESSION['email'] = $email;
                    $recupCode = "";
                    for ($i=0; $i < 8; $i++)
                    {
                        $recupCode .= mt_rand(0,9);
                    }
                    $_SESSION['recupCode'] = $recupCode;

                    $emailrecupexist = $pdo->prepare("SELECT id FROM recup_password WHERE email = ?");
                    $emailrecupexist->execute(array($email));
                    $emailrecupexist = $emailrecupexist->rowCount();

                    if($emailrecupexist == 1)
                    {
                        $recup_insert = $pdo->prepare("UPDATE recup_password SET code = ? WHERE email = ?");
                        $recup_insert->execute(array($recupCode,$email));
                        mail("<".$email.">", "Récupération de mot de passe - Camagram", "Bonjour ".$login.", \n\nVoici votre code de récupération:\n $recupCode");
                        header("Location:http://localhost:8100/camagru/resetpassword.php?section=code");
                    }
                    else
                    {
                        $recup_insert = $pdo->prepare("INSERT INTO recup_password(email, code) VALUES (?, ?)");
                        $recup_insert->execute(array($email, $recupCode));
                        mail("<".$email.">", "Récupération de mot de passe - Camagram", "Bonjour ".$login.", \n\nVoici votre code de récupération:\n $recupCode");
                        header("Location:http://localhost:8100/camagru/resetpassword.php?section=code");

                    }
                }
                else
                {
                    echo "<p id=err>Adresse mail n'existe pas !</p>";
                }
            }
            else
            {
                echo "<p id=err>Adresse mail invalide !</p>";
            }
        }
        else
        {
            echo "<p id=err>Veuillez entrer votre adresse mail</p>";
        }
    }
    require_once ("newpassword.php");
?>
