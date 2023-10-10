<?php   
    include('../funciones.php');
    session_start();
    if ($_SESSION['role'] != 'teacher') {
        logout("../");
    } else {
        addHeader("../");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <title>Teacher Panel</title>
</head>
<body>
    <div class="grid-container">
        <div></div>
        <div>
            <h1>Hello, <?php echo $_SESSION['completeName']; ?></h1>
            <h2>My Courses</h2>
            <?php showTeacherCourses()?>
        </div>
        <div></div>
    </div>
    
</body>
</html>
<?php } ?>