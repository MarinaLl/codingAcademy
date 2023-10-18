document.addEventListener("DOMContentLoaded", function () {
    console.log("Documento cargado");
    var courseBoxes = document.querySelectorAll(".teacherComponent");
    console.log(courseBoxes);
    courseBoxes.forEach(function (courseBox) {
        console.log(courseBox);
        courseBox.addEventListener("click", function (event) {
            console.log(courseBox.id);
            window.location.href = window.location.href + "?course=" + courseBox.id;
            console.log(window.location.href);
        });
    });

    editGradeBtn = document.getElementById("editGradeBtn");
    popUpBackground = document.getElementById("popUpBackground");
    popUp = document.getElementById("popUp");
    console.log(editGradeBtn);
    if (editGradeBtn != null) {
        editGradeBtn.addEventListener('click', function(event){
            
            event.preventDefault();
            popUpBackground.style.display = 'block';
            console.log('cargado curso');
            // cargar contenido php
            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'teacherEditGrade.php', true);
    
            xhr.onload = function() {
                if (xhr.status === 200){
                    popUp.innerHTML = xhr.responseText;
                }
            };
    
            xhr.send();
            
        }); 
    }
});
  