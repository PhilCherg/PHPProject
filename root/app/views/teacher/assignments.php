<!DOCTYPE html>
<html>
    <head>
        <title>All Assignments</title>
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
                <h1>Assignments Overview</h1>
                <p>View, create, edit, and delete assignments.</p>
                <a href="assignmentsCreate"><input type="button" class="button buttonSmall greenButton" value="Create"></a>
            </div>
            <table>
                <tr>
                    <th class="smallCol">Id</th>
                    <th>Assignment</th>
                    <th class='smallCol'>Weight</th>
                    <th class='smallCol'>Edit</th>
                    <th class='smallCol'>Delete</th>
                </tr>
                <?php
                    foreach($data['assignments'] as $assignment) {
                        if ($assignment['subject_id'] == $data['teacher'][0]['subject_id']) {
                            echo "<tr>
                                <td>".$assignment['id']."</td>
                                <td>".$assignment['assignment_title']."</td>
                                <td>".$assignment['assignment_weight']."</td>
                                <td><a href='assignmentsEdit/".$assignment['id']."'><input type='button' class='button buttonBig blueButton' value='Edit'></a></td>
                                <td><a href='assignmentsDelete/".$assignment['id']."'><input type='button' class='button buttonBig redButton' value='Delete'></a></td>
                            <tr>";
                        }
                    }
                ?>
            </table>
        </div>
    </body>
</html>