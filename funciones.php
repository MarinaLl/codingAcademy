<?php
function connectDataBase() {
    $host = 'localhost';
    $dbName = 'codingacademy';
    $dbUsername = 'root';
    $dbPass = '';

    $connect = mysqli_connect($host, $dbUsername, $dbPass, $dbName);

    if($connect == false){
        echo mysqli_connect_error();
    }

    return $connect;
}
// Add the Inter font from Google Fonts
function addFonts() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">';
}

function loginRedirect() {
    echo '<meta http-equiv="refresh" content="0;url='.$_SESSION['role'].'/'.$_SESSION['role'].'.php">';
}

// Only possible values for $path = "" or $path = "../"

function addHeader($path) {
    include(''.$path.'header.php');
}
function logout($path) {
    session_destroy();
    echo '<meta http-equiv="refresh" content="0;url='.$path.'login.php">';
}

// Photo management

function uploadPhoto($profileImageTmp, $profileImageName, $path) {
    if(is_uploaded_file($profileImageTmp)){
        $date = time();
        $imageName = str_replace(' ', '-', $profileImageName);
        $imagePath = "img/".$date."-".$imageName;
        move_uploaded_file($profileImageTmp, $path.$imagePath);
    
    } else {
        echo "no se ha podido subir el fichero";
    }
    
    return $imagePath;
}

function deletePhoto($imagePath, $path) {
    if(file_exists($path.$imagePath) && $imagePath != "img/defaultProfileImage.png") {
        unlink($path.$imagePath);
    }
}

// Parte Administrador
function createNewTeacher($email, $password, $name, $lastNames, $title, $photo, $dni){
    $sql = "INSERT INTO teacher (email, password, dni, name, lastNames, title, photo, active) VALUES ('$email', '$password', '$dni', '$name', '$lastNames', '$title', '$photo', '1')";
    $connectCreateTeacher = connectDataBase();

    if($query = mysqli_query($connectCreateTeacher, $sql)){
        echo "registro insertado";
        echo '<meta http-equiv="refresh" content="0;url=admin.php">';
    } else {
        echo mysqli_errno($connectCreateTeacher);
    }
}
function showAllTeachers(){
    $sql = "SELECT * FROM teacher WHERE active = 1";

    $connectShowTeachers = connectDataBase();
    
    $query = mysqli_query($connectShowTeachers, $sql);

    if ($query == false){
        mysqli_error($connectShowTeachers);
    } else {
        $numLines = mysqli_num_rows($query);
        for($i = 0; $i < $numLines; $i++){
            $line = mysqli_fetch_array($query);
            echo '<tr>
                <td><img src=../'.$line['photo'].'></td>
                <td>'.$line['name'].' '.$line['lastNames'].'</td>
                <td>'.$line['email'].'</td>
                <td>'.$line['title'].'</td>
                <td>'.$line['dni'].'</td>
                <td>'.$line['active'].'</td>
                <td><button type="submit" name="buttonEdit" value='.$line['email'].'>Edit</button></td>
                <td><button type="submit" name="buttonDis" value='.$line['email'].'>Disable</button></td>
            </tr>
            ';
        }
    }
}

function showAllCourses(){
    $sql = "SELECT * FROM course WHERE active = 1";

    $connectShowCourses = connectDataBase();

    $query = mysqli_query($connectShowCourses, $sql);

    if($query == false){
        mysqli_error($connectShowCourses);
    } else {
        $numLines = mysqli_num_rows($query);
        for($i = 0; $i < $numLines; $i++){
            $line = mysqli_fetch_array($query);
            echo '<tr>
                <td><img src=../'.$line['photo'].'></td>
                <td>'.$line['name'].'</td>
                <td>'.$line['teacher_email'].'</td>
                <td>'.$line['category'].'</td>
                <td>'.$line['duration'].'</td>
                <td>'.$line['start'].'</td>
                <td>'.$line['end'].'</td>
                <td>'.$line['active'].'</td>
                <td><button id="editBtn" type="submit" name="buttonEditCourse" value='.$line['code'].'>Edit</button></td>
                <td><button type="submit" name="buttonDisCourse" value='.$line['code'].'>Disable</button></td>
            </tr>
            ';
        }
    }
}

