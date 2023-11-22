<?php 
    session_start();
    include('funciones.php');
    if(isset($_SESSION['user'])) {
        loginRedirect();
    } else {
        addHeader("");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div id="slider-container"> 
        <div id="slider">
            <div class="slide" id="slider-1">
                <h2>Python Essentials</h2>
                <p>
                Learn Python’s core concepts, code real projects, and prepare for a tech- driven future with expert guidance.
                </p>
                <button><a href="register.php">Start today</a></button>
                <!-- <img src="src/Python-Banner-2.png" alt="Imagen 1"> -->
            </div>
            <div class="slide" id="slider-2">
                <h2>Mastering Terminal Commands</h2>
                <p>
                Dive into the world of command-line mastery with our comprehensive course. Learn essential terminal commands, streamline tasks, and elevate your efficiency in a command-line environment.
                </p>
                <button><a href="register.php">Start today</a></button>
                <!-- <img src="src/Terminal-Banner-2.png" alt="Imagen 2"> -->
            </div>
            <div class="slide" id="slider-3">
                <h2>Make your own website</h2>
                <p>
                Learn to use HTML, CSS and JavaScript
                </p>
                <button><a href="register.php">Start today</a></button>
                <!-- <img src="src/HTMLCSSJS-Banner-2.png" alt="Imagen 3"> -->
            </div>
             <!-- Agrega más imágenes según sea necesario  -->
        </div>
        
    </div>
   
    <div id="prev">&#10094;</div>
    <div id="next">&#10095;</div>
    
    <div id="indicator-container"></div>
    <div class="grid-container">
        <div></div>
        <div>
            <div id="testimonials">
                    <h4>TESTIMONIALS</h4>
                    <h5>STUDENTS REVIEWS</h5>
                    <div>
                        <div>
                            <div><img src="src/gato.webp" alt="Student"></div>
                            <div><h6>Marina Llambrich</h6></div>
                            <div><p>"The programming courses on this online platform are absolutely exceptional! Since I enrolled, my professional life has undergone an incredible transformation. The instructors are extremely knowledgeable and passionate about their subjects, which is reflected in the quality of the lessons."</p></div>
                        </div>
                        <div>
                            <div><img src="src/Gurrera.png" alt="Student"></div>
                            <div><h6>Joel Gurrera</h6></div>
                            <div><p>"The lessons are logically structured, making learning a breeze, especially for someone like me with no prior programming experience. Moreover, the platform is very user-friendly and easy to navigate, making finding and accessing course materials a straightforward task."</p></div>
                        </div>
                        <div>
                            <div><img src="src/Ellipse.png" alt="Student"></div>
                            <div><h6>Iker Gonzalez</h6></div>
                            <div><p>"The course content is comprehensive and up-to-date, allowing me to learn the latest technologies and programming languages. I also appreciate the flexibility of being able to study at my own pace, which has been crucial in balancing my studies with my full-time job."</p></div>
                        </div>
                        <div>
                            <div><img src="src/Ellipse.png" alt="Student"></div>
                            <div><h6>Iker Gonzalez</h6></div>
                            <div><p>"In summary, if you're looking for an online learning platform to study programming, look no further! This platform is the perfect choice. The results speak for themselves, and I'm thrilled with everything I've learned so far. I can't wait to continue advancing in my career thanks to these exceptional courses!"</p></div>
                        </div>
                    </div>
                </div>
        </div>
        <div></div>
    </div>
    
    <?php addFooter(""); } ?>
    
    <script src="main.js"></script>

</body>
</html>