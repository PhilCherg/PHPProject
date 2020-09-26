<?php
    require_once("../app/core/dbHandler.php");
    class Teacher extends Controller {
        public function __construct() {
            $this->db = new DbHandler;
            session_start();
        }
        
        public function index()
        {
            $_SESSION['message'] = "";
            $this->view("teacher/index");
        }

        public function students()
        {
            try {
                $teacher = $this->db->executeSQL("SELECT * FROM Teachers WHERE id = :id", ['id' => $_SESSION['id']]);
                $classes = $this->db->executeSQL("SELECT * FROM Classes", []);
                $links = $this->db->executeSQL("SELECT * FROM Class_Teachers", []);
                $students = $this->db->executeSQL("SELECT * FROM Students", []);
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            $_SESSION['message'] = "";
            $this->view("teacher/students", ['teacher' => $teacher, 'classes' => $classes, 'students' => $students, 'links' => $links]);
        }

        public function classes()
        {
            try {
                $teacher = $this->db->executeSQL("SELECT * FROM Teachers WHERE id = :id", ['id' => $_SESSION['id']]);
                $classes = $this->db->executeSQL("SELECT * FROM Classes", []);
                $classTeachers = $this->db->executeSQL("SELECT * FROM Class_Teachers", []);
                $assignments = $this->db->executeSQL("SELECT * FROM Assignments", []);
                $classAssignments = $this->db->executeSQL("SELECT * FROM Class_Assignments", []);
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            $_SESSION['message'] = "";
            $this->view("teacher/classes", ['teacher' => $teacher, 'classes' => $classes, 'classTeachers' => $classTeachers, 'assignments' => $assignments, 'classAssignments' => $classAssignments]);
        }

        public function assignments()
        {
            try {
                $teacher = $this->db->executeSQL("SELECT * FROM Teachers WHERE id = :id", ['id' => $_SESSION['id']]);
                $assignments = $this->db->executeSQL("SELECT * FROM Assignments", []);
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            $_SESSION['message'] = "";
            $this->view("teacher/assignments", ['teacher' => $teacher, 'assignments' => $assignments]);
        }

        public function assignmentsCreate() {
            try {
                $subject = $this->db->executeSQL("SELECT Subjects.id FROM Teachers LEFT JOIN Subjects ON Teachers.subject_id = Subjects.id;", []);
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            if (!isset($_SESSION['message'])) { $_SESSION['message'] = ""; }
            $this->view("teacher/assignmentsCreate", ['subject' => $subject, 'message' => $_SESSION['message']]);
        }

        public function assignmentsCreateSubmit() {  
            if ($_POST['name'] == null || $_POST['weight'] == null) {
                $_SESSION['message'] = "Both the assignment name and weight are required.";
                header("Location:../teacher/assignmentsCreate");
            } else {
                try {
                    $this->db->executeSQL("INSERT INTO Assignments(assignment_title, assignment_weight, subject_id) VALUES(:assignment_name, :assignment_weight, :subject_id);", ['assignment_name' => $_POST['name'], 'assignment_weight' => $_POST['weight'], 'subject_id' => $_POST['subject_id']]);                    
                    header("Location:../teacher/assignments");
                } catch(Exception $e) {
                    echo $e->getMessage();
                }
            }
        }

        public function assignmentsEdit($id) {
            try {
                $assignment = $this->db->executeSQL("SELECT * FROM Assignments WHERE id = :id", ['id' => $id]);
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            if (!isset($_SESSION['message'])) { $_SESSION['message'] = ""; }
            $this->view("teacher/assignmentsEdit", ['assignment' => $assignment, 'message' => $_SESSION['message']]);
        }

        public function assignmentsEditSubmit() {  
            if ($_POST['name'] == null || $_POST['weight'] == null) {
                $_SESSION['message'] = "Both the assignment name and weight are required.";
                header("Location:../teacher/assignmentsCreate");
            } else {
                try {
                    $this->db->executeSQL("UPDATE Assignments SET assignment_title = :name, assignment_weight = :weight WHERE id = :id", ['name' => $_POST['name'], 'weight' => $_POST['weight'], 'id' => $_POST['id']]);
                    header("Location:../teacher/assignments");
                } catch(Exception $e) {
                    echo $e->getMessage();
                }
            }
        }

        public function studentsInfo($id) {
            try {
                $subject = $this->db->executeSQL("SELECT Subjects.id FROM Teachers LEFT JOIN Subjects ON Teachers.subject_id = Subjects.id;", []);
                $student = $this->db->executeSQL("SELECT * FROM Students WHERE id = :id;", ['id' => $id]);
                $assignments = $this->db->executeSQL("SELECT Student_Assignments.id, assignment_title, assignment_weight, assignment_points, assignment_max FROM Student_Assignments LEFT JOIN Students ON student_id = Students.id LEFT JOIN Assignments on assignment_id = Assignments.id WHERE Students.id = :id;", ['id' => $id]);
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            if (!isset($_SESSION['message'])) { $_SESSION['message'] = ""; }
            $this->view("teacher/studentsInfo", ['subject' => $subject, 'student' => $student, 'assignments' => $assignments, 'message' => $_SESSION['message']]);
        }

        public function studentsInfoEdit($id) {
            try {
                $assignment = $this->db->executeSQL("SELECT Student_Assignments.id, assignment_title, assignment_points, assignment_max, student_id FROM Student_Assignments LEFT JOIN Assignments ON assignment_id = Assignments.id WHERE Student_Assignments.id = :id;", ['id' => $id]);
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            if (!isset($_SESSION['message'])) { $_SESSION['message'] = ""; }
            $this->view("teacher/studentsInfoEdit", ['assignment' => $assignment, 'message' => $_SESSION['message']]);
        }

        public function studentsInfoEditSubmit() {  
            if ($_POST['points'] == null) {
                $_SESSION['message'] = "The assignment points is required.";
                header("Location:../teacher/studentsInfoEdit/".$_POST['id']);
            } else if ((float)$_POST['points'] < 0 || (float)$_POST['points'] > (float)$_POST['max']) {
                $_SESSION['message'] = "The assignment points must be between 0 and ".$_POST['max'].".";
                header("Location:../teacher/studentsInfoEdit/".$_POST['id']);
            } else {
                try {
                    $this->db->executeSQL("UPDATE Student_Assignments SET assignment_points = :points WHERE id = :id", ['points' => $_POST['points'], 'id' => $_POST['id']]);
                    header("Location:../teacher/studentsInfo/".$_POST['student_id']);
                } catch(Exception $e) {
                    echo $e->getMessage();
                }
            }
        }
    }
?>