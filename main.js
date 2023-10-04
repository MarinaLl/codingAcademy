

function openWindow(){
	const newWindow = window.open("test.php", "_blank", "width=500, height=500");
}

function contest() {
    let prizeList = ['Sale', 'Free Course', 'Nothing'];
    let i = Math.floor(Math.random() * prizeList.length);

    
	return prizeList[i];

   
}
function showPrize(){
	const prizeText = document.getElementById("prize");
	prizeText.textContent = "Congratulations! You've won: " + contest();
}


console.log("Main.js cargado");

// Obtén una referencia al elemento de entrada y al botón
var studentPassword = document.getElementById("studentPassword");
var studentPasswordBtn = document.getElementById("studentPasswordBtn");


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

