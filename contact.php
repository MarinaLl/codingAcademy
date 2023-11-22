<?php
    session_start();
    include("funciones.php");
    addHeader("");
    $emailSent = "hidden";
    if($_POST) {
        $emailSent = "";
        /* Send an email using PHPMailer and MercuryMail Server
        $to = "d.duque.dev@gmail.com";
        $completeName = $_POST['name']." ".$_POST['lastNames'];
        $subject = "Coding Academy Contact Email";
        $message = $_POST['message'];
        $additional_headers = "From: ".$completeName." with email: ".$_POST['email'];
        */
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="grid-container">
        <div></div>
        <div>
            <h1 class="pageTitle">Contact</h1>
            <div class="contactContainer">
                <div>
                    <img src="src/contact.png" alt="">
                </div>
                <div>
                    <?php
                        createContactForm();
                    ?>
                </div>
            </div>
            <?php echo '<h1 id="emailSent" '.$emailSent.'>Your email has been successfully sent.</h1>'?>
        </div>
        <div></div>
    </div>
    <?php addFooter(""); ?>
</body>
</html>