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
            <link rel="stylesheet" href="css/main.css">
        </head>
        <body>
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
            <div class="loginContainer">
                <div></div>
                <div>
                    <img src="src/codingAcademyLogo2copia.png" alt="codingAcademy">
                    <h1>Sign Up</h1>
                    <form action="register.php" method="post" enctype="multipart/form-data" name="register">
                        <label for="userName">Name</label>
                        <label for="userLastnames">Last Names</label>
                        <input type="text" name="userName" id="userName">
                        <input type="text" name="userLastnames" id="userLastnames">
                        <label for="userDni">DNI</label>
                        <label for="userAge">Age</label>
                        <label for="userPhoto">Photo</label>
                        <input type="text" name="userDni" id="userDni">
                        <input type="text" name="userAge" id="userAge">
                        <input type="file" name="userPhoto" id="userPhoto">
                        <label for="userEmail">Email</label>
                        <label for="userPassword">Password</label>
                        <input type="email" name="userEmail" id="userEmail">
                        <input type="password" name="userPassword" id="userPassword">
                        <input type="submit" value="Sign Up" id="registerBtn">
                    </form>
                    <a id="linkLogin" href="login.php">I already have an account.</a>
                </div>
            </div>
    <?php 
                }
}
?>
        </body>
    </html>