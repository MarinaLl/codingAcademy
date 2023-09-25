<?php if (isset($path)) { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php addFonts(); ?>
    
    <style>
        *{
            padding: 0;
            margin: 0;
        }
        body{
            font-family: 'Inter', sans-serif;
        }
        header{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            height: 60px;
            border-bottom: 1px solid lightgrey;
        }
        img {
            width: 165px;
            
        }
        a{
            text-decoration: none;
            color: black;
        }
        #nav a{
            margin: auto 20px;
        }
        #nav a:hover, #signUp-btn:hover{
            text-decoration: underline;
            color: #007A78;
        }
        #signUpBtn{
            color:#007A78;
            margin-right: 10px
        }
        #signUpBtn:hover{
            text-decoration: underline;
        }
        #logInBtn{
            padding: 10px 40px;
            background-color: #007A78;
            color: white;
            font-weight: bold;
            border-radius: 10px;
            margin-right: 10px;
        }
        #logInBtn:hover{
            text-decoration: underline;
            color: white;
        }
    </style>
</head>
<body>
    <header id="grid">
        <img src="src/codingAcademyLogo.png" alt="logo">
        <div id="nav">
            <?php
            echo '<a href="'.$path.'index.php">Home</a>
            <a href="'.$path.'courses.php">Courses</a>
            <a href="'.$path.'aboutUs.php">About Us</a>
            <a href="'.$path.'contact.php">Contact</a>';
            ?>
        </div>
        <?php
        if(isset($_SESSION['user'])) {
            echo '<div id="session">
            <a id="profileImageBtn" href="'.$path.$_SESSION['role'].'/'.$_SESSION['role'].'.php"><img src="'.$path.$_SESSION['photo'].'"></a>
            <a id="nameBtn" href="'.$path.$_SESSION['role'].'/'.$_SESSION['role'].'.php">'.$_SESSION['completeName'].'</a>
            </div>';
        } else {
            
            echo '<div id="session">
            <a id="signUpBtn" href="'.$path.'register.php">Sign Up</a>
            <a id="logInBtn" href="'.$path.'login.php">Log In</a>
            </div>';
        }
        ?>
        
    </header>
</body>
</html>
<?php
} else {
    header('Location: index.php');
}?>