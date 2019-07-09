<?php
    if(!isset($_SESSION))
        session_start();
    ob_start();
    if (!isset($_POST['pseudo'])) { ?>
        <form method="post" action="connexion.php" class="flex flex-col w-full items-center justify-center">
            <fieldset>
                <h2 class="text-xl">Connexion</h2>
                <div class="flex flex-col">
                    <div class="flex flex-col mt-4">
                        <label for="pseudo">Pseudo</label>
                        <input class="border border-gray-600 rounded px-2 py-1" name="pseudo" type="text" id="pseudo" min=1 required />
                    </div>
                    <div class="flex flex-col mt-4">
                        <label for="password">Mot de Passe</label>
                        <input class="border border-gray-600 rounded px-2 py-1" type="password" name="password" min=1 id="password" required />
                    </div>
                </div>
            </fieldset>
            <div class="flex flex-row w-full">
                <input class="bg-orange-500 rounded-lg px-4 py-2 text-white mt-4 shadow-lg hover:shadow cursor-pointer" type="submit" value="Connexion" />
                <a href="./register.php">Pas encore inscrit ?</a>
            </div>
        </form>
    <?php } else {
        $message='';

        if (empty($_POST['pseudo']) || empty($_POST['password']) ) //Oublie d'un champ
        {
            $message = '<p>une erreur s\'est produite pendant votre identification.
            Vous devez remplir tous les champs</p>
            <p>Cliquez <a href="./connexion.php">ici</a> pour revenir</p>';
        }
        else //On check le mot de passe
        {
            $query=$db->prepare('SELECT membre_mdp, membre_id, membre_rang, membre_pseudo
                FROM forum_membres WHERE membre_pseudo = :pseudo');
            $query->bindValue(':pseudo',$_POST['pseudo'], PDO::PARAM_STR);
            $query->execute();
            $data=$query->fetch();
            if ($data['membre_mdp'] == md5($_POST['password'])) // Acces OK !
            {
                $_SESSION['pseudo'] = $data['membre_pseudo'];
                $_SESSION['level'] = $data['membre_rang'];
                $_SESSION['id'] = $data['membre_id'];
                header('Location: index.php');
            }
            else // Acces pas OK !
            {
                $message = '<p>Une erreur s\'est produite 
                    pendant votre identification.<br /> Le mot de passe ou le pseudo 
                        entré n\'est pas correcte.</p><p>Cliquez <a href="./connexion.php">ici</a> 
                    pour revenir à la page précédente
                    <br /><br />Cliquez <a href="./index.php">ici</a> 
                    pour revenir à la page d accueil</p>';
            }
            $query->CloseCursor();
        } ?>
    <?php }
    //$page = htmlspecialchars($_POST['page']);
    //echo 'Cliquez <a href="'.$page.'">ici</a> pour revenir à la page précédente';
    $content = ob_get_clean();
    require('templates/layout.php');
?>
