<?php

	class Usuario {

		private $idUsuario;
		private $desLogin;
		private $desSenha;
		private $dtCadastro;

		public function getIDUsuario(){

			return $this->idUsuario;

		}

		public function setIDUsuario($value){

			$this->idUsuario = $value;

		}
		
		//

		public function getDesLogin(){

			return $this->desLogin;

		}

		public function setDesLogin($value){

			$this->desLogin = $value;

		}

		//
		
		public function getDesSenha(){

			return $this->desSenha;

		}

		public function setDesSenha($value){

			$this->desSenha = $value;

		}

		//
		
		public function getDTCadastro(){

			return $this->dtCadastro;

		}

		public function setDTCadastro($value){

			$this->dtCadastro = $value;

		}

		public function loadById($id){

			$sql = new Sql();

			$results = $sql->select("SELECT * FROM tb_usuarios WHERE idUsuario = :ID", array(

				":ID"=>$id

			));

			if(count($results) > 0) {

				$row = $results[0];

				$this->setIDUsuario($row['idUsuario']);
				$this->setDesLogin($row['desLogin']);
				$this->setDesSenha($row['desSenha']);
				$this->setDTCadastro(new DateTime($row['dtCadastro']));

			}

		}

		public function __toString(){

			return json_encode(array(
					"idUsuario"=>$this->getIDUsuario(),
					"desLogin"=>$this->getDesLogin(),
					"desSenha"=>$this->getDesSenha(),
					"dtCadastro"=>$this->getDTCadastro()->format("d/m/Y H:i:s")


			));

		}		

	}	



?>