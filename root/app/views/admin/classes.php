<!DOCTYPE html>
<html>
    <head>
        <title>All Classes</title>
        <link rel="stylesheet" type="text/css" href="../../public/css/common.css">
        <link rel="stylesheet" type="text/css" href="../../public/css/table.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
        <script>
            $(document).ready( function () {
                $('#myTable').DataTable( {
                    columns: [
                        null,
                        null,
                        null,
                        { orderable: false },
                        { orderable: false },
                        { orderable: false }
                    ]
                } );
            } );  
        </script>
    </head>
    <body>
        <div class="content">
            <?php require_once "../app/views/common/navigation.php" ?>
            <div class="sectionHeading">
                <h1>Classes Overview</h1>
                <p>View all classes and their unique ID. Create new classes, as well as edit and delete existing ones.</p>
                <a href="classesCreate"><input type="button" class="button buttonSmall greenButton" value="New Class"></a>
            </div>
            <table class='display' id='myTable'>
                <thead>
                    <tr>
                        <th class="smallCol">Id</th>
                        <th class="smallCol">Name</th>
                        <th>Teachers</th>
                        <th class="smallCol">Assign Teacher</th>
                        <th class="smallCol">Edit</th>
                        <th class="smallCol">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($data['classes'] as $row) {
                            echo "<tr>
                                    <td>".$row['id']."</td>
                                    <td>".$row['class_name']."</td>
                                    <td>";
                            $teacherNames = "";
                            foreach ($data['teachers'] as $teacher) {
                                foreach ($data['links'] as $link) {
                                    if ($teacher['id'] == $link['teacher_id'] && $row['id'] == $link['class_id']) {
                                        $teacherNames .= "<strong>".$teacher['subject_name']."</strong>: ".$teacher['first_name']." ".$teacher['middle_name']." ".$teacher['last_name']."<a href='classesUnassignTeacher/".$row['id']."/".$teacher['id']."' class='rightButton'>X</a><br />";
                                    }
                                }
                            }
                            echo $teacherNames."</td>
                                    <td><a href='classesAssignTeacher/".$row['id']."'><input type='button' class='button buttonBig greenButton' value='Add Teacher'></a></td>
                                    <td><a href='classesEdit/".$row['id']."'><input type='button' class='button buttonBig blueButton' value='Edit'></a></td>
                                    <td><a href='classesDelete/".$row['id']."'><input type='button' class='button buttonBig redButton' value='Delete'></a></td>
                            </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>