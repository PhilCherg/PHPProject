<!DOCTYPE html>
<html>
    <head>
        <title>Log In Page</title>
        <link rel="stylesheet" type="text/css" href="../../public/css/common.css">
        <link rel="stylesheet" type="text/css" href="../../public/css/form.css">
    </head>
    <body>
        <div class="content">
            <?php require_once "../app/views/common/navigation.php" ?>
            <div id="form">
                <h5 class='message'><?php echo $data['message']; ?></h5>
                <form action="/PHPProject/root/public/home/loginSubmit" method="POST">
                    <label for="role">Access:</label><br />
                    <select name="role" class="textInput">
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                        <option value="admin">Admin</option>
                    </select><br />
                    <label for="username">Username:</label><br />
                    <input type="email" class="textInput" name="username" placeholder="E-mail"><br />
                    <label for="pass">Password:</label><br />
                    <input type="password" class="textInput" name="pass" placeholder="Password"><br />
                    <input type="submit" class="buttonInput grayButton" value="Log In">
                </form>
            </div>
        </div>
    </body>
</html>
