<!DOCTYPE html>
<html>
    <head>
        <title>Log In Page</title>
        <link rel="stylesheet" type="text/css" href="../../public/css/common.css">
    </head>
    <body>
        <div class="content">
            <?php require_once "../app/views/common/navigation.php" ?>
            <div class='instructions'>
                <h1>Welcome to my PHP Online Gradebook Project.</h1>
                <p>To use the website, you must first login. There are 3 different levels of access:
                admin, teacher, and student. When you login, make sure you also select the correct role 
                you are trying to log in to. I have created some sample users for you to test out my website:</p>
                <p>Admin - username: admin@admin.com | password: admin</p>
                <p>Teacher - username: teacher@teacher.com | password: teacher</p>
                <p>Admin - username: student@student.com | password: student</p>
            </div> 
        </div>
    </body>
</html>