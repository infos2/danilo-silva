<?php

class DBHandler {


	private function getConnection() {
		

		try {

		    $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");

		    return $mng;

		} catch (MongoDB\Driver\Exception\Exception $e) {
		    
		    return Array($e->getMessage(), $e->getFile(), $e->getLine());       
		}
	}

	public function insert() {
		$conn = $this->getConnection();
		$bulk = new MongoDB\Driver\BulkWrite;
		$doc = ['_id' => new MongoDB\BSON\ObjectID, 'name' => 'cebola', 'price' => 40];

		$bulk->insert($doc);
		$conn->executeBulkWrite("test.teste",$bulk);
	}

	public function search() {
		$conn = $this->getConnection();
		$query = new MongoDB\Driver\Query([], []);
		$rows = $conn->executeQuery("test.teste", $query);
		$result = Array();
		foreach ($rows as $row) {
    
        array_push($result, $row);
    }
		return json_encode($result);
	}



}