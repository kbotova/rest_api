<?php
class Author {
    //DB stuff
    private $conn;
    private $table = 'authors';

    //Properties
    public $id;
    public $author;

    //Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    //Get authors
    public function read() {
        //Create query
        $query = 'SELECT 
                id, 
                author
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

    // To get single author by ID
public function read_single() {
    $query = 'SELECT
    id,
    author
   
    From
    ' . $this->table . '
    WHERE 
    id = ?
    LIMIT 0,1';

    // prepare the statment
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(1, $this->id);

    // execute query

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Set Properties

    $this->id = $row['id'];
    $this->author = $row['author'];
 
}
//  end of get single author by id


// create or post new author

public function create() {
    $query = 'INSERT INTO ' . $this->table . '
    SET
    id = :id,
    author = :author';
    // above uses named parameters

    // prepare 
    $stmt = $this->conn->prepare($query);

    $this->id = htmlspecialchars(strip_tags($this->id));
    $this->author = htmlspecialchars(strip_tags($this->author));

    $stmt->bindParam(':id', $this->id);
    $stmt->bindParam(':author', $this->author);

    


    if($stmt->execute()) {
        return true;
    } 

   

    printf("Error: %s. \n", $stmt->error);
    return false;
    }
    // -----------------------

    // Delete author

public function update() {
    $query = 'UPDATE ' . $this->table . '
    SET
    id = :id,
    author = :author
    WHERE
    id = :id'
    ;
    // above uses named parameters

    // prepare 
    $stmt = $this->conn->prepare($query);

    $this->id = htmlspecialchars(strip_tags($this->id));
    $this->author = htmlspecialchars(strip_tags($this->author));

    $stmt->bindParam(':id', $this->id);
    $stmt->bindParam(':author', $this->author);

    if($stmt->execute()) {
        return true;
    } 

    printf("Error: %s. \n", $stmt->error);
    return false;
    }
}