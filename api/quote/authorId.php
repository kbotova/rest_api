<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Quote.php';
include_once '../../models/Author.php';

//Instantiate DB and connect
$database = new Database();
$db = $database->connect();

//Instantiate quote object
$quote = new Quote($db);

$quote->authorId = isset($_GET['authorId']) ? $_GET['authorId'] : die();

$result = $quote->getQuotesByAuthorID();

$num = $result->rowCount();

if ($num > 0) {
    $quote_arr = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $quotes = array('quote' => html_entity_decode($quote), 'category' => $category, 'id' => $id, 'author' => $author);
        array_push($quote_arr, $quotes);
    }
    print_r(json_encode($quote_arr));
} else {
    echo json_encode(array('message' => 'No Quotes Found'));
}