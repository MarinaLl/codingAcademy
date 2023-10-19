<?php
    session_start();
    include('../funciones.php');
    $code = $_SESSION['code'];
    addHeader("../");
    if ($_SESSION['role'] != 'admin') {
        logout("../");
    } else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course</title>
</head>

<body>
    <?php
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
            $sql = "SELECT photo FROM course WHERE code = '".$code."'";

            $query = mysqli_query($connect, $sql);

            $line = mysqli_fetch_array($query, MYSQLI_ASSOC);

            echo $line[0];
            $courseImage = $line[0];

        }

        editCourse($code, $courseName, $courseDescription, $courseCategory, $courseDuration, $courseStartDate, $courseEndDate, $courseTeacher, $courseImage);
    } else {
        ?>
        <div class="grid-container">
            <div></div>
            <div>
                <div class="popupBackground">
                    <div id="popup">
                        <h4 class="popup-title">Edit Course</h4>
                        <?php editCourseForm($code); ?>
                    </div>
                </div>
             </div>
            <div></div>
        </div>
        
        
        <?php
       
    } ?>
</body>

</html>
<?php } ?>
