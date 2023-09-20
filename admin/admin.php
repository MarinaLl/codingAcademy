<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Pannel</title>
</head>
<body>
    
    <h1>Create Teacher</h1>
    <form action="createTeacher.php" method="post">
        <input type="submit" value="Add New Teacher">
    </form>
    <form action="createCourse.php" method="post">
     <input type="submit" value="Add New Course">
    </form>
    
    <?php  
    include('funciones.php');
        if($_POST){
            if(isset($_POST['button'])){
                $teacher = $_POST['button'];
                disableTeacher($teacher);
                header('Location: '. $_SERVER['PHP_SELF']);
                exit;
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
   <?php };?>





</body>
</html>