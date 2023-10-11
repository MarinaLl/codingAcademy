<?php
    session_start();
    include('../funciones.php');
    
    if ($_SESSION['role'] != 'admin') {
        logout("../");
    } else {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $code = $_SESSION['code'];
    $connect = connectDataBase();
    if ($_POST) {
        $courseName = $_POST['courseName'];
        $courseDescription = $_POST['courseDescription'];
        $courseCategory = $_POST['courseCategory'];
        $courseDuration = $_POST['courseDuration'];
        $courseTeacher = $_POST['courseTeacher'];
        $courseStartDate = $_POST['courseStart'];
        $courseEndDate = $_POST['courseEnd'];
        $coursePhoto = $_FILES['coursePhoto']['tmp_name'];
        if ($coursePhoto == null) {
            $sql = "SELECT photo FROM course WHERE code = '$code'";

            

            $query = mysqli_query($connect, $sql);

            $line = mysqli_fetch_array($query, MYSQLI_ASSOC);

            echo $line[0];
            $courseImage = $line[0];

        } else {
            $courseImage = uploadPhoto($coursePhoto, $_FILES['coursePhoto']['name'], "../");
        }


        editCourse($code, $courseName, $courseDescription, $courseCategory, $courseDuration, $courseStartDate, $courseEndDate, $courseTeacher, $courseImage);
    } else {

        $sql = "SELECT * FROM course WHERE code = '$code'";
        $query = mysqli_query($connect, $sql);

        if ($query == false) {
            mysqli_error($connect);
        } else {
            $line = mysqli_fetch_array($query, MYSQLI_ASSOC);
            echo ' <form action="editCourse.php" method="post" enctype="multipart/form-data">
            <label for="courseName">Course Name</label>
            <input type="text" name="courseName" value="' . $line['name'] . '" id="courseName"><br>
            <label for="courseDescription">Description</label>
            <textarea name="courseDescription" value="' . $line['description'] . '" id="courseDescription" cols="30" rows="10">' . $line['description'] . '</textarea><br>
            <label for="category">Category</label>
            <select name="courseCategory" id="courseCategory" >
                <option value="'. $line['category'] .'" default>'. $line['category'] .'</option>
                <option value="beginner-friendly">Beginner Friendly</option>
                <option value="web-development">Web Development</option>
                <option value="game-developmen">Game Development</option>
                <option value="computer-science">Computer Science</option>
            </select><br>
            <label for="courseDuration">Duration</label>
            <input type="number" name="courseDuration" value=' . $line['duration'] . ' id="courseDuration"><br>
            <label for="courseStart">Course Start</label>
            <input type="date" name="courseStart" value=' . $line['start'] . ' id="courseStart"><br>
            <label for="courseEnd">Course Start</label>
            <input type="date" name="courseEnd" value=' . $line['end'] . ' id="courseEnd"><br>
            <label for="courseTeacher">Teacher</label>
            <select name="courseTeacher" id="courseTeacher">
                <option value="' . $line['teacher_email'] . '" default>' . $line['teacher_email'] . '</option>
                <?php listTeacherNames(); ?>
            </select><br>
            <label for="coursePhoto">Photo</label>
            <input type="file" name="coursePhoto" value=' . $line['photo'] . ' id="coursePhoto">
            <input type="submit" value="Confirm">
        </form>';
        }
    } ?>
</body>

</html>
<?php } ?>