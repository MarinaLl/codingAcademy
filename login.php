<?php
include('funciones.php');
session_start();
if (isset($_SESSION['user'])) {
    loginRedirect();
} else {
    $incorrectCredentials = "";
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
                $_SESSION['photo'] = 'src/defaultProfileImage.png';
            } else {
                $_SESSION['photo'] = $row['photo'];
            }
            loginRedirect();
        } else {
            $incorrectCredentials = "Incorrect credentials";
        }

        $connect->close();

    } ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>Log In</title>
            <link rel="stylesheet" href="css/main.css">
            
            <script src="main.js">contest();</script>
        </head>
        <body>
            <div class="loginContainer">
                <div></div>
                <div>
                    <div>
                        <img src="src/codingAcademyLogo2copia.png" alt="codingAcademy">
                    </div>
                    <div>
                        <h1>Log In</h1>
                    </div>
                    <div>
                        <form action="login.php" method="post" enctype="multipart/form-data" name="login">
                            <input type="email" name="userEmail" id="userEmail" placeholder="Email">
                            <input type="password" name="userPassword" id="userPassword" placeholder="Password">
                            <p><?php echo $incorrectCredentials; ?></p>
                            <input type="submit" value="Log In" id="loginBtn">
                        </form>
                    </div>
                    <div>
                        <a id="linkRegister" href="register.php">No account yet? Sign Up now.</a>
                    </div>
                </div>
            </div>
        </body>
    </html>
    <?php }
?>