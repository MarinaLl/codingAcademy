<?php if (isset($path)) { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <?php echo '<link rel="stylesheet" href="'.$path.'css/main.css">'?>
</head>
<body>
    <footer class="grid-container">
        <div></div>
        <?php 
            echo '
            <div>
                <div>
                    <a href="'.$path.'index.php">Home</a>
                    <a href="'.$path.'student/courses.php">Courses</a>
                    <a href="'.$path.'aboutUs.php">About Us</a>
                    <a href="'.$path.'contact.php">Contact</a>
                </div>
                <div>
                    <a href="https://www.youtube.com/"><img id="logo" src="'.$path.'src/youtube.png" alt="youtube"></a>
                    <a href="https://www.facebook.com/"><img id="logo" src="'.$path.'src/facebook.png" alt="facebook"></a>
                    <a href="https://www.instagram.com/"><img id="logo" src="'.$path.'src/instagram.png" alt="instagram"></a>
                    <a href="http://x.com/"><img id="logo" src="'.$path.'src/twitter.png" alt="twitter"></a>
                </div> 
            </div>';
            ?>
        <div></div>
    </footer>
</body>
</html>
<?php
} else {
    echo '<meta http-equiv="refresh" content="0;url=index.php">';
}?>