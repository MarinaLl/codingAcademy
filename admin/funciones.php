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

function uploadPhoto($profileImageTmp, $profileImageName){
    if(is_uploaded_file($profileImageTmp)){
        $directory = "img/";
        $imagePath = $directory.$profileImageName;
        move_uploaded_file($profileImageTmp, $imagePath);
    
    } else {
        echo "no se ha podido subir el fichero";
    }

    return $imagePath;
}

function createNewTeacher($email, $password, $name, $lastNames, $title, $photo){
    $sql = "INSERT INTO teacher (email, password, name, lastNames, title, photo, active) VALUES ('$email', '$password', '$name', '$lastNames', '$title', '$photo', '1')";
    $connect = connectDataBase();

    if($query = mysqli_query($connect, $sql)){
        echo "registro insertado";
    } else {
        echo mysqli_errno($connect);
    }
}
function showAllTeachers(){
    $sql = "SELECT * FROM teacher";

    $connect = connectDataBase();
    
    $query = mysqli_query($connect, $sql);

    if ($query == false){
        mysqli_error($connect);
    } else {
        $numLines = mysqli_num_rows($query);
        for($i = 0; $i < $numLines; $i++){
            $line = mysqli_fetch_array($query);
            echo '<tr>
                <td>'.$line['email'].'</td>
                <td>'.$line['name'].'</td>
                <td>'.$line['lastNames'].'</td>
                <td>'.$line['title'].'</td>
                <td>'.$line['photo'].'</td>
                <td>'.$line['active'].'</td>
                <td></td>
                <td><button type="submit" name="button" value='.$line['email'].'>Disable</button></td>
            </tr>
            ';
        }
    }
}

function disableTeacher(){

}


?>