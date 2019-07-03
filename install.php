<?php
if(!isset($_SESSION))
    session_start();
function install()
{
    $mysqli = mysqli_connect('172.18.0.2', 'root', 'rootpass');
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_query($mysqli, "CREATE DATABASE camagram");
    mysqli_close($mysqli);
}

    /* $mysqli = mysqli_connect('172.18.0.2', 'root', 'rootpass', 'data');
    mysqli_query($mysqli, "CREATE TABLE IF NOT EXISTS users (id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY, login VARCHAR(255) NOT NULL, passwd VARCHAR(255) NOT NULL)");
    mysqli_query($mysqli, "CREATE TABLE IF NOT EXISTS products (id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255) NOT NULL, price FLOAT(9) UNSIGNED, category1 VARCHAR(255) NOT NULL, category2 VARCHAR(255), category3 VARCHAR(255))");
    mysqli_query($mysqli, "CREATE TABLE IF NOT EXISTS panier (id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY, login VARCHAR(255) NOT NULL, panier VARCHAR(4096))");
    mysqli_query($mysqli, "CREATE TABLE IF NOT EXISTS category (id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255) NOT NULL)");
    $login = "admin";
    $result = mysqli_query($mysqli, "SELECT * FROM users WHERE login LIKE '$login'");
    if (!$result->num_rows)
    {
        $adminpasswd = hash("md5", "chikouri");
        mysqli_query($mysqli, "INSERT INTO users (login, passwd) VALUES ('$login', '$adminpasswd')");
    }
    $result = mysqli_query($mysqli, "SELECT * FROM products");
    if (!$result->num_rows)
    {
        mysqli_query($mysqli, "INSERT INTO products (name, price, category1, category2) VALUES ('Survetements', '130', 'Vetements', 'Running')");
        mysqli_query($mysqli, "INSERT INTO products (name, price, category1, category2) VALUES ('T-shirts', '6.80', 'Vetements, 'Chaussures')");
        mysqli_query($mysqli, "INSERT INTO products (name, price, category1, category2) VALUES ('Lacets', '5.00', 'Chaussures', 'Accessoires')");
        mysqli_query($mysqli, "INSERT INTO products (name, price, category1) VALUES ('Pantalons', '64.00', 'Vetements')");
        mysqli_query($mysqli, "INSERT INTO products (name, price, category1) VALUES ('Courones', '8.50', 'Accessoires')");
        mysqli_query($mysqli, "INSERT INTO products (name, price, category1) VALUES ('Sandales', '12.90', 'Chaussures')");
        mysqli_query($mysqli, "INSERT INTO products (name, price, category1) VALUES ('Chemises', '16.90', 'Vetements')");
        mysqli_query($mysqli, "INSERT INTO products (name, price, category1) VALUES ('Lunettes', '22.00', 'Accessoires')");
        mysqli_query($mysqli, "INSERT INTO products (name, price, category1) VALUES ('Tongs', '8.00', 'Chaussures')");
    }
    $result = mysqli_query($mysqli, "SELECT * FROM category");
    if (!$result->num_rows)
    {
        mysqli_query($mysqli, "INSERT INTO category (name) VALUES ('Vetements')");
        mysqli_query($mysqli, "INSERT INTO category (name) VALUES ('Chaussures')");
        mysqli_query($mysqli, "INSERT INTO category (name) VALUES ('Running')");
        mysqli_query($mysqli, "INSERT INTO category (name) VALUES ('Accessoires')");
    }
    mysqli_close($mysqli);
}
*/
?>