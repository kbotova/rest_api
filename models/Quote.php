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
                LEFT JOIN authors a 
                ON q.authorId = a.id
                LEFT JOIN category c
                ON q.categoryId = c.id';

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

    //To read a single quote
    public function read_single() {
    $query = 'SELECT
    q.id,
    q.quote,
    a.author,
    c.category
    From
    ' . $this->table . ' q
    LEFT JOIN authors a 
    ON
    q.authorId = a.id
    LEFT JOIN category c
    ON
    q.categoryId = c.id
    WHERE 
    q.id = :id';

    //Prepare the statment
    $stmt = $this->conn->prepare($query);

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

//Get all quotes by an author ID
public function getQuotesByAuthorID() {
    
    $query = 'SELECT 
     q.id,
    q.quote,
    a.author,
    c.category
    From
    ' . $this->table . ' q
    LEFT JOIN authors a 
    ON
    q.authorId = a.id
    LEFT JOIN category c
    ON
    q.categoryId = c.id
    WHERE 
    q.authorId = :authorId';

    // prepare
    $stmt = $this->conn->prepare($query);
    
    // Execute
    $stmt->bindParam(':authorId', $this->authorId);
   
    // $stmt->bindParam(':id', $this->id);
    // $stmt->bindParam(':author', $this->author);

    $stmt->execute();    
 return $stmt;

}

public function getQuotesByCategoryId() {
    
    $query = 'SELECT 
    q.id,
    q.quote,
    a.author,
    c.category
    FROM
    ' . $this->table . ' q
   LEFT JOIN authors a
   ON 
   q.authorId = a.id 
   LEFT JOIN category c ON  
   q.categoryId = c.id
    WHERE
    q.categoryId = :categoryId';

    // prepare
    $stmt = $this->conn->prepare($query);
    
    // Execute 
    $stmt->bindParam(':categoryId', $this->categoryId);

    $stmt->execute();    
 return $stmt;

}

// Start get quotes by author and category ID
public function getQuotesByAuthorIdAndCategoryId() {
    
    $query = 'SELECT 
    q.id,
    q.quote,
    a.author,
    c.category
    FROM
    ' . $this->table . ' q
   LEFT JOIN authors a 
   ON  
   q.authorId = a.id
   LEFT JOIN 
   category c
   ON 
   q.categoryId = c.id
    WHERE
      q.authorId = :authorId && q.categoryId = :categoryId' ;

    // prepare
    $stmt = $this->conn->prepare($query);
    
    // Execute 
    $stmt->bindParam(':authorId', $this->authorId);
    $stmt->bindParam(':categoryId', $this->categoryId);

    $stmt->execute();    
 return $stmt;

}

//Create a quote
public function create() {
    $query = 'INSERT INTO ' . 
    $this->table . '
    SET
     id = :id,
     quote = :quote,
     authorId = :authorId,
     categoryId = :categoryId';

   $stmt = $this->conn->prepare($query);

    $this->id = htmlspecialchars(strip_tags($this->id));
    $this->quote = htmlspecialchars(strip_tags($this->quote));
    $this->authorId = htmlspecialchars(strip_tags($this->authorId));
    $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

    $stmt->bindParam(':id', $this->id);
    $stmt->bindParam(':quote', $this->quote);
    $stmt->bindParam(':authorId', $this->authorId);
    $stmt->bindParam(':categoryId', $this->categoryId);

    if($stmt->execute()) {
        return true;
 
    } 

    printf("Error: %s. \n", $stmt->error);
    return false;
    
}

//Update a quote

public function update() {
    $query = 'UPDATE ' . 
    $this->table . '
    SET
     id = :id,
     quote = :quote,
     authorId = :authorId,
     categoryId = :categoryId
     WHERE 
     id = :id';

   $stmt = $this->conn->prepare($query);

    $this->id = htmlspecialchars(strip_tags($this->id));
    $this->quote = htmlspecialchars(strip_tags($this->quote));
    $this->authorId = htmlspecialchars(strip_tags($this->authorId));
    $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

    $stmt->bindParam(':id', $this->id);
    $stmt->bindParam(':quote', $this->quote);
    $stmt->bindParam(':authorId', $this->authorId);
    $stmt->bindParam(':categoryId', $this->categoryId);

    if($stmt->execute()) {
        return true;
    } 

    printf("Error: %s. \n", $stmt->error);
    return false;
    
}


}