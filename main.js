

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


document.addEventListener('DOMContentLoaded', function () {
// Slider de imagenes

	let currentSlide = 0;
	const slides = document.querySelectorAll('.slide');
	const totalSlides = slides.length;

	function showSlide(index) {
		if (index >= totalSlides) {
			currentSlide = 0;
		} else if (index < 0) {
			currentSlide = totalSlides - 1;
		} else {
			currentSlide = index;
		}

		// Utilizar translate3d para mejorar el rendimiento de la transición
		const newTransformValue = -currentSlide * 100 + 'vw'; // Cambio aquí

		document.getElementById('slider').style.transform = 'translate3d(' + newTransformValue + ', 0, 0)';
		updateIndicators();

	}

	const prev = document.getElementById("prev");
	const next = document.getElementById("next");

	prev.addEventListener('click', () => changeSlide(-1));
	next.addEventListener('click', () => changeSlide(1));

	function changeSlide(direction) {
		showSlide(currentSlide + direction);
		
	}

	function createIndicators() {
		const indicatorContainer = document.getElementById('indicator-container');

		for (let i = 0; i < totalSlides; i++) {
			const indicator = document.createElement('div');
			indicator.classList.add('indicator');
			indicator.addEventListener('click', function () {
				showSlide(i);
			});
			indicatorContainer.appendChild(indicator);
		}

		updateIndicators();
	}

	function updateIndicators() {
		const indicators = document.querySelectorAll('.indicator');
		indicators.forEach((indicator, index) => {
			if (index === currentSlide) {
				indicator.classList.add('active');
			} else {
				indicator.classList.remove('active');
			}
		});
	}

	createIndicators();

});