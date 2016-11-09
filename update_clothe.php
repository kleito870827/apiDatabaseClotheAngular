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

// set product property values
$clothe->type = $data->type;
$clothe->color = $data->color;
$clothe->price = $data->price;

// update the product
if($clothe->update()){
	echo "Product was updated.";
}

// if unable to update the product, tell the user
else{
	echo "Unable to update product.";
}
?>
