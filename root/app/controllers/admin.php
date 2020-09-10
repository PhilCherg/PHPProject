<?php
    require_once("../app/core/dbHandler.php");
    class Admin extends Controller {
        private $db;
        
        public function __construct() {
            $this->db = new DbHandler;
            session_start();
        }
        
        public function index()
        {
            $_SESSION['message'] = "";
            $this->view("admin/index");
        }
        
        public function classes()
        {
            try {
                $classes = $this->db->executeSQL("SELECT * FROM Classes", []);
                $teachers = $this->db->executeSQL("SELECT Teachers.id, Subjects.subject_name, Teachers.first_name, Teachers.middle_name, Teachers.last_name FROM Teachers LEFT JOIN Subjects ON Teachers.subject_id = Subjects.id;", []);
                $links = $this->db->executeSQL("SELECT * FROM Class_Teachers", []);
                $_SESSION['message'] = "";
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            $this->view("admin/classes", ['classes' => $classes, 'teachers' => $teachers, 'links' => $links]);
        }

        public function classesCreate() {
            if (!isset($_SESSION['message'])) { $_SESSION['message'] = ""; }
            $this->view("admin/classesCreate", ['message' => $_SESSION['message']]);
        }

        public function classesCreateSubmit() {
            if ($_POST['name'] == null) {
                $_SESSION['message'] = "The class name cannot be empty.";
                header("Location:../admin/classesCreate");
            } else {
                try {
                    $allClasses = $this->db->executeSQL("SELECT * FROM Classes;", []);
                    $unique = true;
                    foreach($allClasses as $class) {
                        if ($class['class_name'] == $_POST['name']) $unique = false;
                    }
                    if ($unique) {
                        $this->db->executeSQL("INSERT INTO Classes(class_name) VALUES(:name);", ['name' => $_POST['name']]);
                        header("Location:../admin/classes");
                    } else {
                        $_SESSION['message'] = "A class with this name already exists.";
                        header("Location:../admin/classesCreate");
                    }   
                } catch(Exception $e) {
                    echo $e->getMessage();
                }
            }
        }

        public function classesAssignTeacher($id) {
            try {
                $teachers = $this->db->executeSQL("SELECT Teachers.id, Subjects.subject_name, Teachers.first_name, Teachers.middle_name, Teachers.last_name FROM Teachers LEFT JOIN Subjects ON Teachers.subject_id = Subjects.id;", []);
                $class = $this->db->executeSQL("SELECT * FROM Classes WHERE id = :id", ['id' => $id]);
            } catch(Exception $e) {
                echo $e->getMessage();
            }
            if (!isset($_SESSION['message'])) { $_SESSION['message'] = ""; }
            $this->view("admin/classesAssignTeacher", ['class' => $class, 'teachers' => $teachers, 'message' => $_SESSION['message']]);
        }

        public function classesAssignTeacherSubmit() {
            if ($_POST['teacher_id'] == null) {
                $_SESSION['message'] = "You must choose a teacher to assign to this class.";
                header("Location:../admin/classesAssignTeacher/".$_POST['class_id']);
            } else {
                try {
                    $allLinks = $this->db->executeSQL("SELECT * FROM Class_Teachers;", []);
                    $unique = true;
                    foreach ($allLinks as $link) {
                        if ($link['class_id'] == $_POST['class_id'] && $link['teacher_id'] == $_POST['teacher_id']) $unique = false;
                    }
                    if ($unique) {
                        $this->db->executeSQL("INSERT INTO Class_Teachers(class_id, teacher_id) VALUES(:class_id, :teacher_id);", ['class_id' => $_POST['class_id'], 'teacher_id' => $_POST['teacher_id']]);
                        header("Location:../admin/classes");
                    } else {
                        $_SESSION['message'] = "This teacher has already been assigned to this class.";
                        header("Location:../admin/classesAssignTeacher/".$_POST['class_id']);
                    }       
                } catch(Exception $e) {
                    echo $e->getMessage();
                }
            }
        }

        public function classesUnassignTeacher($class_id, $teacher_id) {
            try {
                $this->db->executeSQL("DELETE FROM Class_Teachers WHERE class_id = :class_id AND teacher_id = :teacher_id;", ['class_id' => $class_id, 'teacher_id' => $teacher_id]);
                header("Location:../../../admin/classes");
            } catch(Exception $e) {
                echo $e->getMessage();
            }
            $this->view("admin/classesAssignTeacher", ['class' => $class, 'teachers' => $teachers]);
        }

        public function classesEdit($id) {
            try {
                $class = $this->db->executeSQL("SELECT * FROM Classes WHERE id = :id;", ['id' => $id]);
            } catch(Exception $e) {
                echo $e->getMessage();
            }
            if (!isset($_SESSION['message'])) { $_SESSION['message'] = ""; }
            $this->view("admin/classesEdit", ['class' => $class, 'message' => $_SESSION['message']]);
        }

        public function classesEditSubmit() {
            if ($_POST['name'] == null) {
                $_SESSION['message'] = "The class name cannot be empty.";
                header("Location:../admin/classesEdit/".$_POST['id']);
            } else {
                try {
                    $allClasses = $this->db->executeSQL("SELECT * FROM Classes;", []);
                    $unique = true;
                    foreach($allClasses as $class) {
                        if ($class['class_name'] == $_POST['name']) $unique = false;
                    }
                    if ($unique) {
                        $this->db->executeSQL("UPDATE Classes SET class_name = :name WHERE id = :id", ['name' => $_POST['name'], 'id' => $_POST['id']]);
                        header("Location:../admin/classes");
                    } else {
                        $_SESSION['message'] = "A class with this name already exists.";
                        header("Location:../admin/classesEdit/".$_POST['id']);
                    }
                } catch(Exception $e) {
                    echo $e->getMessage();
                }
            }
        }

        public function classesDelete($id) {
            try {
                $this->db->executeSQL("DELETE FROM Classes WHERE id = :id;", ['id' => $id]);
                header("Location:../../admin/classes");
            } catch(Exception $e) {
                echo $e->getMessage();
            }
        }
        
        public function subjects()
        {
            try {
                $subjects = $this->db->executeSQL("SELECT * FROM Subjects", []);
                $_SESSION['message'] = "";
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            $this->view("admin/subjects", ['subjects' => $subjects]);
        }

        public function subjectsCreate() {
            if (!isset($_SESSION['message'])) { $_SESSION['message'] = ""; }
            $this->view("admin/subjectsCreate", ['message' => $_SESSION['message']]);
        }

        public function subjectsCreateSubmit() {
            if ($_POST['name'] == null) {
                $_SESSION['message'] = "The subject name cannot be empty.";
                header("Location:../admin/subjectsCreate");
            } else {
                try {
                    $allSubjects = $this->db->executeSQL("SELECT * FROM Subjects;", []);
                    $unique = true;
                    foreach($allSubjects as $subject) {
                        if ($subject['subject_name'] == $_POST['name']) $unique = false;
                    }
                    if ($unique) {
                        $this->db->executeSQL("INSERT INTO Subjects(subject_name) VALUES(:name);", ['name' => $_POST['name']]);
                        header("Location:../admin/subjects");
                    } else {
                        $_SESSION['message'] = "A subject with this name already exists.";
                        header("Location:../admin/subjectsCreate");
                    }   
                } catch(Exception $e) {
                    echo $e->getMessage();
                }
            }
        }

        public function subjectsEdit($id) {
            try {
                $subject = $this->db->executeSQL("SELECT * FROM Subjects WHERE id = :id;", ['id' => $id]);;
            } catch(Exception $e) {
                echo $e->getMessage();
            }
            if (!isset($_SESSION['message'])) { $_SESSION['message'] = ""; }
            $this->view("admin/subjectsEdit", ['subject' => $subject, 'message' => $_SESSION['message']]);
        }

        public function subjectsEditSubmit() {
            if ($_POST['name'] == null) {
                $_SESSION['message'] = "The subject name cannot be empty.";
                header("Location:../admin/subjectsEdit/".$_POST['id']);
            } else {
                try {
                    $allSubjects = $this->db->executeSQL("SELECT * FROM Subjects;", []);
                    $unique = true;
                    foreach($allSubjects as $subject) {
                        if ($subject['subject_name'] == $_POST['name']) $unique = false;
                    }
                    if ($unique) {
                        $this->db->executeSQL("UPDATE Subjects SET subject_name = :name WHERE id = :id", ['name' => $_POST['name'], 'id' => $_POST['id']]);
                        header("Location:../admin/subjects");
                    } else {
                        $_SESSION['message'] = "A subject with this name already exists.";
                        header("Location:../admin/subjectsEdit/".$_POST['id']);
                    }
                } catch(Exception $e) {
                    echo $e->getMessage();
                }
            }
        }

        public function subjectsDelete($id) {
            try {
                $this->db->executeSQL("DELETE FROM Subjects WHERE id = :id;", ['id' => $id]);
                header("Location:../../admin/subjects");
            } catch(Exception $e) {
                echo $e->getMessage();
            }
        }
        
        public function teachers()
        {
            try {
                $teachers = $this->db->executeSQL("SELECT * FROM Teachers;", []);
                $subjects = $this->db->executeSQL("SELECT * FROM Subjects;", []);
                $_SESSION['message'] = "";
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            $this->view("admin/teachers", ['teachers' => $teachers, 'subjects' => $subjects]);
        }

        public function teachersCreate() {
            try {
                $subjects = $this->db->executeSQL("SELECT * FROM Subjects", []);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            if (!isset($_SESSION['message'])) { $_SESSION['message'] = ""; }
            $this->view("admin/teachersCreate", ['subjects' => $subjects, 'message' => $_SESSION['message']]);
        }

        public function teachersCreateSubmit() {
            if ($_POST['username'] == null || 
                $_POST['password'] == null ||
                $_POST['fname'] == null ||
                $_POST['mname'] == null ||
                $_POST['lname'] == null || 
                $_POST['subjectId'] == null) {
                    $_SESSION['message'] = "The username, password, first name, middle name, last name, and subject are all required to create a teacher account.";
                    header("Location:../admin/teachersCreate");
            } else {
                try {
                    $allTeachers = $this->db->executeSQL("SELECT * FROM Teachers;", []);
                    $unique = true;
                    foreach ($allTeachers as $teacher) {
                        if ($teacher['subject_id'] == $_POST['subjectId']) $unique = false;
                    }
                    if ($unique) {
                        $this->db->executeSQL("INSERT INTO Teachers(username, pass, first_name, middle_name, last_name, subject_id) VALUES(:username, :pass, :fname, :mname, :lname, :subjectId);", [':username' => $_POST['username'], ':pass' => $_POST['password'], 'fname' => $_POST['fname'], 'mname' => $_POST['mname'], 'lname' => $_POST['lname'], 'subjectId' => $_POST['subjectId']]);
                        header("Location:../admin/teachers");
                    } else {
                        $_SESSION['message'] = "A teacher for this subject already exists.";
                        header("Location:../admin/teachersCreate");
                    }
                } catch(Exception $e) {
                    echo $e->getMessage();
                }
            }
        }

        public function teachersEdit($id) {
            try {
                $subjects = $this->db->executeSQL("SELECT * FROM Subjects", []);
                $teacher = $this->db->executeSQL("SELECT * FROM Teachers WHERE id = :id;", ['id' => $id]);
            } catch(Exception $e) {
                echo $e->getMessage();
            }
            if (!isset($_SESSION['message'])) { $_SESSION['message'] = ""; }
            $this->view("admin/teachersEdit", ['teacher' => $teacher, 'subjects' => $subjects, 'message' => $_SESSION['message']]);
        }

        public function teachersEditSubmit() {
            if ($_POST['username'] == null || 
                $_POST['password'] == null ||
                $_POST['fname'] == null ||
                $_POST['mname'] == null ||
                $_POST['lname'] == null || 
                $_POST['subjectId'] == null) {
                    $_SESSION['message'] = "The username, password, first name, middle name, last name, and subject are all required to create a teacher account.";
                    header("Location:../admin/teachersEdit/".$_POST['id']);
            } else {
                try {
                    $this->db->executeSQL("UPDATE Teachers SET username = :username, pass = :pass, first_name = :fname, middle_name = :mname, last_name = :lname, subject_id = :subjectId WHERE id = :id", [':username' => $_POST['username'], ':pass' => $_POST['password'], 'fname' => $_POST['fname'], 'mname' => $_POST['mname'], 'lname' => $_POST['lname'], 'subjectId' => $_POST['subjectId'], 'id' => $_POST['id']]);
                    header("Location:../admin/teachers");
                } catch(Exception $e) {
                    echo $e->getMessage();
                }
            }
        }
        
        public function teachersDelete($id) {
            try {
                $this->db->executeSQL("DELETE FROM Teachers WHERE id = :id;", ['id' => $id]);
                header("Location:../../admin/teachers");
            } catch(Exception $e) {
                echo $e->getMessage();
            }
        }

        public function students()
        {
            try {
                $students = $this->db->executeSQL("SELECT * FROM Students;", []);
                $classes = $this->db->executeSQL("SELECT * FROM Classes;", []);
                $_SESSION['message'] = "";
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            $this->view("admin/students", ['students' => $students, 'classes' => $classes]);
        }

        public function studentsCreate() {
            try {
                $classes = $this->db->executeSQL("SELECT * FROM Classes", []);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            if (!isset($_SESSION['message'])) { $_SESSION['message'] = ""; }
            $this->view("admin/studentsCreate", ['classes' => $classes, 'message' => $_SESSION['message']]);
        }

        public function studentsCreateSubmit() {
            if ($_POST['username'] == null || 
                $_POST['password'] == null ||
                $_POST['fname'] == null ||
                $_POST['mname'] == null ||
                $_POST['lname'] == null || 
                $_POST['classId'] == null) {
                    $_SESSION['message'] = "The username, password, first name, middle name, last name, and class are all required to create a student account.";
                    header("Location:../admin/studentsCreate");
            } else {
                try {
                    $this->db->executeSQL("INSERT INTO Students(username, pass, first_name, middle_name, last_name, class_id) VALUES(:username, :pass, :first_name, :middle_name, :last_name, :class_id);", ['username' => $_POST['username'], 'pass' => $_POST['password'], 'first_name' => $_POST['fname'], 'middle_name' => $_POST['mname'], 'last_name' => $_POST['lname'], 'class_id' => $_POST['classId']]);
                    header("Location:../admin/students");
                } catch(Exception $e) {
                    echo $e->getMessage();
                }
            }
        }

        public function studentsEdit($id) {
            try {
                $classes = $this->db->executeSQL("SELECT * FROM Classes", []);
                $student = $this->db->executeSQL("SELECT * FROM Students WHERE id = :id;", ['id' => $id]);
            } catch(Exception $e) {
                echo $e->getMessage();
            }
            if (!isset($_SESSION['message'])) { $_SESSION['message'] = ""; }
            $this->view("admin/studentsEdit", ['student' => $student, 'classes' => $classes, 'message' => $_SESSION['message']]);
        }

        public function studentsEditSubmit() {
            if ($_POST['username'] == null || 
                $_POST['password'] == null ||
                $_POST['fname'] == null ||
                $_POST['mname'] == null ||
                $_POST['lname'] == null || 
                $_POST['classId'] == null) {
                    $_SESSION['message'] = "The username, password, first name, middle name, last name, and class are all required to create a student account.";
                    header("Location:../admin/studentsEdit/".$_POST['id']);
            } else {
                try {
                    $this->db->executeSQL("UPDATE Students SET username = :username, pass = :pass, first_name = :first_name, middle_name = :middle_name, last_name = :last_name, class_id = :class_id WHERE id = :id", [':username' => $_POST['username'], ':pass' => $_POST['password'], 'first_name' => $_POST['fname'], 'middle_name' => $_POST['mname'], 'last_name' => $_POST['lname'], 'class_id' => $_POST['classId'], 'id' => $_POST['id']]);
                    header("Location:../admin/students");
                } catch(Exception $e) {
                    echo $e->getMessage();
                }
            }
        }

        public function studentsDelete($id) {
            try {
                $this->db->executeSQL("DELETE FROM Students WHERE id = :id;", ['id' => $id]);
                header("Location:../../admin/students");
            } catch(Exception $e) {
                echo $e->getMessage();
            }
        }
    }
?>