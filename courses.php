<?php 
    session_start();
    include('funciones.php');
    addHeader("");
    addFonts();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Courses</title>
</head>
<body>
    <div id="categoryGrid">
        <h1 class="pageTitle">COURSES</h1>
        <div id="courseCategoriesContainer">
            <div class="categoryBox">
                <div class="imageBox">
                    <img class="categoryImage" src="src/newbie(1).png" alt="newbie">
                </div>
                <a href="">Beginner Friendly</a>
            </div>
            <div class="categoryBox">
                <div class="imageBox">
                    <img class="categoryImage" src="src/devops(1).png" alt="newbie">
                </div>
                <a href="">Web Development</a>
            </div>
            <div class="categoryBox">
                <div class="imageBox">
                    <img class="categoryImage" src="src/game-development.png" alt="newbie">
                </div>
                <a href="">Game Development</a>
            </div>
            <div class="categoryBox">
                <div class="imageBox">
                    <img class="categoryImage" src="src/artificial-intelligence.png" alt="newbie">
                </div>
                <a href="">Computer Science</a>
            </div>
        </div>
        <div class="left"></div>
        <div class="right"></div>
    </div>
</body>
</html>