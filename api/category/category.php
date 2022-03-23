<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

//Instantiate DB and connect
$database = new Database();
$db = $database->connect();

//Instantiate category object
$category = new Category($db);

$result = $category->read();

$num = $result->rowCount();

if ($num > 0) {
    $cat_arr = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $category_item = array( 
            'id' => $id,
            'category' => $category   
        );
        array_push($cat_arr, $category_item);
    }
    print_r(json_encode($cat_arr));
} else {
    echo json_encode(array('message' => 'No Categories Are Found'));
}