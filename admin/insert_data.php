<?php
include("../funciones.php");

// Verificar si se recibieron datos
if (isset($_POST['data'])) {
	// Decodificar el JSON a un array de PHP
	$receivedData = json_decode($_POST['data'], true);
	importStudents($receivedData);
} else {
	// No se recibieron datos
	http_response_code(400); // Código de error 400 (Bad Request)
	echo json_encode(['error' => 'No se recibieron datos']);
}
?>




