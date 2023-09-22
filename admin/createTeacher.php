<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="createTeacher.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
    <?php
        include('../funciones.php');
        if($_POST){
            
                $teacherName = $_POST['teacherName'];
                $teacherLastNames = $_POST['teacherLastNames'];
                $teacherTitle = $_POST['teacherTitle'];
                $teacherEmail = $_POST['teacherEmail'];
                $teacherPasswd = $_POST['teacherPass'];
                $teacherPhoto = $_FILES['teacherPhoto']['tmp_name'];
                $teacherDni = $_POST['teacherDni'];
                $teacherPasswd = md5($teacherPasswd);

                

                $profileImage = uploadPhoto($teacherPhoto, $_FILES['teacherPhoto']['name']);
    
                connectDataBase();
    
                createNewTeacher($teacherEmail, $teacherPasswd, $teacherName, $teacherLastNames, $teacherTitle, $profileImage, $teacherDni);
                echo '<meta http-equiv="refresh" content="0;url=admin.php">';
            

        } else {
    ?>
    <div class="pop-up-background">
        <div id="createTeacherPopUp">
            <h1>Add new teacher</h1>
            <form action="createTeacher.php" method="post" enctype="multipart/form-data" name="createTeacher">
                <div class="grid-container">
                    <div class="name">
                        <label for="teacherName">Name</label><br>
                        <input type="text" name="teacherName" id="teacherName" class="textbox">
                    </div>
                    <div class="lastnames">
                        <label for="teacherLastNames">Last names</label><br>
                        <input type="text" name="teacherLastNames" id="teacherLastNames" class="textbox">
                    </div>
                    <div class="dni">
                        <label for="teacherDni">DNI</label><br>
                        <input type="text" name="teacherDni" id="teacherDni" class="textbox">
                    </div>
                
                    <div class="title">
                        <label for="teacherTitle">Title</label><br>
                        <input type="text" name="teacherTitle" id="teacherTitle" class="textbox">
                    </div>
                    <div class="photo">
                        <label for="teacherPhotoText">Photo</label><br>
                        <input type="text" name="teacherPhotoText" id="teacherPhotoText" class="textbox" disabled>
                        <label for="teacherPhoto" id="teacherPhotoBtn">Browse</label>
                        <input type="file" name="teacherPhoto" id="teacherPhoto">
                    </div>
                    <div class="email">
                        <label for="teacherEmail">Email</label><br>
                        <input type="email" name="teacherEmail" id="teacherEmail" class="textbox">
                    </div>
                    <div class="password">
                        <label for="teacherPass">Password</label><br>
                        <input type="password" name="teacherPass" id="teacherPass" class="textbox">
                    </div>
                    <div class="buttons">
                        <input id="confirmBtn" type="submit" value="Confirm">
                        <input id="cancelBtn" type="reset" value="Cancel">  
                    </div>
                    
                </div>
                    
            </form>
        </div>
    </div>
    
    <?php }?>
</body>
</html>