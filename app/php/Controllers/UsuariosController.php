<?php

include '../Conexao.php';
include '../Models/DAO.php';
include '../Models/Usuarios.php';

$op = $_GET["op"];
$dados = json_decode(file_get_contents('php://input'));
$usuarios = new Usuarios();

switch ($op) {
	case 'validarLogin':
		echo json_encode($usuarios->validarLogin($dados));
		break;

	case 'cadastrarUsuario':
		echo $usuarios->cadastrarUsuario($dados);
		break;

	case 'buscarUsuarios':
		echo json_encode($usuarios->buscarUsuarios());
		break;
  }
