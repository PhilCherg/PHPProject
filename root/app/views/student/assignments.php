<!DOCTYPE html>
<html>
    <head>
        <title>All Assignments</title>
        <link rel="stylesheet" type="text/css" href="../../public/css/common.css">
        <link rel="stylesheet" type="text/css" href="../../public/css/table.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $('.subjectTable').slideToggle(200);
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
                <h1>Assignments Overview</h1>
                <p>View all assignments in each of your subjects.</p>
            </div>
            <?php
                foreach ($data['subjects'] as $subject) {
                    echo "<h1 class='title'>".$subject['subject_name']."</h1>";
                    echo "<table class='subjectTable'>
                        <tr>
                            <th class='smallCol'>Id</th>
                            <th>Assignment Name</th>
                            <th>Assignment Grade</th>
                            <th>Assignment Weight</th>
                        </tr>";
                    foreach($data['assignments'] as $assignment) {
                        if ($assignment['subject_id'] == $subject['id']) {
                            echo "<tr>
                                    <td>".$assignment['id']."</td>
                                    <td>".$assignment['assignment_title']."</td>
                                    <td>".$assignment['assignment_grade']."</td>
                                    <td>".$assignment['assignment_weight']."</td>
                            </tr>";
                        }
                    }
                    echo "</table>";
                }
            ?>
        </div>
    </body>
</html>