<!DOCTYPE html>
<html>
    <head>
        <title>All Teachers</title>
        <link rel="stylesheet" type="text/css" href="../../public/css/common.css">
        <link rel="stylesheet" type="text/css" href="../../public/css/table.css">
    </head>
    <body>
        <div class="content">
            <?php require_once "../app/views/common/navigation.php" ?>
            <div class="sectionHeading">
                <h1>Teachers Overview</h1>
                <p>View all teachers and their unique ID. Create new teachers, as well as edit and delete existing ones.</p>
                <a href="teachersCreate"><input type="button" class="button buttonSmall greenButton" value="New Teacher"></a>
            </div>
            <table>
                <tr>
                    <th class="smallCol">Id</th>
                    <th>Username</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Subject</th>
                    <th class="smallCol">Edit</th>
                    <th class="smallCol">Delete</th>
                </tr>
                <?php
                    foreach($data['teachers'] as $row) {
                        $subjectName;
                        foreach ($data['subjects'] as $subject) {
                            if ($row['subject_id'] == $subject['id']) {
                                $subjectName = $subject['subject_name'];
                            }
                        }
                        echo "<tr>
                                <td>".$row['id']."</td>
                                <td>".$row['username']."</td>
                                <td>".$row['first_name']."</td>
                                <td>".$row['middle_name']."</td>
                                <td>".$row['last_name']."</td>
                                <td>".$subjectName."</td>
                                <td><a href='teachersEdit/".$row['id']."'><input type='button' class='button buttonBig blueButton' value='Edit'></a></td>
                                <td><a href='teachersDelete/".$row['id']."'><input type='button' class='button buttonBig redButton' value='Delete'></a></td>
                            </tr>";
                    }
                ?>
            </table>
        </div>
    </body>
</html>