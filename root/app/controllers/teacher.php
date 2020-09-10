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

        public function classes()
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
            $this->view("teacher/classes", ['teacher' => $teacher, 'classes' => $classes, 'students' => $students, 'links' => $links]);
        }

        public function classesAddGrade($id) {
            try {
                $subject = $this->db->executeSQL("SELECT Subjects.id FROM Teachers LEFT JOIN Subjects ON Teachers.subject_id = Subjects.id;", []);
                $student = $this->db->executeSQL("SELECT * FROM Students WHERE id = :id;", ['id' => $id]);
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            if (!isset($_SESSION['message'])) { $_SESSION['message'] = ""; }
            $this->view("teacher/classesAddGrade", ['subject' => $subject, 'student' => $student, 'message' => $_SESSION['message']]);
        }

        public function classesAddGradeSubmit() {  
            if ($_POST['name'] == null || $_POST['grade'] == null) {
                $_SESSION['message'] = "Both the assignment name and grade are required.";
                header("Location:../teacher/classesAddGrade/".$_POST['student_id']);
            } else {
                try {
                    $this->db->executeSQL("INSERT INTO Assignments(assignment_title, assignment_grade, subject_id, student_id) VALUES(:assignment_name, :assignment_grade, :subject_id, :student_id);", ['assignment_name' => $_POST['name'], 'assignment_grade' => $_POST['grade'], 'subject_id' => $_POST['subject_id'], 'student_id' => $_POST['student_id']]);                    
                    header("Location:../teacher/classes");
                } catch(Exception $e) {
                    echo $e->getMessage();
                }
            }
        }
    }
?>