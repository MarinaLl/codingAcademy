<?php
    include('../funciones.php');
    session_start();
    if (isset($_SESSION['user']) && $_SESSION['role'] == 'admin') {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Panel</title>
    <style>
        img{
            width: 40px;
        }
        #teacher-form{
            visibility: hidden;
            position: absolute;
            width: 1268px;
            height: 506px;
            background-color: #00a3a0;
            color: white;
            border-radius: 0px 0px 20px 20px;  
        }
        #course-form{
            position: absolute;
            border-radius: 0px 0px 20px 20px;       
            width: 1268px;
            height: 506px;
            background-color: #007A78;
            color: white;
            
        }
        #form-container{
            width: 1268px;
            height: 565px;
            border-radius: 20px;
            background-color: rgba(0, 122, 120, 0.56);
        }
        .btnFolderStyle{
            width: 168px;
            height: 50px;
            border-radius: 20px 20px 0px 0px;
            border: none;
            color: white;
            font-size: 20px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
            margin-top: 11px;
        }
        
        #btnCourse{
            background-color: #007A78;  
            margin-left: 32px;
            
        }
        #btnTeacher{
            background-color: rgba(0, 163, 160, 0.75);
            margin-left: -30px;
    
        }
        table{
            width: 100%;
        }
        </style>
    
</head>
<body>
    <?php addHeader('../');?>

    <form action="createTeacher.php" method="post">
        <input type="submit" value="Add New Teacher">
    </form>
    <form action="createCourse.php" method="post">
     <input type="submit" value="Add New Course">
    </form>
    
    <?php  
        if($_POST){
            

                if(isset($_POST['buttonDis'])){
                    $teacher = $_POST['buttonDis'];
                    disableTeacher($teacher);
                    header('Location: '. $_SERVER['PHP_SELF']);
                    exit;
                } else if (isset($_POST['buttonEdit'])) {
                    echo $_POST['buttonEdit'];
                    $_SESSION['email'] = $_POST['buttonEdit'];
                    include('createTeacher.php');
                }
           
                if(isset($_POST['buttonDisCourse'])){
                    $code = $_POST['buttonDisCourse'];
                    disableCourse($code);
                    header('Location: '. $_SERVER['PHP_SELF']);
                    exit;
                } else if (isset($_POST['buttonEditCourse'])) {
                    $_SESSION['code'] = $_POST['buttonEditCourse'];
                    header('Location: editCourse.php');
                }

        } else {
        
    ?>

    <div id="form-container">
    
    <button id="btnCourse" class="btnFolderStyle">Courses</button>
    <button id="btnTeacher" class="btnFolderStyle">Teachers</button>
    
        
        <div id="teacher-form">
            <form action="admin.php" method="post" name="disableTeacher">
                <table border="1">
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
                <table border="1">
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
    
   <?php };?>



   <script src="main.js"></script>


</body>
</html>
<?php } else {
        logout("../");
    }?>