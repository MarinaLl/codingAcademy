<!DOCTYPE html>
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
        echo '<input type="number" id="newGrade" name="newGrade" value="'.$_POST['studentGrade'].'" min=0 max=10>';
        ?>
        <button id="cancelEditGrade">Cancel</button>
        <input id="confirmEditGrade" type="submit" value="Confirm">
    </form>
</body>
</html>