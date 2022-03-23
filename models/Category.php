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

    //Get category
    public function read_single() {
        //Create query
        $query = 'SELECT
                id,
                category
            FROM 
                ' . $this->table . '
            WHERE id = ? LIMIT 0,1';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Bind data
        $stmt->bindParam(1, $this->id);
    
        //Execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $this->id = $row['id'];
        $this->category = $row['category'];    
    }

    //Create a category
    public function create() {
        //Create query
        $query = 'INSERT INTO ' . $this->table . '
            SET
                id = :id,
                category = :category';
    
        //Prepare statement
        $stmt = $this->conn->prepare($query);
    
        //Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->category = htmlspecialchars(strip_tags($this->category));
    
        //Bind data
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':category', $this->category);
      
        //Execute query
        if ($stmt->execute()) {
            return true;
        }
    
        printf("Error: %s. \n", $stmt->error);
        return false;
    }

    //Update a category
    public function update() {
        //Create query
        $query = 'UPDATE ' . $this->table . '
            SET
                id = :id,
                category = :category
            WHERE id = :id';
    
        //Prepare statement
        $stmt = $this->conn->prepare($query);
    
        //Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->category = htmlspecialchars(strip_tags($this->category));
    
        //Bind data
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':category', $this->category);
    
        //Execute query
        if ($stmt->execute()) {
            return true;
        } 
    
        printf("Error: %s. \n", $stmt->error);
        return false;
    }
}