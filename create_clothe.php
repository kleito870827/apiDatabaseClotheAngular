<?php
// get database connection
include_once 'database/database.php';

$database = new Database();
$db = $database->getConnection();

// instantiate product object
include_once 'objects/clothe.php';
$clothe = new Clothe($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set product property values
$clothe->type = $data->type;
$clothe->color = $data->color;
$clothe->price = $data->price;


// create the product
if($clothe->create()){
	echo "Product was created.";
}

// if unable to create the product, tell the user
else{
	echo "Unable to create product.";
}
?>
