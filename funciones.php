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
        $imagePath = "src/defaultProfileImage.png";
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
            $active = ($line['active'] == 1) ? 'Yes' : 'No';
            echo '<tr>
                <td><img src=../'.$line['photo'].'></td>
                <td>'.$line['name'].' '.$line['lastNames'].'</td>
                <td>'.$line['email'].'</td>
                <td>'.$line['title'].'</td>
                <td>'.$line['dni'].'</td>
                <td>'.$active.'</td>
                <td><button class="editTableBtn" type="submit" id="editTeacher" name="buttonEdit" value='.$line['email'].'></button></td>
                <td><button class="disTableBtn" type="submit" name="buttonDis" value='.$line['email'].'></button></td>
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
            $active = ($line['active'] == 1) ? 'Yes' : 'No';
            echo '<tr>
                <td><img src=../'.$line['photo'].'></td>
                <td>'.$line['name'].'</td>
                <td>'.$line['teacher_email'].'</td>
                <td>'.$line['category'].'</td>
                <td>'.$line['duration'].'</td>
                <td>'.$line['start'].'</td>
                <td>'.$line['end'].'</td>
                <td>'.$active.'</td>
                <td><button class="editTableBtn" id="editBtn" type="submit" name="buttonEditCourse" value='.$line['code'].'></button></td>
                <td><button class="disTableBtn" type="submit" name="buttonDisCourse" value='.$line['code'].'></button></td>
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
            echo '<form action="courses.php" method="post" name="mostPopularEnrollment" class="wrap">';
            while ($line = mysqli_fetch_array($query)) {
                $courseCode = $line['course_code'];
                
                $sql = "SELECT * FROM course WHERE code = " . $courseCode;
                $queryCourse = mysqli_query($connectTopCourses, $sql);
                $course = mysqli_fetch_array($queryCourse);

                $sql = "SELECT name, lastNames, photo FROM teacher WHERE email = '".$course['teacher_email']."'";
                $queryTeacher = mysqli_query($connectTopCourses, $sql);
                $teacher = mysqli_fetch_array($queryTeacher);

                $sqlEnrolled = "SELECT * FROM enrollment WHERE course_code = ".$courseCode." AND student_email = '".$_SESSION['user']."'";
                $queryEnrollments = mysqli_query($connectTopCourses, $sqlEnrolled);
                
                if($queryEnrollments) {
                    if(mysqli_num_rows($queryEnrollments) > 0) {
                        $enrollButton = "";
                    } else {
                        $enrollButton = '<div><button type="submit" name="buttonEnroll" value="'.$courseCode.'">Enroll</button></div>';
                    }
                } else {
                    echo mysqli_error($connectTopCourses);
                }
                
                echo '
                <div class="topComponent">
                <div>
                    <img src="../'.$course['photo'].'" alt="">
                </div>
                <div>
                    <div>
                        <h3>'.$course['name'].'</h3>
                        <div>
                            <img src="../'.$teacher['photo'].'" alt="">
                            <p>'.$teacher['name']." ".$teacher['lastNames'].'</p>
                        </div>
                    </div>
                    <div>'.$course['description'].'</div>
                    <div>'.$course['duration'].' Hours</div>
                    <div>Level: '.formatString($course['difficulty']).'</div>
                    '.$enrollButton.'
                </div>
            </div>';
            }
            echo '</form>';
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
                        <div>
                            <img src="../'.$course['photo'].'">
                        </div>
                        <div class="gridComponent">
                            <div>
                                <h3>'.$course['name'].'</h3>
                            </div>
                            <div>
                                <img src="../'.$teacher['photo'].'">
                                <p>'.$teacherCompleteName.'</p>
                            </div>
                            <div>
                                <input type="hidden" name="courseCategory" value="'.$courseCategory.'">
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

        /*Display course information
        echo '<button type="submit" name="buttonCourse" value='.$course['code'].'>';
        echo '<input type="hidden" name="courseName" value="'.$course['name'].'">';
        echo '<div class="cardComponent">';
        echo '<img src="../' . $course['photo'] . '">';
        echo '<h2>' . $course['name'] . '</h2>';
        echo '<p>' . $numStudents . ' Students</p>';
        echo '</div></button>';*/
        echo'
            <div id="'.$course_code.'" class="teacherComponent">
                <img src="../' . $course['photo'] . '" alt="">
                <h2>' . $course['name'] . '</h2>
                <p>' . $numStudents . ' Students</p>
            </div>
        ';
    }
}