function editTeacher($email, $teacherEmail, $teacherName, $teacherLastNames, $teacherTitle, $teacherDni, $profileImage) {
    $sql = "UPDATE teacher 
            SET email = '$teacherEmail', 
                name = '$teacherName', 
                lastNames = '$teacherLastNames', 
                title = '$teacherTitle',
                photo = '$profileImage'
            WHERE email = '$email'";
    $connectEditTeacher = connectDataBase();

    if($query = mysqli_query($connectEditTeacher, $sql)){
        echo "profesor editado";
        echo '<meta http-equiv="refresh" content="0;url=admin.php">';
        exit;
    } else {
        echo mysqli_error($connectEditTeacher);
    }
}

function editCourse($code, $courseName, $courseDescription, $courseCategory, $courseDuration, $startDate, $endDate, $courseTeacher, $coursePhoto) {
    $sql = "UPDATE course 
            SET name = '$courseName', 
                description = '$courseDescription', 
                category = '$courseCategory', 
                duration = '$courseDuration',
                start = '$startDate',
                end = '$endDate',
                teacher_email = '$courseTeacher',
                photo = '$coursePhoto'
            WHERE code = '$code'";
    $connectEditCourse = connectDataBase();

    if($query = mysqli_query($connectEditCourse, $sql)){
        echo "curso editado";
        echo '<meta http-equiv="refresh" content="0;url=admin.php">';
        exit;
    } else {
        echo mysqli_error($connectEditCourse);
    }
}

function disableTeacher($email){
    $sql = "UPDATE teacher SET active = CASE WHEN active = TRUE THEN FALSE ELSE TRUE END WHERE email = '$email'";
    $connectDisableTeacher = connectDataBase();

    if($query = mysqli_query($connectDisableTeacher, $sql)){
        echo "registro deshabilitado";
    } else {
        echo mysqli_errno($connectDisableTeacher);
    }
    
}

function disableCourse($code){
    $sql = "UPDATE course SET active = CASE WHEN active = TRUE THEN FALSE ELSE TRUE END WHERE code = '$code'";
    $connectDisableCourse = connectDataBase();

    if($query = mysqli_query($connectDisableCourse, $sql)){
        echo "registro deshabilitado";
    } else {
        echo mysqli_errno($connectDisableCourse);
    }
    
}


function listTeacherNames(){
    $sql = "SELECT * FROM teacher";

    $connectListTeachers = connectDataBase();
    
    $query = mysqli_query($connectListTeachers, $sql);

    if ($query == false){
        mysqli_error($connectListTeachers);
    } else {
        $numLines = mysqli_num_rows($query);
        for($i = 0; $i < $numLines; $i++){
            $line = mysqli_fetch_array($query);
            echo '<option value='.$line['email'].'>'.$line['name'].' '.$line['lastNames'] .'</option>';
        }
    }
}

function createNewCourse($name,$description, $category, $duration, $startDate, $endDate, $teacher, $photo, $difficulty){
    $sql = "INSERT INTO course (name, description, category, duration, difficulty, start, end, teacher_email, photo) VALUES ('$name', '$description', '$category', '$duration', '$difficulty', '$startDate', '$endDate', '$teacher', '$photo')";

    $connectCreateCourse = connectDataBase();

    if($query = mysqli_query($connectCreateCourse, $sql)){
        echo "registro creado";
        echo '<meta http-equiv="refresh" content="0;url=admin.php">';
    } else {
        echo mysqli_errno($connectCreateCourse);
    }

}

function addNewUser($username, $lastNames, $dni, $age, $photo, $email, $passwd){

    $sql = "INSERT INTO student (email, password, dni, name, lastNames, age, photo) VALUES ('$email', '$passwd', '$dni', '$username', '$lastNames', '$age', '$photo')";

    $conn = connectDataBase();

    if($query = mysqli_query($conn, $sql)){
        echo "registro creado";
        echo '<meta http-equiv="refresh" content="0;url=student/student.php">';
    } else {
        echo mysqli_error($conn);
    }

}

// Error handling

