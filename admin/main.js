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