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
  });
  
  