<?php
class Category {
    //DB stuff
    private $conn;
    private $table = 'categories';

    //Properties
    public $id;
    public $category;

    //Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    //Get categories
    public function read() {
        //Create query
        $query = 'SELECT 
                id, 
                category
            FROM
                ' . $this->table . '';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Execute query
        $stmt->execute();

        return $stmt;
    }

    //Delete post
    public function delete() {
        //Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        
        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        //Bind data
        $stmt->bindParam(':id', $this->id);

        //Execute query
        if ($stmt->execute()) {
            return true;
        }

        //Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}