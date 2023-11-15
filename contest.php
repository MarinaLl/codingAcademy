<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Resultado del Premio</title>
</head>
<body>
	<div id="prize">
    	<?php
        if (isset($_GET['prize'])) {
            $prize =  $_GET['prize'];
            echo "<h1>Felicidades, has ganado: $prize</h1>";
        }
    	?>
	</div>
</body>
</html>
