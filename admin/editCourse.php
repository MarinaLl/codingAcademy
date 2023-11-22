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
</head>

<body>
    <?php
    $connect = connectDataBase();
    if ($_POST) {
        
        $courseName = "name = '".$_POST['courseName']."',";
        $courseDescription = "description = '".$_POST['courseDescription']."',";
        $courseCategory = "category = '".$_POST['courseCategory']."',";
        $courseDuration = "duration = '".$_POST['courseDuration']."',";
        $startDate = "start = '".$_POST['courseStart']."',";
        $endDate = "end = '".$_POST['courseEnd']."',";
        $courseTeacher = "teacher_email = '".$_POST['courseTeacher']."'";
        $coursePhoto = $_FILES['coursePhoto']['tmp_name'];

        if ($coursePhoto == null) {
            $sql = "SELECT photo FROM course WHERE code = ".$code."";

            $query = mysqli_query($connect, $sql);

            $line = mysqli_fetch_array($query);
            
            
            $courseImage = "";
        } else {
            $courseImage = ", photo = '".uploadPhoto($coursePhoto, $_FILES['coursePhoto']['name'], "../")."'";
        }

        editCourse($code, $courseName, $courseDescription, $courseCategory, $courseDuration, $startDate, $endDate, $courseTeacher, $courseImage);
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
