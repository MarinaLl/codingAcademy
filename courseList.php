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
    <link rel="stylesheet" href="style.css">
    <title>Courses</title>
</head>
<body>
    <?php 
        if ($_POST) {
            $courseCode = $_POST['buttonEnroll'];
            $studentEmail = $_SESSION['user'];
            $sqlInsert = "INSERT INTO enrollment (student_email, course_code, grade) VALUES ('$studentEmail','$courseCode', 0.00)";
            $connectEnrollment = connectDataBase();
            $query = mysqli_query($connectEnrollment, $sqlInsert);
            if ($query == false) {
                mysqli_error($connectEnrollment);
            }
        }
    ?>
    <h1 id="courseTitle">
        <?php $category = str_replace('-', ' ', $_SESSION['courseCategory']);
        $category = ucwords($category); echo $category;
        ?></h1>
    <h2 id="allCourses">All Courses</h2>
    <h2 id="filterBy">Filter by</h2>
    <form action="courseList.php" method="post" name="courseEnrollment">
        <?php
            $sql = "SELECT * FROM course WHERE category = '".$_SESSION['courseCategory']."' AND active = 1 AND code NOT IN (SELECT course_code FROM enrollment WHERE student_email = '".$_SESSION['user']."')";
            
            $connect = connectDataBase();
    
            $query = mysqli_query($connect, $sql);

            if ($query == false){
                mysqli_error($connect);
            } else {
                $numLines = mysqli_num_rows($query);
                
                if ($numLines > 0) {
                    echo '<table>';
                    for($i = 0; $i < $numLines; $i++){
                        $course = mysqli_fetch_array($query);
                        $sql = "SELECT name, lastNames, photo FROM teacher WHERE email = '".$course['teacher_email']."'";
                        $queryTeacher = mysqli_query($connect, $sql);
                        $teacher = mysqli_fetch_array($queryTeacher);
                        $teacherCompleteName = $teacher['name']." ".$teacher['lastNames'];
                        echo '
                            <tr>
                                <td><img src="'.$course['photo'].'"></td>
                                <td>'.$course['name'].'</td>
                                <td><button type="submit" name="buttonEnroll" value='.$course['code'].'>Enroll</button></td>
                                <td><img src="'.$teacher['photo'].'"></td>
                                <td>'.$teacherCompleteName.'</td>
                                <td>'.$course['description'].'</td>
                                <td>'.$course['duration'].'</td>
                                <td>'.$course['start'].'</td>
                                <td>'.$course['difficulty'].'</td>
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