<?php   
    include('../funciones.php');
    session_start();
    if ($_SESSION['role'] != 'teacher') {
        logout("../");
    } else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Panel</title>
</head>
<body>
    <h1>Hello, <?php echo $_SESSION['completeName']; ?></h1>
    <h2>My Courses</h2>
    <?php showTeacherCourses()?>
</body>
</html>
<?php } ?>