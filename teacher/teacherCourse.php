<?php   
    if($_POST) {
        include("../funciones.php");
        updateNotes($_POST['studentGrades'], $_POST['editGradesBtn']);
    } else {
        if (!isset($_SESSION['user']) || $_SESSION['role'] != 'teacher') {
            logout("../");
        } else {
            if (!isset($_GET['course'])) {
                echo '<meta http-equiv="refresh" content="0;url=teacher.php">';
            } else {
                $courseCode = $_GET['course'];
                echo $courseCode;
                $formatCourseCode = explode("?", $courseCode);
                echo $formatCourseCode[0];
                $courseName = getCourseName($formatCourseCode[0]);
                if($courseName == null) {
                    echo '<meta http-equiv="refresh" content="0;url=teacher.php">';
                } else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Panel</title>
    <link rel="stylesheet" href="../css/main.css">
    <script src="../main.js"></script>
</head>
<body>
    <h1>Welcome to, <?php  echo $courseName; ?></h1>
    <p>Teacher: <?php echo $_SESSION['completeName']; ?></p>
    <h2>All Students</h2>
    <?php showAllStudents($courseCode)?>
</body>
</html>
<?php }}}} ?>