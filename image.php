<?php
    if(!isset($_SESSION))
        session_start();

    if(isset($_SESSION['id']))
        require_once "header5.php";
    else
        require_once "header4.php";

    require_once "./controlers/get_images.php";
    require_once "./controlers/utils.php";
    require_once("plugins/includes.php");


    if (isset($_GET["img"]) || isset($_POST["img"]))
    {
        if (isset($_GET["img"]))
        {
            $img = getOneImage($_GET["img"]);
        }
        else if (isset($_POST["img"]))
        {
            $img = getOneImage($_POST["img"]);
        }

    }
    else
        header("Location: /camagru/index.php");

    if (!isset($img["id"]))
    {
        header("Location: /camagru/index.php");
    }

    $pdo = dbConnect();

    if (isset($_POST['comment']) && isset($_SESSION['id']))
    {
        $img_id = $_POST["img"];
        $select = $pdo->prepare("INSERT INTO comments(author, date, text, image_id) VALUES(?, ?, ?, ?)");
        $select->execute(array($_SESSION['login'], date("Y-m-d H:i:s"), htmlentities($_POST['comment']), $img_id));
        $select = $pdo->prepare("SELECT * FROM images WHERE id = ?");
        $select->execute(array($img_id));
        $result = $select->fetchAll();

        if (count($result) > 0)
        {
            $image = $result[0];
            $select = $pdo->prepare("SELECT * FROM users WHERE id = ? AND mail_comment = 1");
            $select->execute(array($image['author_id']));
            $result = $select->rowCount();
            if ($result == 1)
            {
                $login = $select->fetch();

                $header = "MIME-Version: 1.0\r\n";
                $header .= 'From:"camagram"<maberkan@student.le-101.fr>' . "\n";
                $header .= 'Content-Type:text/html; charset="uft-8"' . "\n";
                $header .= 'Content-Transfer-Encoding: 8bit';

                mail("<".$login["email"].">", "Nouveau commentaire", "Un nouveau commentaire a ete poste sur l'image " . $image['title'] . " par ". $_SESSION['login'] .".", $headers);
            }
        }
        $url = "image.php?img=$img_id";
        header("Location: ".$url);
    }
    else if (isset($_POST['like']) && isset($_SESSION['id']))
    {
        $pdo = dbConnect();
        $img_id = $_POST["img"];
        $select = $pdo->prepare("SELECT * FROM images WHERE id = ?");
        $select->execute(array($img_id));
        $result = $select->fetchAll();
        if (count($result) > 0)
        {
            $img = $result[0];
            $select = $pdo->prepare("UPDATE images SET nb_like = ? WHERE id = ?");
            $select->execute(array($img['nb_like'] + 1, $img_id));
            $url = "image.php?img=$img_id";
            header("Location: " . $url);
        }
    }
    $title = $img['title'] . ' - Image';
    $pdo = dbConnect();
    $req = $pdo->prepare("SELECT * FROM comments WHERE image_id = ? ORDER BY date DESC");
    $req->execute(array($_GET["img"]));
    $comments = $req;
    //ob_start();

?>
    <body>
        <div class="conteneur" style="margin: auto; height: 340px">
            <div class="sixteen wide column center aligned">
                <img class="image-main" src=<?php echo "photos/".$img['name'] ?>>
                <?php if (isset($_SESSION['id'])) { ?>
                    <form action="image.php" class="ui form" method="POST" id="postform">
                        <input type="hidden" name="img" id="img" value=<?= $_GET["img"] ?>>
                        <input type="hidden" name="like" id="like"/>
                        <?php if ($_SESSION['id'] == $img['author_id']) { ?>
                            <a href=<?php echo "delete_img.php?img=".$img['id'] ?>>
                                <button type="button" id="takebutton" style="margin-top: 6px">Supprimer</button>
                            </a>
                        <?php } ?>
                        <button type="submit" id="takebutton" style="margin-top: 6px; margin-left: 105px">
                           <?php echo $img['nb_like']; ?>
                        </button>
                    </form>
                    <form action="image.php" class="ui form" method="POST" id="postform">
                        <input type="hidden" name="img" id="img" value=<?= $_GET["img"] ?>>
                        <?php echo input('comment', 'text', "Commentaire"); ?>
                        <button type="submit" id="takebutton" style="margin-left: 10px; margin-top: -10px">
                            Commenter
                        </button>
                    </form>
                <?php } ?>
            </div>
        </div>
        <br /><br/>
        <div class="sixteen wide column center aligned">
            <div class="ui relaxed divided list">
                <?php while ($comment = $comments->fetch()) { ?>
                    <div class="item">
                        <div class="header"><?= $comment['date'] . " - " . $comment["author"] ?></div>
                        <p><?= $comment['text'] ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </body>
<?php

//$content = ob_get_clean();

?>



