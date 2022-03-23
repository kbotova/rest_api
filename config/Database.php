<?php

public function __construct($db) {
    $this->conn = $db;
}

class Database {
    $url = getenv('JAWSDB_URL');
    $dbparts = parse_url($url);
    
    //DB parameters
    private $host = $dbparts['host'];
    private $db_name = ltrim($dbparts['path'],'/');
    private $username = $dbparts['user'];
    private $password = $dbparts['pass'];
    private $conn;

    //DB connect
    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname= ' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Connection error: ' . $e->getMessage();
        }
        return $this->conn;
    }
}