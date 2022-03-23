<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Author.php';

//Instantiate DB and connect
$database = new Database();
$db = $database->connect();

//Instantiate author object
$author = new Author($db);

$author->id = isset($_GET['id']) ? $_GET['id'] : die();

$author->read_single();

$author_arr = array('id' => $author->id, 'author' => $author->author);

if ($author->id !== null) {
    print_r(json_encode($author_arr));
} else {
    echo json_encode(array('message' => 'authorId Not Found'));
}