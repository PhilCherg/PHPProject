<?php
    class Assignment {
        public $id;
        public $name;
        public $grade;
        public $subjectId;
        public $studentId;

        function __construct($params) {
            $id = $params['id'];
            $name = $params['name'];
            $grade = $params['grade'];
            $subjectId = $params['subjectId'];
            $studentId = $params['studentId'];
        }
    }
?>