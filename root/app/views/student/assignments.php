<!DOCTYPE html>
<html>
    <head>
        <title>All Assignments</title>
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
                $('.myTable').DataTable( {} );
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
                <h1>Assignments Overview</h1>
                <p>View all assignments in each of your subjects.</p>
            </div>
            <?php 
                foreach ($data['subjects'] as $subject) {
                    echo "<h1 class='title'>".$subject['subject_name'];
                    $average = 0;
                    $total = 0;
                    foreach ($data['assignments'] as $assignment) {
                        if ($assignment['subject_id'] == $subject['id'] && $assignment['assignment_points'] != null) {
                            $total += round((float)$assignment['assignment_weight'], 2);
                        }
                    }
                    foreach ($data['assignments'] as $assignment) {
                        $score = round((float)$assignment['assignment_points'] / (float)$assignment['assignment_max'] * 100, 2);
                        if ($total != 0) {
                            $average += round($score * $assignment['assignment_weight'] / $total, 2);
                        }
                    }
                    if ($average == 0) $average = "--";
                    echo ": ".$average."%<span class='upArrow'>/\</span>
                    <span class='downArrow'>\/</span></h1>
                        <table class='toggleTable display myTable'>
                        <thead>
                            <tr>
                                <th>Assignment</th>
                                <th class='smallCol'>Weight</th>
                                <th class='mediumCol'>Score</th>
                            </tr>
                        </thead>
                        <tbody>";
                    foreach ($data['assignments'] as $assignment) {
                        if ($assignment['subject_id'] == $subject['id']) {
                            echo "<tr>
                                <td>".$assignment['assignment_title']."</td>
                                <td>".$assignment['assignment_weight']."%</td>
                                <td>".$assignment['assignment_points']." / ".$assignment['assignment_max']." (".round((float)$assignment['assignment_points'] / (float)$assignment['assignment_max'] * 100, 2)."%)</td>
                            </tr>";
                        }
                    }
                    echo "</tbody></table>";
                }
            ?>
        </div>
    </body>
</html>