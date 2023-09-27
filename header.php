<?php if (isset($path)) { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php addFonts(); ?>
    
    <style>
        /**/
        *{
            padding: 0;
            margin: 0;
        }
        /**/
        body{
            font-family: 'Inter', sans-serif;
        }
        /**/
        header{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            height: 60px;
            border-bottom: 1px solid lightgrey;
        }
        /**/
        #logo {
            width: 165px;
            
        }
        a{
            text-decoration: none;
            color: black;
        }
        /**/
        #nav {
            width: 100%;
            height: fit-content;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
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
        #profileImageBtn img{
            width: 50px;
            margin-right: -40px;   
        }
        #links, #session{
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>
    <header>
        <?php 
            echo '
            <div id="nav">
                <img id="logo" src="'.$path.'src/codingAcademyLogo.png" alt="logo">
                <div id="links">
                    <a href="'.$path.'index.php">Home</a>
                    <a href="'.$path.'courses.php">Courses</a>
                    <a href="'.$path.'aboutUs.php">About Us</a>
                    <a href="'.$path.'contact.php">Contact</a>
                </div>';
                echo '<div id="session">';
                    if(isset($_SESSION['user'])) {
                        echo '
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
        
        <?php
        ?>
        
    </header>
</body>
</html>
<?php
} else {
    header('Location: index.php');
}?>