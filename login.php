<?php
include('funciones.php');
session_start();
if (isset($_SESSION['user'])) {
    loginRedirect();
} else {
    if ($_POST) {
        
        $email = $_POST['userEmail'];
        $password = md5($_POST['userPassword']);
        $sql = "
            (SELECT 'admin' AS role, email, NULL AS photo, 'Administrator' AS name, '' AS lastNames FROM admin WHERE email = '$email' AND password = '$password')
            UNION ALL
            (SELECT 'teacher' AS role, email, photo, name, lastNames FROM teacher WHERE email = '$email' AND password = '$password')
            UNION ALL
            (SELECT 'student' AS role, email, photo, name, lastNames FROM student WHERE email = '$email' AND password = '$password')";

        $connect = connectDataBase();
        $result = $connect->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['user'] = $row['email'];
            $_SESSION['role'] = $row['role'];
            $completeName = $row['name']." ".$row['lastNames'];
            $_SESSION['completeName'] = $completeName;
            if (is_null($row['photo'])) {
                $_SESSION['photo'] = 'img/defaultProfileImage.png';
            } else {
                $_SESSION['photo'] = $row['photo'];
            }
            loginRedirect();
        } else {
            echo "Correo electrónico o contraseña incorrectos.";
        }

        $connect->close();

    } else { ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>Log In</title>
            <link rel="stylesheet" href="css/main.css">
            
        </head>
        <body>
            <div id="loginContainer">
                <div></div>
                <div>
                    <img id="logo" src="src/codingAcademyLogo2.png" alt="codingAcademy">
                    <h1>Log In</h1>
                    <form action="login.php" method="post" enctype="multipart/form-data" name="login">
                        <input type="email" name="userEmail" id="userEmail" placeholder="Email">
                        <input type="password" name="userPassword" id="userPassword" placeholder="Password">
                        <input type="submit" value="Log In" id="loginBtn">
                    </form>
                    <a id="linkRegister" href="register.php">No account yet? Sign Up now.</a>
                </div>
            </div>
        </body>
    </html>
    <?php }
}
?>