function checkDNI($id){

    $combinationsDNI = '/^\d{8}[A-HJ-NP-TV-Z]$/i';
    $combinationsNIE = '/^[XYZ]\d{7}[A-HJ-NP-TV-Z]$/i';

    if(preg_match($combinationsDNI, $id) || preg_match($combinationsNIE, $id)){
        return true;
    }
    return false;
}

function isEmailUsed($email) {
    
        $connectEmail = connectDataBase();
        // Realiza una consulta a la tabla 'student'
        $sql_student = "SELECT email FROM student WHERE email = '$email'";
        $result_student = mysqli_query($connectEmail, $sql_student);
        
        // Realiza una consulta a la tabla 'teacher'
        $sql_teacher = "SELECT email FROM teacher WHERE email = '$email'";
        $result_teacher = mysqli_query($connectEmail, $sql_teacher);
        
        // Realiza una consulta a la tabla 'admin'
        $sql_admin = "SELECT email FROM admin WHERE email = '$email'";
        $result_admin = mysqli_query($connectEmail, $sql_admin);
        
        // Verifica si el correo electrónico está en uso en alguna de las tablas
        if (mysqli_num_rows($result_student) > 0 || mysqli_num_rows($result_teacher) > 0 || mysqli_num_rows($result_admin) > 0) {
            return true; // El correo electrónico está en uso
        } else {
            return false; // El correo electrónico no está en uso
        }
    
}

function isOnDate($date) {

    $timestampDate = strtotime($date);

    $timestampActualDate = time();

    // Compara las fechas
    if ($timestampDate < $timestampActualDate) {
        return false;
    } 
    return true;

}

function editProfile($studentName, $studentLastNames, $changeDni, $studentEmail, $changePhoto, $studentAge, $changePassword) {
    
    
    $sql = "UPDATE student SET  
            email = '$studentEmail', 
            ".$changePassword."
             ".$changeDni."
            name = '$studentName', 
            lastNames = '$studentLastNames',
            age = $studentAge,
            ".$changePhoto."
            active = 1 WHERE email = '".$_SESSION['user']."'";
    
    $connectEditProfile = connectDataBase();
    $query = mysqli_query($connectEditProfile, $sql);
    if($query) {
        $_SESSION['completeName'] = "".$studentName." ".$studentLastNames."";

        $sql = "SELECT photo FROM student WHERE email = '$studentEmail'";
        $queryPhoto = mysqli_query($connectEditProfile, $sql);
        if ($queryPhoto) {
            $photo = mysqli_fetch_array($queryPhoto);
            echo $photo['photo'];
            if ($_SESSION['photo'] != $photo['photo']) {
                deletePhoto($_SESSION['photo'], "../");
                $_SESSION['photo'] = $photo['photo'];    
            }
        } else {
            echo mysqli_errno($connectEditProfile);
        }
    } else {
        echo mysqli_errno($connectEditProfile);
    }
}

function isCategory($category) {
	$sql = "SELECT COUNT(*) FROM category WHERE ID = ?";
    $connectCategories = connectDataBase();
    
	if ($stmt = mysqli_prepare($connectCategories, $sql)) {
    	mysqli_stmt_bind_param($stmt, "s", $category);
    	mysqli_stmt_execute($stmt);
    	mysqli_stmt_bind_result($stmt, $count);
    	mysqli_stmt_fetch($stmt);
    	mysqli_stmt_close($stmt);

    	if ($count > 0) {
        	return true;
    	}
	}
	return false;
}


