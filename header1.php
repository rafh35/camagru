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
            <div style="margin-top: -20px; margin-right: 20px">
                <a class="linkHeader" href="inscription.php">Inscription</a>
                <a class="linkHeader" href="connection.php">Connection</a>
            </div>
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