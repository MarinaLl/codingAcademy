document.addEventListener('DOMContentLoaded', function(){
    document.getElementById('fileInput').addEventListener('change', handleFileSelect, false);

function handleFileSelect(event) {
  const file = event.target.files[0];

  if (!file) {
	return;
  }

  const reader = new FileReader();

  reader.onload = function (e) {
	const fileContent = e.target.result;
	processData(fileContent);
  };

  reader.readAsText(file);
}

function processData(fileContent) {
  // Crear un array para almacenar todos los arrays de datos generados
  const allDataArrays = [];

  // Crear una tabla
  const table = document.createElement('table');

  // Dividir las líneas usando el punto y coma como separador
  const lines = fileContent.split(';');

  // Iterar sobre cada línea
  lines.forEach(line => {
	// Dividir cada línea en partes usando el paréntesis como separador
	const parts = line.split(/\(|\)/);

	// Verificar si hay una segunda parte dentro de paréntesis
	if (parts.length > 1) {
  	// Dividir la primera parte por comas, eliminando elementos vacíos
  	const firstPartArray = parts[0].split(',').map(item => item.trim()).filter(Boolean);

  	// Dividir la segunda parte (dentro de paréntesis) por comas
  	const courses = parts[1].split(',').map(course => course.trim());

  	// Crear una fila de la tabla
  	const row = table.insertRow();

  	// Agregar celdas a la fila
  	firstPartArray.forEach((value, index) => {
    	const cell = row.insertCell(index);
    	cell.textContent = value;
  	});

  	// Agregar la celda para el array de cursos
  	const coursesCell = row.insertCell(firstPartArray.length);
  	coursesCell.textContent = JSON.stringify(courses);

  	// Agregar el array de datos generado al array principal
  	allDataArrays.push([...firstPartArray, courses]);
	} else {
  	// No hay segunda parte, imprimir la primera parte
  	const firstPartArray = parts[0].split(',').map(item => item.trim()).filter(Boolean);

  	// Crear una fila de la tabla
  	const row = table.insertRow();

  	// Agregar celdas a la fila
  	firstPartArray.forEach((value, index) => {
    	const cell = row.insertCell(index);
    	cell.textContent = value;
  	});

  	// Agregar el array de datos generado al array principal
  	allDataArrays.push(firstPartArray);
	}
  });

  // Mostrar el array en la consola
  console.log('Todos los arrays de datos:', allDataArrays);

  // Agregar la tabla al contenedor
  const tableContainer = document.getElementById('tableContainer');
  tableContainer.innerHTML = '';
  tableContainer.appendChild(table);

  document.getElementById('insertDataButton').addEventListener('click', function() {
            // Array de ejemplo
    


      // Crear un formulario oculto
      const form = document.createElement('form');
      form.action = 'insert_data.php';
      form.method = 'POST';


      // Crear un campo de entrada oculto para el array
      const input = document.createElement('input');
      input.type = 'hidden';
      input.name = 'data';
      input.value = JSON.stringify(allDataArrays);


      // Agregar el campo de entrada al formulario
      form.appendChild(input);


      // Agregar el formulario al cuerpo del documento
      document.body.appendChild(form);


      // Enviar el formulario
      form.submit();

  });
} 




});

