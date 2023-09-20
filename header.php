<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            padding: 0;
            margin: 0;
        }
        header{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            height: 60px;
            border: 1px solid black;
        }
        img {
            width: 165px;
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <header id="grid">
        <img src="src/codingAcademyLogo.png" alt="logo">
        <div id="nav">
            <a href="">Home</a>
            <a href="">Courses</a>
            <a href="">About Us</a>
            <a href="">Contact</a>
        </div>
        <div id="session">
            <a href="">Sign Up</a>
            <a href="">Log In</a>
        </div>
    </header>
</body>
</html>