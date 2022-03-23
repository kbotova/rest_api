<?php 
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    $method = $_SERVER['REQUEST_METHOD'];
    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    }

    $isId = filter_input(INPUT_GET, "id");
    $isAuthorId = filter_input(INPUT_GET, "authorId");
    $isCategoryId = filter_input(INPUT_GET, "categoryId");
    
   if(!empty($isId) && $method == 'GET') {
       include('./read_single.php');
    }

    else if (!empty($isCategoryId) && !empty($isAuthorId) && $method == 'GET') {
        include('./categoryIdAndAuthorId.php');
    }

    else if (!empty($isAuthorId) && $method == 'GET') {
        
        include('./authorID.php');
    }

    else if (!empty($isCategoryId) && $method == 'GET') {
      
        include('./categoryId.php');
    }

    else if ($method == 'POST') {
        include('./create.php');
    }

    else if ($method == 'PUT') {
        include('./update.php');
    }

    else if ($method == 'DELETE') {
        include('./delete.php');
    }
    
    else if($method == 'GET') {
        include('./quotes.php');
}