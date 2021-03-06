<!DOCTYPE html>
<html>
    <head>
        <title>Add Assignment</title>
        <link rel="stylesheet" type="text/css" href="../../public/css/common.css">
        <link rel="stylesheet" type="text/css" href="../../public/css/form.css">
    </head>
    <body>
        <div class="content">
            <?php require_once "../app/views/common/navigation.php" ?>
            <div id="form">
                <h5 class='message'><?php echo $data['message']; ?></h5>
                <form action="/PHPProject/root/public/teacher/assignmentsCreateSubmit" method="POST">
                    <label for="name">Assignment Name:</label><br />
                    <input type="text" class="textInput" name="name" placeholder="Name"><br />
                    <label for="max">Assignment Max:</label><br />
                    <input type="text" class="textInput" name="max" placeholder="Max"><br />
                    <label for="weight">Assignment Weight:</label><br />
                    <input type="text" class="textInput" name="weight" placeholder="Weight"><br />
                    <label for="weight">Available Weight:</label><br />
                    <input type="text" class="readonly textInput" name="availableWeight" value="<?php echo $data['availableWeight'];?>" readonly><br />
                    <input type="hidden" class="textInput" name="subject_id" value="<?php echo $data['subject'][0]['id'];?>"><br />
                    <a href="../teacher/assignments"><input type="button" class="buttonInput leftButton blueButton" value="Back"></a>
                    <input type="submit" class="buttonInput rightButton greenButton" value="Create">
                </form>
            </div>
        </div>
    </body>
</html>