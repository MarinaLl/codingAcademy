window.addEventListener('load', function() {
    console.log("Admin.js cargado");

    let btnCourses = document.getElementById('btnCourse');
    let btnTeacher = document.getElementById('btnTeacher');

    btnCourses.addEventListener('click', function(){
        let teacherForm = document.getElementById('teacher-form');
        let courseForm = document.getElementById('course-form');

        console.log('boton curso');

        courseForm.style.visibility = 'visible';
        teacherForm.style.visibility = 'hidden';
    });

    btnTeacher.addEventListener('click', function(){
        let teacherForm = document.getElementById('teacher-form');
        let courseForm = document.getElementById('course-form');

        console.log('boton prof');

        courseForm.style.visibility = 'hidden';
        teacherForm.style.visibility = 'visible';
    });

    // desplegar el popup

    const createNewTeacher = document.getElementById('createTeacherBtn');
    const createNewCourse = document.getElementById('createCourseBtn');
    const popUpBackground = document.getElementById('popupBackground');
    const popUp = document.getElementById('popup');
    

    createNewCourse.addEventListener('click', function(){
        popUpBackground.style.display = 'block';
        console.log('cargado curso');
        
        // cargar contenido php
        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'createCourse.php', true);

        xhr.onload = function() {
            if (xhr.status === 200){
                popUp.innerHTML = xhr.responseText;
            }
        };

        xhr.send();
        
    });

    createNewTeacher.addEventListener('click', function(){
        popUpBackground.style.display = 'block';
        console.log('cargado prof');

        //cargar contenido php
        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'createTeacher.php', true);

        xhr.onload = function() {
            if (xhr.status === 200){
                popUp.innerHTML = xhr.responseText;
            }
        };

        xhr.send();
    });

    popUpBackground.addEventListener('click', function(event){
        if(event.target === this){
            popUpBackground.style.display = 'none';     
        }
    });

});