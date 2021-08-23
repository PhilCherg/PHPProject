<?php
    class DbHandler {
        private $db;

        function __construct() {
            try {
                $this->db = new PDO("sqlite:../database.sqlite");
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        function executeSQL($sql, $params) {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll();
        }
    } 
?>

