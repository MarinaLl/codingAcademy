<?php if (isset($path)) { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coding Academy</title>
    <?php echo '<link rel="icon" href="'.$path.'src/codingAcademyLogo2copia.png">';?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <?php echo '<link rel="stylesheet" href="'.$path.'css/main.css">'?>
</head>
<body>
    <header>
        <?php 
            echo '
            <div>
                <img id="logo" src="'.$path.'src/codingAcademyLogo.png" alt="logo">
                <div id="links">
                    <a href="'.$path.'index.php">Home</a>
                    <a href="'.$path.'student/courses.php">Courses</a>
                    <a href="'.$path.'aboutUs.php">About Us</a>
                    <a href="'.$path.'contact.php">Contact</a>
                </div>';
                echo '<div>';
                    if(isset($_SESSION['user'])) {
                        echo '
                        <a href="'.$path.'logout.php" id="logout">Log out</a>
                        <a id="profileImageBtn" href="'.$path.$_SESSION['role'].'/'.$_SESSION['role'].'.php"><img src="'.$path.$_SESSION['photo'].'"></a>
                        <a id="nameBtn" href="'.$path.$_SESSION['role'].'/'.$_SESSION['role'].'.php">'.$_SESSION['completeName'].'</a>
                        ';
                    } else {
                        echo '
                        <a id="signUpBtn" href="'.$path.'register.php">Sign Up</a>
                        <a id="logInBtn" href="'.$path.'login.php">Log In</a>
                        ';
                    }
                echo "</div>";
            echo "</div>";
            ?>
    </header>
</body>
</html>
<?php
} else {
    echo '<meta http-equiv="refresh" content="0;url=index.php">';
}?>