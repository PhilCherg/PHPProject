<!DOCTYPE html>
<html>
    <head>
        <title>All Students</title>
        <link rel="stylesheet" type="text/css" href="../../public/css/common.css">
        <link rel="stylesheet" type="text/css" href="../../public/css/table.css">
    </head>
    <body>
        <div class="content">
            <?php require_once "../app/views/common/navigation.php" ?>
            <div class="sectionHeading">
                <h1>Students Overview</h1>
                <p>View all students and their unique ID. Create new students, as well as edit and delete existing ones.</p>
                <a href="studentsCreate"><input type="button" class="button buttonSmall greenButton" value="New Student"></a>
            </div>
            <table>
                <tr>
                    <th class="smallCol">Id</th>
                    <th>Username</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Class</th>
                    <th class="smallCol">Edit</th>
                    <th class="smallCol">Delete</th>
                </tr>
                <?php
                    foreach($data['students'] as $row) {
                        $className;
                        foreach ($data['classes'] as $class) {
                            if ($row['class_id'] == $class['id']) {
                                $className = $class['class_name'];
                            }
                        }
                        echo "<tr>
                                <td>".$row['id']."</td>
                                <td>".$row['username']."</td>
                                <td>".$row['first_name']."</td>
                                <td>".$row['middle_name']."</td>
                                <td>".$row['last_name']."</td>
                                <td>".$className."</td>
                                <td><a href='studentsEdit/".$row['id']."'><input type='button' class='button buttonBig blueButton' value='Edit'></a></td>
                                <td><a href='studentsDelete/".$row['id']."'><input type='button' class='button buttonBig redButton' value='Delete'></a></td>
                            </tr>";
                    }
                ?>
            </table>
        </div>
    </body>
</html>