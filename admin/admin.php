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
        <link rel="stylesheet" href="../css/main.css">
        <script src="admin.js"></script>
        <script src="import_students.js"></script>
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
            <div id="admin-title">
                <h1>Hello, <?php echo $_SESSION['completeName'];?></h1>
                <label for="fileInput" id="import">Import</label>
                <input type="file" name="importStudents" id="fileInput"/>
            </div>
            
            <div id="form-container">
                <button id="btnCourse" class="btnFolderStyle">Courses</button>
                <button id="btnTeacher" class="btnFolderStyle">Teachers</button>
                <div>
                    <form id="searchBarForm" action="admin.php">
                        <input type="search" id="searchBar" name="search" placeholder="Search">
                        <button id="btnSearch" type="submit"></Button>
                    </form>
                    <button id="createTeacherBtn" title="Add new teacher"></button>
                    <button id="createCourseBtn" title="Add new course"></button>
                </div>
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
                                <th>Duration (h)</th>
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