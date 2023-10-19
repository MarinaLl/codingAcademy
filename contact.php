<?php
    session_start();
    include("funciones.php");
    addHeader("");
    if($_POST) {
        $to = "d.duque.dev@gmail.com";
        $completeName = $_POST['name']." ".$_POST['lastNames'];
        $subject = "Coding Academy Contact Email";
        $message = $_POST['message'];
        $additional_headers = "From: ".$completeName." with email: ".$_POST['email'];
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="grid-container">
        <div></div>
        <div>
            <h1 class="pageTitle">Contact</h1>
            <div class="contactContainer">
                <div>
                    <img src="src/contact.png">
                </div>
                <div>
                    <?php
                        createContactForm();
                    ?>
                </div>
            </div>
        </div>
        <div></div>
    </div>
</body>
</html>