<?php
// include database and object file
include_once 'database/database.php';
include_once 'objects/clothe.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$clothe = new Clothe($db);

// get product id
$data = json_decode(file_get_contents("php://input"));

// set product id to be deleted
$clothe->clothe_id = $data->clothe_id;

// delete the product
if($clothe->delete()){
	echo "Product was deleted.";
}

// if unable to delete the product
else{
	echo "Unable to delete object.";
}
?>
