<?php /*
    if(!isset($student)) {
        include("../funciones.php");
        changeStudentsGrade($_POST['studentEmail'], $_POST['studentGrade']);
    }*/
    if(isset($_GET['student']) && isset($_GET['grade'])) {
        $studentEmail = $_GET['student'];
        $studentGrade = $_GET['grade'];
    }
?><!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body>
    <form action="teacherEditGrade.php" method="post" name="studentsGrade">
        <h1>Edit Grade:</h1>
        <?php
        
        echo '<input type="number" id="newGrade" name="newGrade" value="'.$studentGrade.'" min=0 max=10>
                <input type="hidden" name="studentEmail" value="'.$studentEmail.'">';
        ?>
        <button id="cancelEditGrade">Cancel</button>
        <input id="confirmEditGrade" type="submit" value="Confirm">
    </form>
</body>
</html>