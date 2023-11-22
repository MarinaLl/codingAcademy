<?php
    if (!isset($_SESSION)) {
        session_start();
    } 

    include('../funciones.php');
    if ($_SESSION['role'] != 'admin') {
        logout("../");
    } else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Teacher</title>
    <link rel="stylesheet" href="../css/main.css">
    <script src="admin.js"></script>
</head>
<body>
    
    <?php
        if($_POST){
            
                $teacherName = $_POST['teacherName'];
                $teacherLastNames = $_POST['teacherLastNames'];
                $teacherTitle = $_POST['teacherTitle'];
                $teacherEmail = $_POST['teacherEmail'];
                $teacherPasswd = $_POST['teacherPass'];
                $teacherPhoto = $_FILES['teacherPhoto']['tmp_name'];
                $teacherDni = $_POST['teacherDni'];
                $teacherPasswd = md5($teacherPasswd);

                if(checkDNI($teacherDni)){
                    $profileImage = uploadPhoto($teacherPhoto, $_FILES['teacherPhoto']['name'], "../");
        
        
                    createNewTeacher($teacherEmail, $teacherPasswd, $teacherName, $teacherLastNames, $teacherTitle, $profileImage, $teacherDni);
                    echo '<meta http-equiv="refresh" content="0;url=admin.php">';

                } else {
                    echo "<script>alert('dni no valido');</script>";
                }

        } else {
    ?>
    
            <h1 class="popup-title">Add new teacher</h1>
            <form action="createTeacher.php" method="post" enctype="multipart/form-data" name="createTeacher">
                
                    <div>
                        <label for="teacherName">Name</label>
                    </div>
                    <div>
                        <label for="teacherLastNames">Last names</label>
                    </div>
                    <div>
                        <label for="teacherDni">DNI</label>
                    </div>
                    <div>
                        <input type="text" name="teacherName" id="teacherName" class="textbox" required>
                    </div>
                    <div>
                        <input type="text" name="teacherLastNames" id="teacherLastNames" class="textbox" required>
                    </div>
                    <div>
                        <input type="text" name="teacherDni" id="teacherDni" class="textbox" required>
                    </div>
                    <div>
                        <label for="teacherTitle">Title</label>
                    </div>
                    <div>
                        <input type="text" name="teacherTitle" id="teacherTitle" class="textbox" required>
                    </div>
                    <div>
                        <label for="teacherPhotoText">Photo</label>
                    </div>
                    <div>
                        <input type="text" name="teacherPhotoText" id="teacherPhotoText" class="textbox" readonly>
                        <label for="teacherPhoto" id="teacherPhotoBtn">Browse</label>
                        <input type="file" name="teacherPhoto" id="teacherPhoto" required>
                    </div>
                    <div>
                        <label for="teacherEmail">Email</label>
                    </div>
                    <div>
                        <label for="teacherPass">Password</label>
                    </div>
                    <div>
                        <input type="email" name="teacherEmail" id="teacherEmail" class="textbox" required>
                    </div>
                    <div>
                        <input type="password" name="teacherPass" id="teacherPass" class="textbox" required>
                    </div>
                    <div>
                        <input id="confirmBtn" type="submit" value="Confirm">
                        <input id="cancelBtn" type="reset" value="Cancel">  
                    </div>
                    
                
                    
            </form>
            
    <?php }}?>
</body>
</html>