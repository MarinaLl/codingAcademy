<?php 
session_start();
include('funciones.php');
addHeader("");

if (isset($_GET['category'])) {
    $_SESSION['courseCategory'] = $_GET['category'];
    echo '<meta http-equiv="refresh" content="0;url=courseList.php">';
} else {
    if ($_POST) {
        enroll();
    }
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
    <script src="courses.js"></script>
    <div id="categoryGrid">
        <h1 class="pageTitle">COURSES</h1>
        <div id="courseCategoriesContainer">
            <div id="beginner-friendly" class="categoryBox">
                <div class="imageBox">
                    <img class="categoryImage" src="src/newbie(1).png" alt="newbie">
                </div>
                <a href="">Beginner Friendly</a>
            </div>
            <div id="web-development" class="categoryBox">
                <div class="imageBox">
                    <img class="categoryImage" src="src/devops(1).png" alt="web development">
                </div>
                <a href="">Web Development</a>
            </div>
            <div id="game-development" class="categoryBox">
                <div class="imageBox">
                    <img class="categoryImage" src="src/game-development.png" alt="game development">
                </div>
                <a href="">Game Development</a>
            </div>
            <div id="computer-science" class="categoryBox">
                <div class="imageBox">
                    <img class="categoryImage" src="src/artificial-intelligence.png" alt="computer science">
                </div>
                <a href="">Computer Science</a>
            </div>
        </div>
    </div>
    <h2>MOST POPULAR</h2>
    <?php
        countTopCourses();
    ?>
</body>
</html>
<?php } ?>
