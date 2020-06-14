<?php 

class sql extends PDO{

	private $conn;

	public function __construct(){

		$this->conn = new PDO("sqlsrv:Database=ddbphp7;Server=localhost;ConnectionPooling=0", "sa", "root");

	}

	public function setParams($statmens, $parameters = array()){

		foreach ($parameters as $key => $value){

			$this->setParam($statements, $key,$value);

			
		}

	}

	public function setParam($statmen, $key, $value){

		$statmen->bindParam($key, $value);
	}

	public function query($rawQuery,$params = array()){

		$stmt = $this->conn->prepare($rawQuery);
		
		$this->setParam($stmt, $params);

		$stmt->execute();

		return $stmt;
	}

	public function select($rawQuery,$params = array()): array{

		$stmt = $this->query($rawQuery, $params);
		
		return $stmt->fetchAll(PDO::FETCH_ASSOC);


	}
}

 ?>