<?php
class Quote {
    //DB stuff
    private $conn;
    private $table = 'quotes';

    //Properties
    public $id;
    public $quote;
    public $authorId;
    public $categoryId;

    //Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    //Get categories
    public function read() {
        //Create query
        $query = 'SELECT 
                q.id,
                q.quote,
                a.author,
                c.category
            FROM 
                ' . $this->table . ' q
                LEFT JOIN authors a ON q.authorId = a.id
                LEFT JOIN categories c ON q.categoryId = c.id';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Execute query
        $stmt->execute();
        return $stmt;
    }

    //Delete quote
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

    //To read a single quote
    public function read_single() {
        //Create query
        $query = 'SELECT
                q.id,
                q.quote,
                a.author,
                c.category
            FROM
                ' . $this->table . ' q
                LEFT JOIN authors a ON q.authorId = a.id
                LEFT JOIN categories c ON q.categoryId = c.id
            WHERE q.id = :id';

        //Prepare the statement
        $stmt = $this->conn->prepare($query);

        //Bind data
        $stmt->bindParam(':id', $this->id);

        //Execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set Properties
        $this->id = $row['id'];
        $this->quote = $row['quote'];
        $this->author = $row['author'];
        $this->category = $row['category'];
    }

    //Create a quote
    public function create() {
        //Create query
        $query = 'INSERT INTO ' . $this->table . '
        SET
            id = :id,
            quote = :quote,
            authorId = :authorId,
            categoryId = :categoryId';
        
        //Prepare the statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->authorId = htmlspecialchars(strip_tags($this->authorId));
        $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

        //Bind data
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':authorId', $this->authorId);
        $stmt->bindParam(':categoryId', $this->categoryId);

        //Execute query
        if ($stmt->execute()) {
            return true;
        } 

        printf("Error: %s. \n", $stmt->error);
        return false;
    }

    //Update a quote
    public function update() {
        //Create query
        $query = 'UPDATE ' . $this->table . '
        SET
            id = :id,
            quote = :quote,
            authorId = :authorId,
            categoryId = :categoryId
        WHERE id = :id';

        //Prepare the statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->authorId = htmlspecialchars(strip_tags($this->authorId));
        $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

        //Bind data
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':authorId', $this->authorId);
        $stmt->bindParam(':categoryId', $this->categoryId);

        //Execute query
        if ($stmt->execute()) {
            return true;
        } 

        printf("Error: %s. \n", $stmt->error);
        return false;
    }

    //Get quotes by authorId
    public function getQuotesByAuthorId() {
        //Create query
        $query = 'SELECT 
                q.id,
                q.quote,
                a.author,
                c.category
        FROM
            ' . $this->table . ' q
            LEFT JOIN authors a ON q.authorId = a.id
            LEFT JOIN categories c ON q.categoryId = c.id
        WHERE q.authorId = :authorId';

        //Prepare the statement
        $stmt = $this->conn->prepare($query);
        
        //Bind data
        $stmt->bindParam(':authorId', $this->authorId);

        //Execute query
        $stmt->execute();  
        return $stmt;
    }

    //Get quotes by an ategoryId
    public function getQuotesByCategoryId() {
        //Create query
        $query = 'SELECT 
                q.id,
                q.quote,
                a.author,
                c.category
        FROM
            ' . $this->table . ' q
            LEFT JOIN authors a ON q.authorId = a.id 
            LEFT JOIN categories c ON q.categoryId = c.id
        WHERE q.categoryId = :categoryId';

        //Prepare the statement
        $stmt = $this->conn->prepare($query);
    
        //Bind data
        $stmt->bindParam(':categoryId', $this->categoryId);
        
        //Execute query
        $stmt->execute();  
        return $stmt;
    }

    //Get quotes by authorId and categoryId
    public function getQuotesByAuthorIdAndCategoryId() {
        //Create query
        $query = 'SELECT 
                q.id,
                q.quote,
                a.author,
                c.category
        FROM
            ' . $this->table . ' q
            LEFT JOIN authors a ON q.authorId = a.id
            LEFT JOIN categories c ON q.categoryId = c.id
        WHERE q.authorId = :authorId && q.categoryId = :categoryId' ;

        //Prepare the statement
        $stmt = $this->conn->prepare($query);
    
        //Bind data
        $stmt->bindParam(':authorId', $this->authorId);
        $stmt->bindParam(':categoryId', $this->categoryId);

        //Execute query
        $stmt->execute();
        return $stmt;
    }
}