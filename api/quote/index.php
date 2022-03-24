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
    
   if(!empty($isId) && $crud == 'GET') {
       include('./read_single.php');
    }

    else if (!empty($isCategoryId) && !empty($isAuthorId) && $crud == 'GET') {
        include('./categoryIdAndAuthorId.php');
    }

    else if (!empty($isAuthorId) && $crud == 'GET') {
        
        include('./authorId.php');
    }

    else if (!empty($isCategoryId) && $crud == 'GET') {
      
        include('./categoryId.php');
    }

    else if ($crud == 'POST') {
        include('./create.php');
    }

    else if ($crud == 'PUT') {
        include('./update.php');
    }

    else if ($crud == 'DELETE') {
        include('./delete.php');
    }
    
    else if($crud == 'GET') {
        include('./quotes.php');
}