<!DOCTYPE html>
<html>
    <head>
        <title>Create Student</title>
        <link rel="stylesheet" type="text/css" href="../../public/css/common.css">
        <link rel="stylesheet" type="text/css" href="../../public/css/form.css">
    </head>
    <body>
        <div class="content">
            <?php require_once "../app/views/common/navigation.php" ?>
            <div id="form">
                <h5 class='message'><?php echo $data['message']; ?></h5>
                <form action="/PHPProject/root/public/admin/studentsCreateSubmit" method="POST">
                    <label for="username">Student Username:</label><br />
                    <input type="text" class="textInput" name="username" placeholder="Username"><br />
                    <label for="password">Student Password:</label><br />
                    <input type="password" class="textInput" name="password" placeholder="Password"><br />
                    <label for="fname">Student First Name:</label><br />
                    <input type="text" class="textInput" name="fname" placeholder="First Name"><br />
                    <label for="mname">Student Middle Name:</label><br />
                    <input type="text" class="textInput" name="mname" placeholder="Middle Name"><br />
                    <label for="lname">Student Last Name:</label><br />
                    <input type="text" class="textInput" name="lname" placeholder="Last Name"><br />
                    <label for="subjectId">Class:</label><br />
                    <select name="classId" class="textInput">
                        <option value="" type="readonly">Select Class</option>
                        <?php
                            foreach ($data['classes'] as $class) {
                                echo "<option value='".$class['id']."'>".$class['class_name']."</option>";
                            }
                        ?>
                    </select><br />
                    <a href="../admin/students"><input type="button" class="buttonInput leftButton blueButton" value="Back"></a>
                    <input type="submit" class="buttonInput rightButton greenButton" value="Create">
                </form>
            </div>
        </div>
    </body>
</html>