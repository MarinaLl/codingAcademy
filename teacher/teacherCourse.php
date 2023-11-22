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
                //echo $courseCode;
                $formatCourseCode = explode("?", $courseCode);
                //echo $formatCourseCode[0];
                $courseName = getCourseName($formatCourseCode[0]);
                if($courseName == null) {
                    echo '<meta http-equiv="refresh" content="0;url=teacher.php">';
                } else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/main.css">
    <script src="../main.js"></script>
</head>
<body>
    <div class="grid-container">
        <div></div>
        <div>
            <h1>Welcome to, <?php  echo $courseName; ?></h1>
            <p>Teacher: <?php echo $_SESSION['completeName']; ?></p>
            <h2>All Students</h2>
            <?php showAllStudents($courseCode)?>
        </div>
        <div></div>
    </div>
    <?php addFooter("../"); ?>
</body>
</html>
<?php }}}} ?>