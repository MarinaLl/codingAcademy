<?php 
    session_start();
?>
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
    $email = $_SESSION['email'];
    if($_POST){
        if (isset($_POST['editTeacher'])){
            $teacherName = $_POST['teacherName'];
            $teacherLastNames = $_POST['teacherLastNames'];
            $teacherTitle = $_POST['teacherTitle'];
            $teacherEmail = $_POST['teacherEmail'];
            $teacherPhoto = $_FILES['teacherPhoto']['tmp_name'];
            $teacherActive = $_POST['teacherActive'];

            $profileImage = uploadPhoto($teacherPhoto, $_FILES['teacherPhoto']['name']);

            connectDataBase();

            editTeacher($email, $teacherEmail, $teacherName, $teacherLastNames, $teacherTitle, $profileImage, $teacherActive);
        }

    } else {
    
        $sql = "SELECT * FROM teacher WHERE email = '$email'";
        $connect = connectDataBase();
        $query = mysqli_query($connect, $sql);

        if ($query == false){
            mysqli_error($connect);
        } else {
            $line = mysqli_fetch_array($query);
            echo '<form action="admin.php" method="post" enctype="multipart/form-data" name="editTeacher">
                <label for="teacherName">Name</label>
                <input type="text" name="teacherName" value="'.$line['name'].'" id="teacherName"><br>
                <label for="teacherLastNames">Last Names</label>
                <input type="text" name="teacherLastNames" value="'.$line['lastNames'].'" id="teacherLastNames"><br>
                <label for="teacherTitle">Title</label>
                <input type="text" name="teacherTitle" value="'.$line['title'].'" id="teacherTitle"><br>
                <label for="teacherPhoto">Photo</label>
                <input type="file" name="teacherPhoto" id="teacherPhoto"><br>
                <label for="teacherEmail">Email</label>
                <input type="email" name="teacherEmail" value="'.$line['email'].'" id="teacherEmail"><br>
                <label for="teacherPass">Password</label>
                <input type="password" name="teacherPass" id="teacherPass">
                <input type="submit" value="Confirma">';
        }
    }?>
</body>
</html>