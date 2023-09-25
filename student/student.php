<?php   
    include('../funciones.php');
    session_start();
    if (isset($_SESSION['user']) && $_SESSION['role'] == 'student') {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Panel</title>
</head>
<body>
    <h1>Hello, <?php echo $_SESSION['completeName']; ?></h1>
    <a id="editProfileButton" href="">Edit Profile</a>
</body>
</html>
<?php } else {
        logout("../");
    }?>