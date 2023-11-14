// Courses
console.log("Courses.js cargado");
var categoryBoxes = document.querySelectorAll(".categoryBox");

document.addEventListener("DOMContentLoaded", function () {
    console.log("Documento cargado");
    var categoryBoxes = document.querySelectorAll(".categoryBox");
    console.log(categoryBoxes);
    categoryBoxes.forEach(function (categoryBox) {
        console.log(categoryBox);
      categoryBox.addEventListener("click", function (event) {
        console.log(categoryBox.id);
        window.location.href = window.location.href + "?category=" + categoryBox.id;
        console.log(window.location.href);
      });
    });

  const editProfileBtn = document.getElementById("editProfileButton");
  const popUpBackground = document.getElementById("popupBackground");
  const editProfilePopup = document.getElementById("editProfilePopup");


  editProfileBtn.addEventListener('click', function(){
    popUpBackground.style.display = 'block';
    console.log('cargado perfil');
    
    // cargar contenido php
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'editProfile.php', true);

    xhr.onload = function() {
        if (xhr.status === 200){
          editProfilePopup.innerHTML = xhr.responseText;
        }
    };

    xhr.send();
    
    
  });

   // hide popup when clicking black screen
  popUpBackground.addEventListener('click', function(event){
    if(event.target === this){
        popUpBackground.style.display = 'none';
    }
});

});


  