function countTopCourses() {
    $sql = "SELECT course_code, COUNT(*) AS enrollment_count
    FROM enrollment
    GROUP BY course_code
    ORDER BY enrollment_count DESC
    LIMIT 3";
    $connectTopCourses = connectDataBase();
    $query = mysqli_query($connectTopCourses, $sql);
    if (!$query) {
        echo mysqli_error($connectTopCourses);
    } else {
        $numLines = mysqli_num_rows($query);
        if ($numLines > 0) {
            echo '<form action="courses.php" method="post" name="mostPopularEnrollment"><table>';
            while ($line = mysqli_fetch_array($query)) {
                $courseCode = $line['course_code'];
                $sql = "SELECT * FROM course WHERE code = " . $courseCode;
                $queryCourse = mysqli_query($connectTopCourses, $sql);
                $course = mysqli_fetch_array($queryCourse);
                $sql = "SELECT name, lastNames, photo FROM teacher WHERE email = '".$course['teacher_email']."'";
                $queryTeacher = mysqli_query($connectTopCourses, $sql);
                $teacher = mysqli_fetch_array($queryTeacher);
                $courseImage = $course['photo'];
                $courseName = $course['name'];
                $teacherPhoto = $teacher['photo'];
                $teacherCompleteName = $teacher['name']." ".$teacher['lastNames'];
                $courseDescription = $course['description'];
                $courseDuration = $course['duration'];
                $courseStartDate = $course['start'];
                $courseDifficulty = formatString($course['difficulty']);
                $sqlEnrolled = "SELECT * FROM enrollment WHERE course_code = ".$courseCode." AND student_email = '".$_SESSION['user']."'";
                $queryEnrollments = mysqli_query($connectTopCourses, $sqlEnrolled);
                $enrollButton = '<button type="submit" name="buttonEnroll" value="'.$courseCode.'">Enroll</button>';
                if($queryEnrollments) {
                    if(mysqli_num_rows($queryEnrollments) > 0) {
                        $enrollButton = "";
                    }
                } else {
                    echo mysqli_error($connectTopCourses);
                }
                echo '
                <tr>
                    <td><img src="'.$courseImage.'"></td>
                    <td>'.$courseName.'</td>
                    <td>'.$enrollButton.'</td>
                    <td><img src="'.$teacherPhoto.'"></td>
                    <td>'.$teacherCompleteName.'</td>
                    <td>'.$courseDescription.'</td>
                    <td>'.$courseDuration.'</td>
                    <td>'.$courseStartDate.'</td>
                    <td>'.$courseDifficulty.'</td>
                </tr>';
            }
            echo '</table></form>';
        } else {
            echo 'No hay cursos en esta categoria';
        }
    }
}

function enroll() {
    $courseCode = $_POST['buttonEnroll'];
    $studentEmail = $_SESSION['user'];
    $sqlInsert = "INSERT INTO enrollment (student_email, course_code, grade) VALUES ('$studentEmail','$courseCode', 0.00)";
    $connectEnrollment = connectDataBase();
    $query = mysqli_query($connectEnrollment, $sqlInsert);
    if ($query == false) {
        mysqli_error($connectEnrollment);
    }
}

function showStudentCourses($user){
    $sql = "SELECT  t.photo AS teacherPhoto, 
                                t.name AS teacherName,
                                t.lastNames AS teacherLastNames,
                                c.code AS courseCode,
                                c.photo AS coursePhoto, 
                                c.name AS courseName, 
                                c.start AS courseStart, 
                                c.end AS courseEnd,
                                e.grade AS grade 
                        FROM ((course c INNER JOIN teacher t ON c.teacher_email = t.email) 
                        INNER JOIN enrollment e ON e.course_code = c.code)
                        WHERE e.student_email = '".$user."'";
    $connect = connectDataBase();
                
    $query = mysqli_query($connect, $sql);

    if ($query == false){
        mysqli_error($connect);
    } else {
        $numLines = mysqli_num_rows($query);
                    
        if ($numLines > 0) {
            
            for($i = 0; $i < $numLines; $i++){
                $line = mysqli_fetch_array($query);
                    echo '
                    <div class="card">
                        <div><img src="../'.$line['coursePhoto'].'"></div>
                        <div>
                            <h3>'.$line['courseName'].'</h3>
                            <h4>'.$line['teacherName'].' '.$line['teacherLastNames'].'</h4>
                            <p>'.$line['grade'].'</p>
                            <button type="submit" name="buttonUnenroll" value='.$line['courseCode'].'>Unenroll</button> 
                        </div>
                    </div>';
                        
            }
        } else {
            echo 'You are not enrolled in any course.';
        }

    }
}

