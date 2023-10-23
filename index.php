<?php 
    session_start();
    include('funciones.php');
    if(isset($_SESSION['user'])) {
        loginRedirect();
    } else {
        addHeader("");
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
            <!-- Las imagenes actuales son con las medidas que deben tener, es decir: 1440x700 -->
            <div class="slide"><img src="src/Python-Banner-2.png" alt="Imagen 1"></div>
            <div class="slide"><img src="src/Terminal-Banner-2.png" alt="Imagen 2"></div>
            <div class="slide"><img src="src/HTMLCSSJS-Banner-2.png" alt="Imagen 3"></div>
            <!-- Agrega más imágenes según sea necesario -->
        </div>
    </div>
    
    <div id="prev">&#10094;</div>
    <div id="next">&#10095;</div>
    
    <div id="indicator-container"></div>
    <div class="grid-container">
        <div></div>
        <div>

        </div>
        <div></div>
    </div>
    <div id="testimonials">
        <h4>TESTIMONIALS</h4>

    </div>
    
    <script src="main.js"></script>

</body>
</html>
<?php addFooter(""); } ?>