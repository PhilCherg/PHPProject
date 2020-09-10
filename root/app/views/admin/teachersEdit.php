<!DOCTYPE html>
<html>
    <head>
        <title>Edit Teacher</title>
        <link rel="stylesheet" type="text/css" href="../../../public/css/common.css">
        <link rel="stylesheet" type="text/css" href="../../../public/css/form.css">
    </head>
    <body>
        <div class="content">
            <?php require_once "../app/views/common/navigation.php" ?>
            <div id="form">
                <h5 class='message'><?php echo $data['message']; ?></h5>
                <form action="/PHPProject/root/public/admin/teachersEditSubmit" method="POST">
                    <input type="hidden" name="id" value="<?php echo $data['teacher'][0]['id'];?>">
                    <label for="username">Teacher Username:</label><br />
                    <input type="text" class="textInput" name="username" value="<?php echo $data['teacher'][0]['username'];?>"><br />
                    <label for="password">Teacher Password:</label><br />
                    <input type="password" class="textInput" name="password" value="<?php echo $data['teacher'][0]['pass'];?>"><br />
                    <label for="fname">Teacher First Name:</label><br />
                    <input type="text" class="textInput" name="fname" value="<?php echo $data['teacher'][0]['first_name'];?>"><br />
                    <label for="mname">Teacher Middle Name:</label><br />
                    <input type="text" class="textInput" name="mname" value="<?php echo $data['teacher'][0]['middle_name'];?>"><br />
                    <label for="lname">Teacher Last Name:</label><br />
                    <input type="text" class="textInput" name="lname" value="<?php echo $data['teacher'][0]['last_name'];?>"><br />
                    <label for="subjectId">Subjects:</label><br />
                    <select name="subjectId" class="textInput">
                        <option value="" type="readonly">Select Subject</option>
                        <?php
                            foreach ($data['subjects'] as $subject) {
                                if ($subject['id'] == $data['teacher'][0]['subject_id']) {
                                    echo "<option value='".$subject['id']."' selected='selected'>".$subject['subject_name']."</option>";
                                } else {
                                    echo "<option value='".$subject['id']."'>".$subject['subject_name']."</option>";
                                }
                            }
                        ?>
                    </select><br />
                    <a href="../../admin/teachers"><input type="button" class="buttonInput leftButton blueButton" value="Back"></a>
                    <input type="submit" class="buttonInput rightButton greenButton" value="Submit">
                </form>
            </div>
        </div>
    </body>
</html>