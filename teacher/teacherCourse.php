<?php   
    include('../funciones.php');
    session_start();
    if ($_SESSION['role'] != 'teacher') {
        logout("../");
    } else {
        if (!$_POST) {
            echo '<meta http-equiv="refresh" content="0;url=teacher.php">';
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Panel</title>
</head>
<body>
    <h1>Welcome to, <?php  echo $_POST['courseName']?></h1>
    <p>Teacher: <?php echo $_SESSION['completeName']; ?></p>
    <h2>All Students</h2>
    <?php showAllStudents($_POST['buttonCourse'])?>
</body>
</html>
<?php } ?>