<!DOCTYPE html>
<html>
    <head>
        <title>Add Assignment</title>
        <link rel="stylesheet" type="text/css" href="../../../public/css/common.css">
        <link rel="stylesheet" type="text/css" href="../../../public/css/form.css">
    </head>
    <body>
        <div class="content">
            <?php require_once "../app/views/common/navigation.php" ?>
            <div id="form">
                <h5 class='message'><?php echo $data['message']; ?></h5>
                <form action="/PHPProject/root/public/admin/studentsInfoEditSubmit" method="POST">
                    <input type="hidden" class="textInput" name="id" value="<?php echo $data['assignment'][0]['id'];?>">
                    <input type="hidden" class="textInput" name="student_id" value="<?php echo $data['assignment'][0]['student_id'];?>">
                    <label for="title">Assignment:</label><br />
                    <input type="text" class="readonly textInput" name="title" value="<?php echo $data['assignment'][0]['assignment_title'];?>" readonly><br />
                    <label for="points">Points:</label><br />
                    <input type="text" class="textInput" name="points" value="<?php echo $data['assignment'][0]['assignment_points'];?>"><br />
                    <label for="max">Maximum:</label><br />
                    <input type="text" class="readonly textInput" name="max" value="<?php echo $data['assignment'][0]['assignment_max'];?>" readonly><br />
                    <a href="../../admin/studentsInfo/<?php echo $data['assignment'][0]['student_id'];?>"><input type="button" class="buttonInput leftButton blueButton" value="Back"></a>
                    <input type="submit" class="buttonInput rightButton greenButton" value="Submit">
                </form>
            </div>
        </div>
    </body>
</html>