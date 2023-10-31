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
                        echo "Email usado o DNI no valido";
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
                            <div><input type="text" name="userName" id="userName" placeholder="Name"></div>
                            <div><input type="text" name="userLastnames" id="userLastnames" placeholder="Last Names"></div>
                            <div><label for="userDni">DNI</label></div>
                            <div><label for="userAge">Age</label></div>
                            <div><label for="userPhoto">Photo</label></div>
                            <div><input type="text" name="userDni" id="userDni" placeholder="DNI"></div>
                            <div><input type="text" name="userAge" id="userAge" placeholder="Age"></div>
                            <div><input type="file" name="userPhoto" id="userPhoto"></div>
                            <div><label for="userEmail">Email</label></div>
                            <div><input type="email" name="userEmail" id="userEmail" placeholder="Email"></div>
                            <div><label for="userPassword">Password</label></div>
                            <div><input type="password" name="userPassword" id="userPassword" placeholder="Password"></div>
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