<?php
session_start();
include('funciones.php');
if (isset($_SESSION['user'])) {
    loginRedirect($_SESSION['role']);
} else {
    if ($_POST) {
        
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

    } else { ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>Log In</title>
            <link rel="stylesheet" type="text/css" href="login.css">
            <?php addFonts(); ?>
        </head>
        <body>
        <div id="left">
            <div id="image">
                <img src="src/login.png">
            </div>
        </div>
        <div id="right">
            <img id="logo" src="src/codingAcademyLogo2.png" alt="codingAcademy">
            <h1>Log In</h1>
            <form action="login.php" method="post" enctype="multipart/form-data" name="login">
                <input type="email" name="userEmail" id="userEmail" placeholder="Email"><br>
                <input type="password" name="userPassword" id="userPassword" placeholder="Password">
                <input type="submit" value="Log In" id="loginBtn">
            </form>
            <a id="linkRegister" href="student/register.php">No account yet? Sign Up now.</a>
        </div>
        </body>
    </html>
    <?php }
}
?>