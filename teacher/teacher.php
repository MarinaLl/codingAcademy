<?php   
    include('../funciones.php');
    session_start();
    if ($_SESSION['role'] != 'teacher') {
        logout("../");
    } else {
        addHeader("../");
        if(isset($_GET['course'])) {
            include("teacherCourse.php");
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
            <h1>Hello, <?php echo $_SESSION['completeName']; ?></h1>
            <h2>My Courses</h2>
            <div class="wrap">
                <?php showTeacherCourses()?>
            </div>
        </div>
        <div></div>
    </div>
    <?php addFooter("../"); ?>
</body>
</html>
<?php }} ?>