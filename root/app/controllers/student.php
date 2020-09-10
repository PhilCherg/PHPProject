<?php
    class Student extends Controller {
        public function __construct() {
            session_start();
        }
        
        public function index()
        {
            $this->view("student/index");
        }

        public function assignments()
        {
            require_once("../app/core/dbHandler.php");

            try {
                $stmt = $db->prepare("SELECT * FROM Students 
                                        LEFT JOIN Classes 
                                        ON class_id = Classes.id 
                                        WHERE Students.id = :id;");
                $stmt->execute(['id' => $_SESSION['id']]);
                $student = $stmt->fetchAll();

                $stmt = $db->prepare("SELECT * FROM Classes 
                                        LEFT JOIN Class_Teachers 
                                        ON Classes.id = Class_Teachers.class_id 
                                        LEFT JOIN Teachers 
                                        ON Class_Teachers.teacher_id = Teachers.id 
                                        LEFT JOIN Subjects ON Teachers.subject_id = Subjects.id 
                                        WHERE Classes.id = :class_id;");
                $stmt->execute(['class_id' => $student[0]['class_id']]);
                $subjects = $stmt->fetchAll();

                $stmt = $db->prepare("SELECT * FROM Assignments WHERE student_id = :id");
                $stmt->execute(['id' => $_SESSION['id']]);
                $assignments = $stmt->fetchAll();
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            $this->view("student/assignments", ['student' => $student, 'subjects' => $subjects, 'assignments' => $assignments]);
        }
    }
?>