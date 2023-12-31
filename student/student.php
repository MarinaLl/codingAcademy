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
    <link rel="stylesheet" href="../css/main.css">
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
                <a id="editProfileButton" href="editProfile.php">Edit Profile</a>
            </div>
            <h2>My Courses</h2>
            <div>
                <form action="student.php" method="post" name="unenrollCourse">
                    <div class="wrap">
                        <?php
                            showStudentCourses($_SESSION['user']);
                            
                        ?>
                        
                    </div>
                </form>
            </div>
        </div>
        <div></div>
    </div>
    <?php addFooter("../"); ?>
    <script src="../main.js"></script>
</body>
</html>
<?php } ?>