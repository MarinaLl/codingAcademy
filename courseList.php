<?php 
    session_start();
    include('funciones.php');
    addHeader("");
    addFonts();
    $_SESSION['courseCategory'] = "beginner-friendly";
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
    <h1 id="courseTitle">
        <?php $category = str_replace('-', ' ', $_SESSION['courseCategory']);
        $category = ucwords($category); echo $category;
        ?></h1>
    <h2 id="allCourses">All Courses</h2>
    <h2 id="filterBy">Filter by</h2>
        <?php
            $sql = "SELECT * FROM course WHERE category = '".$_SESSION['courseCategory']."' AND active = 1";
            
            $connect = connectDataBase();
    
            $query = mysqli_query($connect, $sql);

            if ($query == false){
                mysqli_error($connect);
            } else {
                $numLines = mysqli_num_rows($query);
                echo '<table>';
                for($i = 0; $i < $numLines; $i++){
                    $line = mysqli_fetch_array($query);
                    $sql2 = "SELECT name, lastNames, photo FROM teacher WHERE email = '".$line['teacher_email']."'";
                    $connect2 = connectDataBase();
                    $query2 = mysqli_query($connect2, $sql2);
                    $teacher = mysqli_fetch_array($query2);
                    $courseImage = $line['photo'];
                    $courseName = $line['name'];
                    $courseCode = $line['code'];
                    $teacherPhoto = $teacher['photo'];
                    $teacherCompleteName = $teacher['name']." ".$teacher['lastNames'];
                    $courseDescription = $line['description'];
                    $courseDuration = $line['duration'];
                    $courseStartDate = $line['start'];
                    $courseDifficulty = $line['difficulty'];
                    
                    echo '
                        <tr>
                            <td><img src="'.$courseImage.'"></td>
                            <td>'.$courseName.'</td>
                            <td>'.$courseCode.'</td>
                            <td><img src="'.$teacherPhoto.'"></td>
                            <td>'.$teacherCompleteName.'</td>
                            <td>'.$courseDescription.'</td>
                            <td>'.$courseDuration.'</td>
                            <td>'.$courseStartDate.'</td>
                            <td>'.$courseDifficulty.'</td>
                        </tr>';
                }
                echo '</table>';
            }
        ?>
</body>
</html>