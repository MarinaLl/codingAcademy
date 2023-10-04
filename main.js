function contest() {
	let prizeList = ['Sale', 'Free Course', 'Nothing'];
	let i = Math.floor(Math.random() * prizeList.length);
	return prizeList[i];
}

const contestBtn = document.getElementById("contest");

contestBtn.addEventListener('click', function(){
	window.open("test.php", "_blank", "width=500, height=500");
	const txt = document.getElementById("prize");
	txt.innerText = contest();
	
});


// Obtén una referencia al elemento de entrada y al botón
var studentPassword = document.getElementById("studentPassword");
var studentPasswordBtn = document.getElementById("studentPasswordBtn");

console.log("Main.js cargado");

studentPasswordBtn.addEventListener("click", function() {
  if (studentPassword.readOnly) {
	studentPassword.readOnly = false;
  } else {
	studentPassword.readOnly = true;
  }
});

function isPasswordChanged() {
	if(studentPassword.readOnly) {
		return true;
	} else {
		return false;
	}
}


