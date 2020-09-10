<!DOCTYPE html>
<html>
    <head>
        <title>Create Class</title>
        <link rel="stylesheet" type="text/css" href="../../public/css/common.css">
        <link rel="stylesheet" type="text/css" href="../../public/css/form.css">
    </head>
    <body>
        <div class="content">
            <?php require_once "../app/views/common/navigation.php" ?>
            <div id="form">
                <h5 class='message'><?php echo $data['message']; ?></h5>
                <form action="/PHPProject/root/public/admin/classesCreateSubmit" method="POST">
                    <label for="name">Class name:</label><br />
                    <input type="text" class="textInput" name="name" placeholder="Name"><br />
                    <a href="../admin/classes"><input type="button" class="buttonInput leftButton blueButton" value="Back"></a>
                    <input type="submit" class="buttonInput rightButton greenButton" value="Create">
                </form>
            </div>
        </div>
    </body>
</html>