<html>
    <head>
        <title>Camagram</title>
        <meta charset='utf-8'>
        <link rel="stylesheet" href="main.css" type="text/css" media="all">
        <script src="capture.js"></script>
        <h1 class="degrade" style="font-size: 60px; font-family: Billabong; text-align: center">Camagram</h1>
        <div id="header">
            <a href="index.php"><img src="camagram.png" id="logo"></a>
            <form action="compte.php" method="get">
                <button type="submit" name="submit" value="OK" class="button">Profil</button>
            </form>
            <form action="deconnection.php" method="get">
                <button type="submit" name="submit" value="OK" class="button" style="top: 105px;">Déconnection</button>
            </form>
            <form action="desinscrire.php" method="get">
                <button type="submit" name="submit" value="OK" class="button" style="top: 140px;">Désinscription</button>
            </form>
        </div>
    </head>
    <body>
        <div class="conteneur">
            <div class="camera">
                <video id="video">Video stream not available.</video>
            </div>
            <canvas id="canvas"></canvas>
            <div class="output">
                <img id="photo" alt="The screen capture will appear in this box.">
            </div>
            <button id="startbutton">Take photo</button>
        </div>
    </body>
    <footer>
        <p>maberkan 2019</p>
    </footer>
</html>
