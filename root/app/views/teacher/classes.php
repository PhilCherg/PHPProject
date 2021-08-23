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
                $('.downArrow').toggle(0);
                $('.title').click(function(){
                    $(this).nextUntil('.title').toggle(0);
                    $(this).find('.upArrow').toggle(0);
                    $(this).find('.downArrow').toggle(0);
                });
                $('.myTable').DataTable( {
                    columns: [
                        null,
                        null,
                        { orderable: false }
                    ]
                } );
            } );  
        </script>
        <style>
            .dataTables_wrapper {
                margin-top: 10px;
            }
        </style>
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
                            echo "<h1 class='title titleFix'>Class: ".$class['class_name']."
                                <span class='add'>
                                    <a href='classesAddAssignment/".$class['id']."'><input type='button' class='button greenButton' value='Add'></a>
                                </span>
                                <span class='upArrow'>/\</span>
                                <span class='downArrow'>\/</span>
                            </h1>";
                            echo "<table class='classTable myTable'>
                                <thead>
                                    <tr>
                                        <th>Assignment</th>
                                        <th class='smallCol'>Weight</th>
                                        <th class='smallCol'>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>";
                            foreach($data['assignments'] as $assignment) {
                                foreach($data['classAssignments'] as $linkA) {
                                    if ($linkA['class_id'] == $class['id'] && $linkA['assignment_id'] == $assignment['id']) {
                                        echo "<tr class='assignment'>
                                            <td>".$assignment['assignment_title']."</td>
                                            <td>".$assignment['assignment_weight']."%</td>
                                            <td><a href='classesRemoveAssignment/".$class['id']."/".$assignment['id']."'><input type='button' class='button buttonBig redButton' value='Remove'></a></td>
                                        </tr>";
                                    }
                                }
                            }
                            echo "</tbody></table>";
                        }
                    }
                }
            ?>
        </div>
    </body>
</html>