function showCourseList($courseCategory) {
    $sql = "SELECT * FROM course WHERE category = '".$courseCategory."' AND active = 1 AND code NOT IN (SELECT course_code FROM enrollment WHERE student_email = '".$_SESSION['user']."')";
    
    $connect = connectDataBase();

    $query = mysqli_query($connect, $sql);

    if ($query == false){
        mysqli_error($connect);
    } else {
        $numLines = mysqli_num_rows($query);
        
        if ($numLines > 0) {
                for($i = 0; $i < $numLines; $i++){
                    $course = mysqli_fetch_array($query);
                    $sql = "SELECT name, lastNames, photo FROM teacher WHERE email = '".$course['teacher_email']."'";
                    $queryTeacher = mysqli_query($connect, $sql);
                    $teacher = mysqli_fetch_array($queryTeacher);
                    $teacherCompleteName = $teacher['name']." ".$teacher['lastNames'];
                    $difficulty = formatString($course['difficulty']);

                    echo '<div class="cardComponent">';
                    echo '
                        <img src="'.$course['photo'].'">
                        <div class="gridComponent">
                            <div>
                                <h2>'.$course['name'].'</h2>
                            </div>
                            <div>
                                <img src="'.$teacher['photo'].'">
                                <p>'.$teacherCompleteName.'</p>
                            </div>
                            <div>
                                <button type="submit" name="buttonEnroll" value='.$course['code'].'>Enroll Now</button>
                            </div>
                            <div>
                                <p>'.$course['description'].'</p>
                            </div>
                            <div class="bottomCard">'.$course['duration'].' Hours</div>
                            <div class="bottomCard">Starts: '.$course['start'].'</div>
                            <div class="bottomCard">Level: '.$difficulty.'</div>
                        </div>';
                        
                        echo '</div>';
                }
            
        } else {
            echo 'No hay cursos en esta categoria';
        }
        
        
    }
}

function formatString($string) {
    $words = explode("-", $string);
    $formattedString = implode(" ", array_map('ucfirst', $words));
    return $formattedString;
}

function showTeacherCourses() {
    $sql = "SELECT * FROM course WHERE teacher_email = '".$_SESSION['user']."'";
    
    $connect = connectDataBase();

    $query = mysqli_query($connect, $sql);
    echo '<form action="teacherCourse.php" method="post" name="mostPopularEnrollment">';
    while ($course = mysqli_fetch_assoc($query)) {
        // Count the number of students for each course
        $course_code = mysqli_real_escape_string($connect, $course['code']);
        $sql = "SELECT COUNT(*) AS numStudents FROM enrollment WHERE course_code = '$course_code'";
        $queryStudents = mysqli_query($connect, $sql);

        if (!$queryStudents) {
            // Handle the SQL query error here
            echo "Error executing the student count query: " . mysqli_error($connect);
            continue; // Move to the next course
        }

        $enrollments = mysqli_fetch_assoc($queryStudents);
        $numStudents = $enrollments['numStudents'];

        // Display course information
        echo '<button type="submit" name="buttonCourse" value='.$course['code'].'>';
        echo '<input type="hidden" name="courseName" value="'.$course['name'].'">';
        echo '<div class="cardComponent">';
        echo '<img src="../' . $course['photo'] . '">';
        echo '<h2>' . $course['name'] . '</h2>';
        echo '<p>' . $numStudents . ' Students</p>';
        echo '</div></button>';
    }
    echo '</form>';

}

function showAllStudents($course) {
    $sql = "SELECT 
        s.photo AS photo, 
        s.name AS name,
        s.lastNames AS lastNames,
        s.email AS email,
        e.grade AS grade FROM (student s INNER JOIN enrollment e ON s.email = e.student_email) WHERE course_code = '$course'";
    
    $connect = connectDataBase();

    $query = mysqli_query($connect, $sql);
    echo '<form action="teacherEditGrade.php" method="post" name="studentsGrade"><table>';
    while ($student = mysqli_fetch_assoc($query)) {
        
        echo '<tr>
        <td><img src="../'.$student['photo'].'"></td>
        <td>'.$student['name'].'</td>
        <td>'.$student['lastNames'].'</td>
        <td>'.$student['grade'].'</td>
        <td><button type="submit" name="editGrade" value='.$student['email'].'><img src="../src/edit.png"></button></td>
        <input type="hidden" name="studentGrade" value="'.$student['grade'].'"</tr>';
    }
    echo '</table></form>';
}
?>