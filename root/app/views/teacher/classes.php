<!DOCTYPE html>
<html>
    <head>
        <title>All Classes</title>
        <link rel="stylesheet" type="text/css" href="../../public/css/common.css">
        <link rel="stylesheet" type="text/css" href="../../public/css/table.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $('.classTable').slideToggle(200);
                $('.title').click(function(){
                    $(this).nextUntil('.title').slideToggle(200);
                });
            });
        </script>
    </head>
    <body>
        <div class="content">
            <?php require_once "../app/views/common/navigation.php" ?>
            <div class="sectionHeading">
                <h1>Classes Overview</h1>
                <p>View all classes and the assignments in them. Add assignments that you have created.</p>
            </div>
            <?php
                foreach ($data['classes'] as $class) {
                    foreach ($data['classTeachers'] as $linkT) {
                        if ($linkT['class_id'] == $class['id'] && $linkT['teacher_id'] == $data['teacher'][0]['id']) {
                            echo "<h1 class='title'>Class: ".$class['class_name']."</h1>";
                            echo "<table class='classTable'>
                                <tr>
                                    <th>Assignment</th>
                                    <th class='smallCol'>Weight</th>
                                    <th class='smallCol'></th>
                                </tr>";
                            foreach($data['assignments'] as $assignment) {
                                foreach($data['classAssignments'] as $linkA) {
                                    if ($linkA['class_id'] == $class['id'] && $linkA['assignment_id'] == $assignment['id']) {
                                        echo "<tr class='assignment'>
                                            <td>".$assignment['assignment_title']."</td>
                                            <td>".$assignment['assignment_weight']."</td>
                                            <td><a href='classesRemoveAssignment/".$assignment['id']."'><input type='button' class='button buttonBig redButton' value='Remove'></a></td>
                                        </tr>";
                                    }
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