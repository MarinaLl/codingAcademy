<?php   
    include('../funciones.php');
    session_start();
    if ($_SESSION['role'] != 'student') {
        logout("../");
    } else {
        addHeader("../");

        if (isset($_GET['category'])) {
            if (isCategory(($_GET['category']))) {
                $category = $_GET['category'];
                include("courseList.php");
            } else {
                echo '<meta http-equiv="refresh" content="0;url=courses.php">';
            }
            
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
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="css/main.css">
    <title>Courses</title>
</head>
<body>
    <script src="../main.js"></script>
    <div class="grid-container">
        <div></div>
        <div class="courseCategories">
                <h1 class="pageTitle">COURSES</h1>
                <div id="courseCategoriesContainer">
                    <div id="beginner-friendly" class="categoryBox">
                        <div class="imageBox">
                            <img class="categoryImage" src="../src/newbie(1).png" alt="newbie">
                        </div>
                        <p>Beginner Friendly</p>
                    </div>
                    <div id="web-development" class="categoryBox">
                        <div class="imageBox">
                            <img class="categoryImage" src="../src/devops(1).png" alt="web development">
                        </div>
                        <p>Web Development</p>
                    </div>
                    <div id="game-development" class="categoryBox">
                        <div class="imageBox">
                            <img class="categoryImage" src="../src/game-development.png" alt="game development">
                        </div>
                        <p>Game Development</p>
                    </div>
                    <div id="computer-science" class="categoryBox">
                        <div class="imageBox">
                            <img class="categoryImage" src="../src/artificial-intelligence.png" alt="computer science">
                        </div>
                        <p>Computer Science</p>
                    </div>
                </div>
                <?php countTopCourses(); ?>
        </div>
        <div></div>
    </div>
    <?php addFooter("../"); ?>
</body>
</html>
<?php }} ?>
