<?php
// include database and object files
include_once 'database/database.php';
include_once 'objects/clothe.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$clothe = new Clothe($db);

// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of product to be edited
$clothe->clothe_id = $data->clothe_id;

// read the details of product to be edited
$clothe->readOne();

// create array
$clothe_arr[] = array(
	"clothe_id" =>  $clothe->clothe_id,
	"type" => $clothe->type,
	"color" => $clothe->color,
	"price" => $clothe->price
);

// make it json format
print_r(json_encode($clothe_arr));
?>
