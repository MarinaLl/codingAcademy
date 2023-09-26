<?php 
    session_start();
    include('funciones.php');
    addHeader("");
    addFonts();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Courses</title>
</head>
<body>
    <h1 id="courseTitle"><?php echo $_SESSION['courseCategory'];?></h1>
    <h2 id="allCourses">All Courses</h2>
    <h2 id="filterBy">Filter by</h2>
    <div class="cardComponent">
        <?php
            $sql = "SELECT * FROM course WHERE category = '".$_SESSION['courseCategory']."' AND active = 1";
            $connect = connectDataBase();
    
            $query = mysqli_query($connect, $sql);

            if ($query == false){
                mysqli_error($connect);
            } else {
                $numLines = mysqli_num_rows($query);
                for($i = 0; $i < $numLines; $i++){
                    $line = mysqli_fetch_array($query);
                    


                }
            }
            echo '<img class="courseImage" src="src/'.$_SESSION['courseCategory'].'.png" alt="'.$_SESSION['courseCategory'].'">';
            echo '<h1 class="courseTitle"></h1>';
            echo '';
            echo '';
        ?>
    </div>
</body>
</html>