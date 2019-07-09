<?php
    if(!isset($_SESSION))
        session_start();
    define( 'DB_NAME', 'camagram' );
    define( 'DB_USER', 'root' );
    define( 'DB_PASSWORD', 'rootpass' );
    define( 'DB_HOST', '172.18.0.2' );
    define( 'DB_TABLE', 'users' );
    function install()
    {
        // connexion à Mysql sans base de données
        $pdo = new PDO('mysql:host='.DB_HOST, DB_USER, DB_PASSWORD);

        // création de la requête sql
        // on teste avant si elle existe ou non (par sécurité)
        $requete = "CREATE DATABASE IF NOT EXISTS `".DB_NAME."` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";

        // on prépare et on exécute la requête
        $pdo->prepare($requete)->execute();
        // connexion à la bdd
        $connexion = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);

        // on vérifie que la connexion est bonne
        if($connexion){
            // on créer la requête
            $requete = "CREATE TABLE IF NOT EXISTS `".DB_NAME."`.`".DB_TABLE."` (
				`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
				`login` VARCHAR( 255 ) NOT NULL ,
				`password` TEXT NOT NULL ,
				`email` VARCHAR( 255 ) NOT NULL ,
				`confirmeKey` VARCHAR( 255 ) NOT NULL ,
				`confirme` INT( 1 ) NOT NULL
				) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";
            // on prépare et on exécute la requête
            $connexion->prepare($requete)->execute();
        }
    }
?>