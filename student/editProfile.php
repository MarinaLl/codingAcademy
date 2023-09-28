<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php
        session_start();
        include('../funciones.php'); addFonts();
        if($_POST){

            
            $studentName = $_POST['studentName'];
            
            $studentLastNames = $_POST['studentLastNames'];
            $studentDni = $_POST['studentDni'];
            $studentEmail = $_POST['studentEmail'];
            $studentPassword = $_POST['studentPassword'];
            $studentPhoto = $_FILES['studentPhoto']['tmp_name'];
            $studentAge = $_POST['studentAge'];

            $changePassword = "";
            if ($studentPassword != "") {
                $studentPassword = md5($studentPassword);
                $changePassword = "password = '$studentPassword',";
            }

            $changePhoto = "";
            if ($studentPhoto != "") {
                $profileImage = uploadPhoto($studentPhoto, $_FILES['studentPhoto']['name']);
                $changePhoto = "photo = '$profileImage',";  
            }
            
            $changeDni = "";
            if(checkDNI($studentDni)){
                $changeDni = "dni = '$studentDni',";
            }
                    
            editProfile($studentName, $studentLastNames, $changeDni, $studentEmail, $changePhoto, $studentAge, $changePassword);
            
            echo '<meta http-equiv="refresh" content="0;url=student.php">';

        } else {
            $sql = "SELECT * FROM student WHERE email = '".$_SESSION['user']."'";
            $connectSelectInfoStudent = connectDataBase();
            $query = mysqli_query($connectSelectInfoStudent, $sql);
            $student = mysqli_fetch_row($query);
    ?>
    
        
            <h1>Edit profile</h1>
            <form action="editProfile.php" method="post" enctype="multipart/form-data" name="editProfile">
                <div class="grid-container">
                    <?php echo '
                    <div class="photo">
                        <label for="studentPhoto"><img src=../'.$student[6].'></label>
                        <input type="file" name="studentPhoto" id="studentPhoto" value="'.$student[3].'">
                    </div>
                    <div class="name">
                        <label for="studentName">Name</label><br>
                        <input type="text" name="studentName" id="studentName" value="'.$student[3].'" class="textbox">
                    </div>
                    <div class="lastnames">
                        <label for="studentLastNames">Last names</label><br>
                        <input type="text" name="studentLastNames" id="studentLastNames" value="'.$student[4].'" class="textbox">
                    </div>
                    <div class="dni">
                        <label for="studentDni">DNI</label><br>
                        <input type="text" name="studentDni" id="studentDni" value="'.$student[2].'" class="textbox">
                    </div>
                    <div class="age">
                        <label for="studentAge">Age</label><br>
                        <input type="text" name="studentAge" id="studentAge" value="'.$student[5].'" class="textbox">
                    </div>
                    <div class="email">
                        <label for="studentEmail">Email</label><br>
                        <input type="email" name="studentEmail" id="studentEmail" value="'.$student[0].'" class="textbox">
                    </div>
                    <div class="password">
                        <label for="studentPassword">Password</label><br>
                        <input type="password" name="studentPassword" id="studentPassword" class="textbox" readonly>
                        <div id="studentPasswordBtn">Change</div>
                    </div>
                    <div class="buttons">
                        <input id="cancelBtn" type="reset" value="Cancel">  
                        <input id="confirmBtn" type="submit" value="Confirm">
                    </div>
                    ';?>
                </div>
                    
            </form>
            <script src="../main.js"></script>
    <?php }?>
</body>
</html>