document.addEventListener("DOMContentLoaded", function() {
    // select elements for popups
    const createNewTeacher = document.getElementById('createTeacherBtn');
    const createNewCourse = document.getElementById('createCourseBtn');
    const popUpBackground = document.getElementById('popupBackground');
    const popUp = document.getElementById('popup');
    const cancelBtn = document.getElementById('cancelBtn');

    console.log("Admin.js cargado");

    // select elements from html
    let btnCourses = document.getElementById('btnCourse');
    let btnTeacher = document.getElementById('btnTeacher');

    // show courses folder
    btnCourses.addEventListener('click', function(){
        let teacherForm = document.getElementById('teacher-form');
        let courseForm = document.getElementById('course-form');

        console.log('boton curso');

        courseForm.style.visibility = 'visible';
        btnCourses.style.zIndex = 1;
        
        teacherForm.style.visibility = 'hidden';
        btnTeacher.style.zIndex = 0;
    });

    // show teachers folder
    btnTeacher.addEventListener('click', function(){
        let teacherForm = document.getElementById('teacher-form');
        let courseForm = document.getElementById('course-form');

        console.log('boton prof');

        courseForm.style.visibility = 'hidden';
        btnCourses.style.zIndex = "0";
        teacherForm.style.visibility = 'visible';
        btnTeacher.style.zIndex = "1";
    });

    
    
    // loads into popup createCourse.php data
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

    // loadns into popup createTeacher.php data
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

    // hide popup when clicking black screen
    popUpBackground.addEventListener('click', function(event){
        if(event.target === this){
            popUpBackground.style.display = 'none';     
        }
    });

    
    if(cancelBtn){
        console.log('hay boton reset');
        cancelBtn.addEventListener('click', function(){
            popUpBackground.style.display = 'none';
        });
    } else {
        console.log('no boton reset');
    }
    
});
