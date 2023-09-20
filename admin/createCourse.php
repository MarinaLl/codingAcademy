<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Course</title>
</head>
<body>
    <?php include('funciones.php');
        if ($_POST){
            $courseName = $_POST['courseName'];
            $courseDescription = $_POST['courseDescription'];
            $category = $_POST['courseCategory'];
            $courseDuration = $_POST['courseDuration'];
            $courseStart = $_POST['courseStart'];
            $courseEnd = $_POST['courseEnd'];
            $courseTeacher = $_POST['courseTeacher'];
            $courseImage = $_FILES['coursePhoto']['tmp_name'];

            $image = uploadPhoto($courseImage, $_FILES['coursePhoto']['name']);

            createNewCourse($courseName, $courseDescription, $category, $courseDuration, $courseStart, $courseEnd, $courseTeacher, $image);
            
        } else {
    ?>
    <form action="createCourse.php" method="post" enctype="multipart/form-data">
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
        </select><br>
        <label for="courseDuration">Duration</label>
        <input type="number" name="courseDuration" id="courseDuration"><br>
        <label for="courseStart">Course Start</label>
        <input type="date" name="courseStart" id="courseStart"><br>
        <label for="courseEnd">Course Start</label>
        <input type="date" name="courseEnd" id="courseEnd"><br>
        <label for="courseTeacher">Teacher</label>
        <select name="courseTeacher" id="courseTeacher">
            <option value="" default></option>
            <?php listTeacherNames(); ?>
        </select><br>
        <label for="coursePhoto">Photo</label>
        <input type="file" name="coursePhoto" id="coursePhoto">
        <input type="submit" value="Confirm">
    </form>
    <?php }?>
</body>
</html>