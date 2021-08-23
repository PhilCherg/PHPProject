<div class="menu">
    <ul>
        <?php
            if (isset($_SESSION['id'])) {
                if ($_SESSION['access'] == "admin") {
                    echo "<a href='/PHPProject/root/public/admin/index'><li class='leftButton ".($_SESSION['page'] == 'adminIndex' ? "highlight" : "")."'>Home</li></a>";
                    echo "<a href='/PHPProject/root/public/admin/classes'><li class='leftButton ".($_SESSION['page'] == 'adminClasses' ? "highlight" : "")."'>Classes</li></a>";
                    echo "<a href='/PHPProject/root/public/admin/subjects'><li class='leftButton ".($_SESSION['page'] == 'adminSubjects' ? "highlight" : "")."'>Subjects</li></a>";
                    echo "<a href='/PHPProject/root/public/admin/teachers'><li class='leftButton ".($_SESSION['page'] == 'adminTeachers' ? "highlight" : "")."'>Teachers</li></a>";
                    echo "<a href='/PHPProject/root/public/admin/students'><li class='leftButton ".($_SESSION['page'] == 'adminStudents' ? "highlight" : "")."'>Students</li></a>";
                    echo "<a href='/PHPProject/root/public/admin/grades'><li class='leftButton ".($_SESSION['page'] == 'adminGrades' ? "highlight" : "")."'>Grades</li></a>";
                    echo "<a href='/PHPProject/root/public/home/logout'><li class='rightButton'>Log Out</li></a>";    
                } else if ($_SESSION['access'] == "teacher") {
                    echo "<a href='/PHPProject/root/public/teacher/index'><li class='leftButton ".($_SESSION['page'] == 'teacherIndex' ? "highlight" : "")."'>Home</li></a>";
                    echo "<a href='/PHPProject/root/public/teacher/students'><li class='leftButton ".($_SESSION['page'] == 'teacherStudents' ? "highlight" : "")."'>Students</li></a>";
                    echo "<a href='/PHPProject/root/public/teacher/classes'><li class='leftButton ".($_SESSION['page'] == 'teacherClasses' ? "highlight" : "")."'>Classes</li></a>";
                    echo "<a href='/PHPProject/root/public/teacher/assignments'><li class='leftButton ".($_SESSION['page'] == 'teacherAssignments' ? "highlight" : "")."'>Assignments</li></a>";
                    echo "<a href='/PHPProject/root/public/home/logout'><li class='rightButton'>Log Out</li></a>";
                } else if ($_SESSION['access'] == "student") {
                    echo "<a href='/PHPProject/root/public/student/index'><li class='leftButton ".($_SESSION['page'] == 'studentIndex' ? "highlight" : "")."'>Home</li></a>";
                    echo "<a href='/PHPProject/root/public/student/assignments'><li class='leftButton ".($_SESSION['page'] == 'studentAssignments' ? "highlight" : "")."'>Assignments</li></a>";
                    echo "<a href='/PHPProject/root/public/home/logout'><li class='rightButton'>Log Out</li></a>";
                } else {
                    echo "<a href='/PHPProject/root/public/home/index'><li class='leftButton'>Home</li></a>";
                    echo "<a href='/PHPProject/root/public/home/login'><li class='rightButton'>Log In</li></a>";    
                }
            } else {
                echo "<a href='/PHPProject/root/public/home/index'><li class='leftButton ".($_SESSION['page'] == 'homeIndex' ? "highlight" : "")."'>Home</li></a>";
                echo "<a href='/PHPProject/root/public/home/login'><li class='rightButton ".($_SESSION['page'] == 'homeLogin' ? "highlight" : "")."'>Log In</li></a>";
            }
        ?>
    </ul>
</div>