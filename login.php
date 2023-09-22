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
        <form action="login.php" method="post" enctype="multipart/form-data" name="login">
        <label for="userEmail">Email</label>
        <input type="email" name="userEmail" id="userEmail"><br>
        <label for="userPassword">Password</label>
        <input type="password" name="userPassword" id="userPassword">
        <input type="submit" value="Log In">
    </form>
    <?php }
}
?>