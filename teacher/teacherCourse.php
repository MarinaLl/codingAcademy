<?php   
    if (!isset($_SESSION['user']) || $_SESSION['role'] != 'teacher') {
        include("../funciones.php");
        logout("../");
    } else {
        if (!isset($_GET['course'])) {
            echo '<meta http-equiv="refresh" content="5;url=teacher.php">';
        } else {
            $courseCode = $_GET['course'];
            $courseName = getCourseName($courseCode);
            if($courseName == null) {
                echo '<meta http-equiv="refresh" content="5;url=teacher.php">';
            } else {
                

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Panel</title>
    <link rel="stylesheet" href="../css/main.css">
    <script src="teacher.js"></script>
</head>
<body>
    <h1>Welcome to, <?php  echo $courseName; ?></h1>
    <p>Teacher: <?php echo $_SESSION['completeName']; ?></p>
    <h2>All Students</h2>
    <?php showAllStudents($courseCode)?>
    <div id="popUpBackground" class="popupBackground">
        <div id="popUp"> 
        </div>
    </div>
</body>
</html>
<?php }}} ?>