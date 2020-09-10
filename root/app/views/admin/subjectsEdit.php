<!DOCTYPE html>
<html>
    <head>
        <title>Edit Subject</title>
        <link rel="stylesheet" type="text/css" href="../../../public/css/common.css">
        <link rel="stylesheet" type="text/css" href="../../../public/css/form.css">
    </head>
    <body>
        <div class="content">
            <?php require_once "../app/views/common/navigation.php" ?>
            <div id="form">
                <h5 class='message'><?php echo $data['message']; ?></h5>
                <form action="/PHPProject/root/public/admin/subjectsEditSubmit" method="POST">
                    <input type="hidden" class="textInput" name="id" value="<?php echo $data['subject'][0]['id'];?>">
                    <label for="name">Subject name:</label><br />
                    <input type="text" class="textInput" name="name" value="<?php echo $data['subject'][0]['subject_name'];?>"><br />
                    <a href="../../admin/subjects"><input type="button" class="buttonInput leftButton blueButton" value="Back"></a>
                    <input type="submit" class="buttonInput rightButton greenButton" value="Submit">
                </form>
            </div>
        </div>
    </body>
</html>