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

$data = json_decode(file_get_contents("php://input"));

$category->id = $data->id;
$category->category = $data->category;

if ($category->update()) {
    echo json_encode(array('id' => $category->id, 'category' => $category->category));
} else {
    echo json_encode(array('message' => 'Category Not Updated'));
}