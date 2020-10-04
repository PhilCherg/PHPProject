<!DOCTYPE html>
<html>
    <head>
        <title>All Assignments</title>
        <link rel="stylesheet" type="text/css" href="../../public/css/common.css">
        <link rel="stylesheet" type="text/css" href="../../public/css/table.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $('.toggleTable').slideToggle(0);
                $('.title').click(function(){
                    $(this).nextUntil('.title').slideToggle(1);
                });
            });
        </script>
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
                        if ($assignment['assignment_points'] != null) {
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
                    echo ": ".$average."%</h1>
                        <table class='toggleTable'>
                        <tr>
                            <th>Assignment</th>
                            <th class='smallCol'>Score</th>
                            <th class='smallCol'>Weight</th>
                        </tr>";
                    foreach ($data['assignments'] as $assignment) {
                        if ($assignment['subject_id'] == $subject['id']) {
                            echo "<tr>
                                <td>".$assignment['assignment_title']."</td>
                                <td>".$assignment['assignment_points']." / ".$assignment['assignment_max']." (".round((float)$assignment['assignment_points'] / (float)$assignment['assignment_max'] * 100, 2)."%)</td>
                                <td>".$assignment['assignment_weight']."%</td>
                            </tr>";
                        }
                    }
                    echo "</table>";
                }
            ?>
        </div>
    </body>
</html>