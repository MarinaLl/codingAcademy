<?php
    include("funciones.php");
    addHeader("");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
</head>
<body>
    <div class="grid-container">
        <div></div>
        <div class="aboutUsContainer">
            <h1 class="pageTitle">About Us</h1>
            <h2>For developers, by developers</h2>
            <p>At Coding Academy, we are passionate about education and committed to empowering individuals like you to achieve their learning goals. Our mission is to provide accessible, high-quality courses that inspire curiosity, cultivate skills, and open doors to new opportunities.</p>
            <div>
                <div>
                    <img src="src/Rectangle-28.png">
                    <h3><?php echo getActiveCourses();?></h3>
                    <p>Active Courses</p>
                    <div><p>COURSES</p></div>
                </div>
                <div>
                    <img src="src/Rectangle-31.png">
                    <h3><?php echo getActualStudents();?></h3>
                    <p>Actual Students</p>
                    <div><p>STUDENTS</p></div>
                </div>
                <div>
                    <img src="src/Rectangle-34.png">
                    <h3><?php echo getActualTeachers();?></h3>
                    <p>Professional Teachers</p>
                    <div><p>TEACHERS</p></div>
                </div>
            </div>
        </div>
        <div></div>
    </div>
</body>
</html>