<?php   
    include('../funciones.php');
    session_start();
    if (isset($_SESSION['user']) && $_SESSION['role'] == 'teacher') {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Panel</title>
</head>
<body>
    <h1>Hello, <?php echo $_SESSION['completeName']; ?></h1>
</body>
</html>
<?php } else {
        logout("../");
    }?>