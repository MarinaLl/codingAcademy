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
            <link rel="icon" href="src/codingAcademyLogo2copia.png">
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
                        echo "Email already in use or invalid DNI";
                        # Añadir mensaje de que el dni no es valido o ya esta en uso
                    }
                } else {
            ?>
            <div class="loginContainer">
                <div></div>
                <div  id="register">
                    <div>
                        <img src="src/codingAcademyLogo2copia.png" alt="codingAcademy">
                    </div>
                    <div>
                        <h1>Sign Up</h1>
                    </div>
                    <div>
                    <form action="register.php" method="post" enctype="multipart/form-data" name="register">
                            <div><label for="userName">Name</label></div>
                            <div><label for="userLastnames">Last Names</label></div>
                            <div><input type="text" name="userName" id="userName" required></div>
                            <div><input type="text" name="userLastnames" id="userLastnames" required></div>
                            <div><label for="userDni">DNI</label></div>
                            <div><label for="userAge">Age</label></div>
                            <div><label for="userPhoto">Photo</label></div>
                            <div><input type="text" name="userDni" id="userDni" required></div>
                            <div><input type="text" name="userAge" id="userAge" required></div>
                            <div>
                                <input type="file" name="userPhoto" id="userPhoto">
                                <label for="userPhoto" id="fileLabel">Browse</label>
                            </div>
                            <div><label for="userEmail">Email</label></div>
                            <div><input type="email" name="userEmail" id="userEmail" required></div>
                            <div><label for="userPassword">Password</label></div>
                            <div><input type="password" name="userPassword" id="userPassword" required></div>
                            <div><input type="submit" value="Sign Up" id="registerBtn"></div>
                        </form>
                    </div>
                    <div>
                        <a id="linkLogin" href="login.php">I already have an account.</a>
                    </div>
                </div>
            </div>
    <?php 
                }
}
?>
        </body>
    </html>