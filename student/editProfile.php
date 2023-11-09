<?php
    session_start();
    include('../funciones.php'); 
    addHeader("../");
    if ($_SESSION['role'] != 'student') {
        logout("../");
    } else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <title>Edit Student</title>
</head>
<body>
    <?php        
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
                $profileImage = uploadPhoto($studentPhoto, $_FILES['studentPhoto']['name'], "../");
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
            $student = mysqli_fetch_array($query);
    ?>
    
        
    <div class="grid-container">
        <div></div>
        <div>
            <div class="popupBackground">
                <div id="popup-edit">
                    <form action="editProfile.php" method="post" enctype="multipart/form-data" name="editProfile">
                            <?php echo '
                            <div>
                                <label for="studentPhoto"><img src=../'.$student['photo'].'></label>
                                <input type="file" name="studentPhoto" id="studentPhoto" value="'.$student['photo'].'">
                                <img src="../src/close.png" id="editClose">
                                </div>
                            <div>
                                <label for="studentName">Name</label>
                            </div>
                            <div>
                                <input type="text" name="studentName" id="studentName" value="'.$student['name'].'" class="textbox">
                            </div>
                            <div>
                                <label for="studentLastNames">Last names</label>
                            </div>
                            <div>
                                <input type="text" name="studentLastNames" id="studentLastNames" value="'.$student['lastNames'].'" class="textbox">
                            </div>
                            <div>
                                <label for="studentDni">DNI</label>
                            </div>
                            <div>
                                <label for="studentAge">Age</label>
                            </div>
                            <div>
                                <input type="text" name="studentDni" id="studentDni" value="'.$student['dni'].'" class="textbox">
                            </div>
                            <div>
                                <input type="text" name="studentAge" id="studentAge" value="'.$student['age'].'" class="textbox">
                            </div>
                            <div>
                                <label for="studentEmail">Email</label>
                            </div>
                            <div>
                                <input type="email" name="studentEmail" id="studentEmail" value="'.$student['email'].'" class="textbox">
                            </div>
                            <div>
                                <label for="studentPassword">Password</label>
                            </div>
                            <div>
                                <input type="password" name="studentPassword" id="studentPassword" class="textbox" readonly>
                            </div>
                            <div id="studentPasswordBtn">Change</div>
                            <div class="buttons" id="editBtns">
                                <input id="cancelBtn" type="reset" value="Cancel">  
                                <input id="confirmBtn" type="submit" value="Confirm">
                            </div>
                            ';?>
                            
                        </form>
                </div>
            </div>
                <script src="../main.js"></script>
        </div>
        <div></div>
    </div>
    <?php }}?>
</body>
</html>