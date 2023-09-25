<?php
session_start();
include("../funciones.php");
if (isset($_SESSION['user'])) {
    loginRedirect($_SESSION['role']);
} else {
    if ($_POST) {
        /*
        $email = $_POST['userEmail'];
        $password = md5($_POST['userPassword']);
        $sql = "
            (SELECT 'admin' AS role, email FROM administrator WHERE email = '$email' AND password = '$password')
            UNION ALL
            (SELECT 'teacher' AS role, email FROM teacher WHERE email = '$email' AND password = '$password')
            UNION ALL
            (SELECT 'student' AS role, email FROM student WHERE email = '$email' AND password = '$password')";

        $connect = connectDataBase();
        $result = $connect->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['user'] = $row['email'];
            $_SESSION['role'] = $row['role'];
            loginRedirect($_SESSION['role']);
            }
        else {
            echo "Correo electrónico o contraseña incorrectos.";
        }

        $conn->close();
        */
    } else { ?>
<!DOCTYPE html>
    <html>
        <head>
            <title>Sign Up</title>
            <link rel="stylesheet" type="text/css" href="login.css">
            <?php addFonts(); ?>
        </head>
        <body>
        <div id="left">
            <div id="image">
                <img src="../src/login.png">
            </div>
        </div>
        <div id="right">
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
                <input type="select" name="userAge" id="userAge"><br>
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
    <?php }
}
?>