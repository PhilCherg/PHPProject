<?php
    require_once("../app/core/dbHandler.php");
    class Home extends Controller {
        private $db;

        public function __construct() {
            $this->db = new DbHandler;
            session_start();
        }
        
        public function index()
        {
            $_SESSION['message'] = "";
            $this->view("home/index");
        }

        public function login() {
            if (!isset($_SESSION['message'])) { $_SESSION['message'] = ""; }
            $this->view("home/login", ['message' => $_SESSION['message']]);
        }

        public function loginSubmit() {
            if ($_POST['username'] == null || $_POST['pass'] == null) {
                $_SESSION['message'] = "Both the username and password are required to log in.";
                header("Location:../home/login");
            } else {
                if ($_POST['role'] == "student") {
                    try {
                        $user = $this->db->executeSQL("SELECT * FROM Students WHERE username = :username AND pass = :pass;", ['username' => $_POST['username'], 'pass' => $_POST['pass']]);
                        $count = count($user);
                        if ($count > 0) {
                            session_start();
                            $_SESSION['id'] = $user[0]['id'];
                            $_SESSION['access'] = "student";
                            header("Location:../student/index");
                        } else {
                            $_SESSION['message'] = "Wrong username or password.";
                            header("Location:../home/login");
                        }
                    } catch(Exception $e) {
                        echo $e->getMessage();
                    }
                } else if ($_POST['role'] == "teacher") {
                    try {
                        $user = $this->db->executeSQL("SELECT * FROM Teachers WHERE username = :username AND pass = :pass;", ['username' => $_POST['username'], 'pass' => $_POST['pass']]);
                        $count = count($user);
                        if ($count > 0) {
                            session_start();
                            $_SESSION['id'] = $user[0]['id'];
                            $_SESSION['access'] = "teacher";
                            header("Location:../teacher/index");
                        } else {
                            $_SESSION['message'] = "Wrong username or password.";
                            header("Location:../home/login");
                        }
                    } catch(Exception $e) {
                        echo $e->getMessage();
                    }
                } else if ($_POST['role'] == "admin") {
                    try {
                        $user = $this->db->executeSQL("SELECT * FROM Admins WHERE username = :username AND pass = :pass;", ['username' => $_POST['username'], 'pass' => $_POST['pass']]);
                        $count = count($user);
                        if ($count > 0) {
                            session_start();
                            $_SESSION['id'] = $user[0]['id'];
                            $_SESSION['access'] = "admin";
                            header("Location:../admin/index");
                        } else {
                            $_SESSION['message'] = "Wrong username or password.";
                            header("Location:../home/login");
                        }
                    } catch(Exception $e) {
                        echo $e->getMessage();
                    }
                } else {
                    $_SESSION['message'] = "Invalid role.";
                    header("Location:../home/login");
                }
            }
        }

        public function logout() {
            session_start();
            session_destroy();
            header("Location:../home/index");
        }
    }
?>