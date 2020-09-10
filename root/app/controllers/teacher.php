<?php
    class Teacher extends Controller {
        public function __construct() {
            session_start();
        }
        
        public function index()
        {
            $_SESSION['message'] = "";
            $this->view("teacher/index");
        }

        public function classes()
        {
            require_once("../app/core/dbHandler.php");

            try {
                $stmt = $db->prepare("SELECT * FROM Teachers WHERE id = :id");
                $stmt->execute(['id' => $_SESSION['id']]);
                $teacher = $stmt->fetchAll();

                $stmt = $db->prepare("SELECT * FROM Classes");
                $stmt->execute();
                $classes = $stmt->fetchAll();

                $stmt = $db->prepare("SELECT * FROM Class_Teachers");
                $stmt->execute();
                $links = $stmt->fetchAll();

                $stmt = $db->prepare("SELECT * FROM Students");
                $stmt->execute();
                $students = $stmt->fetchAll();
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            $_SESSION['message'] = "";
            $this->view("teacher/classes", ['teacher' => $teacher, 'classes' => $classes, 'students' => $students, 'links' => $links]);
        }

        public function classesAddGrade($id) {
            require_once("../app/core/dbHandler.php");

            try {
                $stmt = $db->prepare("SELECT Subjects.id FROM Teachers LEFT JOIN Subjects ON Teachers.subject_id = Subjects.id;");
                $stmt->execute();
                $subject = $stmt->fetchAll();

                $stmt = $db->prepare("SELECT * FROM Students WHERE id = :id;");
                $stmt->execute(['id' => $id]);
                $student = $stmt->fetchAll();
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            if (!isset($_SESSION['message'])) { $_SESSION['message'] = ""; }
            $this->view("teacher/classesAddGrade", ['subject' => $subject, 'student' => $student, 'message' => $_SESSION['message']]);
        }

        public function classesAddGradeSubmit() {
            require_once("../app/core/dbHandler.php");
            
            if ($_POST['name'] == null || $_POST['grade'] == null) {
                $_SESSION['message'] = "Both the assignment name and grade are required.";
                header("Location:../teacher/classesAddGrade/".$_POST['student_id']);
            } else {
                try {
                    $stmt = $db->prepare("INSERT INTO Assignments(assignment_title, assignment_grade, subject_id, student_id)
                                                        VALUES(:assignment_name, :assignment_grade, :subject_id, :student_id);");
                    $stmt->execute(['assignment_name' => $_POST['name'],
                                    'assignment_grade' => $_POST['grade'],
                                    'subject_id' => $_POST['subject_id'],
                                    'student_id' => $_POST['student_id']]);
                    
                    header("Location:../teacher/classes");
                } catch(Exception $e) {
                    echo $e->getMessage();
                }
            }
            print_r($_POST);
        }
    }
?>