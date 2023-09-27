<?php 

function connectDataBase(){
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
    header('Location: '.$_SESSION['role'].'/'.$_SESSION['role'].'.php');
}

// Only possible values for $path = "" or $path = "../"

function addHeader($path) {
    include(''.$path.'header.php');
}
function logout($path) {
    session_destroy();
    header('Location: '.$path.'login.php');
}

// Photo management

function uploadPhoto($profileImageTmp, $profileImageName, $path) {
    if(is_uploaded_file($profileImageTmp)){
        $directory = $path."img/";

        $date = time();
        $imageName = str_replace(' ', '-', $profileImageName);
        $imagePath = $directory.$date."-".$imageName;
        move_uploaded_file($profileImageTmp, $imagePath);
    
    } else {
        echo "no se ha podido subir el fichero";
    }
    
    return $imagePath;
}
// Parte Administrador
function createNewTeacher($email, $password, $name, $lastNames, $title, $photo, $dni){
    $sql = "INSERT INTO teacher (email, password, dni, name, lastNames, title, photo, active) VALUES ('$email', '$password', '$dni', '$name', '$lastNames', '$title', '$photo', '1')";
    $connect = connectDataBase();

    if($query = mysqli_query($connect, $sql)){
        echo "registro insertado";
        header("Location: admin.php");
    } else {
        echo mysqli_errno($connect);
    }
}
function showAllTeachers(){
    $sql = "SELECT * FROM teacher WHERE active = 1";

    $connect = connectDataBase();
    
    $query = mysqli_query($connect, $sql);

    if ($query == false){
        mysqli_error($connect);
    } else {
        $numLines = mysqli_num_rows($query);
        for($i = 0; $i < $numLines; $i++){
            $line = mysqli_fetch_array($query);
            echo '<tr>
                <td><img src='.$line['photo'].'></td>
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

    $connect = connectDataBase();

    $query = mysqli_query($connect, $sql);

    if($query == false){
        mysqli_error($connect);
    } else {
        $numLines = mysqli_num_rows($query);
        for($i = 0; $i < $numLines; $i++){
            $line = mysqli_fetch_array($query);
            echo '<tr>
                <td><img src='.$line['photo'].'></td>
                <td>'.$line['name'].'</td>
                <td>'.$line['teacher_email'].'</td>
                <td>'.$line['category'].'</td>
                <td>'.$line['duration'].'</td>
                <td>'.$line['start'].'</td>
                <td>'.$line['end'].'</td>
                <td>'.$line['active'].'</td>
                <td><button type="submit" name="buttonEditCourse" value='.$line['code'].'>Edit</button></td>
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
    $connect = connectDataBase();

    if($query = mysqli_query($connect, $sql)){
        echo "profesor editado";
        header('Location: admin.php');
        exit;
    } else {
        echo mysqli_error($connect);
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
    $connect = connectDataBase();

    if($query = mysqli_query($connect, $sql)){
        echo "curso editado";
        header('Location: admin.php');
        exit;
    } else {
        echo mysqli_error($connect);
    }
}

function disableTeacher($email){
    $sql = "UPDATE teacher SET active = CASE WHEN active = TRUE THEN FALSE ELSE TRUE END WHERE email = '$email'";
    $connect = connectDataBase();

    if($query = mysqli_query($connect, $sql)){
        echo "registro deshabilitado";
    } else {
        echo mysqli_errno($connect);
    }
    
}

function disableCourse($code){
    $sql = "UPDATE course SET active = CASE WHEN active = TRUE THEN FALSE ELSE TRUE END WHERE code = '$code'";
    $connect = connectDataBase();

    if($query = mysqli_query($connect, $sql)){
        echo "registro deshabilitado";
    } else {
        echo mysqli_errno($connect);
    }
    
}


function listTeacherNames(){
    $sql = "SELECT * FROM teacher";

    $connect = connectDataBase();
    
    $query = mysqli_query($connect, $sql);

    if ($query == false){
        mysqli_error($connect);
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

    $connect = connectDataBase();

    if($query = mysqli_query($connect, $sql)){
        echo "registro creado";
        header("Location: admin.php");
    } else {
        echo mysqli_errno($connect);
    }

}

function addNewUser($username, $lastNames, $dni, $age, $photo, $email, $passwd){

    $sql = "INSERT INTO student (email, password, dni, name, lastNames, age, photo) VALUES ('$email', '$passwd', '$dni', '$username', '$lastNames', '$age', '$photo')";

    $conn = connectDataBase();

    if($query = mysqli_query($conn, $sql)){
        echo "registro creado";
        header('Location: student/student.php');
    } else {
        echo mysqli_error($conn);
    }

}

// Error handling
function checkDNI($dni){

    $combinations = '/^\d{8}[A-HJ-NP-TV-Z]$/i';

    if(preg_match($combinations, $dni)){
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

?>