<!DOCTYPE html>
<html>
    <head>
        <title>Create Teacher</title>
        <link rel="stylesheet" type="text/css" href="../../public/css/common.css">
        <link rel="stylesheet" type="text/css" href="../../public/css/form.css">
    </head>
    <body>
        <div class="content">
            <?php require_once "../app/views/common/navigation.php" ?>
            <div id="form">
                <h5 class='message'><?php echo $data['message']; ?></h5>
                <form action="/PHPProject/root/public/admin/teachersCreateSubmit" method="POST">
                    <label for="username">Teacher Username:</label><br />
                    <input type="text" class="textInput" name="username" placeholder="Username"><br />
                    <label for="password">Teacher Password:</label><br />
                    <input type="password" class="textInput" name="password" placeholder="Password"><br />
                    <label for="fname">Teacher First Name:</label><br />
                    <input type="text" class="textInput" name="fname" placeholder="First Name"><br />
                    <label for="mname">Teacher Middle Name:</label><br />
                    <input type="text" class="textInput" name="mname" placeholder="Middle Name"><br />
                    <label for="lname">Teacher Last Name:</label><br />
                    <input type="text" class="textInput" name="lname" placeholder="Last Name"><br />
                    <label for="subjectId">Subjects:</label><br />
                    <select name="subjectId" class="textInput">
                        <option value="" type="readonly">Select Subject</option>
                        <?php
                            foreach ($data['subjects'] as $subject) {
                                echo "<option value='".$subject['id']."'>".$subject['subject_name']."</option>";
                            }
                        ?>
                    </select><br />
                    <a href="../admin/teachers"><input type="button" class="buttonInput leftButton blueButton" value="Back"></a>
                    <input type="submit" class="buttonInput rightButton greenButton" value="Create">
                </form>
            </div>
        </div>
    </body>
</html>