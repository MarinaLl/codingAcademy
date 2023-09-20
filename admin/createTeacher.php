<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include('funciones.php');
        if($_POST){
            
                $teacherName = $_POST['teacherName'];
                $teacherLastNames = $_POST['teacherLastNames'];
                $teacherTitle = $_POST['teacherTitle'];
                $teacherEmail = $_POST['teacherEmail'];
                $teacherPasswd = $_POST['teacherPass'];
                $teacherPhoto = $_FILES['teacherPhoto']['tmp_name'];
                $teacherDni = $_POST['teacherDni'];
                $teacherPasswd = md5($teacherPasswd);

                

                $profileImage = uploadPhoto($teacherPhoto, $_FILES['teacherPhoto']['name'], "Courses");
    
                connectDataBase();
    
                createNewTeacher($teacherEmail, $teacherPasswd, $teacherName, $teacherLastNames, $teacherTitle, $profileImage, $teacherDni);
                
            

        } else {
    ?>
    <form action="createTeacher.php" method="post" enctype="multipart/form-data" name="createTeacher">
        <label for="teacherName">Name</label>
        <input type="text" name="teacherName" id="teacherName"><br>
        <label for="teacherLastNames">Last Names</label>
        <input type="text" name="teacherLastNames" id="teacherLastNames"><br>
        <label for="teacherDni">DNI</label>
        <input type="text" name="teacherDni" id="teacherDni"><br>
        <label for="teacherTitle">Title</label>
        <input type="text" name="teacherTitle" id="teacherTitle"><br>
        <label for="teacherPhoto">Photo</label>
        <input type="file" name="teacherPhoto" id="teacherPhoto"><br>
        <label for="teacherEmail">Email</label>
        <input type="email" name="teacherEmail" id="teacherEmail"><br>
        <label for="teacherPass">Password</label>
        <input type="password" name="teacherPass" id="teacherPass">
        <input type="submit" value="Confirma">
    </form>
    <?php }?>
</body>
</html>