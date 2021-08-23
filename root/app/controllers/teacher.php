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
            $_SESSION['page'] = "teacherIndex";
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
            $_SESSION['page'] = "teacherStudents";
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
            $_SESSION['page'] = "teacherClasses";
            $this->view("teacher/classes", ['teacher' => $teacher, 'classes' => $classes, 'classTeachers' => $classTeachers, 'assignments' => $assignments, 'classAssignments' => $classAssignments]);
        }

        public function classesAddAssignment($id)
        {
            try {
                $class = $this->db->executeSQL("SELECT * FROM Classes WHERE id = :id", ['id' => $id]);
                $assignments = $this->db->executeSQL("SELECT * FROM Assignments", []);
                $teacher = $this->db->executeSQL("SELECT * FROM Teachers WHERE id = :id", ['id' => $_SESSION['id']]);
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            if (!isset($_SESSION['message'])) { $_SESSION['message'] = ""; }
            $this->view("teacher/classesAddAssignment", ['class' => $class, 'teacher' => $teacher, 'assignments' => $assignments]);
        }

        public function classesAddAssignmentSubmit() {
            if ($_POST['assignment_id'] == null) {
                $_SESSION['message'] = "You must choose an assignment to assign to this class.";
                header("Location:../teacher/classesAddAssignment/".$_POST['class_id']);
            } else {
                try {
                    $allLinks = $this->db->executeSQL("SELECT * FROM Class_Assignments;", []);
                    $students = $this->db->executeSQL("SELECT * FROM Students WHERE class_id = :id", ['id' => $_POST['class_id']]);
                    $unique = true;
                    foreach ($allLinks as $link) {
                        if ($link['class_id'] == $_POST['class_id'] && $link['assignment_id'] == $_POST['assignment_id']) $unique = false;
                    }
                    if ($unique) {
                        $this->db->executeSQL("INSERT INTO Class_Assignments(class_id, assignment_id) VALUES(:class_id, :assignment_id);", ['class_id' => $_POST['class_id'], 'assignment_id' => $_POST['assignment_id']]);
                        foreach ($students as $student) {
                            $this->db->executeSQL("INSERT INTO Student_Assignments(student_id, assignment_id) VALUES(:student_id, :assignment_id);", ['student_id' => $student['id'], 'assignment_id' => $_POST['assignment_id']]);
                        }
                        header("Location:../teacher/classes");
                    } else {
                        $_SESSION['message'] = "This assignment has already been added to this class.";
                        header("Location:../teacher/classesAddAssignment/".$_POST['class_id']);
                    }       
                } catch(Exception $e) {
                    echo $e->getMessage();
                }
            }
        }

        public function classesRemoveAssignment($class_id, $assignment_id) {
            try {
                $students = $this->db->executeSQL("SELECT * FROM Students WHERE class_id = :id", ['id' => $class_id]);
                    
                $this->db->executeSQL("DELETE FROM Class_Assignments WHERE class_id = :class_id AND assignment_id = :assignment_id;", ['class_id' => $class_id, 'assignment_id' => $assignment_id]);
                foreach ($students as $student) {
                    $this->db->executeSQL("DELETE FROM Student_Assignments WHERE student_id = :student_id AND assignment_id = :assignment_id;", ['student_id' => $student['id'], 'assignment_id' => $assignment_id]);
                }
                header("Location:../../../teacher/classes");
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public function assignments() {
            try {
                $teacher = $this->db->executeSQL("SELECT * FROM Teachers WHERE id = :id", ['id' => $_SESSION['id']]);
                $assignments = $this->db->executeSQL("SELECT * FROM Assignments", []);
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            $_SESSION['message'] = "";
            $_SESSION['page'] = "teacherAssignments";
            $this->view("teacher/assignments", ['teacher' => $teacher, 'assignments' => $assignments]);
        }

        public function assignmentsCreate() {
            try {
                $subject = $this->db->executeSQL("SELECT Subjects.id FROM Teachers LEFT JOIN Subjects ON Teachers.subject_id = Subjects.id;", []);
                $assignments = $this->db->executeSQL("SELECT assignment_weight FROM Assignments;", []);
                $availableWeight = 100;
                foreach ($assignments as $assignment) {
                    $availableWeight -= $assignment['assignment_weight'];
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            if (!isset($_SESSION['message'])) { $_SESSION['message'] = ""; }
            $this->view("teacher/assignmentsCreate", ['subject' => $subject, 'availableWeight' => $availableWeight, 'message' => $_SESSION['message']]);
        }

        public function assignmentsCreateSubmit() {  
            if ($_POST['name'] == null || (float)$_POST['weight'] == null || (float)$_POST['max'] == null) {
                $_SESSION['message'] = "The assignment name, max, and weight are required.";
                header("Location:../teacher/assignmentsCreate");
            } else if ((float)$_POST['weight'] > (float)$_POST['availableWeight']) {
                $_SESSION['message'] = "The assignment weight cannot exceed the available weight.";
                header("Location:../teacher/assignmentsCreate");
            } else {
                try {
                    $this->db->executeSQL("INSERT INTO Assignments(assignment_title, assignment_max, assignment_weight, subject_id) VALUES(:assignment_name, :assignment_max, :assignment_weight, :subject_id);", ['assignment_name' => $_POST['name'], 'assignment_max' => $_POST['max'], 'assignment_weight' => $_POST['weight'], 'subject_id' => $_POST['subject_id']]);                    
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

        public function assignmentsDelete($id) {
            try {
                $this->db->executeSQL("DELETE FROM Assignments WHERE id = :id;", ['id' => $id]);
                header("Location:../../teacher/assignments");
            } catch(Exception $e) {
                echo $e->getMessage();
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
            if ((float)$_POST['points'] == null) {
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