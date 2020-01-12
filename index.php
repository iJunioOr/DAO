<?php

	require_once ("config.php");

	// $sql = new Sql();

	// $usuarios = $sql->select("SELECT * FROM tb_usuarios");

	// echo json_encode($usuarios);


	//---Carrega um usuario
	// $user = new Usuario();
	// $user->loadById(1);
	// echo $user;

	//---Carrega uma lista de usuarios
	// $lista = Usuario::getList();
	// echo json_encode($lista);

	//---Carrega uma lista de usuarios buscando pelo login
	// $search = Usuario::search("m");
	// echo json_encode($search);

	//---Carrega um usuario usando login e a senha
	$usuario = new Usuario();
	$usuario->login("iJunioOr","123456");

	echo $usuario;
?>