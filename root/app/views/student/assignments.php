<!DOCTYPE html>
<html>
    <head>
        <title>All Assignments</title>
        <link rel="stylesheet" type="text/css" href="../../public/css/common.css">
        <link rel="stylesheet" type="text/css" href="../../public/css/table.css">
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
                    echo "<h1>Subject: ".$subject['subject_name']."</h1>";
                    echo "<table>
                        <tr>
                            <th class='smallCol'>Id</th>
                            <th>Assignment Name</th>
                            <th>Assignment Grade</th>
                        </tr>";
                    foreach($data['assignments'] as $assignment) {
                        if ($assignment['subject_id'] == $subject['id']) {
                            echo "<tr>
                                    <td>".$assignment['id']."</td>
                                    <td>".$assignment['assignment_title']."</td>
                                    <td>".$assignment['assignment_grade']."</td>
                            </tr>";
                        }
                    }
                    echo "</table>";
                }
            ?>
        </div>
    </body>
</html>