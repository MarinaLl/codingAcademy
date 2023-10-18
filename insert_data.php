<?php
// Verificar si se recibieron datos
if (isset($_POST['data'])) {
	// Decodificar el JSON a un array de PHP
	$receivedData = json_decode($_POST['data'], true);


	// Puedes realizar operaciones con los datos aquí
	//print_r($receivedData);
	// Recorrer el array con foreach
	foreach ($receivedData as $indice => $fila) {
		echo "Fila $indice: <br>";
		foreach ($fila as $clave => $valor) {
			// Si el valor es un array, recorrer también ese array
			if (is_array($valor)) {
				echo "  Subarray: <br>";
				foreach ($valor as $subclave => $subvalor) {
					echo "    [$subclave] => $subvalor <br>";
				}
			} else {
				echo "  [$clave] => $valor <br>";
			}
		}
		echo "<br>";
	}








	// Enviar una respuesta de vuelta al cliente (puede ser un simple mensaje)
	$response = ['message' => 'Datos recibidos correctamente'];
	echo json_encode($response);
} else {
	// No se recibieron datos
	http_response_code(400); // Código de error 400 (Bad Request)
	echo json_encode(['error' => 'No se recibieron datos']);
}
?>




