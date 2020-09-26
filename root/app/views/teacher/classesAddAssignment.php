<!DOCTYPE html>
<html>
    <head>
        <title>Add Assignment Teacher</title>
        <link rel="stylesheet" type="text/css" href="../../../public/css/common.css">
        <link rel="stylesheet" type="text/css" href="../../../public/css/form.css">
    </head>
    <body>
        <div class="content">
            <?php require_once "../app/views/common/navigation.php"?>
            <div id="form">
                <h5 class='message'><?php echo $_SESSION['message']; ?></h5>
                <form action="/PHPProject/root/public/teacher/classesAddAssignmentSubmit" method="POST">
                    <input type="hidden" class="textInput" name="class_id" value="<?php echo $data['class'][0]['id']?>">
                    <label for="class">Class:</label><br />
                    <input type="text" class="readonly textInput" name="class" value="<?php echo $data['class'][0]['class_name']?>" readonly>
                    <label for="assignment_id">Assignment:</label><br />
                    <select name="assignment_id" class="textInput">
                        <option value="" type="readonly">Select Assignment</option>
                        <?php
                            foreach ($data['assignments'] as $assignment) {
                                if ($assignment['subject_id'] == $data['teacher'][0]['subject_id']) {
                                    echo "<option value='".$assignment['id']."'>".$assignment['assignment_title']."</option>";
                                }
                            }
                        ?>
                    </select><br />
                    <a href="../../teacher/classes"><input type="button" class="buttonInput leftButton blueButton" value="Back"></a>
                    <input type="submit" class="buttonInput rightButton greenButton" value="Assign">
                </form>
            </div>
        </div>
    </body>
</html>