<?php
 session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Pannel</title>
    <style>
        img{
            width: 100px;
        }
    </style>
</head>
<body>
    <?php include('../header.php');?>

    <form action="createTeacher.php" method="post">
        <input type="submit" value="Add New Teacher">
    </form>
    <form action="createCourse.php" method="post">
     <input type="submit" value="Add New Course">
    </form>
    
    <?php  
    include('funciones.php');
        if($_POST){
            

                if(isset($_POST['buttonDis'])){
                    $teacher = $_POST['buttonDis'];
                    disableTeacher($teacher);
                    header('Location: '. $_SERVER['PHP_SELF']);
                    exit;
                } else if (isset($_POST['buttonEdit'])) {
                    echo $_POST['buttonEdit'];
                    $_SESSION['email'] = $_POST['buttonEdit'];
                    header('Location: editTeacher.php');
                }
           
                if(isset($_POST['buttonDisCourse'])){
                    $code = $_POST['buttonDisCourse'];
                    disableCourse($code);
                    header('Location: '. $_SERVER['PHP_SELF']);
                    exit;
                } else if (isset($_POST['buttonEditCourse'])) {
                    echo $_POST['buttonEdit'];
                    $_SESSION['code'] = $_POST['buttonEditCourse'];
                    header('Location: editCourse.php');
                }
            

        }else {
        
    ?>
    <form action="admin.php" method="post" name="disableTeacher">
        <table border="1">
            <tr>
                <th>Email</th>
                <th>DNI</th>
                <th>Name</th>
                <th>Last Names</th>
                <th>Title</th>
                <th>Photo</th>
                <th>Active</th>
                <th>Edit</th>
                <th>Disable</th>
            </tr>
            <?php showAllTeachers(); ?>
        </table>
    </form>
    <form action="admin.php" method="post" name="disableCourse">
        <table border="1">
            <tr>
                <th>Photo</th>
                <th>Code</th>
                <th>Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Duration</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Teacher</th>
                <th>Active</th>
                <th>Edit</th>
                <th>Disable</th>
            </tr>
            <?php showAllCourses(); ?>
        </table>
    </form>
   <?php };?>





</body>
</html>