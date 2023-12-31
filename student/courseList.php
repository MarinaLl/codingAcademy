<?php
    if (!isset($category) && !isset($_GET['filter'])) {
        if ($_POST) {
            session_start();
            include("../funciones.php");
            enroll();
        }
        echo '<meta http-equiv="refresh" content="0;url=courses.php?category='.$_POST['courseCategory'].'">';
    } else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/main.css">
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const filterBy = document.getElementById("filterByOptions");
            filterBy.addEventListener('change', function(){
                let w = window.location.href;
                if (w.includes('filter')) {
                    let url = window.location.href.split('&');
                    w = url[0];
                } 
                window.location.href = w + "&filter=" + filterBy.value;
                
                
            });
        });
    </script>
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

        <h1 class="pageTitle">
            <?php $categoryName = str_replace('-', ' ', $category);
            $categoryName = ucwords($categoryName); echo $categoryName;
            ?></h1>
        <div>
            <h3 id="allCourses"><a href="courses.php">All Courses</a></h3>
            <div>
                <label id="filterBy" for="filterByOptions">Filter by </label>
                <select id="filterByOptions" name="filterByOptions">
                    <option value="">select option</option>
                    <option value="duration">Duration</option>
                    <option value="difficulty">Difficulty</option>
                    <option value="start">Start Date</option>
                </select>
            </div>
        </div>
        <form action="courseList.php" method="post" name="courseEnrollment">
            <?php
                showCourseList($category); 
            ?>
            </form>
            
        </div>
        <div></div>
    </div>
    <?php addFooter("../"); ?>
</body>
</html>
<?php } ?>