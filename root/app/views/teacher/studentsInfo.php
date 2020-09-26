<!DOCTYPE html>
<html>
    <head>
        <title>Student Info</div></title>
        <link rel="stylesheet" type="text/css" href="../../../public/css/common.css">
        <link rel="stylesheet" type="text/css" href="../../../public/css/table.css">
    </head>
    <body>
        <div class="content">
            <?php require_once "../app/views/common/navigation.php" ?>
            <div class="sectionHeading">
                <h1><?php echo $data['student'][0]['first_name']." ".$data['student'][0]['last_name'];?>'s Grades</h1>
                <?php
                    $average = 0;
                    $total = 0;
                    foreach ($data['assignments'] as $assignment) {
                        $total += round((float)$assignment['assignment_weight'], 2);
                    }
                    foreach ($data['assignments'] as $assignment) {
                        $score = round((float)$assignment['assignment_points'] / (float)$assignment['assignment_max'] * 100, 2);
                        $average += round($score * $assignment['assignment_weight'] / $total, 2);
                    }
                    if ($average == 0) $average = "--";
                    echo "<h1>".$average."%</h1>";
                ?>
            </div>
            <table>
                <tr>
                    <th>Assignment</th>
                    <th class='smallCol'>Score</th>
                    <th class='smallCol'>Weight</th>
                    <th class='smallCol'>Edit</th>
                </tr>
                <?php 
                    foreach ($data['assignments'] as $assignment) {
                        echo "<tr>
                            <td>".$assignment['assignment_title']."</td>
                            <td>".$assignment['assignment_points']." / ".$assignment['assignment_max']." (".round((float)$assignment['assignment_points'] / (float)$assignment['assignment_max'] * 100, 2)."%)</td>
                            <td>".$assignment['assignment_weight']."%</td>
                            <td><a href='../studentsInfoEdit/".$assignment['id']."'><input type='button' class='button buttonBig blueButton' value='Edit'></a></td>
                        </tr>";
                    }
                
                ?>
            </table>
        </div>
    </body>
</html>