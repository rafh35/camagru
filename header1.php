<html>
    <head>
        <title>Camagram</title>
        <meta charset='utf-8'>
        <link rel="stylesheet" href="main.css" type="text/css" media="all">
        <script src="capture.js">
        </script>
        <h1>Camagram</h1>
        <div id="header">
            <a href="index.php"><img src="camagram.png" id="logo"></a>
            <form action="inscription.php" method="get">
                <button type="submit" name="submit" value="OK" class="button">Inscription</button>
            </form>
            <form action="connection.php" method="get">
                <button type="submit" name="submit" value="OK" class="button" style="top: 105px;">Se connecter</button>
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