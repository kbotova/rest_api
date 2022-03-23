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

    public function read_single() {
        $query = 'SELECT
        id,
        category
        
        FROM 
        ' . $this->table . '
        WHERE
        id = ?
        LIMIT 0,1';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);
    
        // execute query
    
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    

        $this->id = $row['id'];
        $this->category = $row['category'];
        
    }
    // end of single category model


    // Start of create new category
    public function create() {
        $query = 'INSERT INTO ' . $this->table . '
        SET
        id = :id,
        category = :category';
        // above uses named parameters
    
        // prepare 
        $stmt = $this->conn->prepare($query);
    
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->category = htmlspecialchars(strip_tags($this->category));
    
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':category', $this->category);
      
        
       if($stmt->execute()) {
        
          
            return true;
        }
    
        printf("Error: %s. \n", $stmt->error);
        return false;
        }


        // --------------------------
    // Start of update new category
    public function update() {
        $query = 'UPDATE ' . $this->table . '
        SET
        id = :id,
        category = :category
        WHERE id = :id';
        // above uses named parameters
    
        // prepare 
        $stmt = $this->conn->prepare($query);
    
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->category = htmlspecialchars(strip_tags($this->category));
    
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':category', $this->category);
    
        if($stmt->execute()) {
            return true;
        } 
    
        printf("Error: %s. \n", $stmt->error);
        return false;
        }

}