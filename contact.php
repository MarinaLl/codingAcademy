<?php
    session_start();
    include("funciones.php");
    addHeader("");
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
            <h1>CONTACT</h1>
            <img src="src/contact.png">
            <?php
                createContactForm();
            ?>
        </div>
        <div></div>
    </div>
</body>
</html>