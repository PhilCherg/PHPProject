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

        public function classesStudentInfo($id) {
            try {
                $subject = $this->db->executeSQL("SELECT Subjects.id FROM Teachers LEFT JOIN Subjects ON Teachers.subject_id = Subjects.id;", []);
                $student = $this->db->executeSQL("SELECT * FROM Students WHERE id = :id;", ['id' => $id]);
                $assignments = $this->db->executeSQL("SELECT * FROM Assignments WHERE student_id = :id;", ['id' => $id]);
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            if (!isset($_SESSION['message'])) { $_SESSION['message'] = ""; }
            $this->view("teacher/classesAddGrade", ['subject' => $subject, 'student' => $student, 'assignments' => $assignments, 'message' => $_SESSION['message']]);
        }
    }
?>