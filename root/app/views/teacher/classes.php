<!DOCTYPE html>
<html>
    <head>
        <title>All Classes</title>
        <link rel="stylesheet" type="text/css" href="../../public/css/common.css">
        <link rel="stylesheet" type="text/css" href="../../public/css/table.css">
    </head>
    <body>
        <div class="content">
            <?php require_once "../app/views/common/navigation.php" ?>
            <div class="sectionHeading">
                <h1>Classes Overview</h1>
                <p>View all classes and the students in them. Add new individual grades to students.</p>
            </div>
            <?php
                foreach ($data['classes'] as $class) {
                    foreach ($data['links'] as $link) {
                        if ($link['class_id'] == $class['id'] && $link['teacher_id'] == $data['teacher'][0]['id']) {
                            echo "<h1>Class: ".$class['class_name']."</h1>";
                            echo "<table>
                                <tr>
                                    <th class='smallCol'>Id</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th class='smallCol'>Add Grade</th>
                                </tr>";
                            foreach($data['students'] as $student) {
                                if ($student['class_id'] == $class['id']) {
                                    echo "<tr>
                                            <td>".$student['id']."</td>
                                            <td>".$student['first_name']."</td>
                                            <td>".$student['middle_name']."</td>
                                            <td>".$student['last_name']."</td>
                                            <td><a href='classesAddGrade/".$student['id']."'><input type='button' class='button buttonBig greenButton' value='Add Grade'></a></td>
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