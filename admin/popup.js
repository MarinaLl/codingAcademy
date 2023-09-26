let createNewTeacher = document.getElementById('createTeacherBtn');
let createNewCourse = document.getElementById('createCourseBtn');

createNewCourse.addEventListener('click', function(){
    let popUpBackground = document.getElementById('popupBackground');
    popUpBackground.style.display = 'block';
    console.log('poup desplegado');
});

createNewTeacher.addEventListener('click', function(){
    let popUpBackground = document.getElementById('popupBackground');
    popUpBackground.style.display = 'block';
    console.log('poup desplegado');
});