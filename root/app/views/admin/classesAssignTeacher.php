<!DOCTYPE html>
<html>
    <head>
        <title>Assign Teacher</title>
        <link rel="stylesheet" type="text/css" href="../../../public/css/common.css">
        <link rel="stylesheet" type="text/css" href="../../../public/css/form.css">
    </head>
    <body>
        <div class="content">
            <?php require_once "../app/views/common/navigation.php" ?>
            <div id="form">
                <h5 class='message'><?php echo $data['message']; ?></h5>
                <form action="/PHPProject/root/public/admin/classesAssignTeacherSubmit" method="POST">
                    <input type="hidden" class="textInput" name="class_id" value="<?php echo $data['class'][0]['id']?>">
                    <label for="teacher_id">Teacher:</label><br />
                    <select name="teacher_id" class="textInput">
                        <option value="" type="readonly">Select Teacher</option>
                        <?php
                            foreach ($data['teachers'] as $teacher) {
                                echo "<option value='".$teacher['id']."'>".$teacher['subject_name'].": ".$teacher['first_name']." ".$teacher['middle_name']." ".$teacher['last_name']."</option>";
                            }
                        ?>
                    </select><br />
                    <a href="../../admin/classes"><input type="button" class="buttonInput leftButton blueButton" value="Back"></a>
                    <input type="submit" class="buttonInput rightButton redButton" value="Assign">
                </form>
            </div>
        </div>
    </body>
</html>