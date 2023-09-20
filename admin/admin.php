<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Pannel</title>
</head>
<body>
    <?php
        include('funciones.php');
        if($_POST){
            $teacherName = $_POST['teacherName'];
            $teacherLastNames = $_POST['teacherLastNames'];
            $teacherTitle = $_POST['teacherTitle'];
            $teacherEmail = $_POST['teacherEmail'];
            $teacherPasswd = $_POST['teacherPass'];
            $teacherPhoto = $_FILES['teacherPhoto']['tmp_name'];

            $teacherPasswd = md5($teacherPasswd);

            $profileImage = uploadPhoto($teacherPhoto, $_FILES['teacherPhoto']['name']);

            connectDataBase();

            createNewTeacher($teacherEmail, $teacherPasswd, $teacherName, $teacherLastNames, $teacherTitle, $profileImage);

            showAllTeachers();
            

        } else {
    ?>
    <h1>Create Teacher</h1>
    <form action="admin.php" method="post" enctype="multipart/form-data">
        <label for="teacherName">Name</label>
        <input type="text" name="teacherName" id="teacherName"><br>
        <label for="teacherLastNames">Last Names</label>
        <input type="text" name="teacherLastNames" id="teacherLastNames"><br>
        <label for="teacherTitle">Title</label>
        <input type="text" name="teacherTitle" id="teacherTitle"><br>
        <label for="teacherPhoto">Photo</label>
        <input type="file" name="teacherPhoto" id="teacherPhoto"><br>
        <label for="teacherEmail">Email</label>
        <input type="email" name="teacherEmail" id="teacherEmail"><br>
        <label for="teacherPass">Password</label>
        <input type="password" name="teacherPass" id="teacherPass">
        <input type="submit" value="Confirma">

    </form>
    <?php }; ?>

    <form action="" method="post">
        <table border="1">
            <tr>
                <th>Email</th>
                <th>Name</th>
                <th>Last Names</th>
                <th>Title</th>
                <th>Photo</th>
                <th>Active</th>
                <th>Edit</th>
                <th>Disable</th>
            </tr>
            <?php showAllTeachers(); ?>
        </table>
    </form>
    



</body>
</html>