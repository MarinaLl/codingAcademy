<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <title>Create New Course</title>
</head>
<body>
    <?php include('../funciones.php');
        if ($_POST){
            $courseName = $_POST['courseName'];
            $courseDescription = $_POST['courseDescription'];
            $category = $_POST['courseCategory'];
            $courseDuration = $_POST['courseDuration'];
            $courseDifficulty = $_POST['difficulty'];
            $courseStart = $_POST['courseStart'];
            $courseEnd = $_POST['courseEnd'];
            $courseTeacher = $_POST['courseTeacher'];
            $courseImage = $_FILES['coursePhoto']['tmp_name'];

            $image = uploadPhoto($courseImage, $_FILES['coursePhoto']['name'], "../");

            createNewCourse($courseName, $courseDescription, $category, $courseDuration, $courseStart, $courseEnd, $courseTeacher, $image, $courseDifficulty);
            
        } else {
    ?>
    <h1 class="popup-title">Create New Course</h1>
    <form action="createCourse.php" method="post" enctype="multipart/form-data">
        <div class="popup-container-course">
            <div>
                <label for="courseName">Course Name</label>
                <input type="text" name="courseName" id="courseName">
            </div>
            <div>
                <label for="category">Category</label>
                <select name="courseCategory" id="courseCategory" >
                    <option value="" default></option>
                    <option value="beginner-friendly">Beginner Friendly</option>
                    <option value="web-development">Web Development</option>
                    <option value="game-developmen">Game Development</option>
                    <option value="computer-science">Computer Science</option>
                </select>
            </div>
            <div>
                <label for="difficulty">Difficulty</label>
                <select name="difficulty" id="difficulty">
                    <option value="" default></option>
                    <option value="beginner-friendly">Beginner Friendly</option>
                    <option value="intermediate">Intermediate</option>
                    <option value="advanced">Advanced</option>
                    <option value="expert">Expert</option>
                </select>
            </div>
            <div>
                <label for="courseDuration">Duration</label><br>
                <input type="number" name="courseDuration" id="courseDuration" min=1>
            </div>
            <div>
                <label for="courseTeacher">Teacher</label><br>
                <select name="courseTeacher" id="courseTeacher">
                    <option value="" default></option>
                    <?php listTeacherNames(); ?>
                </select>
            </div>
            <div>
                <label for="courseStart">Course Start</label>
                <input type="date" name="courseStart" id="courseStart">
            </div>
            <div>
                <label for="courseEnd">Course Start</label>
                <input type="date" name="courseEnd" id="courseEnd">
            </div>
            <div>
                <label for="coursePhotoText">Photo</label><br>
                <input type="text" name="coursePhotoText" id="coursePhotoText" class="textbox" readonly>
                <label for="coursePhoto" id="coursePhotoBtn">Browse</label>
                <input type="file" name="coursePhoto" id="coursePhoto">
            </div>
            <div>
                <label for="courseDescription">Description</label><br>
                <textarea name="courseDescription" id="courseDescription" cols="30" rows="10"></textarea>
            </div>
            <div>
                <input type="submit" value="Confirm">
                <input type="reset" value="Cancel">
            </div>
        </div>
        
    </form>
    <?php }?>
</body>
</html>