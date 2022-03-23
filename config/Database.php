<?php

class Database {
    private $url;
    private $conn;

    function __construct() {

        $this->conn = null;
        $this->url = getenv('JAWSDB_URL');
    }

    //DB connect
    public function connect() {

        private $dbparts = parse_url($url);

        //DB parameters
        private $hostname = $dbparts['host'];
        private $username = $dbparts['user'];
        private $password = $dbparts['pass'];
        private $db_name = ltrim($dbparts['path'],'/');

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Connection error: ' . $e->getMessage();
        }
        return $this->conn;
    }
}