function showAllStudents($course) {
	$connect = connectDataBase();
    
	$sql = "SELECT
    	s.photo AS photo,
    	s.name AS name,
    	s.lastNames AS lastNames,
    	s.email AS email,
    	e.grade AS grade FROM (student s INNER JOIN enrollment e ON s.email = e.student_email) WHERE course_code = '$course'";

	$query = mysqli_query($connect, $sql);

	echo '<form action="teacherCourse.php" method="post" name="studentsGrade"><table>';
    
	while ($student = mysqli_fetch_assoc($query)) {
    	echo '<tr>
        	<td><img src="../'.$student['photo'].'"></td>
        	<td>'.$student['name'].'</td>
        	<td>'.$student['lastNames'].'</td>
        	<td>
            	<input type="number" min=0 max=10 name="studentGrades['.$student['email'].']" class="studentGrade" value="'.$student['grade'].'" step="0.01">
        	</td>
    	</tr>';
	}
	echo '</table>
	<button type="submit" name="editGradesBtn" value="'.$course.'">UPDATE NOTES</button></form>';
}

function updateNotes($students, $course) {
	$connect = connectDataBase();
	foreach ($students as $email => $newGrade) {
    	$sql = "UPDATE enrollment SET grade = '$newGrade' WHERE student_email = '$email' AND course_code = '$course'";
    	$result = mysqli_query($connect, $sql);
        echo '<meta http-equiv="refresh" content="0;url=teacher.php">';
	}
}


function createContactForm() {
    $email = "";
    $name = "";
    $lastNames = "";
    if (isset($_SESSION['user'])) {
        $email = $_SESSION['user'];

        $sql = "SELECT name, lastNames FROM student WHERE email = '".$_SESSION['user']."'";
        $connect = connectDataBase();
        $query = mysqli_query($connect, $sql);
        if ($query == false){
            mysqli_error($connect);
        } else {
            $student = mysqli_fetch_array($query);
            $name = $student['name'];
            $lastNames = $student['lastNames'];
        }
    }
    echo '
    <form action="contact.php" method="post" name="contactForm">
        <div><h4>TALK WITH OUR TEAM</h4></div>
        <div><label for="name">NAME</label></div>
        <div><label for="lastNames">LAST NAMES</label></div>
        <div><input type="text" name="name" value="'.$name.'"></div>
        <div><input type="text" name="lastNames" value="'.$lastNames.'"></div>
        <div><label for="email">EMAIL</label></div>
        <div><input type="text" name="email" value="'.$email.'"></div>
        <div><label for="message">MESSAGE</label></div>
        <div><textarea id="message" name="message" rows="4" cols="50"></textarea></div>
        <div><button type="submit" id="sendMessage" name="sendMessage">SEND MESSAGE</button></div>
    ';
}

function getCourseName($courseCode) {
    $sql = "SELECT name FROM course WHERE code = ".$courseCode." AND teacher_email = '".$_SESSION['user']."'";
    $connect = connectDataBase();
    $query = mysqli_query($connect, $sql);

    if ($query == false){
        mysqli_error($connect);
    } else {
        $numLines = mysqli_num_rows($query);
        if ($numLines > 0) {
            $course = mysqli_fetch_array($query);
            return $course['name'];
        }
    }
    return null;
}
?>