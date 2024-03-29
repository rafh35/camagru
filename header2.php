<?php
    if(!isset($_SESSION))
        session_start();

    require_once "controlers/utils.php";
    require_once "plugins/includes.php";
    require_once "controlers/get_images.php";


    if (isset($_POST['title']) AND (isset($_POST['photo'])))
    {
        $pdo = dbConnect();
        $title = htmlentities($_POST['title']);
        $filename = time() . '.png';
        $filepath = 'photos/';
        $select = $pdo->prepare("INSERT INTO images(name, title, author_id, nb_like) VALUES(?, ?, ?, ?)");
        $select->execute(array($filename, $title, $_SESSION['id'], 0));
        $data = $_POST['photo'];
        list($type, $data) = explode(';', $data);
        list(, $data) = explode(',', $data);
        $data = base64_decode($data);
        file_put_contents($filepath . $filename, $data);
        $select = $pdo->prepare("SELECT * FROM images WHERE title = ? AND author_id = ?");
        $select->execute(array($title, $_SESSION['id']));
        $result = $select->fetchAll();
        if (count($result) > 0) {
            $id = $result[0]['id'];
            header("Location: image.php?img=$id");
        } else {
            header('Location: header2.php');
            setMessageForm("Impossible d'enregistrer l'image.", 'error');
        }
    }
    $images = getImagesByAuth($_SESSION['id']);
    $title = "Nouvelle image";
    ?>
    <head>
        <title>Camagram</title>
        <meta charset='utf-8'>
        <link rel="stylesheet" href="main.css" type="text/css" media="all">
        <h1 class="degrade" style="font-size: 60px; font-family: Billabong; text-align: center">Camagram</h1>
        <div id="header">
            <a href="header2.php"><img src="camagram.png" id="logo"></a>
            <div style="margin-top: -20px; margin">
                <a class="linkHeader" href="compte.php">Profil</a>
                <a class="linkHeader" href="galerie.php">Galerie</a>
                <a class="linkHeader" href="deconnection.php">Déconnexion</a>
                <a class="linkHeader" href="desinscription.php">Désinscription</a>
            </div>
        </div>
    </head>
    <body>
        <div class="conteneur" style="margin: auto">
            <div class="a">
                <video autoplay="true" id="video">
                </video>
                <button type="button" id="takebutton">Take photo</button>
                <canvas id="canvas" style="position: absolute"></canvas>
            <div/>
            <div class="galerie" style="margin-top: -17px">
                <?php if(isset($images)){ while ($img = $images->fetch()) { ?>
                    <div style="border: #111111 solid 1px">
                        <a href=<?= "image.php?img=" . $img['id'] ?>>
                            <img src=<?= "photos/" . $img['name'] ?>>
                        </a>
                    </div>
                <?php }} ?>
            </div>
            <div>
                <form action="header2.php" method="POST" enctype="multipart/form-data" id="postform">
                    <input type="file" id="upload" name="upload" accept="image/png"/>
                    <ul style="width: 70px; height: 170px; margin-left: 450px;"><br />
                        <li><label><input type="radio" name="alpha" class="alpha" value="alpha1" checked="checked" style="margin-bottom: 15px"><img style="width: 45px;" src=<?= "./filtres/f1.png" ?>></label></li><br /><br />
                        <li><label><input type="radio" name="alpha" class="alpha" value="alpha2" style="margin-bottom: 15px"><img style="width: 45px" src=<?= "./filtres/f2.png" ?>></label></li><br /><br />
                        <li><label><input type="radio" name="alpha" class="alpha" value="alpha3"><img style="width: 45px" src=<?= "./filtres/f3.png" ?>></label></li><br /><br />
                    </ul>
                    <input type="hidden" name="photo" id="photo">
                    <?php echo input('title', 'text', "Titre"); ?>
                    <button type="submit" id="takebutton" style="margin-top: 108px; margin-left: -185px">Save</button>
                </form>
            </div>
        </div>
        <script src="capture.js" type="text/javascript"></script>
    </body>
