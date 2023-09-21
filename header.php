<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Document</title>
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
        #signUp-btn{
            color:#007A78;
            margin-right: 10px
        }
        #logIn-btn{
            padding: 10px 40px;
            background-color: #007A78;
            color: white;
            font-weight: bold;
            border-radius: 10px;
            margin-right: 10px;
        }
        #logIn-btn:hover-bottom{
            text-decoration: underline;
            color: white;
        }
    </style>
</head>
<body>
    <header id="grid">
        <img src="src/codingAcademyLogo.png" alt="logo">
        <div id="nav">
            <a href="index.php">Home</a>
            <a href="courses.php">Courses</a>
            <a href="aboutUs.php">About Us</a>
            <a href="contact.php">Contact</a>
        </div>
        <div id="session">
            <a id="signUp-btn" href="">Sign Up</a>
            <a id="logIn-btn" href="">Log In</a>
        </div>
    </header>
</body>
</html>