<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Quote.php';
include_once '../../models/Author.php';
include_once '../../models/Category.php';


$database = new Database();
$db = $database->connect();


$quote = new Quote($db);

// get data

$data = json_decode(file_get_contents("php://input"));

$quote->delete();

$quote->id = $data->id;
// delete the post itself 




if($quote->id !== null) {
    echo json_encode(
        array('id' =>  $quote->id));
} 
else {
    echo json_encode(
        array('message' => 'No Quotes Found') 
    );
}