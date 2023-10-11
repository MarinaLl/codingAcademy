<?php 
    session_start();
    include('funciones.php');
    addHeader("");
    addFonts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>CodingAcademy</title>
  
</head>
<body>
    <div id="slider-container">
        <div id="slider">
            <div class="slide"><img src="src/Python-Banner.png" alt="Imagen 1"></div>
            <div class="slide"><img src="src/Terminal-Banner.png" alt="Imagen 2"></div>
            <div class="slide"><img src="src/HTMLCSSJS-Banner.png" alt="Imagen 3"></div>
            <!-- Agrega más imágenes según sea necesario -->
        </div>
    </div>
    
    <div id="prev">&#10094;</div>
    <div id="next">&#10095;</div>
    
    <div id="indicator-container"></div>
    
    <script src="main.js"></script>

</body>
</html>