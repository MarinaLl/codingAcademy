<?php 
    session_start();
    include('funciones.php');
    addHeader("");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    
    <title>Courses</title>
</head>
<body>
    <?php 
        if ($_POST) {
            enroll();
        }
    ?>
    <div class="grid-container">
        <div></div>
        <div class="courseList">

        <h1 id="courseTitle">
            <?php $category = str_replace('-', ' ', $_SESSION['courseCategory']);
            $category = ucwords($category); echo $category;
            ?></h1>
        <div>
            <h3 id="allCourses">All Courses</h3>
            <h3 id="filterBy">Filter by</h3>
        </div>
        <form action="courseList.php" method="post" name="courseEnrollment">
            <?php
                showCourseList($_SESSION['courseCategory'], $_SESSION['user']);
                
            ?>
            </form>
        </div>
        <div></div>
    </div>
</body>
</html>