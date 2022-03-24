<?php 
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../check/fail.php';
include_once '../check/missing.php';


$crud = $_SERVER['REQUEST_METHOD'];
if ($crud === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
}

$isId = filter_input(INPUT_GET, "id");

if (isset($isId) && $crud == 'GET') {
    include('./read_single.php');
} 

else if ($crud == 'GET') {
    include('./author.php');
} 

else if ($crud == 'PUT') {
    include('./update.php');
}

else if ($crud == 'DELETE') {
    include('./delete.php');
}

if ($crud == 'POST') {
    include('./create.php');
}