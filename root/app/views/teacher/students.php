<!DOCTYPE html>
<html>
    <head>
        <title>All Students</title>
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
                <h1>Students Overview</h1>
                <p>View all classes and the students in them. Check individual information for each student.</p>
            </div>
            <?php
                foreach ($data['classes'] as $class) {
                    foreach ($data['links'] as $link) {
                        if ($link['class_id'] == $class['id'] && $link['teacher_id'] == $data['teacher'][0]['id']) {
                            echo "<h1 class='title'>Class: ".$class['class_name']."<span class='upArrow'>/\</span><span class='downArrow'>\/</span></h1>";
                            echo "<table class='classTable display myTable'>
                                <thead>    
                                    <tr>
                                        <th class='smallCol'>Id</th>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th class='smallCol'>Add Grade</th>
                                    </tr>
                                </thead>
                                <tbody>";
                            foreach($data['students'] as $student) {
                                if ($student['class_id'] == $class['id']) {
                                    echo "<tr class='student'>
                                            <td>".$student['id']."</td>
                                            <td>".$student['first_name']."</td>
                                            <td>".$student['middle_name']."</td>
                                            <td>".$student['last_name']."</td>
                                            <td><a href='studentsInfo/".$student['id']."'><input type='button' class='button buttonBig blueButton' value='Info'></a></td>
                                    </tr>";
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