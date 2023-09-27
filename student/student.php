<?php   
    include('../funciones.php');
    session_start();
    if (isset($_SESSION['user']) && $_SESSION['role'] == 'student') {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Panel</title>
</head>
<body>
    <?php
        if ($_POST) {
            $course = $_POST['buttonUnenroll'];
            $student = $_SESSION['user'];
            $sql = "DELETE FROM enrollment WHERE course_code = $course AND student_email = '$student'";
            $connectDelete = connectDataBase();
            $query = mysqli_query($connectDelete, $sql);
            if ($query == false){
                mysqli_error($connect);
            }
        }
    ?>
    <h1>Hello, <?php echo $_SESSION['completeName']; ?></h1>
    <a id="editProfileButton" href="">Edit Profile</a>
    <form action="student.php" method="post" name="unenrollCourse">
    <?php 
        $sql = "SELECT  t.photo AS teacherPhoto, 
                        t.name AS teacherName,
                        t.lastNames AS teacherLastNames,
                        c.code AS courseCode,
                        c.photo AS coursePhoto, 
                        c.name AS courseName, 
                        c.start AS courseStart, 
                        c.end AS courseEnd,
                        e.grade AS grade 
                FROM ((course c INNER JOIN teacher t ON c.teacher_email = t.email) 
                INNER JOIN enrollment e ON e.course_code = c.code)
                WHERE e.student_email = '".$_SESSION['user']."'";
        $connect = connectDataBase();
        
        $query = mysqli_query($connect, $sql);

        if ($query == false){
            mysqli_error($connect);
        } else {
            $numLines = mysqli_num_rows($query);
            
            if ($numLines > 0) {
                echo '<table>';
                for($i = 0; $i < $numLines; $i++){
                    $line = mysqli_fetch_array($query);
                    
                    echo '
                        <tr>
                            <td><img src="'.$line['coursePhoto'].'"></td>
                            <td>'.$line['courseName'].'</td>
                            <td><img src="'.$line['teacherPhoto'].'"></td>
                            <td>'.$line['teacherName'].' '.$line['teacherLastNames'].'</td>
                            <td>'.$line['courseStart'].'</td>
                            <td>'.$line['courseEnd'].'</td>
                            <td><button type="submit" name="buttonUnenroll" value='.$line['courseCode'].'>Unenroll</button></td>
                            <td>Grade: '.$line['grade'].' / 10</td>
                        </tr>';
                }
                echo '</table></form>';
            } else {
                echo 'You are not enrolled in any course.';
            }
        }
    ?>
</body>
</html>
<?php } else {
        logout("../");
    }?>