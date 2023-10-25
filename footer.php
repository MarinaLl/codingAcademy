<?php if (isset($path)) { ?>
<!DOCTYPE html>
<html lang="en">
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
                    <a href="https://www.youtube.com/"><img src="'.$path.'src/youtube.png" alt="youtube"></a>
                    <a href="https://www.facebook.com/"><img src="'.$path.'src/facebook.png" alt="facebook"></a>
                    <a href="https://www.instagram.com/"><img src="'.$path.'src/instagram.png" alt="instagram"></a>
                    <a href="http://x.com/"><img src="'.$path.'src/twitter.png" alt="twitter"></a>
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