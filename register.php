<?php
include("funciones.php");
session_start();
if (isset($_SESSION['user'])) {
    loginRedirect();
} else {
    ?>
<!DOCTYPE html>
    <html>
        <head>
            <title>Sign Up</title>
            <!-- <link rel="stylesheet" type="text/css" href="login.css"> -->
            <?php addFonts(); ?>
        </head>
        <body>
        <div>
            <div id="image">
                <img src="../src/login.png">
            </div>
        </div>
        <div id="right">
            <?php 
                if ($_POST){
                    $username = $_POST['userName'];
                    $userLastNames = $_POST['userLastnames'];
                    $userDni = $_POST['userDni'];
                    $userAge = $_POST['userAge'];
                    $userPhoto = $_FILES['userPhoto']['tmp_name'];
                    $userEmail = $_POST['userEmail'];
                    $userPass = md5($_POST['userPassword']);

                    $_SESSION['username'] = $username;

                    $photo = uploadPhoto($userPhoto, $_FILES['userPhoto']['name'], "");
                    if (checkDNI($userDni) && !isEmailUsed($userEmail)) {
                        addNewUser($username, $userLastNames, $userDni, $userAge, $photo, $userEmail, $userPass);
                        # Añadir Pop Up Concurso
                        echo '<meta http-equiv="refresh" content="0;url=login.php">';
                    } else {
                        # Añadir mensaje de que el dni no es valido o ya esta en uso
                    }
                    
                } else {
            ?>
            <img id="logo" src="../src/codingAcademyLogo2.png" alt="codingAcademy">
            <h1>Sign Up</h1>
            <form action="register.php" method="post" enctype="multipart/form-data" name="register">
                <label for="userName">Name</label>
                <input type="text" name="userName" id="userName"><br>
                <label for="userLastnames">Last Names</label>
                <input type="text" name="userLastnames" id="userLastnames"><br>
                <label for="userDni">DNI</label>
                <input type="text" name="userDni" id="userDni"><br>
                <label for="userAge">Age</label>
                <input type="text" name="userAge" id="userAge"><br>
                <label for="userPhoto">Photo</label>
                <input type="file" name="userPhoto" id="userPhoto"><br>
                <label for="userEmail">Email</label>
                <input type="email" name="userEmail" id="userEmail"><br>
                <label for="userPassword">Password</label>
                <input type="password" name="userPassword" id="userPassword">
                <input type="submit" value="Sign Up" id="registerBtn">
            </form>
            <a id="linkLogin" href="login.php">I already have an account.</a>
        </div>
        </body>
    </html>
    <?php 
                }
}
?>