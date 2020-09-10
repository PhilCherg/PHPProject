<?php
    class Student {
        public $id;
        public $username;
        public $firstName;
        public $middleName;
        public $lastName;
        public $classId;
        public $grades = [];

        function __construct($params) {
            $id = $params['id'];
            $username = $params['username'];
            $firstName = $params['fname'];
            $middleName = $params['mname'];
            $lastName = $params['lname'];
            $classId = $params['classId'];
        }

        public function addGrade($assignment) {

        }
    }
?>