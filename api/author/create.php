<?php
//Header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Author.php';

//Instantiate DB and connect
$database = new Database();
$db = $database->connect();

//Instantiate author object
$author = new Author($db);

$data = json_decode(file_get_contents("php://input"));

if ($author->create()) { 
    echo json_encode(array('id' => $db->lastInsertId(), 'author' => $author->author));
}