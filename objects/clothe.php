<?php
class Clothe{

	// database connection and table name
	private $conn;
	private $table_name = "clothes";

	// object properties
	public $clothe_id;
	public $type;
	public $color;
	public $price;

	// constructor with $db as database connection
	public function __construct($db){
		$this->conn = $db;
	}

	// create product
	function create(){

		// query to insert record
		$query = "INSERT INTO
					" . $this->table_name . "
				SET
					type=:type, color=:color, price=:price";

		// prepare query
		$stmt = $this->conn->prepare($query);

		// sanitize
		$this->type=htmlspecialchars(strip_tags($this->type));
		$this->color=htmlspecialchars(strip_tags($this->color));
		$this->price=htmlspecialchars(strip_tags($this->price));

		// bind values
		$stmt->bindParam(":type", $this->type);
		$stmt->bindParam(":color", $this->color);
		$stmt->bindParam(":price", $this->price);

		// execute query
		if($stmt->execute()){
			return true;
		}else{
			echo "<pre>";
				print_r($stmt->errorInfo());
			echo "</pre>";

			return false;
		}
	}

	// read products
	function readAll(){

		// select all query
		$query = "SELECT
					clothe_id, type, color, price
				FROM
					" . $this->table_name . "
				ORDER BY
					clothe_id DESC";

		// prepare query statement
		$stmt = $this->conn->prepare( $query );

		// execute query
		$stmt->execute();

		return $stmt;
	}

	// used when filling up the update product form
	function readOne(){

		// query to read single record
		$query = "SELECT
					type, color, price
				FROM
					" . $this->table_name . "
				WHERE
					clothe_id = ?
				LIMIT
					0,1";

		// prepare query statement
		$stmt = $this->conn->prepare( $query );

		// bind id of product to be updated
		$stmt->bindParam(1, $this->clothe_id);

		// execute query
		$stmt->execute();

		// get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		// set values to object properties
		$this->type = $row['type'];
		$this->color = $row['color'];
		$this->price = $row['price'];
	}

	// update the product
	function update(){

		// update query
		$query = "UPDATE
					" . $this->table_name . "
				SET
					type = :type,
					color = :color,
					price = :price
				WHERE
					clothe_id = :clothe_id";

		// prepare query statement
		$stmt = $this->conn->prepare($query);

		// sanitize
		$this->type=htmlspecialchars(strip_tags($this->type));
		$this->color=htmlspecialchars(strip_tags($this->color));
		$this->price=htmlspecialchars(strip_tags($this->price));

		// bind new values
		$stmt->bindParam(':type', $this->type);
		$stmt->bindParam(':color', $this->color);
		$stmt->bindParam(':price', $this->price);
		$stmt->bindParam(':clothe_id', $this->clothe_id);

		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	// delete the product
	function delete(){

		// delete query
		$query = "DELETE FROM " . $this->table_name . " WHERE clothe_id = ?";

		// prepare query
		$stmt = $this->conn->prepare($query);

		// sanitize
		$this->clothe_id=htmlspecialchars(strip_tags($this->clothe_id));

		// bind id of record to delete
		$stmt->bindParam(1, $this->clothe_id);

		// execute query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

}
?>
