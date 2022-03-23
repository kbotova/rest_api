<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Author.php';

//Instantiate DB and connect
$database = new Database();
$db = $database->connect();

//Instantiate author object
$author = new Author($db);

$data = json_decode(file_get_contents("php://input"));

//Update Id
$author->id = $data->id;
$author->author = $data->author;

if ($author->update()) {
    echo json_encode(array('id' => $author->id, 'author' => $author->author));
}