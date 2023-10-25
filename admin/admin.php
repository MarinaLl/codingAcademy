<?php
    include('../funciones.php');
    session_start();
    if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
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
        <title>Administrator Panel</title>
        <script src="admin.js"></script>
    </head>
    <body>
        <?php  
            if($_POST) {
                if(isset($_POST['buttonDis'])) {
                    $teacher = $_POST['buttonDis'];
                    disableTeacher($teacher);
                    echo '<meta http-equiv="refresh" content="0;url='.$_SERVER['PHP_SELF'].'">';
                    exit;
                } else if (isset($_POST['buttonEdit'])) {
                    echo $_POST['buttonEdit'];
                    $_SESSION['email'] = $_POST['buttonEdit'];
                    echo '<meta http-equiv="refresh" content="0;url=editTeacher.php">';
                }
            
                if(isset($_POST['buttonDisCourse'])){
                    $code = $_POST['buttonDisCourse'];
                    disableCourse($code);
                    echo '<meta http-equiv="refresh" content="0;url='.$_SERVER['PHP_SELF'].'">';
                    exit;
                } else if (isset($_POST['buttonEditCourse'])) {
                    //echo $_POST['buttonEditCourse'];
                    $_SESSION['code'] = $_POST['buttonEditCourse'];
                    echo '<meta http-equiv="refresh" content="0;url=editCourse.php">';
                }
            }
        ?>
    <div class="grid-container">
        <div></div>
        <div>
            <h1>Hello, <?php echo $_SESSION['completeName'];?></h1>
            <button id="createTeacherBtn"></button>
            <button id="createCourseBtn"></button>
            <a href="../string.php">Import Students</a>
            
            <div id="form-container">
                
                <button id="btnCourse" class="btnFolderStyle">Courses</button>
                <button id="btnTeacher" class="btnFolderStyle">Teachers</button>
                <div id="teacher-form">
                    <form action="admin.php" method="post" name="disableTeacher">
                        <table>
                            <tr>
                                <th>Photo</th>
                                <th>Teacher Name</th>
                                <th>Email</th>
                                <th>Title</th>
                                <th>DNI</th>
                                <th>Active</th>
                                <th>Edit</th>
                                <th>Disable</th>
                            </tr>
                            <?php showAllTeachers(); ?>
                        </table>
                    </form>
                </div>
                
                <div id="course-form">
                    <form action="admin.php" method="post" name="disableCourse">
                        <table>
                            <tr>
                                <th>Photo</th>
                                <th>Course Name</th>
                                <th>Teacher</th>
                                <th>Category</th>
                                <th>Duration</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Active</th>
                                <th>Edit</th>
                                <th>Disable</th>
                            </tr>
                            <?php showAllCourses(); ?>
                        </table>
                    </form>
                </div>
            </div>
            <div id="popupBackground" class="popupBackground" style="display: none;">
                <div id="popup">
                    
                </div>
            </div>
            <?php }?>
        </div>
        <div></div>
    </div>
</body>
</html>