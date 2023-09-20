<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Course</title>
</head>
<body>
    <?php include('funciones.php'); ?>
    <form action="admin.php" method="post">
        <label for="courseName">Course Name</label>
        <input type="text" name="courseName" id="courseName"><br>
        <label for="courseDescription">Description</label>
        <textarea name="courseDescription" id="courseDescription" cols="30" rows="10"></textarea><br>
        <label for="category">Category</label>
        <select name="courseCategory" id="courseCategory" >
            <option value="" default></option>
            <option value="beginner-friendly">Beginner Friendly</option>
            <option value="web-development">Web Development</option>
            <option value="game-developmen">Game Development</option>
            <option value="computer-science">Computer Science</option>
        </select>
        <label for="courseDuration">Duration</label>
        <input type="number" name="courseDuration" id="courseDuration">
        <label for="courseStart">Course Start</label>
        <input type="date" name="courseStart" id="courseStart">
        <label for="courseEnd">Course Start</label>
        <input type="date" name="courseEnd" id="courseEnd">
        <label for="courseTeacher">Teacher</label>
        <select name="courseTeacher" id="courseTeacher">
            <option value="" default></option>
            <?php listTeacherNames(); ?>
        </select>
    </form>
</body>
</html>