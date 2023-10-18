<?php   
    include('../funciones.php');
    session_start();
    if (!isset($_SESSION['user']) || $_SESSION['role'] != 'student') {
        logout("../");
    } else {
        addHeader("../");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
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
    <div class="grid-container">
        <div></div>
        <div id="studentPanel">
            <div>
                <h1>Hello, <?php echo $_SESSION['completeName']; ?></h1>
            </div>
            <div>
                <button id="editProfileButton">Edit Profile</button>
            </div>
            <div>
                <h2>My Courses</h2>
            </div>
            <div>
                <form action="student.php" method="post" name="unenrollCourse">
                    <div class="wrap">
                        <?php
                            showStudentCourses($_SESSION['user']);
                            
                        ?>
                        
                    </div>
                </form>
            </div>
            <div id="popupBackground" class="popupBackground">
                <div id="editProfilePopup">
                    
                </div>
            </div>
        </div>
        <div></div>
    </div>
    <script src="../main.js"></script>
</body>
</html>
<?php } ?>