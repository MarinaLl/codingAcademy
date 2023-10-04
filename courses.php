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
                    <img class="categoryImage" src="src/devops(1).png" alt="newbie">
                </div>
                <a href="">Web Development</a>
            </div>
            <div id="game-development" class="categoryBox">
                <div class="imageBox">
                    <img class="categoryImage" src="src/game-development.png" alt="newbie">
                </div>
                <a href="">Game Development</a>
            </div>
            <div id="computer-science" class="categoryBox">
                <div class="imageBox">
                    <img class="categoryImage" src="src/artificial-intelligence.png" alt="newbie">
                </div>
                <a href="">Computer Science</a>
            </div>
        </div>
    </div>
    <h2>MOST POPULAR</h2>
    <?php
        $sql = "SELECT course_code, COUNT(*) AS enrollment_count
        FROM enrollment
        GROUP BY course_code
        ORDER BY enrollment_count DESC
        LIMIT 3";
        $connect = connectDataBase();
        $query = mysqli_query($connect, $sql);
        if ($query == false) {
            mysqli_error($connect);
        } else {
            $numLines = mysqli_num_rows($query);
            echo $numLines;
            if ($numLines < 3) {
                echo '<table>';
                for($i = 0; $i < $numLines; $i++){
                    $line = mysqli_fetch_array($query, MYSQL_ASSOC);
                    $sql = "SELECT * FROM course WHERE code = ".$line['course_code']."";
                    $queryCourse = mysqli_query($connect, $sql);
                    $course = mysqli_fetch_array($queryCourse, MYSQL_ASSOC);
                    $sql = "SELECT name, lastNames, photo FROM teacher WHERE email = '".$course['teacher_email']."'";
                    $queryTeacher = mysqli_query($connect, $sql);
                    $teacher = mysqli_fetch_array($queryTeacher, MYSQL_ASSOC);
                    $courseImage = $course['photo'];
                    $courseName = $course['name'];
                    $courseCode = $line['course_code'];
                    $teacherPhoto = $teacher['photo'];
                    $teacherCompleteName = $teacher['name']." ".$teacher['lastNames'];
                    $courseDescription = $course['description'];
                    $courseDuration = $course['duration'];
                    $courseStartDate = $course['start'];
                    $courseDifficulty = $course['difficulty'];
                    
                    echo '
                        <tr>
                            <td><img src="'.$courseImage.'"></td>
                            <td>'.$courseName.'</td>
                            <td><button type="submit" name="buttonEnroll" value='.$courseCode.'>Enroll</button></td>
                            <td><img src="'.$teacherPhoto.'"></td>
                            <td>'.$teacherCompleteName.'</td>
                            <td>'.$courseDescription.'</td>
                            <td>'.$courseDuration.'</td>
                            <td>'.$courseStartDate.'</td>
                            <td>'.$courseDifficulty.'</td>
                        </tr>';
                }
                echo '</table></form>';
            } else {
                echo 'No hay cursos en esta categoria';
            }
        }
    ?>
    
</body>
</html>