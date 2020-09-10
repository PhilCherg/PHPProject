<!DOCTYPE html>
<html>
    <head>
        <title>Add Grade</title>
        <link rel="stylesheet" type="text/css" href="../../../public/css/common.css">
        <link rel="stylesheet" type="text/css" href="../../../public/css/form.css">
    </head>
    <body>
        <div class="content">
            <?php require_once "../app/views/common/navigation.php" ?>
            <div id="form">
                <h5 class='message'><?php echo $data['message']; ?></h5>
                <form action="/PHPProject/root/public/teacher/classesAddGradeSubmit" method="POST">
                    <label for="name">Assignment Name:</label><br />
                    <input type="text" class="textInput" name="name" placeholder="Name"><br />
                    <label for="grade">Assignment Grade:</label><br />
                    <select name="grade" class="textInput">
                        <option value="" type="readonly">Select Grade</option>
                        <?php
                            for ($grade = 6; $grade >= 2; $grade -= 1) {
                                echo "<option value='".$grade."'>".$grade."</option>";
                            }
                        ?>
                    </select><br />
                    <input type="hidden" class="textInput" name="subject_id" value="<?php echo $data['subject'][0]['id'];?>"><br />
                    <input type="hidden" class="textInput" name="student_id" value="<?php echo $data['student'][0]['id'];?>"><br />
                    <a href="../../teacher/classes"><input type="button" class="buttonInput leftButton blueButton" value="Back"></a>
                    <input type="submit" class="buttonInput rightButton greenButton" value="Create">
                </form>
            </div>
        </div>
    </body>
</html>