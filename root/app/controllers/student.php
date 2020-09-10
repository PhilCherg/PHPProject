<?php
    require_once("../app/core/dbHandler.php");
    class Student extends Controller {
        private $db;

        public function __construct() {
            $this->db = new DbHandler;
            session_start();
        }
        
        public function index()
        {
            $_SESSION['message'] = "";
            $this->view("student/index");
        }

        public function assignments()
        {
            try {
                $student = $this->db->executeSQL("SELECT * FROM Students LEFT JOIN Classes ON class_id = Classes.id WHERE Students.id = :id;", ['id' => $_SESSION['id']]);
                $subjects = $this->db->executeSQL("SELECT * FROM Classes LEFT JOIN Class_Teachers ON Classes.id = Class_Teachers.class_id LEFT JOIN Teachers ON Class_Teachers.teacher_id = Teachers.id LEFT JOIN Subjects ON Teachers.subject_id = Subjects.id WHERE Classes.id = :class_id;", ['class_id' => $student[0]['class_id']]);
                $assignments = $this->db->executeSQL("SELECT * FROM Assignments WHERE student_id = :id", ['id' => $_SESSION['id']]);
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            $this->view("student/assignments", ['student' => $student, 'subjects' => $subjects, 'assignments' => $assignments]);
        }
    }
?>