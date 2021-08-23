<!DOCTYPE html>
<html>
    <head>
        <title>All Grades</title>
        <link rel="stylesheet" type="text/css" href="../../public/css/common.css">
        <link rel="stylesheet" type="text/css" href="../../public/css/table.css">
        <link rel="stylesheet" type="text/css" href="../../public/css/form.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css"> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
        <script>
            $(document).ready( function () {
                $('.downArrow').toggle(0);
                $('.title').click(function(){
                    $(this).nextUntil('.title').toggle(0);
                    $('.upArrow').toggle(0);
                    $('.downArrow').toggle(0);
                });
                $('#myTable').DataTable( {
                    columns: [
                        null,
                        null,
                        null,
                        null,
                        { orderable: false },
                    ]
                } );
            } );  
        </script>
    </head>
    <body>
        <div class="content">
            <?php require_once "../app/views/common/navigation.php" ?>
            <div class="sectionHeading">
                <h1>Students Overview</h1>
                <p>View all classes and the students in them. Check individual information for each student.</p>
                <div id="form">
                    <form action="/PHPProject/root/public/admin/grades" method="GET">
                        <select name="classId" class="textInput">
                            <option value="" type="readonly">Select Class</option>
                            <?php
                                foreach ($data['classes'] as $class) {
                                    if($class['id'] == $data['class'][0]['id']) {
                                        echo "<option selected='selected' value='".$class['id']."'>".$class['class_name']."</option>";
                                    } else {
                                        echo "<option value='".$class['id']."'>".$class['class_name']."</option>";
                                    }
                                }
                            ?>
                        </select><br />
                        <input type="submit" class="buttonInput greenButton" value="Choose">
                    </form>
                </div>
            </div>
            
            <?php
                if($data['class'] != null) {
                    echo "<table class='classTable display' id='myTable'>
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
                        echo "<tr class='student'>
                                <td>".$student['id']."</td>
                                <td>".$student['first_name']."</td>
                                <td>".$student['middle_name']."</td>
                                <td>".$student['last_name']."</td>
                                <td><a href='studentsInfo/".$student['id']."'><input type='button' class='button buttonBig blueButton' value='Info'></a></td>
                        </tr>";
                    }
                    echo "</tbody></table>";
                }   
            ?>
        </div>
    </body>
</html>