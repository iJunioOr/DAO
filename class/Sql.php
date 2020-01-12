<?php

	class Sql extends PDO {

		private $conn;

		public function __construct(){

			// echo "class Construct <br>";


			$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7","root","");

		}

		private function setParams($statement, $parameters = array()){

			// echo "class setParams <br>";


			foreach ($parameters as $key => $value) {

				$this->setParam($statement,$key,$value);

				
			}	

		}

		private function setParam($statement,$key,$value){

			// echo "class setParam <br>";


			$statement->bindParam($key, $value);

		}

		public function query($rawQuery, $params = array()){

			// echo "class query <br>";
			// echo "class $rawQuery <br>";
			// var_dump($params);



			$stmt = $this->conn->prepare($rawQuery);

			$this->setParams($stmt, $params);

			$stmt->execute();

			return $stmt; 


		}

		public function select($rawQuery,$params = array()):array
		{

			// echo "class select <br>";
			// echo "class $rawQuery <br>";
			// var_dump($params);


			$stmt = $this->query($rawQuery, $params);

			return $stmt->fetchAll(PDO::FETCH_ASSOC);




		}

	}

?>