<?php
    session_start();
    if ($_SESSION['role'] != 'admin') {
        logout("../");
    } else {
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
    include('../funciones.php');
    $email = $_SESSION['email'];
    
    if($_POST){
            $teacherName = $_POST['teacherName'];
            $teacherLastNames = $_POST['teacherLastNames'];
            $teacherTitle = $_POST['teacherTitle'];
            $teacherEmail = $_POST['teacherEmail'];
            $teacherPhoto = $_FILES['teacherPhoto']['tmp_name'];
            if ($teacherPhoto == null){
                $sql = "SELECT photo FROM teacher WHERE email = '$email'";

                $connect = connectDataBase();

                $query = mysqli_query($connect, $sql);

                $line = mysqli_fetch_array($query, MYSQL_ASSOC);

                echo $line[0];
                $profileImage = $line[0];
                
            }else {
                $profileImage = uploadPhoto($teacherPhoto, $_FILES['teacherPhoto']['name'], "../");
            }

            $teacherDni = $_POST['teacherDni'];

            connectDataBase();

            editTeacher($email, $teacherEmail, $teacherName, $teacherLastNames, $teacherTitle, $teacherDni, $profileImage);
        

    } else {
    
        $sql = "SELECT * FROM teacher WHERE email = '$email'";
        $connect = connectDataBase();
        $query = mysqli_query($connect, $sql);

        if ($query == false){
            mysqli_error($connect);
        } else {
            $line = mysqli_fetch_array($query, MYSQL_ASSOC);
            echo '<form action="editTeacher.php" method="post" enctype="multipart/form-data" name="editTeacher">
                <label for="teacherName">Name</label>
                <input type="text" name="teacherName" value="'.$line['name'].'" id="teacherName"><br>
                <label for="teacherLastNames">Last Names</label>
                <input type="text" name="teacherLastNames" value="'.$line['lastNames'].'" id="teacherLastNames"><br>
                <label for="teacherTitle">Title</label>
                <input type="text" name="teacherTitle" value="'.$line['title'].'" id="teacherTitle"><br>
                <label for="teacherPhoto">Photo</label>
                <input type="file" name="teacherPhoto" value='.$line['photo'].' id="teacherPhoto"><br>
                <label for="teacherEmail">Email</label>
                <input type="email" name="teacherEmail" value="'.$line['email'].'" id="teacherEmail"><br>
                <label for="teacherDni">DNI</label>
                <input type="text" name="teacherDni" value="'.$line['dni'].'" id="teacherDni"><br>
                <input type="submit" value="Confirma">';
                echo $line['photo'];
        }
    }?>
</body>
</html>
<?php } ?>