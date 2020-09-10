<!DOCTYPE html>
<html>
    <head>
        <title>All Subjects</title>
        <link rel="stylesheet" type="text/css" href="../../public/css/common.css">
        <link rel="stylesheet" type="text/css" href="../../public/css/table.css">
    </head>
    <body>
        <div class="content">
            <?php require_once "../app/views/common/navigation.php" ?>
            <div class="sectionHeading">
                <h1>Subjects Overview</h1>
                <p>View all subjects and their unique ID. Create new subjecs, as well as edit and delete existing ones.</p>
                <a href="subjectsCreate"><input type="button" class="button buttonSmall greenButton" value="New Subject"></a>
            </div>
            <table>
                <tr>
                    <th class="smallCol">Id</th>
                    <th>Name</th>
                    <th class="smallCol">Edit</th>
                    <th class="smallCol">Delete</th>
                </tr>
                <?php
                    foreach($data['subjects'] as $row) {
                        echo "<tr>
                                <td>".$row['id']."</td>
                                <td>".$row['subject_name']."</td>
                                <td><a href='subjectsEdit/".$row['id']."'><input type='button' class='button buttonBig blueButton' value='Edit'></a></td>
                                <td><a href='subjectsDelete/".$row['id']."'><input type='button' class='button buttonBig redButton' value='Delete'></a></td>
                            </tr>";
                    }
                ?>
            </table>
        </div>
    </body>
</html>