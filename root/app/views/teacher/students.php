<!DOCTYPE html>
<html>
    <head>
        <title>All Students</title>
        <link rel="stylesheet" type="text/css" href="../../public/css/common.css">
        <link rel="stylesheet" type="text/css" href="../../public/css/table.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $('.title').click(function(){
                    $(this).nextUntil('.title').slideToggle(200);
                });
                $('.student').click(function(){
                    $(this).nextUntil('.student').slideToggle(200);
                });
            });
        </script>
    </head>
    <body>
        <div class="content">
            <?php require_once "../app/views/common/navigation.php" ?>
            <div class="sectionHeading">
                <h1>Students Overview</h1>
                <p>View all classes and the students in them. Check individual information for each student.</p>
            </div>
            <?php
                foreach ($data['classes'] as $class) {
                    foreach ($data['links'] as $link) {
                        if ($link['class_id'] == $class['id'] && $link['teacher_id'] == $data['teacher'][0]['id']) {
                            echo "<h1 class='title'>Class: ".$class['class_name']."</h1>";
                            echo "<table class='classTable'>
                                <tr>
                                    <th class='smallCol'>Id</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th class='smallCol'>Add Grade</th>
                                </tr>";
                            foreach($data['students'] as $student) {
                                if ($student['class_id'] == $class['id']) {
                                    echo "<tr class='student'>
                                            <td>".$student['id']."</td>
                                            <td>".$student['first_name']."</td>
                                            <td>".$student['middle_name']."</td>
                                            <td>".$student['last_name']."</td>
                                            <td><a href='classesStudentInfo/".$student['id']."'><input type='button' class='button buttonBig blueButton' value='Info'></a></td>
                                    </tr>";
                                }
                            }
                            echo "</table>";
                        }
                    }
                }
            ?>
        </div>
    </body>
</html>