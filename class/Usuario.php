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

				$this->setData($results[0]);

			}

		}

		public static function getList(){

			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios ORDER BY desLogin;");

		}

		public static function search($login){

			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios WHERE desLogin LIKE :SEARCH ORDER BY desLogin",array(
				':SEARCH'=>"%".$login."%"

			));
		}

		public function login($login,$pass){

			$sql = new Sql();

			$results = $sql->select("SELECT * FROM tb_usuarios WHERE desLogin = :LOGIN AND desSenha = :PASS", array(

				":LOGIN"=>$login,
				":PASS"=>$pass

			));

			if(count($results) > 0) {

				$this->setData($results[0]);

			} else {

				throw new Exception("Login e/ou senhas invalidos.", 1);
				

			}

		}

		public function setData($data){

			$this->setIDUsuario($data['idUsuario']);
			$this->setDesLogin($data['desLogin']);
			$this->setDesSenha($data['desSenha']);
			$this->setDTCadastro(new DateTime($data['dtCadastro']));		

		}

		public function insert(){

			$sql = new Sql();

			$results = $sql->select("CALL sp_usuarios_insert(:LOGIN,:PASS)",array(
				':LOGIN'=>$this->getDesLogin(),
				':PASS'=>$this->getDesSenha()

			));

			if(count($results) > 0){

				$this->setData($results[0]);

			}

		}

		public function update($login,$pass){

			$this->setDesLogin($login);
			$this->setDesSenha($pass);


			$sql = new Sql();

			$sql->query("UPDATE tb_usuarios SET desLogin = :LOGIN, desSenha = :PASS WHERE idUsuario = :ID",array(

				':LOGIN'=>$this->getDesLogin(),
				':PASS'=>$this->getDesSenha(),
				':ID'=>$this->getIDUsuario()

			));

		}

		public function delete(){

			$sql = new Sql();

			$sql->query("DELETE FROM tb_usuarios WHERE idUsuario = :ID",array(

				':ID'=>$this->getIDUsuario()

			));

			$this->setIDUsuario(0);
			$this->setDesLogin("");
			$this->setDesSenha("");
			$this->setDTCadastro(new DateTime());

		}

		public function __construct($login = "",$pass = ""){

			$this->setDesLogin($login);
			$this->setDesSenha($pass);

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