<?php
include("funciones.php");

$connect = connectDataBase();



// Verificar si se recibieron datos
if (isset($_POST['data'])) {
	// Decodificar el JSON a un array de PHP
	$receivedData = json_decode($_POST['data'], true);

	// Recorrer el array con foreach
	foreach ($receivedData as $indice => $fila) {
		// aqui consoluta para añadir estudiantes
		$email = $fila[0];
		$pass = md5($fila[1]);
		$dni = $fila[2];
		$name = $fila[3];
		$lastname = $fila[4];
		$age = $fila[5];
		$img = $fila[6];

		$sql = "INSERT INTO student (email, password, dni, name, lastNames, age, photo) VALUES ('$email', '$pass', '$dni', '$name', '$lastname', $age, '$img')";
		$query = mysqli_query($connect, $sql);

		
		echo "Fila $indice: <br>";
		foreach ($fila as $clave => $valor) {
			// Si el valor es un array, recorrer también ese array
			if (is_array($valor)) {
				echo "  Subarray: <br>";
				foreach ($valor as $subclave => $subvalor) {
					echo "    [$subclave] => $subvalor <br>";
					$sql2 = "INSERT INTO enrollment (student_email, course_code) VALUES ('$email', '$subvalor')";
					$query2 = mysqli_query($connect, $sql2);
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




