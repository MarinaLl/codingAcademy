<?php
    session_start();
    include('../funciones.php');
    addHeader('../');
    if ($_SESSION['role'] != 'admin') {
        logout("../");
    } else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <title>Edit Teacher</title>
</head>
<body>
    <?php
    $email = $_SESSION['email'];
    $connect = connectDataBase();
    if($_POST){
            $teacherName = $_POST['teacherName'];
            $teacherLastNames = $_POST['teacherLastNames'];
            $teacherTitle = $_POST['teacherTitle'];
            $teacherEmail = $_POST['teacherEmail'];
            $teacherPhoto = $_FILES['teacherPhoto']['tmp_name'];
            
            if ($teacherPhoto == null){
                $sql = "SELECT photo FROM teacher WHERE email = '$email'";

                

                $query = mysqli_query($connect, $sql);

                $line = mysqli_fetch_array($query);

                $profileImage = $line[0];
                
            }else {
                $profileImage = uploadPhoto($teacherPhoto, $_FILES['teacherPhoto']['name'], "../");
            }

            $teacherDni = $_POST['teacherDni'];

            editTeacher($email, $teacherEmail, $teacherName, $teacherLastNames, $teacherTitle, $teacherDni, $profileImage);
            echo '<meta http-equiv="refresh" content="0;url=admin.php">';

    } else {
    ?>
    <div class="grid-container">
        <div></div>
        <div>
            <div class="popupBackground">
                <div id="popup">
                    <h4 class="popup-title">Edit Teacher</h4>
                    <?php editTeacherForm($email); ?>
                </div>
            </div>
        </div>
        <div></div>
    </div>
    
    <?php }}?>
</body>
</html>